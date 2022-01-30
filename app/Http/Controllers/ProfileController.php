<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserInterface;

class ProfileController extends Controller
{
    public UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get profile for current user 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProfile(Request $request) 
    {

        $profile = new ProfileResource(auth()->user());

        return response()->json($profile);
    }

    /**
     * Update profile for current user 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserRequest $request) 
    {

        $validated = $request->validated();

        $user = $this->user->update(
            $validated, 
            auth()->id()
        );

        $profile = new ProfileResource($user);

        return response()->json([
            "success" => true, 
            "data" => $profile,
            "message" => __("Successfuly Update Profile")
        ]);
    }
}
