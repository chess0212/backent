<?php


namespace App\Models;

use App\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['session_id'];

    public function responses()
    {
        return $this->hasMany(Response::class, 'session_id' );
    }
}
