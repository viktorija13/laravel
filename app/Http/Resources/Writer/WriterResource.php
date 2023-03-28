<?php

namespace App\Http\Resources\Writer;

use Illuminate\Http\Resources\Json\JsonResource;

class WriterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'writer';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'born' => $this->resource->birth,
            'from' => $this->resource->nationality,
        ];
    }
}
