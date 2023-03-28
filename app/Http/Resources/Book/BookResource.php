<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Genre\GenreResource;
use App\Http\Resources\Writer\WriterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'book';

    public function toArray($request)
    {
        return [
            'title' => $this->resource->title,
            'writer' => new WriterResource($this->resource->writer),
            'abstract' => $this->resource->abstract,
            'genre' => new GenreResource($this->resource->genre),
            'published in' => $this->resource->year,
        ];
    }
}
