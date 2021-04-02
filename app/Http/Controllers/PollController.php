<?php

namespace App\Http\Controllers;

use App\Models\{Poll, Division};
use App\Http\Requests\PollRequest;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::paginate(10);
        $divisions = Division::paginate(10);
        
        return view('polls.index', compact('polls', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollRequest $request)
    {
        $data = $request->all();
        $data['deadline'] = $request->deadline.date(' H:i:s');
        
        $poll = auth()->user()->polls()->create($data);

        foreach ($request->choices as $choice) {
            if ($choice != null) {
                $poll->choices()->create([
                    'name'=>$choice
                ]);
            }
        }

        return redirect('/polls')->with('status', 'The poll has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        Poll::destroy($poll->id);

        return redirect('/polls')->with('status', 'The poll has been successfully deleted.');
    }
}
