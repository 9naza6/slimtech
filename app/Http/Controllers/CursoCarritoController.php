<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Carrito;
use Illuminate\Http\Request;
use App\Services\CarritoService;
use Illuminate\Support\Facades\Cookie;

class CursoCarritoController extends Controller
{

    public $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = $carritoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function index(Curso $curso)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function create(Curso $curso)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Curso $curso)
    {
        $carrito = $this->carritoService->getFromCookieOrCreate();
        $quantity = $carrito->cursos()
            ->find($curso->id)
            ->pivot
            ->quantity ?? 0;
        $carrito->cursos()->syncWithoutDetaching([
            $curso->id => ['quantity' => $quantity + 1],
        ]);
        $cookie = $this->carritoService->makeCookie($carrito);

        return redirect()->back()->cookie($cookie) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso, Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso, Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso, Carrito $carrito)
    {
        $carrito->cursos()->detach($curso->id);
        $cookie = $this->carritoService->makeCookie($carrito);
        return redirect()->back()->cookie($cookie);
    }

    
}
