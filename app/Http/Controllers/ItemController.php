<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Car;
use App\Models\Country;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\Stock;
use Auth;

use DataTables;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ကားပစ္စည်း-အားလုံးကြည့်မည်');
        $this->middleware('permission:ကားပစ္စည်း-အသစ်ထပ်ထည့်မည်', ['only' => ['create','store']]);
        $this->middleware('permission:ကားပစ္စည်း-အသေးစိတ်ကြည့်မည်', ['only' => ['show']]);

        $this->middleware('permission:ကားပစ္စည်း-ပြင်ဆင်မည်', ['only' => ['edit','update']]);
        $this->middleware('permission:ကားပစ္စည်း-ဖျက်မည်', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('backside/car/list',compact('suppliers'));
    }

    public function getlistData(Request $request)
    {

        $data = Item::latest()->get();
        // $stocks = Stock::groupBy('item_id')
        //    ->selectRaw('sum(qty) as sum, item_id')
        //    ->pluck('sum','item_id');

        
        return  Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('codeno', function(Item $item) {
                        return $item->codeno;
                    })
                    ->addColumn('name', function(Item $item) {
                        return $item->name;
                    })
                    ->addColumn('stock', function(Item $item) {
                        $stockqtys = $item->stocks;
                        $stock = 0;
                        foreach ($stockqtys as $stockqty) {
                            $stock += $stockqty->qty;
                        }


                        $saleqtys = $item->saledetails;
                        $sale = 0;
                        foreach ($saleqtys as $saleqty) {
                            $sale += $saleqty->qty;
                        }

                        $currentstock = $stock - $sale;

                        return $currentstock;
                    })
                    ->addColumn('price', function(Item $item) {
                        return $item->price;
                    })
                    
                    ->addColumn('action', function($row){

                        $user = Auth::user();

                        $btn = '<div class="buttons">';
                        if($user->hasAnyPermission(['ကားပစ္စည်းstock-အသစ်ထပ်ထည့်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-primary mmfont stockBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Stock ထပ်ထည့်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'"> 
                                        <i class="bi bi-bag-plus-fill btnicon"></i>
                                    </a>';
                        }

                        if($user->hasAnyPermission(['ကားပစ္စည်း-အသေးစိတ်ကြည့်မည်'])){

                            $btn = $btn.'<a href="'.route("item.show",$row->id).'" class="btn icon btn-success mmfont" data-bs-toggle="tooltip" data-bs-placement="top" title="အသေးစိတ်ကြည့်မည်">
                                        <i class="bi bi-info btnicon"></i>
                                    </a>';
                        }

                        if($user->hasAnyPermission(['ကားပစ္စည်း-ပြင်ဆင်မည်'])){

                            $btn = $btn.'<a href="'.route("item.edit",$row->id).'" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်">
                                    <i class="bi bi-gear btnicon"></i>
                                </a>';

                        }

                        if($user->hasAnyPermission(['ကားပစ္စည်း-ဖျက်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
                                    <i class="bi bi-x btnicon"></i>
                                </a>';
                        }
                        
                        $btn = $btn.'</div>';
    
                        return $btn;
                    })
                    ->rawColumns(['action','stock'])
                    ->make(true);
    }

    public function create()
    {
        $categories = Category::latest()->get();
        $cars = Car::latest()->get();
        $countries = Country::latest()->get();
        $colors = Color::latest()->get();
        $suppliers = Supplier::latest()->get();

        return view('backside/car/new', compact('categories','cars','countries','colors','suppliers'));
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:items,name,NULL,id,deleted_at,NULL',
            'price' => 'required'
        ];

        $customMessages = [
            'name.required' => 'ကားပစ္စည်းနာမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'ကားပစ္စည်းနာမည်မှာထပ်နေပါသည်။',
            'price.required' => 'ရောင်းစျေးသတ်မှတ်ရန်လိုအပ်သည်။'
        ];

        $this->validate($request, $rules, $customMessages);

        $data=[];

        if ($request->hasfile('images')) {
            foreach($request->file('images') as $image)
            {
                $filenamewithExt = $image->getClientOriginalName();

                $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();

                $fileNameToStore = rand(11111,99999).'.'.$extension;
                $image->move(public_path().'/storage/item/',$fileNameToStore);

                $path = '/storage/item/'.$fileNameToStore;
                array_push($data, $path); 
            }
        }
        $photoString = json_encode($data);

        $db_item = Item::orderBy('id','desc')->first();
        if($db_item == null)
        {
            $num = "0001";
        }
        else
        {
            $db_codeno = $db_item->codeno;
            $array = explode('-', $db_codeno);

            $number = intval($array[1]) + 1;
            $num = sprintf('%04d', $number);
        }

        $codeno = "ITEM-".$num;

        // ITEM
        $name = $request->name;
        $liter = $request->liter;
        $price = $request->price;
        $color = $request->color;
        $car = $request->car;
        $category = $request->category;
        $country = $request->country;
        $description = $request->description;

        $item= new Item();
        $item->codeno=$codeno;
        $item->name=$name;
        $item->liter=$liter;
        $item->price=$price;
        $item->photo=$photoString;
        $item->description=$description;
        $item->country_id=$country;
        $item->category_id=$category;
        $item->car_id=$car;
        $item->color_id=$color;
        $item->user_id= 1;
        $item->save();


        
            $supplier_id = $request->sup_existingsupplier;

        // STOCK 
        $st_price = $request->st_price;
        $st_quantity = $request->st_quantity;
        $st_pc = $request->st_pc;
        $st_date = $request->st_date;
        $st_type = $request->st_type;

        $stock = new Stock();
        $stock->stockdate = $st_date;
        $stock->qty = $st_quantity;
        $stock->pc = $st_pc;
        $stock->type = $st_type;
        $stock->price = $st_price;
        $stock->item_id = $item->id;
        $stock->supplier_id = $supplier_id;
        $stock->user_id = 1;
        $stock->save();

        return redirect()->route('item.index')->with("success_flashmsg", "New ITEM is ADDED in your data");

        
    }



    public function show(Item $item)
    {
        $suppliers = Supplier::latest()->get();
        $stocks = Stock::where('item_id',$item->id)
                    ->orderBy('stockdate','desc')
                    ->get();

        return view('backside/car/detail',compact('item','suppliers','stocks'));
    }

    public function edit(Item $item)
    {
        $categories = Category::latest()->get();
        $cars = Car::latest()->get();
        $countries = Country::latest()->get();
        $colors = Color::latest()->get();

        return view('backside.car.edit',compact('item','categories','cars','countries','colors'));
    }

    public function update(Request $request, Item $item)
    {
        $data=[];

        $imageUrl = asset('/');

        $oldphoto_arr = $request->oldPhoto;
        if ($oldphoto_arr) 
        {
            $oldphoto_str = json_encode($oldphoto_arr);
        }


        if ($request->hasfile('images')) {
            foreach($request->file('images') as $image)
            {
                // File Upload
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('storage/item'), $imageName);

                $path = 'storage/item/'.$imageName;
                array_push($data, $path); 
            }
        }

        if(count($data) > 0){
            $newphoto_str = json_encode($data);
        }else{
            $newphoto_str = null;
        }

        if ($newphoto_str && $oldphoto_arr) 
        {
            $new_arr = json_decode($newphoto_str);
            $old_arr = $oldphoto_arr;

            $mergedArray = array_merge($new_arr,$old_arr);

            $photo = json_encode($mergedArray);


        }
        elseif($newphoto_str)
        {
            $photo = $newphoto_str;
        }
        else
        {
            $photo = $oldphoto_str;
        }


        $name = $request->name;
        $liter = $request->liter;
        $price = $request->price;
        $color = $request->color;
        $car = $request->car;
        $category = $request->category;
        $country = $request->country;
        $description = $request->description;

        $item->name=$name;
        $item->liter=$liter;
        $item->price=$price;
        $item->photo=$photo;
        $item->description=$description;
        $item->country_id=$country;
        $item->category_id=$category;
        $item->car_id=$car;
        $item->color_id=$color;
        $item->user_id= Auth::id();

        $item->save();

        return redirect('item')->with("success_flashmsg", "Existing ITEM is Updated in your data");
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['success'=>'ITEM <b> DELETED </b> successfully.']);

    }
}
