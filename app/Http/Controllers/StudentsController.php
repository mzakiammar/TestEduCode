<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = students::get();
        return view('list', ['students' =>$students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'class' => 'required|in:9,10,11,12',
            'status' => 'required|boolean',
        ]);

        students::create([
            'name' => $request->name,
            'class' => $request->class,
            'status' => $request->status,
        ]);
    
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = students::find($id);
        return view('edit', ['students' => $students]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'class' => 'required|in:9,10,11,12',
            'status' => 'required|boolean',
        ]);

        $students = students::find($id);

        if ($students) {
            $students->update([
                'name' => $request['name'],
                'class' => $request['class'],
                'status' => $request['status'],
            ]);
        }

        return redirect('/students');
    }

    public function updateStatus(Request $request)
    {
        $student = Student::find($request->student_id);

        if ($student) {
            // Ubah status
            $newStatus = ($request->current_status == 1) ? 0 : 1;
            $student->status = $newStatus;
            $student->save();

            return response()->json(['status' => $newStatus]);
        }

        return response()->json(['error' => 'Student not found'], 404);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = students::find($id);

        if ($student) {
            $student->delete();
            return redirect('/students')->with('success', 'Data Berhasil Dihapus!');
        } else {
            return redirect('/students')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
