<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;
use Auth;
use DataTables;

class SpaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:spa-အားလုံးကြည့်မည်');
        $this->middleware('permission:spa-အသစ်ထပ်ထည့်မည်', ['only' => ['create','store']]);
        $this->middleware('permission:spa-အသေးစိတ်ကြည့်မည်', ['only' => ['show']]);

        $this->middleware('permission:spa-ပြင်ဆင်မည်', ['only' => ['edit','update']]);
        $this->middleware('permission:spa-ဖျက်မည်', ['only' => ['destroy']]);
    }
    
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

                        $user = Auth::user();

                        $btn = '<div class="buttons">';
                        if($user->hasAnyPermission(['soa-အသေးစိတ်ကြည့်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-success mmfont detailBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="အသေးစိတ်ကြည့်မည်" data-id="'.$row->id.'" data-id="'.$row->id.'" 
                            data-name="'.$row->name.'" 
                            data-codeno="'.$row->codeno.'" 
                            data-price="'.$row->price.'" 
                            data-description="'.htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8').'" 
                            data-photo="'.$row->photo.'">
                                        <i class="bi bi-info btnicon"></i>
                                    </a>';
                        }

                        if($user->hasAnyPermission(['spa-ပြင်ဆင်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" 
                            data-name="'.$row->name.'" 
                            data-codeno="'.$row->codeno.'" 
                            data-price="'.$row->price.'" 
                            data-description="'.htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8').'" 
                            data-photo="'.$row->photo.'">
                                        <i class="bi bi-gear btnicon"></i>
                                    </a>';
                        }

                        if($user->hasAnyPermission(['spa-ဖျက်မည်'])){

                            $btn = $btn.'<a href="#" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
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

        $image = $request->file('image');

        // File Upload
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('storage/spa/'), $imageName);

        $imagepath = '/storage/spa/'.$imageName;


        Spa::create([
            'codeno'=> $codeno,
            'name'  => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $imagepath
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
        $newphoto = $request->image;
        $oldphoto = $request->oldimage;

        if ($request->hasfile('image')) {
            if(\File::exists(public_path($oldphoto))){
                \File::delete(public_path($oldphoto));
            }
            
            // Photo File Upload
            $imageName = time().'.'.$newphoto->extension();
            $newphoto->move(public_path('storage/spa/'),$imageName);
            $photo_filepath = '/storage/spa/'.$imageName;
        }else{
            $photo_filepath = $oldphoto;
        }

        $spa=Spa::find($id);
        $spa->name= request('name');
        $spa->price= request('price');
        $spa->description= request('description');
        $spa->photo = $photo_filepath;

        $spa->save();

        return response()->json(['success'=>'Spa <b> UPDATED </b> successfully.']);
    }

    public function destroy(Spa $spa)
    {
        if(\File::exists(public_path($spa->photo))){
            \File::delete(public_path($spa->photo));
        }

        $spa->delete();

        return response()->json(['success'=>'SPA <b> DELETED </b> successfully.']);
    }
}
