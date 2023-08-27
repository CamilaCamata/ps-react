<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriasRequest;
use App\Http\Requests\UpdateCategoriasRequest;
use App\Models\Categorias;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;


class CategoriasController extends Controller
{
    private Categorias $categoria;

    public function __construct(Categorias $categoria){
        $this->categoria = $categoria;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoria = $this->categoria->with('produtos')->when($request->search, function ($query) use ($request){
            $query->where('nome','like','%' .$request->search. '%');
        });

        //->paginate(11);
        //$categoria = $this->categoria->with('produtos')->get();
        return response()->json($categoria);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriasRequest $request)
    {
        $data = $request->validated();
        $categoria = $this->categoria->create($data);
        return response()->json($categoria);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = $this->categoria->with('produtos')->find($id);
        return response()->json($categoria);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriasRequest $request, Categorias $id)
    {
        $data = $request->validated();
        $categoria = $this->categoria->findOrFail($id);
        $categoria->update($data);
        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $categoria = $this->categoria->newQuery()->findOrFail($id);
        $categoria->delete();
        return 'categoria deletado';
    }
}
