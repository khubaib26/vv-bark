<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use App\Models\User;
use App\Models\LeadStatus;
use Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    function __construct()
    {
        $this->middleware('role_or_permission:Lead access|Lead create|Lead edit|Lead delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Lead create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Lead edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Lead delete', ['only' => ['destroy']]);
    } 

    public function index()
    {
        $userId = Auth::user()->id;
         
        if(Auth::user()->hasRole('admin'))
        {
           $leads= Lead::orderBy('id', 'desc')->paginate(10);
        }else{
           $leads= Lead::where('assing_user_id',$userId)->orderBy('id', 'desc')->paginate(10);
        }

        $users = User::where('active','1')->whereNotIn('id', [1])->get();
        $status = LeadStatus::all();
        return view('setting.lead.index',['leads'=>$leads, 'users'=>$users, 'status'=>$status]);
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

    public function assign_user(Request $request){
       
        $lead_id = $request->lead_id;
        $user_id = $request->user_id;
        
        $lead = Lead::where('id', $lead_id)->update(['assing_user_id'=>$user_id]);
        
        return $lead;
    }


    // Lead Create API for Brands
    public function create_lead_api(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
             ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $leads = Lead::create([
            'brand_id' => $request->get('brand_id'),
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'details' => $request->get('details'),
            'source' => $request->get('source'),
            'platform' => $request->get('platform'),
            'value' => $request->get('value'),
            'lead_ip' => $request->get('lead_ip'),
            'lead_city' => "", // $currentUserInfo->cityName, //$request->get('lead_city'),
            'lead_state' => "", // $currentUserInfo->regionName, //$request->get('lead_state'),
            'lead_zip' => "",  // $currentUserInfo->zipCode, //$request->get('lead_zip'),
            'lead_country' => "", // $currentUserInfo->countryName, //$request->get('lead_country'),
            'lead_url' => $request->get('lead_url'),
            'keyword' => $request->get('keyword'),
            'matchtype' => $request->get('matchtype'),
            'msclkid' => $request->get('msclkid'),
            'gclid' => $request->get('gclid'),
            'view' => '0',
            'status_id' => '1'
        ]);
        
        return response()->json([
            'data' => $leads,
            'message' => 'Add Lead Successfully Created!'
        ], 200);    
    }


}
