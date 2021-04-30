<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Spa;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Route;

class FrontendController extends Controller
{
    public function index(){
        $datas = Item::latest()->get();
        $items = array();
        foreach ($datas as $key => $data) {
            $id = $data->id;

            $stockqtys = $data->stocks;
            $stock = 0;
            foreach ($stockqtys as $stockqty) {
                $stock += $stockqty->qty;
            }


            $saleqtys = $data->saledetails;
            $sale = 0;
            foreach ($saleqtys as $saleqty) {
                $sale += $saleqty->qty;
            }

            $currentstock = $stock - $sale;
            if($currentstock > 0){
                $item = Item::find($id);
                if (count($items) < 7 ) {
                    array_push($items, $item);
                }

            }

        }

    	return view('frontside.index',compact('items'));
    }

    public function accessory(){

    	$datas = Item::latest()->get();
        $itemarrays = array();
        foreach ($datas as $key => $data) {
            $id = $data->id;

            $stockqtys = $data->stocks;
            $stock = 0;
            foreach ($stockqtys as $stockqty) {
                $stock += $stockqty->qty;
            }


            $saleqtys = $data->saledetails;
            $sale = 0;
            foreach ($saleqtys as $saleqty) {
                $sale += $saleqty->qty;
            }

            $currentstock = $stock - $sale;
            if($currentstock > 0){
                $item = Item::find($id);
                array_push($itemarrays, $item);

            }

        }

        $items = $this->paginate($itemarrays);
        // dd($items);


    	return view('frontside.accessories',compact('items','datas'));
    }

    public function paginate($items, $perPage = 6, $page = null, $options = [])
    {
        $currentURL = Route::current()->getName();
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $paginatedItems = new LengthAwarePaginator($items->forPage($page, $perPage), 
            $items->count(), $perPage, $page, $options);

        $paginatedItems->setPath($currentURL);

        return $paginatedItems;
    }

    public function info($id){
    	$item = Item::find($id);
    	return view('frontside.accessory',compact('item'));
    }

    public function service(){
        $spas = Spa::latest()->paginate(6);

    	return view('frontside.services',compact('spas'));
    }

    public function detail($id){
    	$spa = Spa::find($id);
    	return view('frontside.service',compact('spa'));
    }

}
