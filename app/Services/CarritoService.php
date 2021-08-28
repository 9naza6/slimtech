<?php

namespace App\Services;

use App\Carrito;
use Illuminate\Support\Facades\Cookie;

class CarritoService
{
    protected $cookieName = 'carrito';

    public function getFromCookie()
    {
        $carritoId = Cookie::get($this->cookieName);
        $carrito = Carrito::find($carritoId);
        return $carrito;

    }

    public function getFromCookieOrCreate(){
        
        $carrito = $this->getFromCookie();
        return $carrito ?? Carrito::create();
    }

    public function makeCookie(Carrito $carrito)
    {
        return Cookie::make($this->cookieName, $carrito->id, 7 * 24 * 60);
    }

    public function countProducts()
    {
        $carrito = $this->getFromCookie();

        if ($carrito != null) {
            return $carrito->cursos->pluck('pivot.quantity')->sum();
        }

        return 0;
    }
}