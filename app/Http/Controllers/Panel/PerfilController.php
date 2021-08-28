<?php

namespace App\Http\Controllers\Panel;

use App\Curso;
use App\Perfil;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        if(($perfil->imagen) === null){
            $perfil->imagen = 'default.gif';
        }
        if(($perfil->portada) === null){
            $perfil->portada = 'logo.gif';
        }
        // Obtener cursos con paginacion
        $cursos = Curso::where('user_id', $perfil->user_id)->paginate(3);
        return view('perfiles.show', compact('perfil', 'cursos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        //Ejecutar el Policy

        $this->authorize('update',$perfil);


        // Validar 
        $data = request()->validate([
            'nombre' => 'required',
            'biografia' => 'required',
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'linkedin' => ''
        ]);

        //Si el usuario sube una imagen

        if( $request['imagen']){
            // Obtener la ruta de la imagen 
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //Resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            // crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }  

        if( $request['portada']){
            // Obtener la ruta de la imagen 
            $ruta_portada = $request['portada']->store('upload-portada', 'public');

            //Resize de la imagen
            $port = Image::make( public_path("storage/{$ruta_portada}"))->fit(1000, 500);
            $port->save();

            // crear un arreglo de imagen
            $array_portada = ['portada' => $ruta_portada];
        }  
        // Asignar nombre y URL 

        // auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar URL y NAME de $data

        unset($data['nombre']);
        
        // Guardar informacion
        // Asignar Biografia e imagen

        auth()->user()->perfil()->update( array_merge(
            $data, 
            $array_imagen ?? [],
            $array_portada ?? []
        ));
        //redireccionar
        return redirect()->action('Panel\CursoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
