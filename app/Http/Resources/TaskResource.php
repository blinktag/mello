<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TaskResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'card_id'   => $this->card_id,
            'name'      => $this->name,
            'due_on'    => $this->due_on,
            'order_key' => $this->order_key
        ];
    }
}
