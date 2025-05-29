<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Resource;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MindExplorerController extends Controller{
    /**
     * Display a listing of the topics/resources/lessons.
     *
     * @return Response
     */
    public function index(): Response {
        $topics = Topic::where('user_id', auth()->id())->with('resources','lessons', 'parent')->get()->map(function($topic){
            return $topic->setAttribute('type', 'topic');
        });
        $lessons = Lesson::where('user_id', auth()->id())->with('topics')->get()->map(function($lesson){
            return $lesson->setAttribute('type', 'lesson');
        });
        $resources = Resource::where('user_id', auth()->id())->with('topics')->get()->map(function($resource){
            return $resource->setAttribute('type', 'resource');
        });

        $data = $topics->concat($lessons)->concat($resources)->sortByDesc('type')->values();

        return Inertia::render('MindExplorer', [
            'nameData' => 'MindExplorer',
            'description' => 'Explore your mind with topics, resources, and lessons.',
            'data' => $data,
            'columns' => Topic::$tableColumns,
            'filterColumns' => Topic::$filterColumns,
        ]);
    }
}
