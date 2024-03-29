<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carpeta;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::user()->id;
        $carpetas = Carpeta::whereNull('carpeta_padre_id')
        ->where('user_id', $id_user)
        ->get();

        return view('admin.mi_unidad.index',['carpetas' => $carpetas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:191',
        ]);

        $carpeta = new Carpeta();
        $carpeta->nombre = $request->nombre;
        $carpeta->user_id = $request->user_id;
        $carpeta->save();

        return redirect()->route('mi_unidad.index')
            ->with('mensaje','Se creó con éxito una nueva carpeta')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carpeta = Carpeta::findOrFail($id);
        // hago la llamada al modelo carpetasHijas para traerme todos los registros de esa carpeta
        $subcarpetas = $carpeta->carpetasHijas;
        $archivos = $carpeta->archivos;

        return view( 'admin.mi_unidad.show', compact('carpeta','subcarpetas', 'archivos') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         //$datos = request()->all();
         //return response()->json($datos);

        $request->validate([
            'nombre' => 'required|max:191',
        ]);

        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->nombre = $request->nombre;
        $carpeta->save();

        return redirect()->route('mi_unidad.index')
            ->with('mensaje','El nombre de la carpeta fue cambiado con éxito')
            ->with('icono','success');
    }

    public function update_color(Request $request){
        //$datos = request()->all();
        //return response()->json($datos);
        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->color = $request->color;
        $carpeta->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function crear_subcarpeta(Request $request){



        $request->validate(
            [
            'nombre' => 'required|max:191',
            'carpeta_padre_id' => 'required'
            ]
        );

        $carpeta = new Carpeta();

        $carpeta->user_id = $request->user_id;
        $carpeta->nombre = $request->nombre;
        $carpeta->carpeta_padre_id = $request->carpeta_padre_id;
        $carpeta->save();

        return redirect()->back()
            ->with('mensaje','Se creó con éxito una nueva carpeta')
            ->with('icono','success');
    }

    public function update_subcarpeta (Request $request){
        $request->validate([
            'nombre' => 'required|max:191',
        ]);
        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->nombre = $request->nombre;
        $carpeta->save();

        return redirect()->back()
        ->with('mensaje','Se actualizó con éxito una nueva sub-carpeta')
        ->with('icono','success');

    }

    public function update_subcarpeta_color(Request $request){
        //$datos = request()->all();
        //return response()->json($datos);

        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->color = $request->color;
        $carpeta->save();
        return back();
    }


}
