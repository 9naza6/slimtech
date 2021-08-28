<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    //Campos que se agregaran
    protected $fillable = [
        'estado', 
        'customer_id',
    ];

    public function pago(){
        return $this->hasOne(Pago::class);

    }

    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function cursos(){
        return $this->belongsToMany(Curso::class)->withPivot('quantity');
    }

    public function getTotalAttribute()
    {
        return $this->cursos->pluck('total')->sum();
    }
}

