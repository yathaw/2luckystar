<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index()
    {
        $authid = Auth::id();

        $user = User::find($authid);
        return view('backside.profile',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->name= request('e_name');
        $user->email= request('e_email');
        $user->save();

        return redirect('profile');

    }

    public function changepassword(Request $request)
    {
        $rules = [
            'password'  =>'required|min:8',
        ];

        $customMessages = [
            'password.required' => 'စကားဝှက်ဖြည့်သွင်းရန်လိုအပ်ပါ​သည်။',
            'password.min' => 'စကားဝှက်မှာအနည်းဆုံး ၈ လုံးလိုအပ်ပါသည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        $authid = Auth::id();

        $user = User::find($authid);
        $user->password= Hash::make(request('password'));
        $user->save();

        return response()->json(['response'=>'Image <b> ADDED </b> successfully.']);
        
    }

    public function changeprofile(Request $request)
    {
        $authid = Auth::id();

        $user = User::find($authid);
        
        $image = $request->file('newprofile');

        if ($request->hasfile('newprofile')) {

            if(\File::exists(public_path($user->profile_photo_path))){
                \File::delete(public_path($user->profile_photo_path));
            }
        }
        

        // File Upload
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('storage/user/'), $imageName);

        $imagepath = '/storage/user/'.$imageName;

        $user->profile_photo_path= $imagepath;
        $user->save();

        return response()->json(['response'=>'Image <b> ADDED </b> successfully.']);
        
    }
}
