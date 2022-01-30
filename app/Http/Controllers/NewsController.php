<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Repositories\Interfaces\NewsInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public NewsInterface $news;

    function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // filter news by title 
        $news = $this->news->filterLike('title', $request->search); 
        $news = $news->orderBy('created_at', "desc")
                        ->paginate($request->per_page ?? 8);
        return NewsResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required",
            "text" => "required",
            "image" => "required|image",
        ]);

        $news = $this->news->create($validated);
        $news = new NewsResource($news);

        return response()->json([
            "success" => true,
            "data" => $news,
            "message" => __("Successufly create new news")
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $news = $this->news->get($id);
        $news = new NewsResource($news);

        return response()->json([
            "success" => true,
            "data" => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "title" => "string",
            "text" => "string",
            "image" => "image",
        ]);

        $news = $this->news->update($validated, $id);
        $news = new NewsResource($news);

        return response()->json([
            "success" => true,
            "data" => $news,
            "message" => __("Successufly update news")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->news->delete($id);

        return response()->json([
            "success" => true,
            "message" => __("Successufly delete news $id")
        ]);
    }
}
