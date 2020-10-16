<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\CardGroup;
use App\Card;

class CardGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CardGroup::where('user_id', Auth::user()->id)->orWhere('owner', 1)->orderBy('name', 'asc')->paginate(15);
        return view('card_groups.index')->with([
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
        $data = Card::where('user_id', Auth::user()->id)->orWhere('owner', 1)->get();
        return view('card_groups.create')->with([
            "data" => $data
        ]);
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

        $cardgroup = new CardGroup;
        $cardgroup->name = $request->name;
        $cardgroup->description = $request->description;
        $cardgroup->user_id = Auth::user()->id;
        $cardgroup->save();
        $cardgroup->cards()->sync($request->cards);
        $cardgroup->save();
        return redirect()->route('user.cardgroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = CardGroup::find($id);
        $data = Card::where('user_id', Auth::user()->id)->orWhere('owner', 1)->get();
        return view('card_groups.edit')->with([
            "card" => $card,
            "data" => $data
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

        $cardgroup = CardGroup::find($id);
        $cardgroup->name = $request->name;
        $cardgroup->description = $request->description;
        $cardgroup->user_id = Auth::user()->id;
        $cardgroup->save();
        $cardgroup->cards()->sync($request->cards);
        $cardgroup->save();
        return redirect()->route('user.cardgroups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = CardGroup::find($id);
        $card->cards()->detach();
        $card->delete();
        return redirect()->route('user.cardgroups.index');
    }

    public function search(Request $request)
    {
        $cards = CardGroup::where(function ($query){
            $query->where('user_id', Auth::user()->id)
            ->orWhere('owner', 1);
        })->where('name', 'like', '%'.$request->dataToSearch.'%')->paginate(15);

        return view('card_groups.index')->with([
            "data" => $cards,
        ]);
    }
}
