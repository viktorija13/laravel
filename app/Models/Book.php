<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'abstract',
        'year',
        'writer_id',
        'genre_id'
    ];

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
