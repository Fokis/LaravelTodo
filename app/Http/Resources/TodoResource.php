<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category'    => $this->category ? $this->category->name : '',
            'cretated_at' => $this->created_at
        ];
    }
}
