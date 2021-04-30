<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Auth;

class StaffController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:staff-အားလုံးကြည့်မည်');
        $this->middleware('permission:staff-အသစ်ထပ်ထည့်မည်', ['only' => ['create','store']]);
        $this->middleware('permission:staff-အသေးစိတ်ကြည့်မည်', ['only' => ['show']]);
        $this->middleware('permission:staff-ပြင်ဆင်မည်', ['only' => ['edit','update']]);
        $this->middleware('permission:staff-ဖျက်မည်', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('backside.staff',compact('roles','permissions'));
    }

    public function getlistData(Request $request)
    {

        $data = User::whereHas(
                'roles', function($q){
                    $q->where('name', 'Staff');
                }
            )->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($data){
                        return $data->name;
                    })
                    ->addColumn('email', function($data) {
                        return $data->email;
                    })
                    ->addColumn('action', function($row){
                        $roleNames = $row->getRoleNames();
                        $roleid = $row->roles->first()->id;
                        $user = Auth::user();


                        $btn = '<div class="buttons">';
                        if($user->hasAnyPermission(['staff-အသေးစိတ်ကြည့်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-success mmfont detailBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="အသေးစိတ်ကြည့်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'" data-email="'.$row->email.'" data-role="'.$roleNames[0].'">
                                    <i class="bi bi-info btnicon"></i>
                                </a>';
                        }

                        if($user->hasAnyPermission(['staff-ပြင်ဆင်မည်'])){

                            $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" data-name="'.$row->name.'" data-email="'.$row->email.'" data-roleid="'.$roleid.'">
                                        <i class="bi bi-gear btnicon"></i>
                                </a>';
                        }

                        if($user->hasAnyPermission(['staff-ဖျက်မည်'])){

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
            'name'  =>'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Staff နာမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'name.unique' => 'Staff နာမည် မှာထပ်နေပါသည်။',

            'email.required' => 'အီးမေးလ် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'password.required' => 'စကားဝှက် ဖြည့်သွင်းရန်လိုအပ်သည်။',

        ];

        $this->validate($request, $rules, $customMessages);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Staff');

        $user->syncPermissions($request->permission);  


        return response()->json(['success'=>'User <b> SAVED </b> successfully.']);
    }

    public function getPermission_byUserid(Request $request){
        $userid = $request->id;

        $user = User::find($userid);

        $permissionNames = $user->getDirectPermissions();

        return $permissionNames;
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
        $user = User::find($id);
        $user->permissions()->detach();
        $user->syncPermissions($request->permission);  

        return response()->json(['success'=>'User <b> SAVED </b> successfully.']);
    }

    public function destroy(User $user)
    {
        $users->delete();

        return response()->json(['success'=>'User <b> DELETED </b> successfully.']);
    }
}
