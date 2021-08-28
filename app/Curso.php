<?php

namespace App;

use App\Carrito;
use App\Orden;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

    //Campos que se agregaran
    protected $fillable = [
        'titulo', 
        'descripcion', 
        'estado', 
        'costo', 
        'existencia', 
        'fecha', 
        'precio', 
        'imagen', 
        'categoria_id'
    ];
    // Obtiene la categoria del curso via FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaCurso::class);
    }

    // Obtiene la categoria del curso via FK
    public function autor() {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Likes que ha recibido un curso
    public function likes(){
        return $this->belongsToMany(User::class, 'likes_curso');
    }

    public function carritos(){
        return $this->belongsToMany(Carrito::class)->withPivot('quantity');
    }

    public function ordens(){
        return $this->belongsToMany(Orden::class)->withPivot('quantity');
    }

    public function getTotalAttribute()
    {
        return $this->pivot->quantity * $this->precio;
    }
}
