<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use Auth;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::user()->user_type == 'user')
		{
			$idx = Auth::user()->distri_id;
			$data = array();
			$data['total_property'] = DB::table('claim')->where('distributor_id',$idx)->count();
			$data['featured_property'] = DB::table('distributor')->where('status',1)->count();
			$data['sold_property'] = DB::table('claim')->where('distributor_id',$idx)->where('status','B')->count();
			$data['inactive_property'] = DB::table('users')->where('user_type','<>','user')->count();
			$data['total_queries'] = $this->total_queries();
			$data['total_category'] = $this->total_category();
		}
		else
		{
			$data = array();
			$data['total_property'] = DB::table('claim')->count();
			$data['featured_property'] = DB::table('distributor')->where('status',1)->count();
			$data['sold_property'] = DB::table('claim')->where('status','B')->count();
			$data['inactive_property'] = DB::table('users')->where('user_type','<>','user')->count();
			$data['total_queries'] = $this->total_queries();
			$data['total_category'] = $this->total_category();
		}
		
        return view('backend/dashboard', $data);
    }
	
	private function total_queries(){
		$date = '2023-01-01';
		if(Auth::user()->user_type == 'user')
		{
			$idx = Auth::user()->distri_id;
			$search_query  = "[";
			$search_queries = \DB::select("SELECT m.month, COUNT(id) as total_queries
			FROM ( SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH 
			UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH 
			UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH 
			UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH ) AS m
			LEFT JOIN claim ON distributor_id = '$idx' AND m.month = MONTH(created_at) AND YEAR(created_at) = YEAR('$date') 
			GROUP BY m.month ORDER BY m.month ASC");
			foreach($search_queries as $row){
				$search_query .= $row->total_queries . ",";
			}
			return $search_query."]";
		}
		else
		{
			$search_query  = "[";
			$search_queries = \DB::select("SELECT m.month, COUNT(id) as total_queries
			FROM ( SELECT 1 AS MONTH UNION SELECT 2 AS MONTH UNION SELECT 3 AS MONTH 
			UNION SELECT 4 AS MONTH UNION SELECT 5 AS MONTH UNION SELECT 6 AS MONTH 
			UNION SELECT 7 AS MONTH UNION SELECT 8 AS MONTH UNION SELECT 9 AS MONTH 
			UNION SELECT 10 AS MONTH UNION SELECT 11 AS MONTH UNION SELECT 12 AS MONTH ) AS m 
			LEFT JOIN claim ON m.month = MONTH(created_at) AND YEAR(created_at) = YEAR('$date') 
			GROUP BY m.month ORDER BY m.month ASC");
			foreach($search_queries as $row){
				$search_query .= $row->total_queries . ",";
			}
			return $search_query."]";
		}
	}
	
	private function total_category(){
		$date = date("Y");
		
		if(Auth::user()->user_type == 'user')
		{
			$idx = Auth::user()->distri_id;
			$total_category  = "[";
			$totals = \DB::select("SELECT  count(id) as total_category, status from claim  where distributor_id = '$idx' and year(created_at)='$date' GROUP by  status");
			foreach($totals as $row){
				$total_category .= "[ '".klaimi_status($row->status)."',".$row->total_category ."]," ;
			}
			return $total_category."]";
		}
		else
		{
			$total_category  = "[";
			$totals = \DB::select("SELECT  count(id) as total_category, status from claim  where year(created_at)='$date' GROUP by  status");
			foreach($totals as $row){
				$total_category .= "[ '".klaimi_status($row->status)."',".$row->total_category ."]," ;
			}
			return $total_category."]";
		}
	}
}
