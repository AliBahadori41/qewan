<?php

namespace App\Traits;

use App\Enums\EventBonusEnums;
use App\Models\InvoicedUsers;
use App\Models\Session;
use Illuminate\Database\Eloquent\Builder;

trait InvoiceableTrait
{
    public $start_date;

    public $end_date;

    public $invoiceable_users;

    /**
     * Prepare the invoice details.
     *
     * @param string $start
     * @param string $end
     * @return \App\Models\Invoice
     */
    public function createInvoice(string $start, string $end)
    {
        $this->start_date = $start;

        $this->end_date = $end;

        $this->checkEvent();

        if ($this->invoiceable_users->isNotEmpty()) {

            $invoice = $this->invoices()->create([
                'total_price' => $this->invoiceable_users->sum('sar')
            ]);

            $invoice->users()->syncWithoutDetaching($this->invoiceable_users);

            $invoiced_events = $this->getInvoicedEvents();

            $invoice->events()->createMany($invoiced_events);

            return $invoice;
        }
    }

    /**
     * Check user event to create invoice.
     *
     * @return void
     */
    public function checkEvent()
    {
        $this->invoiceable_users = collect();

        $check_date = [$this->start_date, $this->end_date];

        $this->users()->whereBetween('created_at', $check_date)
            ->whereDoesntHave('sessions', function (Builder $query) use ($check_date) {
                $query->whereBetween('appointment', $check_date)
                    ->orWhereBetween('activited', $check_date);
            })
            ->each(function ($user) {

                if (!$this->eventInvoicedAlready($user, 'registration')) {

                    $this->invoiceable_users->push([
                        'user_id' => $user->id,
                        'invoice_for' => 'registration',
                        'date' => $user->created_at,
                        'sar' => EventBonusEnums::REGISTRATION()
                    ]);
                }
            });

        //get customer's users
        $user_ids = $this->users()->pluck('id')->toArray();

        Session::whereIn('user_id', $user_ids)
            ->whereBetween('appointment', $check_date)
            ->orWhereBetween('activited', $check_date)
            ->groupBy('user_id')
            ->each(function ($session) use ($check_date) {

                $hasAppointment = $this->hasAppointment($session, $check_date);

                if ($hasAppointment) {
                    if (! $this->eventInvoicedAlready($session, 'appointment')) {
                        $this->invoiceable_users->push([
                            'user_id' => $hasAppointment->user_id,
                            'invoice_for' => 'appointment',
                            'date' => $hasAppointment->appointment,
                            'sar' => $this->calculateSAR($session, EventBonusEnums::APPOINTMENT()),
                        ]);
                    }
                } else  {

                    if (! $this->eventInvoicedAlready($session, 'activation')) {
                        $this->invoiceable_users->push([
                            'user_id' => $session->user_id,
                            'invoice_for' => 'activation',
                            'date' => $session->activited,
                            'sar' => $this->calculateSAR($session, EventBonusEnums::ACTIVATION()),
                        ]);
                    }
                }
            });
    }


    /**
     * Calculates the SAR for the given session and user.
     *
     * @param \App\Models\Session $session
     * @param int $sar
     * @return void
     */
    public function calculateSAR($session, $sar)
    {
        $invoiced_event = InvoicedUsers::where('user_id', $session->user_id)->first();

        if ($invoiced_event) {
            $calc = $sar - $invoiced_event->sar;
        } else {
            $calc = $sar;
        }

        return $calc;
    }

    /**
     * Check if user has an appointment.
     *
     * @param \App\Models\Session $session
     * @param string $check_date
     * @return \App\Models\Session
     */
    public function hasAppointment($session, $check_date)
    {
        return Session::where('user_id', $session->user_id)->whereBetween('appointment', $check_date)->first();
    }

    /**
     * get all invoviced events.
     *
     * @return array
     */
    public function getInvoicedEvents()
    {
        return $this->invoiceable_users->groupBy(['invoice_for'])->map(function ($item, $key) {
            return [
                'title' => $key,
                'price' => $item[0]['sar'],
            ];
        })->toArray();
    }

    /**
     * Check if given event has been invoviced.
     *
     * @param $record
     * @return bool
     */
    public function eventInvoicedAlready($record, $event = null)
    {
        $query = InvoicedUsers::query();

        if ($event == 'registration') {
            $query->where('invoice_for', $event)->where('user_id', $record->id);
        } else {
            $query->where('invoice_for', $event)->where('user_id', $record->user_id);
        }

        return $query->exists();
    }
}
