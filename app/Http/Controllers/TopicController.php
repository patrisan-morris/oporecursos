<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Controller for managing Topics.
 */
class TopicController extends Controller{
    /**
     * Display a listing of the topics.
     *
     * @return Response
     */
    public function index(): Response {
        $topics = Topic::where('user_id', auth()->id())->get();

        return Inertia::render('Topics', [
            'topics' => $topics,
        ]);
    }

    /**
     * Store a newly created topic in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Topic::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
    }


    /**
     * Update the specified topic in storage.
     *
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Topic $topic) {
        $this->authorize('update', $topic);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $topic->update([
            'name' => $request->name,
        ]);

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified topic from storage.
     *
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Topic $topic) {
        $this->authorize('delete', $topic);

        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }
}
