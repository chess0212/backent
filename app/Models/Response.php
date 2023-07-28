<?php

namespace App\Models;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'question_id',
        'response_value',

        // 'response_type',
        // Ajoutez d'autres colonnes nécessaires ici
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

}
