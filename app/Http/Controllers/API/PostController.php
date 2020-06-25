<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->has('name'))
       {
         $posts = Post::where('name', $request->input('name'))->get();
       }
       else {
         $posts = Post::all();
       }


       return $this->sendResponse(PostResource::collection($posts), "Post was retreive successfully");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $validator = $request->validated();
        $input = $request->all();
        $posts = Post::create($input);

        return $this->sendResponse(new PostResource($posts), "Post was stored successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $posts = Post::findOrFail($id);

        return $this->sendResponse(new PostResource($posts),  "Post was shown successfully");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //

        $posts = Post::findOrFail($id);
        $validator = $request->validated();
        $input = $request->all();
        $posts->update($input);

        return $this->sendResponse(new PostResource($posts),  "Post was updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $posts = Post::findOrFail($id);
        $posts->delete();

        return $this->sendResponse(new PostResource($posts),  "Post was deleted successfully");
    }
}
