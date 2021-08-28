<?php

namespace App\Http\Controllers;

use App\Curso;
use App\CategoriaCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Perfil;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Middleware\Authorize;

class CursoShowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Auth::user()->recetas->dd(),
        // $cursos = auth()->user()->cursos;
        $usuario = auth()->user();
        $perfil = Perfil::all();
        // $meGusta = auth()->user()->meGusta;
        $cursos = Curso::where('user_id', $usuario->id)->paginate(3);
        return view('cursos.index')->with('cursos', $cursos)
                                    ->with('usuario', $usuario)
                                    ->with('perfil', $perfil);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        
        // Obtener si el usuario actual le gusta la receta y esta autentificado
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($curso->id) : false;

        // Pasa la cantidad de likes a la vista 
        $likes = $curso->likes->count();

        return view('cursos.show', compact('curso', 'like', 'likes'));
    }

    public function search(Request $request){
        $busqueda = $request['buscar'];
        $cursos = Curso::where('titulo', 'like', '%' . $busqueda . '%' )->paginate(10);
        $cursos->appends(['buscar' => $busqueda]);
        return view('busquedas.show', compact('cursos', 'busqueda'));
    }
}
