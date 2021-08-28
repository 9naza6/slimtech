<?php

namespace App;

use App\Orden;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    //Campos que se agregaran
    protected $fillable = [
        'precio',
        'pagado',
        'orden_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['pagado'];

    public function orden(){
        return $this->belongsTo(Orden::class);
    }


}
