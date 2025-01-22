<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    /** @use HasFactory<\Database\Factories\NoticiaFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'titular',
        'url',
        'descripcion',
        'imagen',
        'categoria_id',
        'user_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRutaImagen()
    {
        //Esto es para que salgan las imagenes del fake (NoticiaFactory.php)
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }
        // hasta aqui

        return asset('storage/imagenes/' . $this->id . '.jpg');
    }
}
