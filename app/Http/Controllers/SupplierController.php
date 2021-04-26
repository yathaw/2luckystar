<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    
    public function index()
    {
        return view('backside.supplier');
    }

    public function getlistData(Request $request)
    {

        $data = Supplier::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Supplier $supplier) {
                        return $supplier->name;
                    })
                    ->addColumn('phone', function(Supplier $supplier) {
                        return $supplier->phoneno;
                    })
                    ->addColumn('address', function(Supplier $supplier) {
                        return $supplier->address;
                    })
                    ->addColumn('note', function(Supplier $supplier) {
                        return $supplier->note;
                    })

                    ->addColumn('action', function($row){

                        $btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'" data-phone="'.$row->phoneno.'" data-address="'.$row->address.'" data-note="'.$row->note.'">
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

    public function create()
    {
        
    }

    public function store(Request $request)
    {

        $rules = [
            'name'  =>'required|unique:suppliers,name,NULL,id,deleted_at,NULL',
            'phone' =>'required',
            'address' =>'required',

        ];

        $customMessages = [
            'name.required' => 'Supplier နာမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'Supplier နာမည်မှာထပ်နေပါသည်။',
            'phone.required' => 'Supplier ဖုန်းနံပါတ် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'address.required' => 'Supplier လိပ်စာ ဖြည့်သွင်းရန်လိုအပ်သည်။',

        ];

        $this->validate($request, $rules, $customMessages);

        Supplier::create([
            'name'  => $request->name,
            'phoneno'  => $request->phone,
            'address'  => $request->address,
            'note'  => $request->note,
            'user_id' => Auth::id()

        ]);        
   
        return response()->json(['success'=>'Supplier <b> SAVED </b> successfully.']);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $supplier=Supplier::find($id);
        $supplier->name= request('name');
        $supplier->phoneno= request('phone');
        $supplier->address= request('address');
        $supplier->note= request('note');
        $supplier->user_id= Auth::id();


        $supplier->save();

        return response()->json(['success'=>'Supplier <b> UPDATED </b> successfully.']);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json(['success'=>'Supplier <b> DELETED </b> successfully.']);
    }
}
