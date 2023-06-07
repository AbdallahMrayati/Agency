<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("blogsView");
        $Posts = Post::all();
        return $this->sendResponse(PostResource::collection($Posts), 'Posts retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("blogAdd");
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'subtitle' => 'required',
            'contant' => 'required',
            "slug" => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = new Post();
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->contant = $request->contant;
        $post->slug = $request->slug;
        $post->user_id = auth()->user()->id;;
        $post->save();
        // $post = Post::create($input);

        return $this->sendResponse(new PostResource($post), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize("blogShow");
        $Post = Post::find($id);

        if (is_null($Post)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse(new PostResource($Post), 'Post retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $Post)
    {
        $this->authorize("blogEdit");
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'subtitle' => 'required',
            'contant' => 'required',
            "slug" => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Post->title = $input['title'];
        $Post->subtitle = $input['subtitle'];
        $Post->contant = $input['contant'];
        $Post->slug = $input['slug'];
        $Post->save();

        return $this->sendResponse(new PostResource($Post), 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("blogDelete");
        $post = Post::find($id);
        if (!$post) {
            return response()->json(["Not found"]);
        }
        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
