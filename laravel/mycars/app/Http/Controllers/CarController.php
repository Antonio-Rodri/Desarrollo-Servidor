<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cars = $user->cars()->paginate(2);
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|unique:cars,matricula,NULL,id,deleted_at,NULL',
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'year' => 'required|integer',
            'fecha_ultima_revision' => 'required|date',
            'precio' => 'required',
            'foto' => 'required|image',
        ]);

        try {
            $car = new Car();
            $car->matricula = $request->matricula;
            $car->marca = $request->marca;
            $car->modelo = $request->modelo;
            $car->color = $request->color;
            $car->year = $request->year;
            $car->fecha_ultima_revision = $request->fecha_ultima_revision;
            $car->precio = $request->precio;
            $car->user_id = Auth::id();
            $nombreFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
            $car->foto = $nombreFoto;
            $car->save();
            $request->file('foto')->storeAs('imgcars', $nombreFoto);
            return redirect()->route('cars.index')->with('msg', 'Coche creado correctamente');
        } catch (QueryException $ex) {
            return redirect()->route('cars.index')->with('msg', 'Error al crear el coche');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $url = 'storage/imgcars/';
        return view('cars.show', compact('car', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $url = 'storage/imgcars/';
        return view('cars.edit', compact('car', 'url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'matricula' => 'required|unique:cars,matricula,"' . $car->id . '",id,deleted_at,NULL',
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'year' => 'required|integer',
            'fecha_ultima_revision' => 'required|date',
            'precio' => 'required',
            'foto' => 'image',
        ]);

        try {
            $car->matricula = $request->matricula;
            $car->marca = $request->marca;
            $car->modelo = $request->modelo;
            $car->color = $request->color;
            $car->year = $request->year;
            $car->fecha_ultima_revision = $request->fecha_ultima_revision;
            $car->precio = $request->precio;
            if (is_uploaded_file($request->file('foto'))) {
                Storage::delete('imgcars/' . $car->foto);
                $nombreFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
                $car->foto = $nombreFoto;
                $request->file('foto')->storeAs('imgcars', $nombreFoto);
            }
            $car->save();
            return redirect()->route('cars.index')->with('msg', 'Coche actualizado correctamente');
        } catch (QueryException $ex) {
            return redirect()->route('cars.index')->with('msg', 'Error al actualizar el coche');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        try {
            Storage::delete('imgcars/' . $car->foto);
            $car->delete();
            return redirect()->route('cars.index')->with('msg', 'Coche eliminado correctamente');
        } catch (QueryException $ex) {
            return redirect()->route('cars.index')->with('msg', 'Error al eliminar el coche');
        }
    }
}
