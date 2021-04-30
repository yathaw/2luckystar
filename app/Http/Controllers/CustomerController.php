<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;
use Auth;

class CustomerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:customer-အားလုံးကြည့်မည်');
        $this->middleware('permission:customer-ဖျက်မည်', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('backside.customer');
    }

    public function create()
    {
        //
    }

    public function getlistData(Request $request)
    {

        $data = Customer::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Customer $customer) {
                        return $customer->name;
                    })
                    ->addColumn('phone', function(Customer $customer) {
                        return $customer->phoneno;
                    })
                    ->addColumn('address', function(Customer $customer) {
                        return $customer->address;
                    })

                    ->addColumn('action', function($row){

                        $user = Auth::user();

                        $btn = '<div class="buttons">';
                        if($user->hasAnyPermission(['customer-ဖျက်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
                                        <i class="bi bi-x btnicon"></i>
                                    </a>';
                        }
                        
                        $btn = $btn.'</div>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['success'=>'Customer <b> DELETED </b> successfully.']);
    }
}
