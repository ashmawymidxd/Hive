<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>  str_pad($this->id, 6, '0', STR_PAD_LEFT),
            'guestName' => $this->guest->getFullName(),
            'roomNumber' => $this->room->room_number,
            'checkIn' => $this->check_in->format('Y-m-d H:i:s'),
            'checkOut' => $this->check_out->format('Y-m-d H:i:s'),
            'status' => $this->status,
            'totalAmount' => $this->amount,
        ];
    }
}    