<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'imagem',
        'quantidade',
        'descrição',
        //'categoria',
        'categoria_id',
    ];
    public function categorias(){
        return $this->belongsTo(Categorias::class,'categoria_id');
    }
}
