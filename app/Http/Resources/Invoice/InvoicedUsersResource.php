<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoicedUsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'invoice_for' => $this->pivot->invoice_for,
            'sar' => $this->pivot->sar,
            'description' => __('invoiced_user_description', [
                'event' => $this->pivot->invoice_for,
                'date' => $this->pivot->date
            ])
        ];
    }
}
