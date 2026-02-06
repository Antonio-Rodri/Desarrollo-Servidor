<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $estudiantes = $user->estudiantes()->paginate(2);
        //$estudiantes = $user->estudiantes()->wherePivot('asignatura', 'Matemáticas')->get();
        // $user2 = User::find(Auth::id());

        return view('profesor.index', compact('user', 'estudiantes'));
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

    public function nota()
    {
        $user = Auth::user();
        $estudiantes = $user->estudiantes;
        return view('profesor.ponerNota', compact('estudiantes'));
    }

    public function putNota(Request $request)
    {
        $estudiante = Student::find($request->id);
        return redirect()->route('profesor.index');
    }
}
