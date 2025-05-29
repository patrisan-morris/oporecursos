<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Controller for managing Resources.
 */
class ResourceController extends Controller{
    /**
     * Display a listing of the resources.
     *
     * @return Response
     */
    public function index(): Response    {
        $resources = Resource::with('topics')
            ->where('user_id', auth()->id())
            ->get();

        return Inertia::render('Crud', [
            'nameData' => 'Resources',
            'data' => $resources,
            'columns' => Resource::$tableColumns,
            'filterColumns' => Resource::$filterColumns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response    {
        $topics = Topic::where('user_id', auth()->id())->get();

        return Inertia::render('Resources/Create', [
            'topics' => $topics,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'topics' => ['array'],
            'topics.*' => ['exists:topics,id'],
        ]);

        $resource = Resource::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'user_id' => auth()->id(),
        ]);

        if ($request->topics) {
            $resource->topics()->sync($request->topics);
        }

        return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     * @return Response
     */
    public function edit(Resource $resource): Response    {
        $this->authorize('update', $resource);

        $topics = Topic::where('user_id', auth()->id())->get();
        $selectedTopics = $resource->topics->pluck('id');

        return Inertia::render('Resources/Edit', [
            'resource' => $resource,
            'topics' => $topics,
            'selectedTopics' => $selectedTopics,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Resource $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Resource $resource)    {
        $this->authorize('update', $resource);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'url'],
            'topics' => ['array'],
            'topics.*' => ['exists:topics,id'],
        ]);

        $resource->update([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
        ]);

        if ($request->topics) {
            $resource->topics()->sync($request->topics);
        } else {
            $resource->topics()->detach();
        }

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Resource $resource)    {
        $this->authorize('delete', $resource);

        $resource->topics()->detach();
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }
}
