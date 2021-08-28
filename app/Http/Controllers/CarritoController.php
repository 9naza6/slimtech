<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Services\CarritoService;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    public $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = $carritoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carritos.index')->with([
        'carrito' => $this->carritoService->getFromCookieOrCreate(),
        ]);
    } 

}
