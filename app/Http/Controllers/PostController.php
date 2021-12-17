<?php

namespace App\Http\Controllers;

use App\Actions\PostAction;
use App\Enums\SearchEnum;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::query()
            ->search($request->input(SearchEnum::SEARCH_TERM))
            ->sort($request->input(SearchEnum::SORT))
            ->filter($request->query())
            // ->with(['user' => fn ($q) => $q->withCountPostsMultiplyAge()])
            ->paginate($request->input(SearchEnum::PER_PAGE) ?: 15)
            ->appends(request()->query());

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request, PostAction $postAction)
    {
        $this->authorize('create', Post::class);

        $imagePath = $postAction->uploadPhoto($request->file('image'));

        auth()->user()->posts()->create(
            array_merge($request->validated(), ['image' => $imagePath])
        );

        return back()->with(['messages' => ['Post created successfully']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post, PostAction $postAction)
    {
        $this->authorize('update', $post);

        $imageArray = [];
        if ($request->has('image')) {
            $postAction->deletePhotos($post);
            $imageArray['image'] = $postAction->uploadPhoto($request->file('image'));
        }

        $post->update(array_merge($request->validated(), $imageArray));

        return back()->with(['messages' => ['Post updated successfully']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back()->with(['messages' => ['Post deleted successfully']]);
    }
}
