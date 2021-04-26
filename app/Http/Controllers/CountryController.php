<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

use DataTables;

class CountryController extends Controller
{
    public function index()
    {
        return view('backside/country');
    }

    public function getlistData(Request $request)
    {

        $data = Country::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Country $country) {

                        $name = '<div class="d-flex no-block align-items-center">';

                        if($country->flag){

                        $name = $name.'<div class="mr-3">
                                        <img src="'.$country->flag.'"
                                            alt="'.$country->name.'" class="rounded-circle" width="45"
                                            height="45" />
                                    </div>';
                        }

                        $name = $name.'<div class="">
                                        <p class="ms-3">'.$country->name.'</p>
                                    </div>
                                </div>';
                        
                        

                        return $name;
                    })
                    ->addColumn('action', function($row){
    
                        $btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'" data-image="'.$row->flag.'">
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:countries,name,NULL,id,deleted_at,NULL',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'required'],

        ];

        $customMessages = [
            'name.required' => 'ထုတ်လုပ်သည့်နိုင်ငံဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'ထုတ်လုပ်သည့်နိုင်ငံမှာထပ်နေပါသည်။',
            'image.required' => 'နိုင်ငံ၏အလံပုံဖြည့်သွင်းရန်လိုအပ်သည်။',
            'image.mimes' => 'ပုံမှာ jpeg,png,jpg,gif,svg ဖြင့်သာသိမ်းလို့ရပါသည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        $image = $request->file('image');

        // File Upload
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('storage/country/'), $imageName);

        $imagepath = '/storage/country/'.$imageName;

        Country::create([
            'name'  => $request->name,
            'flag'  => $imagepath,

        ]);        
   
        return response()->json(['success'=>'Country <b> SAVED </b> successfully.']);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $newphoto = $request->image;
        $oldphoto = $request->oldimage;

        if ($request->hasfile('image')) {
            if(\File::exists(public_path($oldphoto))){
                \File::delete(public_path($oldphoto));
            }
            
            // Photo File Upload
            $imageName = time().'.'.$newphoto->extension();
            $newphoto->move(public_path('storage/country/'),$imageName);
            $photo_filepath = '/storage/country/'.$imageName;
        }else{
            $photo_filepath = $oldphoto;
        }

        $country=Country::find($id);
        $country->name= request('name');
        $country->flag= $photo_filepath;
        $country->save();

        return response()->json(['success'=>'Country <b> UPDATED </b> successfully.']);
    }

    public function destroy(Country $country)
    {
        if(\File::exists(public_path($country->flag))){
            \File::delete(public_path($country->flag));
        }

        $country->delete();

        return response()->json(['success'=>'Country <b> DELETED </b> successfully.']);
    }
}
