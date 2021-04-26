<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Customer;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){
    	$now = Carbon::now();
	    $month = $now->format('F');
	   	$date = $now->toDateString(); 


        if (request('sdate') && request('edate')) {
        	$s = request('sdate');
        	$e = request('edate');

        	$startdate = Carbon::parse($s)->format('Y-m-d');
    		$enddate = Carbon::parse($e)->format('Y-m-d');

    		$sales = Sale::whereBetween('saledate',[$startdate, $enddate])->get();

    		$purchases = DB::select('SELECT stocks.*, items.id as i_id, items.codeno as codeno, items.name as name, colors.name as color 
		    				FROM stocks 
		    				INNER JOIN items ON stocks.item_id = items.id
		    				INNER JOIN colors ON items.color_id = colors.id
		    				WHERE stocks.stockdate BETWEEN ? AND ?',[$startdate,$enddate]);

    		// Purchase
		    $purchasedata = DB::select('SELECT SUM(price) as total FROM stocks WHERE stockdate BETWEEN ? AND ?',[$startdate,$enddate]);  
	        $purchase = intval($purchasedata[0]->total);

	        // Sale
	        $saledata = DB::select('SELECT SUM(total) as total FROM sales WHERE saledate BETWEEN ? AND ?',[$startdate,$enddate]);
	        $sale = intval($saledata[0]->total);

	        // Sale
	        $expensedata = DB::select('SELECT SUM(amount) as total FROM expenses WHERE expensedate BETWEEN ? AND ?',[$startdate,$enddate]);      
	        $expense = intval($expensedata[0]->total);

	        $chartdatas = [
	                'sale'         => $sale,
	                'purchase'       => $purchase,
	                'expense'      => $expense,
	            ];

        }else{


	        $sales = Sale::orderBy('saledate', 'DESC')->where('saledate',$date)->get();

	        $purchases = DB::select('SELECT stocks.*, items.id as i_id, items.codeno as codeno, items.name as name, colors.name as color 
		    				FROM stocks 
		    				INNER JOIN items ON stocks.item_id = items.id
		    				INNER JOIN colors ON items.color_id = colors.id
		    				WHERE stocks.stockdate = ?',[$date]);

	        $startdate = $now->startOfMonth()->toDateString();
			$enddate = $now->endOfMonth()->toDateString();

	    	// Purchase
		    $purchasedata = DB::select('SELECT SUM(price) as total FROM stocks WHERE stockdate BETWEEN ? AND ?',[$startdate,$enddate]);  
	        $purchase = intval($purchasedata[0]->total);

	        // Sale
	        $saledata = DB::select('SELECT SUM(total) as total FROM sales WHERE saledate BETWEEN ? AND ?',[$startdate,$enddate]);
	        $sale = intval($saledata[0]->total);

	        // Expense
	        $expensedata = DB::select('SELECT SUM(amount) as total FROM expenses WHERE expensedate BETWEEN ? AND ?',[$startdate,$enddate]);      
	        $expense = intval($expensedata[0]->total);

	        $chartdatas = [
	                'sale'         => $sale,
	                'purchase'       => $purchase,
	                'expense'      => $expense,
	            ];
        }
    	return view('backside.report', compact('date', 'sales', 'purchases', 'chartdatas'));
    }

    public function dashboard(){
    	$now = Carbon::now();
	    $month = $now->format('F');
	   	$date = $now->toDateString();

	   	// Sale
        $sale = Sale::where('saledate', $date)->sum('total');

        $items = Item::count();
        $suppliers = Supplier::count();
        $customers = Customer::count();

        $period = now()->subMonths(11)->monthsUntil(now());

		$datedatas = [];
		foreach ($period as $date)
		{
		   $datedatas[] = [
		       	'month' => $date->month,
		      	'startdate' => $date->startOfMonth()->toDateString(),
				'enddate' => $date->endOfMonth()->toDateString(),
		       	'year' => $date->year,
		   ];
		}
		asort($datedatas);

		$datas = [];

		foreach ($datedatas as $key => $datedata) {
			$month = $datedata['month'];
			$startdate = $datedata['startdate'];
			$enddate = $datedata['enddate'];

			// Sale
	        $saledata = DB::select('SELECT SUM(total) as total FROM sales WHERE saledate BETWEEN ? AND ?',[$startdate,$enddate]);
	        $sale = intval($saledata[0]->total);

	        $datas[] = [
	        	'month' => $month,
	        	'total' => $sale
 	        ];
		}

    	return view('backside.dashboard',compact('sale','items','suppliers','customers','datas'));
    }
}
