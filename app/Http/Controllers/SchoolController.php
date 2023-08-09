<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        return view('schools.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            if ($request->hasFile('logo')) {
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=200,min_height=200',
                ]);
                if ($request->file('logo')->isValid()) {
                    $path = Storage::url($request->file('logo')->store('public/logos'));
                }
            }

            $school = School::create([
                'name' => $request->name,
                'address' => $request->address,
                'logo' => $path,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'web_page' => $request->web_page
            ]);

            $request->session()->flash('success', 'Escuela creada con éxito.');
            return redirect()->route('schools.show', $school->id);


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
        $school = School::findOrFail($id);
        return view('schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schools = School::findOrFail($id);
        return view('schools.form', compact('schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            if ($request->hasFile('logo')) {
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=200,min_height=200',
                ]);

                if ($request->file('logo')->isValid()) {
                    $path = Storage::url($request->file('logo')->store('public/logos'));
                    $request->logo = $path;

                }
            }

            $school = School::findOrFail($id);
            $school->update([
                'name' => $request->name,
                'address' => $request->address,
                'logo' => $request->logo,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'web_page' => $request->web_page
            ]);


            $request->session()->flash('success', 'Escuela actualizada con éxito.');
            return redirect()->route('schools.show', $school->id);

        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());

            $request->session()->flash('error', 'Ha ocurrido un error.');
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        try {

            $school = School::findOrFail($id);
            $school->delete();
            $request->session()->flash('success', 'Escuela eliminada con éxito.');
            return redirect()->route('schools.index');

        } catch (\Exception $e) {

            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());

            $request->session()->flash('error', 'Ha ocurrido un error.');

            if ($e->getCode() == 23000)
                $request->session()->flash('error', 'No se puede eliminar la escuela porque tiene alumnos asignados. Por favor elimine los alumnos antes de eliminar la escuela.');

            return redirect()->back();

        }

    }
}
