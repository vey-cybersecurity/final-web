<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $departments = Department::withCount('students')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department): View
    {
        $department->loadCount('students');
        $students = $department->students()->latest('id')->paginate(10);

        return view('departments.show', compact('department', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): RedirectResponse
    {
        if ($department->students()->exists()) {
            return redirect()->route('departments.index')->with('error', 'Cannot delete department "'.$department->name.'" because it still has registered students. Please reassign or delete its students first.');
        }

        try {
            $department->delete();

            return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
        } catch (QueryException $e) {
            return redirect()->route('departments.index')->with('error', 'Unable to delete department because related records exist.');
        }
    }
}
