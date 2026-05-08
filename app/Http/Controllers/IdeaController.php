<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Models\Idea;
use App\IdeaStatus;
use App\Actions\CreateIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $ideas = $user
            ->ideas()
            ->when(in_array($request->status, IdeaStatus::values()), fn($query) => $query->where('status', $request->status))
            ->latest()
            ->get();

        return view('idea.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::statusCount($user),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request)
    {
        //(new CreateIdea)->handle();

        $idea = Auth::user()->ideas()->create($request->safe()->except('steps','image'));
        $idea->steps()->createMany(collect($request->steps)->map(fn ($step)=>['description'=>$step])
        );
        $image_path = $request->image->store('ideas','public');
        $idea->update(['image_path' => $image_path]);
        return redirect("/")->with("success , Idea created !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        
        return view('idea.show', ['idea' => $idea]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete($idea->id);
        return redirect('/');
    }
}
