<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Orden;
use Illuminate\Http\Request;
use App\Services\CarritoService;

class OrdenController extends Controller
{

    public $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = $carritoService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carrito = $this->carritoService->getFromCookie();
        if (!isset($carrito) || $carrito->cursos->isEmpty()){
            return redirect()
                ->back()
                ->withErrors("Tu carrito esta vacio!");
        }
        return view('ordens.create')->with([
            'carrito' => $carrito,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = $request->user();
        $orden = $user->ordens()->create([
            'estado' => 'pendiente',
        ]);

        $carrito = $this->carritoService->getFromCookie();

        $carritoCursosWithQuantity = $carrito->cursos->mapWithKeys(function ($curso) {
            $element[$curso->id] = ['quantity' => $curso->pivot->quantity];
            return $element;
        });
        
        $orden->cursos()->attach($carritoCursosWithQuantity->toArray());

        return redirect()->route('ordens.pagos.create', ['orden' => $orden]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
