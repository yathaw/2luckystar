<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ပစ္စည်းအမျိုးအစား-အားလုံးကြည့်မည်');
        $this->middleware('permission:ပစ္စည်းအမျိုးအစား-အသစ်ထပ်ထည့်မည်', ['only' => ['create','store']]);
        $this->middleware('permission:ပစ္စည်းအမျိုးအစား-ပြင်ဆင်မည်', ['only' => ['edit','update']]);
        $this->middleware('permission:ပစ္စည်းအမျိုးအစား-ဖျက်မည်', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        return view('backside/category');
    }

    public function getlistData(Request $request)
    {

        $data = Category::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                        $user = Auth::user();

                        $btn = '<div class="buttons">';
                        if($user->hasAnyPermission(['ပစ္စည်းအမျိုးအစား-ပြင်ဆင်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                        <i class="bi bi-gear btnicon"></i>
                                    </a>';
                        }

                        if($user->hasAnyPermission(['ပစ္စည်းအမျိုးအစား-ဖျက်မည်'])){

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
            'name'  =>'required|unique:categories,name,NULL,id,deleted_at,NULL',
        ];

        $customMessages = [
            'name.required' => 'ကားအမှတ်တံဆိပ်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'ကားအမှတ်တံဆိပ်မှာထပ်နေပါသည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        Category::create([
            'name'  => $request->name,
        ]);        
   
        return response()->json(['success'=>'Category <b> SAVED </b> successfully.']);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $category->name= request('name');

        $category->save();

        return response()->json(['success'=>'Category <b> UPDATED </b> successfully.']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success'=>'Category <b> DELETED </b> successfully.']);
    }
}
