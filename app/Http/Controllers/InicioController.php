<?php

namespace App\Http\Controllers;

use App\Curso;
use App\CategoriaCurso;
use App\Perfil;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index(){
        $nuevas = Curso::latest()->take(5)->get();
        // Obtener todas las categorias 
        $perfiles = Perfil::all();
        $categorias = CategoriaCurso::all();
        $libros = Curso::where('categoria_id', 2)->take(5)->get();
        $equipos = Curso::where('categoria_id', 3)->take(1)->get();
        $cursos = Curso::where('categoria_id', 1)->take(4)->get();
        // Agrupar los cursos por categoria 
        $productos = [];
        foreach($perfiles as $perfil) {
            if(($perfil->imagen) === null){
                $perfil->imagen = 'default.gif';
            }
            if(($perfil->portada) === null){
                $perfil->portada = 'defaultfondo.jpg';
            }
        }
        foreach($categorias as $categoria) {
            $productos[ Str::slug( $categoria->nombre ) ] [] = Curso::where('categoria_id', $categoria->id )->take(3)->get();
        }
        
        return view('inicio.index', compact('nuevas', 'cursos', 'perfiles', 'libros', 'equipos', 'productos'));
    }
}
