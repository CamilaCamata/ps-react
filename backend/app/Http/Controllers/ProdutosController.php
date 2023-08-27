<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutosRequest;
//use App\Htpp\Controllers\Controller;
use App\Http\Requests\UpdateProdutosRequest;
use App\Models\Produtos;
use Illuminate\Support\Facades\Storage;
use PhpOption\Option;

class ProdutosController extends Controller
{
    
    private Produtos $produtos;

    public function __construct(Produtos $produtos){
        $this->produtos = $produtos;
    }
    
        
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $produtos = $this->produtos->with('categorias')->get();
        return response()->json($produtos);

        //return response()->json($this->produtos->get());
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
           // $data['imagem'] = $request->file('imagem')->store('imagem','public');
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
    public function update(UpdateProdutosRequest $request, int $id)
    {
        $data = $request->validated();
        $produto = $this->produtos->findOrFail($id);
        if($request->hasFile('imagem')){
            Storage::disk('public')->delete($produto->imagem);
            $path = $request->file('imagem')->store('imagem', 'public');
            $data['imagem'] = url('storage/' . $path);
            //$data['imagem'] = $request->file('imagem')->store('imagem', 'public');
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