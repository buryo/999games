<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::limit(128)->orderby('created_at')->get(['name', 'last_name']);
        $subsitutes = Participant::limit(15)->offset(128)->orderby('created_at')->get(['name', 'last_name']);

        return view('participant.home', compact('participants'), compact('subsitutes'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(participant $participant)
    {
        //
    }
}
