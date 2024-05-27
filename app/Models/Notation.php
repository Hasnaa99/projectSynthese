<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    use HasFactory;
    protected $fillable = ['note','evaluation_id','stagiaire_id'];

    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }

    public function stagiaire(){
        return $this->belongsTo(Stagiaire::class);
    }
}
