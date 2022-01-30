<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckUPResource;
use App\Models\CheckUP;
use App\Models\User;
use App\Repositories\Interfaces\CheckUPInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CheckUPRequest;

class CheckUPController extends Controller
{

    public CheckUPInterface $checkup;

    public function __construct(CheckUPInterface $checkup)
    {
        $this->checkup = $checkup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $checkup = $this->checkup->filterBySick($request->search);
        $checkup = $checkup->orderBy('created_at', "desc")
                            ->paginate($request->per_page ?? 8);
        return CheckUPResource::collection($checkup);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckUPRequest $request)
    {
        $validated = $request->validated();

        $checkup = $this->checkup->create($validated);
        $checkup = new CheckUPResource($checkup);

        return response()->json([
            "success" => true,
            "data" => $checkup,
            "message" => __("Successufly create checkup")
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckUP  $checkUP
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $checkup = $this->checkup->get($id);
        $checkup = new CheckUPResource($checkup);

        return response()->json([
            "success" => true,
            "data" => $checkup
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckUP  $checkUP
     * @return \Illuminate\Http\Response
     */
    public function update(CheckUPRequest $request, $id)
    {
        $validated = $request->validated();

        $checkup = $this->checkup->update($validated, $id);
        $checkup = new CheckUPResource($checkup);

        return response()->json([
            "success" => true,
            "data" => $checkup,
            "message" => __("Successufly update checkup")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckUP  $checkUP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkup->delete($id);

        return response()->json([
            "success" => true,
            "message" => __("Successufly delete checkup $id")
        ]);
    }
}
