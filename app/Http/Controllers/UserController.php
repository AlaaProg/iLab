<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\ProfileResource;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserInterface $user;

    function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (auth()->user()->hasRoles(['lab'])){
            
            $request->role = "sick";
        }

        // filter users by name 
        $users = $this->user->filter($request->search ?? "", $request->role);
        $users = $users->paginate($request->per_page ?? 8);
        return ProfileResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // get validated data 
        $validated = $request->validated();
        
        $user = $this->user->create($validated);
        $profile = new ProfileResource($user);

        return response()->json([
            "success" => true,
            "data" =>  $profile,
            "message" => __("Successfuly Create User")
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
        $user = $this->user->get($id);
        $profile = new ProfileResource($user);

        return $profile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // get validated data 
        $validated = $request->validated();

        $user = $this->user->update($validated, $id);
        $profile = new ProfileResource($user);
        
        return response()->json([
            "success" => true, 
            "data" => $profile,
            "message" => __("Successfuly update user profile")
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
        $this->user->delete($id);

        return response()->json([

            "success" => true, 
            "message" => __("Successfuly delete  user $id")
        ]);
    }
}
