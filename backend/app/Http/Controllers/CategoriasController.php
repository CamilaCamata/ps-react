<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriasRequest;
use App\Http\Requests\UpdateCategoriasRequest;
use App\Models\Categorias;

class CategoriasController extends Controller
{
    private Categorias $categorias;

    public function __construct(Categorias $categorias){
        $this->categorias = $categorias;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = $this->categorias->with('produtos')->get();
        return response()->json($this->categorias->get());

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriasRequest $request)
    {
        $data = $request->validated();
        $categorias = $this->categorias->create($data);
        return response()->json($categorias);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorias = $this->categorias->with('categorias')->find($id);
        return response()->json($categorias);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriasRequest $request, Categorias $id)
    {
        $data = $request->validated();
        $categoria = $this->categorias->findOrFail($id);
        $categoria->update($data);
        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $categoria = $this->categorias->newQuery()->findOrFail($id);
        $categoria->delete();
        return 'categoria deletado';
    }
}
