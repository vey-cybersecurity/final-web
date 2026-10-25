<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $departmentId = $request->query('department_id');

        $departments = Department::orderBy('name')->get();

        $students = Student::with('department')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('student_code', 'like', "%{$search}%");
                });
            })
            ->when($departmentId, function ($query, $departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'departments', 'search', 'departmentId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $departments = Department::orderBy('name')->get();

        return view('students.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        $student->load('department');

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        $departments = Department::orderBy('name')->get();

        return view('students.edit', compact('student', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student): RedirectResponse
    {
        $data = $request->validated();

        if ($request->boolean('remove_photo')) {
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }
            $data['photo'] = null;
        } elseif ($request->hasFile('photo')) {
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }
            $data['photo'] = $request->file('photo')->store('students', 'public');
        } else {
            unset($data['photo']);
        }

        unset($data['remove_photo']);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
