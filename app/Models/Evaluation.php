<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['date','type' ,'bareme','duree','groupe_id','module_id','numero_ctrl'];

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function notations(){
        return $this->hasMany(Notation::class);
    }

    public function groupe(){
        return $this->belongsTo(Groupe::class);
    }
}
