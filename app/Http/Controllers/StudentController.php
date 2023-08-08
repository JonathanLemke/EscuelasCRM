<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $student = Student::create($request->all());
            return redirect()->route('students.show', $student->id)->with()->flash('success', 'Estudiante creado con éxito.');
        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            return redirect()->back()->with()->flash('error', 'Ha ocurrido un error.');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $student = Student::findOrFail($id);
            $student->update($request->all());
            return redirect()->route('students.show', $student->id)->with()->flash('success', 'Estudiante actualizado con éxito.');

        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            return redirect()->back()->with()->flash('error', 'Ha ocurrido un error.');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $student = Student::findOrFail($id);
            $student->delete();
            return redirect()->route('students.index')->with()->flash('success', 'Estudiante eliminado con éxito.');
        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            return redirect()->back()->with()->flash('error', 'Ha ocurrido un error.');

        }
    }
}
