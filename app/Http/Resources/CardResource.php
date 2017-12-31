<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Task;

class CardResource extends Resource
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
            'id'    => $this->id,
            'name'  => $this->name,
            'items' => TaskResource::collection($this->tasks)
        ];
    }
}
