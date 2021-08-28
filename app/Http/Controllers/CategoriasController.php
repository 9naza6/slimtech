<?php

namespace App\Http\Controllers;

use App\Curso;
use App\CategoriaCurso;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('categorias.index', compact('cursos'));
    } 

    public function show(CategoriaCurso $categoriaCurso){
        $cursos = Curso::where('categoria_id', $categoriaCurso->id)->paginate(3);
        return view('categorias.show', compact('cursos', 'categoriaCurso'));
    }
}
