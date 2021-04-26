<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Saledetail;


use Illuminate\Http\Request;
use App\Models\Spa;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(6);
        $spas = Spa::latest()->paginate(6);

        return view('backside.sale.index',compact('items','spas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Customer
        $c_name = $request->name;
        $c_phone = $request->phone;
        $c_address = $request->address;

        $invoiceno = $request->invoiceno;

        $total = $request->total;
        $discount = $request->discount;
        $paymoney = $request->paymoney;


        $carts = $request->cart;

        $carbon = Carbon::now();
        $today = $carbon->format('Y-m-d');

        
        $customer = Customer::create([
            'name'      => $c_name,
            'phoneno'   => $c_phone,
            'address'   => $c_address,
            'status'    => 0
        ]);

        $customerid = $customer->id;



        $sale = Sale::create([
                'invoiceno'     => $invoiceno,
                'saledate'      => $today,
                'total'         => $total,
                'discount'      => $discount,
                'paymoney'      => $paymoney,
                'customer_id'   => $customerid,
                'user_id'       => Auth::id(),

            ]);

        foreach ($carts as $cart) 
        {
            $id = $cart['id'];
            $codeno = $cart['codeno'];
            $name = $cart['name'];
            $price = $cart['price'];
            $qty = $cart['qty'];
            $status = $cart['status'];

            $saledetail= new Saledetail();
            $saledetail->qty=$qty;

            if ($status == "item") 
            {
                $saledetail->item_id=$id;
            }
            else 
            {
                $saledetail->spa_id=$id;
            }

            $saledetail->sale_id=$sale->id;
            $saledetail->save();

        }
        return response()->json(['success'=>'Sale <b> SAVED </b> successfully.']);

    }

    public function show(Sale $sale)
    {
        return view('backside.sale.detail',compact('sale'));
    }

    public function edit(Sale $sale)
    {
        //
    }

    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        //
    }

    public function spa_fetch_data(Request $request)
    {
        $spas = Spa::latest()->paginate(6);

        return view('backside.sale.spa', compact('spas'))->render();
    }

    public function item_fetch_data(Request $request)
    {
        $items = Item::latest()->paginate(6);

        return view('backside.sale.item', compact('items'))->render();
    }

    public function salesearch(Request $request)
    {
        $search = $request->seach;

        $spa = Spa::where('codeno','like','%'.$search.'%')
                    ->orWhere('name','like','%'.$search.'%')
                    ->get();
        $item = Item::with(array('stocks','saledetails'))
                ->where('codeno','like','%'.$search.'%')
                ->orWhere('name','like','%'.$search.'%')
                ->get();

        $datas = $spa->merge($item);

        return Response($datas);
    }
}
