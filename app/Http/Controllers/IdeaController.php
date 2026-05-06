<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\IdeaStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $ideas = Auth::user()
        ->ideas()
        ->when($request->status, fn ($query, $status) => $query->where('status', $status))
        ->get();

    // Select status, count(*) from ideas group by status


    return view('idea.index', [
        'ideas' => $ideas,
        'statusCounts' => Idea::statusCount(Auth::user())
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('idea.show',['idea'=>$idea]);

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
