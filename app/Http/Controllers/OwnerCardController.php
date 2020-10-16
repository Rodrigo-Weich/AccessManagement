<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Card;

class OwnerCardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('list-cards')){
            return view('403');
        }

        $data = Card::where('owner', 1)->orderBy('name', 'asc')->paginate(15);
        return view('admin.cards.index')->with([
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
        if(Gate::denies('create-cards')){
            return view('403');
        }

        return view('admin.cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('create-cards')){
            return view('403');
        }

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
        $card->owner = 1;
        $card->save();
        return redirect()->route('admin.cards.index');
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
        if(Gate::denies('update-cards')){
            return view('403');
        }

        $data = Card::find($id);
        return view('admin.cards.edit')->with([
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
        if(Gate::denies('update-cards')){
            return view('403');
        }

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
        $card->owner = 1;
        $card->save();
        return redirect()->route('admin.cards.index');
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
        return redirect()->route('admin.cards.index');
    }

    public function search(Request $request)
    {
        $cards = Card::where('owner', 1)
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->dataToSearch.'%');
            })->paginate(15);

        return view('admin.cards.index')->with([
            "data" => $cards,
        ]);
    }
}
