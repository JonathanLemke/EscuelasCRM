<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::paginate(10);
        return view('schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=200,min_height=200',
            ]);
            if ($request->file('logo')->isValid()) {
                $path = $request->file('logo')->store('public/logos');
                $request->merge(['logo' => $path]);
            }
        }

        $school = School::create($request->all());
        return redirect()->route('schools.show', $school->id)->with()->flash('success', 'Escuela creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $school = School::findOrFail($id);
        return view('schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $school = School::findOrFail($id);
        return view('schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=200,min_height=200',
            ]);

            if ($request->file('logo')->isValid()) {
                $path = $request->file('logo')->store('public/logos');
                $request->merge(['logo' => $path]);
            }
        }

        $school = School::findOrFail($id);
        $school->update($request->all());
        return redirect()->route('schools.show', $school->id)->with()->flash('success', 'Escuela actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $school = School::findOrFail($id);
        $school->delete();
        return redirect()->route('schools.index')->with()->flash('success', 'Escuela eliminada con éxito.');
    }
}
