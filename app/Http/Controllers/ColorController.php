<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

use DataTables;


class ColorController extends Controller
{
    public function index()
    {
        return view('backside/color');
    }

    public function getlistData(Request $request)
    {

        $data = Color::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Color $color) {

	                    $name = '<div class="d-flex no-block align-items-center">';
	                                if($color->name){
	                    
	                    $name = $name.'<div class="me-3">
	                                        <div style="width:50px; height:50px; background-color:'.$color->code.'"> </div>
	                                    </div>';
	                                }
	                    $name = $name.'<div class="">
	                                    <p >'.$color->name.'</p>
	                                </div>
	                            </div>';

	                    return $name;
	                })
                    ->addColumn('action', function($row){

                    	$btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'" data-code="'.$row->code.'">
                                    <i class="bi bi-gear btnicon"></i>
                                </a>';

                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
                                    <i class="bi bi-x btnicon"></i>
                                </a>';
   	
                        $btn = $btn.'</div>';

                        return $btn;
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:colors,name,NULL,id,deleted_at,NULL',
            'code'	=> 'required'
        ];

        $customMessages = [
            'name.required' => 'အရောင်နာမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'အရောင်နာမည်မှာထပ်နေပါသည်။',
            'code.required' => 'အရောင်ဖြည့်သွင်းရန်လိုအပ်သည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        Color::create([
            'name'  => $request->name,
            'code'	=> $request->code
        ]);        
   
        return response()->json(['success'=>'Color <b> SAVED </b> successfully.']);
    }

    public function update(Request $request, $id)
    {
        $color=Color::find($id);
        $color->name= request('name');
        $color->code= request('code');
        $color->save();

        return response()->json(['success'=>'Color <b> UPDATED </b> successfully.']);
    }

    public function destroy($id)
    {
        $color=Color::find($id);
        $color->delete();

        return response()->json(['success'=>'Color <b> DELETED </b> successfully.']);
    }
}
