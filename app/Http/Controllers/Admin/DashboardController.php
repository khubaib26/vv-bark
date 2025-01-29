<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Lead;
use App\Models\User;
use App\Models\LeadStatus;
use App\Models\UserCredit;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        
        //Stats Functions
        $todayLeadsCount = Lead::whereDate('created_at', Carbon::today())->count(); //count today leads 
        $yearLeadsCount = Lead::whereYear('created_at', Carbon::now()->year)->count(); // count current year lead   
        $convertLeadsCount = Lead::where('status_id','2')->whereYear('created_at', Carbon::now()->year) // Count month Converted Lead
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->count();
        
        $monthLeadsCount = Lead::whereYear('created_at', Carbon::now()->year) // Count month Lead
        ->whereMonth('created_at', Carbon::now()->month)->count();
        
        // Last Month Lead Count
        $lastMonthLead = Lead::select('*')->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        //End Stats Functions

        // User List 
        $users = User::where('id', '!=', '1')->withCount([
            'leads as convertedLead' => function ($query) {
                $query->where('status_id', 2);
            }
        ])->get();

        $data = [
            "todayLead"       => $todayLeadsCount,
            "monthLead"       => $monthLeadsCount,
            "yearleadCount"   => $yearLeadsCount, 
            "convertedLead"   => $convertLeadsCount,
            "leadConvertRate" => conversion_rate($convertLeadsCount, $monthLeadsCount),
            "LeadMonthGrowth" => growth_calculation($monthLeadsCount,$lastMonthLead),
            "userList"        => $users,  
            // "leadstatus"      => json_encode($leadData),
            // "statusValue"     => json_encode($statusValue),
            // "statusColor"     => json_encode($statusColor),
            // "leadStatusCount" => $leadStatusCount,
            // "recentlyAddLeads" => $recentlyAddLeads,
            // "statusData"       => implode(", ",$statusData),
            // "lastMonthStatusData" => implode(", ",$lastMonthStatusData),
            // "statusNameBar"    => implode(",",$statusNameBar),
            // "freshAccount"     => $freshAccount 
        ]; 
       
        return view('dashboard',compact('data'));   
    }
}
