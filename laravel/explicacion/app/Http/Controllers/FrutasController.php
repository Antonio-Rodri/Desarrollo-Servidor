<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FrutasRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Fruta;



class FrutasController extends Controller
{
    public function index()
    {
        $frutas = [
            'Manzana',
            'Platano',
            'Mango',
            'Durazno',
            'Mora',
            'Fresa',
            'Ciruela',
            'Mandarina',
            'Melon',
            'Guayaba',
        ];
        return view('frutas.index', compact('frutas'));
    }

    public function naranjas()
    {
        // $frutas = DB::table('frutas')->get();
        $frutas = Fruta::all();
        return view('frutas.naranjas', compact('frutas'));
    }

    public function peras()
    {
        return "No le pidas peras al olmo";
    }

    public function recibeFrutas(FrutasRequest $request)
    {
        // $messages=[
        //     'fruta.required'=> 'La fruta es obligatoria',
        //     'fruta.min'=> 'La fruta debe tener al menos 4 caracteres',
        //     'fruta.max'=> 'La fruta debe tener menos de 10 caracteres',
        //     'fruta.string'=> 'La fruta debe ser un string',
        //     'fruta.in'=> 'La fruta debe ser pera, manzana o banana',
        //     'descripcion.required'=> 'La descripcion es obligatoria',
        //     'descripcion.max'=> 'La descripcion debe tener menos de 20 caracteres',
        //     'pais.required'=> 'El pais es obligatorio',
        // ];
        // $request->validate([
        //     'fruta' => 'required|min:4|max:10|string|in:pera,manzana,banana',
        //     'descripcion' => 'required|max:20',
        //     'pais' => 'required',
        // ], $messages);
        $request->validated();

        // return "Fruta guardada correctamente";
        // return $request->all();
        // return $request->dd();
        // echo $request->input('fruta');
        echo "<br>" . $request->descripcion;
        if ($request->fruta == 'pera') {
            return redirect()->route('frutas.index')->with('mensaje', 'Pera añadida satisfactoriamente (o no, que me la voy a jalar)');
        } else {
            return back()->withInput()->with('mensaje', 'No le pidas peras al olmo');
        }
    }
}
