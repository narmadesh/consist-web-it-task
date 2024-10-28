<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('courses.index', ['courses' => Course::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create',['instructors' => Instructor::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        if ($request->process()) {
            return redirect()->back()->with('success', 'Course created');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit',['course' => $course,'instructors' => Instructor::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        if ($request->process()) {
            return redirect()->back()->with('success', 'Course updated');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->delete()) {
            return redirect()->back()->with('success', 'Course deleted');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
}
