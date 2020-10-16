<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Card::where('user_id', Auth::user()->id)->orWhere('owner', 1)->orderBy('name', 'asc')->paginate(15);
        return view('cards.index')->with([
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
        return view('cards.create');
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
            'name' => 'required|min:3|max:200'
        ];
        $messages = [
            "name.required" => "The user name cannot be empty.",
            "name.min" => "The name must contain at least :min characters.",
            "name.max" => "The name must contain a maximum of :max characters."
        ];
        $request->validate($rules, $messages);

        $card = new Card;
        $card->name = $request->name;
        $card->url = $request->url;
        $card->login = $request->login;
        $card->password = Crypt::encrypt($request->password);
        $card->user_id = Auth::user()->id;
        $card->owner = 0;
        $card->save();
        return redirect()->route('user.cards.index');
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
        $data = Card::find($id);
        return view('cards.edit')->with([
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
            'name' => 'required|min:3|max:200'
        ];
        $messages = [
            "name.required" => "The user name cannot be empty.",
            "name.min" => "The name must contain at least :min characters.",
            "name.max" => "The name must contain a maximum of :max characters."
        ];
        $request->validate($rules, $messages);

        $card = Card::find($id);
        $card->name = $request->name;
        $card->url = $request->url;
        $card->login = $request->login;
        $card->password = Crypt::encrypt($request->password);
        $card->user_id = Auth::user()->id;
        $card->owner = 0;
        $card->save();
        return redirect()->route('user.cards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();
        return redirect()->route('user.cards.index');
    }

    public function search(Request $request)
    {
        $cards = Card::where(function ($query){
            $query->where('user_id', Auth::user()->id)
            ->orWhere('owner', 1);
        })->where(function ($query) use ($request){
            $query->where('name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('login', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('url', 'like', '%'.$request->dataToSearch.'%');
        })->paginate(15);

        return view('cards.index')->with([
            "data" => $cards,
        ]);
    }
}
