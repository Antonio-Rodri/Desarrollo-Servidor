<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('estudiante.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Esto solo sirve para asignar de forma masiva siempre que no haya pivot
        // $estudiante = Student::create($request->all());
        // $estudiante->user_id = Auth::id();
        // $estudiante->save();
        // return redirect()->route('estudiante.index');
        $student = new Student();
        $student->dni = $request->dni;
        $student->name = $request->name;
        $student->apellidos = $request->apellidos;
        $student->email = $request->email;
        $student->curso = $request->curso;
        $student->save();
        $student->profesores()->attach(Auth::id(), [
            'asignatura' => $request->asignatura,
            'nota' => $request->nota,
        ]);

        return redirect()->route('estudiante.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
