<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;

use Illuminate\Http\Request;
use DataTables;

class CarController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        return view('backside/car',compact('brands'));
    }

    public function getlistData(Request $request)
    {

        $data = Car::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Car $car) {
                        return $car->name;
                    })
                    ->addColumn('duration', function(Car $car) {
                        return $car->duration;
                    })
                    ->addColumn('brand', function(Car $car) {
                        return $car->brand->name;
                    })
                    ->addColumn('action', function($row){
   
                        $btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'" data-duration="'.$row->duration.'" data-brandid="'.$row->brand_id.'" data-brandname="'.$row->brand->name.'">
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

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:cars,name,NULL,id,deleted_at,NULL',
            'year' => 'required',
            'brand' => 'required',
        ];

        $customMessages = [
            'name.required' => 'ကားအမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'ကားအမည်မှာထပ်နေပါသည်။',
            'year.required' => 'ကား၏ထုတ်လုပ်သည့်ခုနှစ်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'brand.required' => 'ကားအမှတ်တံဆိပ်ရွေးပေးရန်လိုအပ်သည်။',

        ];

        $this->validate($request, $rules, $customMessages);

        $validator = $request->validate([
            'name'  =>'required|unique:cars,name,NULL,id,deleted_at,NULL',
        ]);

        Car::create([
            'name'  => $request->name,
            'duration'  => $request->year,
            'brand_id'  => $request->brand
        ]);        
   
        return response()->json(['success'=>'Car <b> SAVED </b> successfully.']);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $car=Car::find($id);
        $car->name= request('name');
        $car->duration= request('duration');
        $car->brand_id= request('brandid');
        $car->save();

        return response()->json(['success'=>'Car <b> UPDATED </b> successfully.']);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(['success'=>'Car <b> DELETED </b> successfully.']);
    }
}
