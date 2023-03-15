<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $livre=Livre::all();
        return response()->json($livre);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $livre= new Livre;
        $livre=$this->requestLivre($request,$livre);
        return response()->json($livre);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $livre= Livre::find($id);
        return response()->json($livre);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $livre = Livre::find($id);
        $livre=$this->requestLivre($request,$livre);
        return response()->json($livre);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $livre =  Livre::find($id);
        $livre->delete();
        return response()->json(['messqge','Livre Deleted']);

    }

    private  function requestLivre(Request $request,Livre $livre){
        $livre->title=$request->input('title');
        $livre->genre_id=$request->input('genre_id');
        $livre->collection=$request->input('collection');
        $livre->isbn=$request->input('isbn');
        $livre->released_date=$request->input('released_date');
        $livre->page_numbers=$request->input('page_numbers');
        $livre->emplacement=$request->input('emplacement');
        $livre->statut=$request->input('statut');
        $livre->save();
        return $livre;

    }
}
