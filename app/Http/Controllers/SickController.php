<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckUPResource;
use App\Models\CheckUP;
use Illuminate\Http\Request;

class SickController extends Controller
{

    /**
     * Display a listing of the checkups for user.
     *
     * @return \App\Http\Resources\CheckUPResource
     */   
    function getCheckups(Request $request) 
    {
        $checkups = CheckUP::where("sick_id", auth()->id());
        $checkups = $checkups->whereHas('lab', function ($query) use($request) {
            return $query->where('name', 'like', "%$request->search%");
        });
        $checkups = $checkups->orderBy('created_at', "desc")
                            ->paginate($request->per_page ?? 2);
        return CheckUPResource::collection($checkups);
    }
}
