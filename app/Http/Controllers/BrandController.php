<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;

use DataTables;

class BrandController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ကားအမှတ်တံဆိပ်-အားလုံးကြည့်မည်');
        $this->middleware('permission:ကားအမှတ်တံဆိပ်-အသစ်ထပ်ထည့်မည်', ['only' => ['create','store']]);
        $this->middleware('permission:ကားအမှတ်တံဆိပ်-ပြင်ဆင်မည်', ['only' => ['edit','update']]);
        $this->middleware('permission:ကားအမှတ်တံဆိပ်-ဖျက်မည်', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        return view('backside/brand');
    }

    public function getlistData(Request $request)
    {

        $data = Brand::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $user = Auth::user();

                        $btn = '<div class="buttons">';
                        if($user->hasAnyPermission(['ကားအမှတ်တံဆိပ်-ပြင်ဆင်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                        <i class="bi bi-gear btnicon"></i>
                                    </a>';

                        }

                        if($user->hasAnyPermission(['ကားအမှတ်တံဆိပ်-ဖျက်မည်'])){

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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:brands,name,NULL,id,deleted_at,NULL',
        ];

        $customMessages = [
            'name.required' => 'ကားအမှတ်တံဆိပ်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'ကားအမှတ်တံဆိပ်မှာထပ်နေပါသည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        Brand::create([
            'name'  => $request->name,
        ]);        
   
        return response()->json(['success'=>'Brand <b> SAVED </b> successfully.']);
    }

    public function show(Brand $brand)
    {
        //
    }

    public function edit(Brand $brand)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $brand=Brand::find($id);
        $brand->name= request('name');

        $brand->save();

        return response()->json(['success'=>'Brand <b> UPDATED </b> successfully.']);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json(['success'=>'Brand <b> DELETED </b> successfully.']);
    }
}
