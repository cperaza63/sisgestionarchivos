<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $id = $request->id;
        $file = $request->file('file');
        $fileName = time() . "-" . $file->getClientOriginalName();
        // para mandarla al area de Storage
        $request->file('file')->store($id, 'public');
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
