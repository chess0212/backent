<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_text',
        'question_type',
        'options',

    ];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
