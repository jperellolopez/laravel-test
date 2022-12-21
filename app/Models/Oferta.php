<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/*
Para crear este modelo usar el comando 'php artisan make:model Nombre'
El modelo contendrá los métodos que tratarán los datos que vienen de una DB

Tiene que haber coherencia entre el nombre del modelo (singular) y el de la tabla (plural)

Al extender de Model, ya hereda muchos métodos, por lo que los métodos all() y find() que usamos en routes/web se pueden usar sin especificarlos aquí 
*/


class Oferta extends Model
{
    use HasFactory;

    // función para filtrar las tags
    public function scopeFilter($query, array $filters)
    {

        // se ejecuta si hay un tag seleccionado
        if ($filters['tag'] ?? false) {
            // busca que los tags tengan el formato adecuado (similar a una query de mysql)
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // se ejecuta si hay un elemento search seleccionado
        if ($filters['search'] ?? false) {
            // busqueda se aplicará en los campos de ($oferta['title']), descripción, tags y localización
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%');
        }
    }

    // los datos que se pasan desde el formulario para crear una nueva oferta. Es necesario crear esta variable fillable por motivos de seguridad, ya que asi se especifica sobre qué campos se va a actuar en la BD
    protected $fillable = ['title', 'company', 'email', 'description', 'location', 'website', 'tags', 'user_id'];

    // relación con la tabla de usuarios
    // una oferta pertenece a un usuario, entre paréntesis se le indica donde encontrar ese usuario
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
