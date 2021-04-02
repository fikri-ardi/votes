<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($pollId, $choiceId)
    {
        auth()->user()->votes()->create([
            'poll_id'=>$pollId,
            'choice_id'=>$choiceId,
            'division_id'=> auth()->user()->division_id,
        ]);

        return redirect('/polls')->with('status', 'Your vote is recorded.');
    }
}
