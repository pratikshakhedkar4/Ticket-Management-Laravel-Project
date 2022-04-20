<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view all tickets
    public function index()
    {
        $tickets=Ticket::all();        
        return view('tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //add ticket page
    public function create()
    {
        $users=User::where('role','user')->get();
        $agents=User::where('role','agent')->get();
        return view('tickets.create',compact(['users','agents']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store ticket data in table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'users' => 'required',
            'assets'=>'required',
            'priority'=>'required',
            'serial_number'=>'required|min:5|max:15',
            'model_number'=>'required|min:5|max:15',
            'agent'=>'required'
        ]);
        Ticket::create([
            'user_id'=>$request->users,
            'mobile'=>$request->mobile,
            'assets'=>$request->assets,
            'priority'=>$request->priority,
            'serial_number'=>$request->serial_number,
            'model_number'=>$request->model_number,
            'agent_id'=>$request->agent
        ]);
        return redirect('/tickets');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //autofilled mobile number based on user
    public function fetchMobile(Request $request){
        if($request->user_Id){
        $id=$request->user_Id;    
        $mobile= User::find($id)->mobile;
        return response()->json(['mobile'=>$mobile], 200);
        }
    }

    // view the ticket reports based on filter
    public function generateReport(Request $request){
        $start=strtotime($request->StartDate);
        $end=$request->EndDate;
        $request->validate([
            'StartDate'=>'required|date',
            'EndDate'=>'required|date',
            'priority'=>'required',
            'status'=>'required'
        ]);
        
        $tickets = Ticket::select("*")
                        ->whereDate('created_at','>=',date ( 'Y-m-d' , $start ))->where(['priority'=>$request->priority,'status'=>$request->status])
                        ->get();
  
        return view('view',compact('tickets'));

    }
    // report filter page
    public function viewReport(){
        $tickets=[];
        return view('report',compact('tickets'));
    }
    
}
