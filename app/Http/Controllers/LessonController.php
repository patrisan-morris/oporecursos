<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Controller for managing Lessons
 */
class LessonController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() : Response    {
        $lessons = Lesson::where('user_id', auth()->id())
        ->get();

        return Inertia::render('Crud', [
            'nameData' => 'Lessons',
            'data' => $lessons,
            'columns' => Lesson::$tableColumns,
            'filterColumns' => Lesson::$filterColumns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
