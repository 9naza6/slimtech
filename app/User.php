<?php

namespace App;
use App\Orden;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Un evento que se ejecuta cuando un usuario es creado 

    protected static function boot(){
        parent::boot();


        // Asignar perfil una vez se haya creado un usuario nuevo

        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    /** Relacion 1:n de Usuario a Recetas */
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    //Relacion 1:1 de Usuario a Perfil
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

    // Recetas que el usuario le ha dado me gusta
    public function meGusta(){
        return $this->belongsToMany(Curso::class, 'likes_curso'); 
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['admin_since',];

    public function ordens(){
        return $this->hasMany(Orden::class, 'customer_id');
    }

    public function pagos(){
        return $this->hasManyThrough(Pago::class, Orden::class, 'customer_id');
    }

    public function isAdmin(){
        return $this->admin_since != null
            && $this->admin_since->lessThanOrEqualTo(now());
    }
}
