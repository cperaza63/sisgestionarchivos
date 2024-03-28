<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cambiar_de_privado_a_publico (Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $id = $request->id;
        $estado_archivo = $request->estado;
        $archivo = Archivo::find($id);
        $carpeta_id = $archivo->carpeta_id;
        $nombre = $archivo->nombre;
        $archivo->estado_archivo = $estado_archivo;
        $archivo->save();
        if( $estado_archivo == "PRIVADO" ){
            $ruta_archivo_desde = "public/" . $carpeta_id ."/". $nombre;
            $ruta_archivo_hasta = $carpeta_id ."/". $nombre;
        }else{
            $ruta_archivo_desde = $carpeta_id ."/". $nombre;
            $ruta_archivo_hasta = "public/" . $carpeta_id ."/". $nombre;
        }
        Storage::move($ruta_archivo_desde, $ruta_archivo_hasta);

        return redirect()->back()
        ->with('mensaje', 'El archivo cambio a Estado ' . $estado_archivo)
        ->with('icon', 'success');
    }

    public function eliminar_archivo(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $id = $request->id;
        $archivo = Archivo::find($id);
        $estado_archivo = $archivo->estado_archivo;
        if( $estado_archivo == "PRIVADO" ){
            Storage::delete($archivo->carpeta_id . '/' . $archivo->nombre);
        }else{
            Storage::delete('public/' . $archivo->carpeta_id . '/' . $archivo->nombre);
        }
        Archivo::destroy($id);
        return redirect()->back()
        ->with('mensaje', 'El archivo fue eliminado con éxito')
        ->with('icon', 'success');
    }

    public function upload(Request $request)
    {
        // definimos el nombre nuevo
        // correr por consola:     php artisan storage:link
        // para crear un link del archivo para ponerlo y se vuelve public para compartir las imagenes, videos, todo
        // el resultado:
        // INFO  The [C:\xampp2\htdocs\sisgestionarchivos\public\storage] link
        // has been connected to
        // [C:\xampp2\htdocs\sisgestionarchivos\storage\app/public].

        $id = $request->id;                 // id del archivo
        $file = $request->file('file');
        $fileName = time() . "-" . $file->getClientOriginalName();
        //$file->storeAs($id, $fileName, 'public');
        $file->storeAs($id, $fileName);             // carga de forma privada

        $archivo = new Archivo();
        $archivo->carpeta_id = $request->id;
        $archivo->nombre = $fileName;
        $archivo->estado_archivo = 'PRIVADO';
        $archivo->save();

        return redirect()->back()
        ->with('mensaje', 'Se cargo el archivo de manera correcta')
        ->with('icono', 'success');

        // para mandarla al area de Storage
        // si no encuentra la carpeta la crea
        // otra MANERA para mandarla al area de PUBLIC
        //$file->move(public_path($id), $fileName);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
