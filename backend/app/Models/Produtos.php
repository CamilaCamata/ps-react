<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use App\Models\Categorias;

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
        'categorias_id',
    ];
    public function categorias(){
        return $this->belongsTo(Categorias::class,'categorias_id');
    }
}
