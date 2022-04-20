<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
    //dashboard page
    public function index()
    {
        $resolvedCount=Ticket::where('status', 'Dispatched')->where('status_updated_at',Carbon::now()->toDateString())->count();
        $closedCount=Ticket::where('status', 'Closed')->where('status_updated_at',Carbon::now()->toDateString())->count();
        $activeAgent=User::where(['status'=>'active','role'=>'agent'])->get()->count();
        $activeTicket=Ticket::where('status', 'pending')->count();
        return view('home',compact(['resolvedCount','closedCount','activeAgent','activeTicket']));
    }
}
