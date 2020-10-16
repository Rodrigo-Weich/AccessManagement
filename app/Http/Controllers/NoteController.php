<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Note::where('user_id', Auth::user()->id)->orWhere('owner', 1)->orderBy('name', 'asc')->paginate(15);
        return view('notes.index')->with([
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:200',
            'description' => 'required'
        ];
        $messages = [
            "name.required" => "The user name cannot be empty.",
            "name.min" => "The name must contain at least :min characters.",
            "name.max" => "The name must contain a maximum of :max characters.",
            "name.required" => "The description field cannot be empty."
        ];
        $request->validate($rules, $messages);

        $note = new Note;
        $note->name = $request->name;
        $note->description = $request->description;
        $note->user_id = Auth::user()->id;
        $note->owner = 0;
        $note->save();
        return redirect()->route('user.notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);
        return view('notes.show')->with([
            "note" => $note
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit')->with([
            "note" => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3|max:200',
            'description' => 'required'
        ];
        $messages = [
            "name.required" => "The user name cannot be empty.",
            "name.min" => "The name must contain at least :min characters.",
            "name.max" => "The name must contain a maximum of :max characters.",
            "name.required" => "The description field cannot be empty."
        ];
        $request->validate($rules, $messages);

        $note = Note::find($id);
        $note->name = $request->name;
        $note->description = $request->description;
        $note->user_id = Auth::user()->id;
        $note->owner = 0;
        $note->save();
        return redirect()->route('user.notes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        return redirect()->route('user.notes.index');
    }

    public function search(Request $request)
    {
        $cards = Note::where(function ($query){
            $query->where('user_id', Auth::user()->id)
            ->orWhere('owner', 1);
        })->where('name', 'like', '%'.$request->dataToSearch.'%')->paginate(15);

        return view('notes.index')->with([
            "data" => $cards,
        ]);
    }
}
