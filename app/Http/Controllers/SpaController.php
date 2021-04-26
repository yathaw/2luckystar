<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;

use DataTables;

class SpaController extends Controller
{
    public function index()
    {
        return view('backside/spa');
    }

    public function getlistData(Request $request)
    {

        $data = Spa::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('codeno', function(Spa $spa) {
                        return $spa->codeno;
                    })
                    ->addColumn('name', function(Spa $spa) {
                        return $spa->name;
                    })
                    ->addColumn('price', function(Spa $spa) {
                        return $spa->price;
                    })
                    ->addColumn('action', function($row){

                        $btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-success mmfont detailBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="အသေးစိတ်ကြည့်မည်" data-id="'.$row->id.'" data-id="'.$row->id.'" 
                        data-name="'.$row->name.'" 
                        data-codeno="'.$row->codeno.'" 
                        data-price="'.$row->price.'" 
                        data-description="'.htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8').'" >
                                    <i class="bi bi-info btnicon"></i>
                                </a>';

                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" 
                        data-name="'.$row->name.'" 
                        data-codeno="'.$row->codeno.'" 
                        data-price="'.$row->price.'" 
                        data-description="'.htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8').'" >
                                    <i class="bi bi-gear btnicon"></i>
                                </a>';

                        $btn = $btn.'<a href="#" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
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
            'name'  =>'required|unique:spas,name,NULL,id,deleted_at,NULL',
            'price' => 'required'
        ];

        $customMessages = [
            'name.required' => 'SPA နာမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'SPA နာမည် မှာထပ်နေပါသည်။',
            'price.required' => 'စျေးနှုန်းသတ်မှတ်ရန်လိုအပ်သည်။'
        ];

        $this->validate($request, $rules, $customMessages);

        $spa = Spa::orderBy('id','desc')->first();
        if($spa == null)
        {
            $num = "0001";
        }
        else
        {
            $db_codeno = $spa->codeno;
            $array = explode('-', $db_codeno);

            $number = intval($array[1]) + 1;
            $num = sprintf('%04d', $number);
        }

        $codeno = "SPA-".$num;


        Spa::create([
            'codeno'=> $codeno,
            'name'  => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);        
   
        // return response()->json(['success'=>'Spa <b> SAVED </b> successfully.']);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $spa=Spa::find($id);
        $spa->name= request('name');
        $spa->price= request('price');
        $spa->description= request('description');

        $spa->save();

        return response()->json(['success'=>'Spa <b> UPDATED </b> successfully.']);
    }

    public function destroy(Spa $spa)
    {
        //
    }
}
