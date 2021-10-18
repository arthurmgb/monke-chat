<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'nome',
        'checked',
        'user_id',
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}