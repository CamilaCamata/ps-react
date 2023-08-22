<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutosRequest;
use App\Http\Requests\UpdateProdutosRequest;
use App\Models\Produtos;

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
        return response()->json($this->produtos);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produtos $produtos)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutosRequest $request, Produtos $produtos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produtos $produtos)
    {
        //
    }

}