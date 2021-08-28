<?php

namespace App\Http\Controllers\Panel;

use App\Curso;
use App\Perfil;
use App\CategoriaCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Orden;
use App\Pago;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Middleware\Authorize;
use SebastianBergmann\Environment\Console;

class CursoController extends Controller
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
        // $perfil = Perfil::all();
        // Auth::user()->recetas->dd(),
        // $cursos = auth()->user()->cursos;
        $usuario = auth()->user();
        $usuarios = User::all();
        $top5Users = User::latest()->take(6)->get();
        $totalUsers = User::count();
        $totalProducts = Curso::count();
        $ordensPay = Orden::where('estado', 'pagado')->get()->count();
        $ordensPending = Orden::where('estado', 'pendiente')->get()->count();
        $money = Pago::sum('precio');
        
        // $meGusta = auth()->user()->meGusta;
        $cursos = Curso::where('user_id', $usuario->id)->paginate(3);
        return view('cursos.index')->with('cursos', $cursos)
                                    ->with('usuario', $usuario)
                                    ->with('money', $money)
                                    ->with('top5Users', $top5Users)
                                    ->with('ordensPay', $ordensPay)
                                    ->with('ordensPending', $ordensPending)
                                    ->with('totalUsers', $totalUsers)
                                    ->with('totalProducts', $totalProducts)
                                    ->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();
        //Obtener las categorias ( sin modelo)
        // $categorias = DB::table('categoria_cursos')->get()->pluck('nombre', 'id');
        
        // Con modelo
        $categorias = CategoriaCurso::all(['id', 'nombre']);

        return view('cursos.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(request()->estado == 'available' && request()->existencia == 0) {
            session()->flash('error', 'If available must have stock');
            return redirect()->back();
        }

        session()->forget('error');
        // dd($request['imagen']->store('upload-recetas', 'public'));

        //validacion
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|min:1',
            'costo' => '',
            'fecha' => 'required',
            'estado' => ['required', 'in:available,unavailable'],
            'existencia' => '',
            'imagen' => 'required|image'
        ]);
        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //Resize de la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 667);
        $img->save();

        //almacenar en la bd (sin modelo)
        // DB::table('cursos')->insert([
        //     'titulo' => $data['titulo'],
        //     'descripcion' => $data['descripcion'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']
        // ]);

        //Almacenar en la BD con modelo

        auth()->user()->cursos()->create([
            'titulo' => $data['titulo'],
            'precio' => $data['precio'], 
            'costo' => $data['costo'], 
            'descripcion' => $data['descripcion'],
            'fecha' => $data['fecha'],
            'existencia' => $data['existencia'],
            'estado' => $data['estado'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],

        ]);
        //Redireccionar

        return redirect()->action('Panel\CursoController@index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        // Revisar el policy
        $this->authorize('view', $curso);
        $categorias = CategoriaCurso::all(['id', 'nombre']);
        return view('cursos.edit', compact('categorias', 'curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {

        // Revisar el policy
        $this->authorize('update', $curso);
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'descripcion' => 'required',
            'estado' => 'required'
        ]);

        // Asignar los valores
        $curso->titulo = $data['titulo'];
        $curso->categoria_id = $data['categoria'];
        $curso->descripcion = $data['descripcion'];
        $curso->estado = $data['estado'];

        // Si el usuario sube una nueva imagen

        if(request('imagen')) {
            
            // Obtener la ruta de la imagen 
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //Resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();
            $curso->imagen = $ruta_imagen;
        }
        $curso->save();

        //redireccionar
        return redirect()->action('Panel\CursoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        // return "eliminando...";
        $this->authorize('delete', $curso);
        
        $curso->delete();
        
        return redirect()->action('Panel\CursoController@index');
    }

    public function search(Request $request){
        $busqueda = $request['buscar'];
        $cursos = Curso::where('titulo', 'like', '%' . $busqueda . '%' )->paginate(10);
        $cursos->appends(['buscar' => $busqueda]);
        return view('busquedas.show', compact('cursos', 'busqueda'));
    }

    public function totalUsers() {
        $users = User::count();
        return $users;
    }
}
