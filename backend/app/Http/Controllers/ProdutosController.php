<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Use;
use App\Http\Requests\StoreProdutosRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProdutosRequest;
use App\Models\Produtos;
use App\Models\Categorias;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOption\Option;
use Symfony\Component\HttpKernel\Attribute\AsController;

class ProdutosController extends Controller
{
    
    private Produtos $produtos;

    public function __construct(Produtos $produtos){
        $this->produtos = $produtos;
    }
    
        
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = $this->produtos->with('categorias')->when($request->search, function ($query) use ($request){
            $query->where('nome','like','%' .$request->search. '%')->orWhere('categorias_id',$request->search);
        })
        ->paginate(11);

        return response()->json($produtos);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutosRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('imagem')){
            $path = $request->file('imagem')->store('imagem', 'public');
            $data['imagem'] = url('storage/' . $path);
        }
        $produtos = $this->produtos->create($data);
        return response()->json($produtos);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produtos = $this->produtos->with('categorias')->find($id);
        return response()->json($produtos);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutosRequest $request, Produtos $id)
    {
        $data = $request->validated();
        $produto = $this->produtos->findOrFail($id);
        if($request->hasFile('imagem')){
            Storage::disk('public')->delete($produto->imagem);
            $path = $request->file('imagem')->store('imagem', 'public');
            $data['imagem'] = url('storage/' . $path);
        }
        $produto->update($data);
        return response()->json($produto);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $produto = $this->produtos->newQuery()->findOrFail($id);
        Storage::disk('public')->delete($produto->imagem);
        $produto->delete();
        return 'produto deletado';
    }

}