<?php

namespace App\Http\Controllers\Api;

use App\Models\Prompts;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromptRequest;
use Illuminate\Http\Request;

class PromptsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Prompts::orderByDesc('prompts_id')->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromptRequest $request)
    {
        $validated = $request->validated();

        $prompts = Prompts::create($validated);

        return $prompts;
    }

    public function destroy($id)
    {
        $prompts = Prompts::findOrFail($id);

        $prompts->delete();

        return $prompts;
    }

    public function clear()
    {
        Prompts::query()->delete();
        return 'Deleted Successfully';
    }
}
