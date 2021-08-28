<?php

namespace App;

use App\Curso;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    public function cursos(){
        return $this->belongsToMany(Curso::class)->withPivot('quantity');
    }

    public function getTotalAttribute()
    {
        return $this->cursos->pluck('total')->sum();
    }
}
