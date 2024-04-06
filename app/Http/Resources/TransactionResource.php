<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'transactions' => [
                '0to5000' => $this->count_0_to_5000,
                '5000to10000' => $this->count_5000_to_10000,
                '10000to100000' => $this->count_10000_to_100000,
                '100000toup' => $this->count_10000_to_up
            ],
            'summary' => [
                'amount' => $this->amount,
                'web_count' => $this->web_count,
                'pos_count' => $this->pos_count,
                'mobile_count'=>  $this->mobile_count,
            ],
        ];
    }
}
