<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Car;
use App\Models\Country;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\Stock;

use DataTables;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getitemstockData($id)
    {
        $datas = Stock::where('item_id',$id)
        			->orderBy('stockdate','desc')
        			->get();

        return  Datatables::of($datas)
                    ->addIndexColumn()
                    ->addColumn('stockdate', function($datas){
                        return $datas->stockdate;
                    })
                    ->addColumn('supplier', function($datas){
                        return $datas->supplier->name;
                    })
                    ->addColumn('qty',function($datas){
                        return $datas->qty;
                    })
                    ->addColumn('pc', function($datas){
                        return $datas->pc;
                    })
                    ->addColumn('price', function($datas){
                        return $datas->price;
                    })
                    ->addColumn('action', function($row){

                        $btn = '<div class="buttons">';
                       	$btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-stockdate="'.$row->stockdate.'" data-qty="'.$row->qty.'" data-pc="'.$row->pc.'" data-price="'.$row->price.'">
                                    <i class="bi bi-gear btnicon"></i>
                                </a>';

                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
                                    <i class="bi bi-x btnicon"></i>
                                </a>';
                        
                        $btn = $btn.'</div>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        
    }

    public function additemStock(Request $request, $id)
    {
        $item = Item::find($id); 

        $date = $request->date;
        $price = $request->price;
        $qty = $request->qty;
        $pc = $request->pc;
        $type = $request->type;
        $sup_name = $request->sup_name;
        $sup_phone = $request->sup_phone;
        $sup_address = $request->sup_address;
        $sup_note = $request->sup_note;
        $sup_existingsupplier = $request->sup_existingsupplier;

        if ($sup_name) 
        {
            $supplier= new Supplier();
            $supplier->name=$sup_name;
            $supplier->phoneno=$sup_phone;
            $supplier->address=$sup_address;
            $supplier->note=$sup_note;
            $supplier->user_id= Auth::id();
            $supplier->save();

            $supplier_id = $supplier->id;
        }
        else
        {
            $supplier_id = $sup_existingsupplier;
        }

        // STOCK 
        $st_price = $price;
        $st_quantity = $qty;
        $st_pc = $pc;
        $st_date = $date;
        $st_type = $type;

        $stock = new Stock();
        $stock->stockdate = $st_date;
        $stock->qty = $st_quantity;
        $stock->pc = $st_pc;
        $stock->type = $st_type;
        $stock->price = $st_price;
        $stock->item_id = $item->id;
        $stock->supplier_id = $supplier_id;
        $stock->user_id = 1;
        $stock->save();


        return response()->json(['success'=>'STOCK <b> ADDED </b> successfully.']);


    }

    public function edititemStock(Request $request, $id){
    	// STOCK 
        $st_price = $request->price;
        $st_quantity = $request->qty;
        $st_pc = $request->pc;
        $st_date = $request->date;

        $stock = Stock::find($id);
        $stock->stockdate = $st_date;
        $stock->qty = $st_quantity;
        $stock->pc = $st_pc;
        $stock->price = $st_price;
        $stock->user_id = 1;
        $stock->save();

        return response()->json(['success'=>'STOCK <b> UPDATED </b> successfully.']);
    	

    }

    public function destroyitemStock($id){
    	$stock = Stock::find($id);
    	$stock->delete();

        return response()->json(['success'=>'Stock <b> DELETED </b> successfully.']);
    }
}
