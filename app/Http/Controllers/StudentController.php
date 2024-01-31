<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('student.list')) {
         
            abort(403, 'Unauthorized action.');
        }

        $students = Students::latest()->paginate(20);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('student.create')) {
         
            abort(403, 'Unauthorized action.');
        }
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'name' => 'required|max:80',
            'roll' => 'required|unique:students,roll',
            'registration' => 'required|unique:students,registration',
        ]);

        $user = Students::create([
            'name' => $request->name,
            'roll' => $request->roll,
            'registration' => $request->registration,
        ]);
        session()->flash('success', 'Student created successfully');
        return back();
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
        if (!Auth::user()->hasPermissionTo('student.edit')) {
         
            abort(403, 'Unauthorized action.');
        }
        $student = Students::find($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $student)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|max:80',
            'roll' => "required|unique:students,roll,$student->id",
            'registration' => "required|unique:students,registration,$student->id",
        ]);

        $student->update([
            'name' => $request->name,
            'roll' => $request->roll,
            'registration' => $request->registration,
        ]);

        session()->flash('success', 'Student updated successfully');
        return back();
    }

    public function exportToExcel()
    {
        
        if (!Auth::user()->hasPermissionTo('student.export')) {
         
            abort(403, 'Unauthorized action.');
        }

        //     $fileName = 'students_export.xlsx';

        //    return Excel::download(new StudentsExport, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $student)
    {
        if (!Auth::user()->hasPermissionTo('student.delete')) {
         
            abort(403, 'Unauthorized action.');
        }
        $student->delete();
        session()->flash('success', 'Student deleted successfully');
        return back();
    }
}
