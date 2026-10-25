<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with summary metrics and latest students.
     */
    public function index(): View
    {
        $totalStudents = Student::count();
        $totalDepartments = Department::count();
        $recentStudents = Student::with('department')
            ->latest('id')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalStudents', 'totalDepartments', 'recentStudents'));
    }
}
