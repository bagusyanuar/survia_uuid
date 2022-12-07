<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sec extends UuidModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
    ];

    protected $casts = [
        'start' => 'integer',
        'end' => 'integer',
    ];

}
