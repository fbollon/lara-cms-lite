<?php

namespace Fbollon\LaraCmsLite\Http\Controllers;

use Fbollon\LaraCmsLite\Models\Content;
use App\Http\Controllers\Controller;
// use App\Content_type;
use Illuminate\Http\Request;
// use Spatie\MediaLibrary\Models\Media;

class ContentController extends Controller
{
    /**
     * Display a listing of the content.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contentQuery = Content::query();
        $contentQuery->where('name', 'like', '%'.request('q').'%');
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
        $this->authorize('create', new Content);
        $routes = \Route::getRoutes()->getRoutesByMethod()['GET'];
        ksort($routes);
        return view('contents.create', compact('routes'));
    }

    /**
     * Store a newly created content in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Content);
        $newContent = $request->validate([
            'name'        => 'required|max:100',
            'description' => 'required',
            'route' => 'required',
            'displayed'         => 'required|boolean',
        ]);

        $newContent['user_id'] = auth()->id();
        $content = Content::create($newContent);

        return redirect()->route('contents.show', $content);
    }

    /**
     * Display the specified content.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\View\View
     */
    public function show(Content $content)
    {
        // $mediaItems = $content->getMedia('images');
        $mediaItems = null;
        return view('contents.show', compact('content', 'mediaItems'));
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\View\View
     */
    public function edit(Content $content)
    {
        $this->authorize('update', $content);
        $routes = \Route::getRoutes()->getRoutesByMethod()['GET'];
        ksort($routes);
        return view('contents.edit', compact('content', 'routes'));
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
        $this->authorize('update', $content);

        $contentData = $request->validate([
            'name'        => 'required|max:100',
            'description' => 'required',
            'route' => 'required',
            'displayed'         => 'required|boolean',
        ]);
        $contentData['user_id'] = auth()->id();
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
        $this->authorize('delete', $content);
        $request->validate(['content_id' => 'required']);

        if ($request->get('content_id') == $content->id && $content->delete()) {
            return redirect()->route('contents.index');
        }

        return back();
    }

    /**
     * remove uploaded file
     *
     * remove file and thumb
     *
     **/
    public function removeFile(Request $request)
    {
        // foreach ($request['medias'] as $media) {
        //     $mediaTodelete = Media::find($media)->delete();
        // }

        return redirect("/contents/{$request['content_id']}")->with('success', 'File deleted !');
    }


    public function upload(Request $request, Content $content)
    {
        // $this->validate($request, [
        //     'newFile' => 'image|max:10000|required',
        //     'fileDescription' => 'nullable|max:1000',
        //     'fileTitle' => 'nullable|max:100',
        // ]);

        // //Store Image
        // if ($request->hasFile('newFile') && $request->file('newFile')->isValid()) {
        //     $media = $content->addMediaFromRequest('newFile')
        //         ->withCustomProperties(
        //             [
        //                 'description' => $request->fileDescription,
        //                 'title' => $request->fileTitle
        //             ]
        //         )->toMediaCollection('images');
        // }

        return redirect("/contents/{$content->id}")->with('success', 'New file added !');
    }

}

