<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();
        // verify filter school of students and paginate
        if (request()->get('escuela'))
            $students = Student::where('school_id', request()->get('escuela'))
                ->paginate(10);
        else
            $students = Student::paginate(10);

        return view('students.index', compact('students', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get all schools
        $schools = School::all();
        return view('students.form', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $student = Student::create($request->all());
            $request->session()->flash('success', 'Estudiante creado con éxito.');
            return redirect()->route('students.show', $student->id);
        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error', 'Ha ocurrido un error.');
            return redirect()->back();

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
        $schools = School::all();
        return view('students.form', compact('student', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $student = Student::findOrFail($id);
            $student->update($request->all());
            $request->session()->flash('success', 'Estudiante actualizado con éxito.');
            return redirect()->route('students.show', $student->id);

        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error', 'Ha ocurrido un error.');
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {

            $student = Student::findOrFail($id);
            $student->delete();
            $request->session()->flash('success', 'Estudiante eliminado con éxito.');
            return redirect()->route('students.index');

        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error', 'Ha ocurrido un error.');
            return redirect()->back();

        }
    }
}
