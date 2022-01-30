<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public UserInterface $user;

    function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    function getUsers(Request $request) {

        $users = $this->user->filter($request->search ?? "", 'sick');
        return ProfileResource::collection($users->get());
    }
}
