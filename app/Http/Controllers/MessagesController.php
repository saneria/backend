<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Http\Requests\MessageRequest;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Messages::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
       
        //Retrieve the validated input data
        $validated = $request->validated();

        $message = Messages::create($validated);

        return $message;
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, string $id)
    {
        $validated = $request->validated();

        $message = Messages::findOrFail($id);

        $message->update($validated);

        return $message;
    }

 
}
