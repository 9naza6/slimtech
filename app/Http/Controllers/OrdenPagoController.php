<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Orden;
use App\Currency;
use App\PaymentPlatform;
use Illuminate\Http\Request;
use App\Services\CarritoService;
use App\Services\PayPalService;

class OrdenPagoController extends Controller
{
    public function __construct(CarritoService $carritoService, PayPalService $payPalService)
    {
        $this->carritoService = $carritoService;
        $this->paypalService = $payPalService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function index(Orden $orden)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function create(Orden $orden)
    {
        $currencies = Currency::all();
        $paymentPlatforms = PaymentPlatform::all();
        return view('pagos.create')->with([
            'orden' => $orden,
            'currencies' => $currencies,
            'paymentPlatforms' => $paymentPlatforms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Orden $orden)
    {

        $this->carritoService->getFromCookie()->cursos()->detach();
        $orden->pago()->create([
            'precio' => $orden->total,
            'pagado' => now(),
        ]);

        $orden->estado = 'pagado';
        $orden->save();

        return $this->paypalService->handlePayment($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orden  $orden
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden, Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orden  $orden
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden, Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden, Pago $pago)
    {
        //
    }
}
