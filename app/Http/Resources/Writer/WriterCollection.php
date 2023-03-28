<?php

namespace App\Http\Resources\Writer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WriterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'writers';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
