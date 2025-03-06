<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'id');
        $sortDesc = $request->input('sort_desc', 'asc');
        $perPage = $request->input('per_page', 20);

        $search = $request->input('search');

        $students = Student::orderBy($sortBy, $sortDesc)
            ->where(function($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                      ->orWhere('last_name', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());

        return response()->json($student);
    }

    public function show(string $id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json(Student::find($id));
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->update($request->all());
            return response()->json(['message' => 'Student updated successfully', 'student' => $student], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    public function destroy(string $id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
