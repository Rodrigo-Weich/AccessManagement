<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\HomeChart;
use Auth;
use App\Card;
use App\CardGroup;
use App\Note;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cardUserData = Card::where('user_id', Auth::user()->id)->count();
        $cardData = Card::count();
        $cardGroupUserData = CardGroup::where('user_id', Auth::user()->id)->count();
        $cardGroupData = CardGroup::count();
        $noteUserData = Note::where('user_id', Auth::user()->id)->count();
        $noteData = Note::count();

        $borderColors = [
            "rgba(70, 48, 171, 1)",
            "rgba(72, 41, 97, 1)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(70, 48, 171, 0.2)",
            "rgba(72, 41, 97, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        $chart = new HomeChart;
        $chart->labels(['My', 'General']);
        $chart->minimalist(true);
        $chart->displaylegend(true);
        $chart->dataset('Data cards', 'doughnut', [$noteUserData, $noteData-$noteUserData])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

        $chart2 = new HomeChart;
        $chart2->labels(['My', 'General']);
        $chart2->minimalist(true);
        $chart2->displaylegend(true);
        $chart2->dataset('Data cards', 'doughnut', [$cardUserData, $cardData-$cardUserData])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $chart3 = new HomeChart;
        $chart3->labels(['My', 'General']);
        $chart3->minimalist(true);
        $chart3->displaylegend(true);
        $chart3->dataset('Data cards', 'doughnut', [$cardGroupUserData, $cardGroupData-$cardGroupUserData])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

        return view('home')->with([
            'chart' => $chart,
            'chart2' => $chart2,
            'chart3' => $chart3,
            'noteUserData' => $noteUserData,
            'cardUserData' => $cardUserData,
            'cardGroupUserData' => $cardGroupUserData
        ]);
    }
}
