<?php

namespace Fbollon\LaraCmsLite\Http\Controllers;

use Fbollon\LaraCmsLite\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContentController extends Controller
{
    /**
     * Display a listing of the content.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('lara-cms-lite-manage');

        $contentQuery = Content::query();
        $contentQuery->where('name', 'like', '%'.request('q').'%');
        $contentQuery->with('User');
        $contentsList = $contentQuery->paginate(25);

        return view('lara-cms-lite::contents.index', compact('contentsList'));
    }

    /**
     * Show the form for creating a new content.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        Gate::authorize('lara-cms-lite-manage');

        $routes = $this->getRoutes();
        return view('lara-cms-lite::contents.create', compact('routes'));
    }

    /**
     * Get routes to populate select menu
     *
     * in create or edit form
     *
     **/
    private function getRoutes()
    {
        $routes = Route::getRoutes()->getRoutesByMethod()['GET'];

        if (config('lara-cms-lite.filter_routes')) {
            $allowed_routes = config('lara-cms-lite.allowed_routes');
            $filterArray = array_filter($routes, function ($route) use ($allowed_routes) {
                return (in_array($route->uri, $allowed_routes) === true);
            });
            $routes = $filterArray;
        }

        ksort($routes);
        return $routes;
    }

    /**
     * Store a newly created content in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Gate::authorize('lara-cms-lite-manage');

        $newContent = $request->validate([
            'name'        => 'required|max:100',
            'description' => 'required',
            'route' => 'required',
            'displayed'         => 'required|boolean',
            'display_title' => 'boolean',
            'display_footer' => 'boolean',
            'weight' => 'integer|max:65535',
        ]);

        $newContent['creator_id'] = auth()->id();
        $content = Content::create($newContent);

        return redirect()->route('contents.show', $content);
    }

    /**
     * Display the specified content.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        Gate::authorize('lara-cms-lite-manage');

        $content = Content::with(config('lara-cms-lite.user.className'))->find($id);
        $mediaItems = null;
        return view('lara-cms-lite::contents.show', compact('content', 'mediaItems'));
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\View\View
     */
    public function edit(Content $content)
    {
        Gate::authorize('lara-cms-lite-manage');

        $routes = $this->getRoutes();
        return view('lara-cms-lite::contents.edit', compact('content', 'routes'));
    }

    /**
     * Update the specified content in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Content $content)
    {
        Gate::authorize('lara-cms-lite-manage');

        $contentData = $request->validate([
            'name'        => 'required|max:100',
            'description' => 'required',
            'route' => 'required',
            'displayed'         => 'required|boolean',
            'display_title' => 'boolean',
            'display_footer' => 'boolean',
            'weight' => 'integer|max:65535',
        ]);
        $contentData['creator_id'] = auth()->id();
        $contentData['displayed'] = $request->displayed;
        $content->update($contentData);

        return redirect()->route('contents.show', $content);
    }

    /**
     * Remove the specified content from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Content $content)
    {
        Gate::authorize('lara-cms-lite-manage');

        if ($request->get('content_id') == $content->id && $content->delete()) {
            return redirect()->route('contents.index');
        }

        return back();
    }


}

