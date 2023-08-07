<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class UsersController extends Controller
{
    public function index(Request $request)
    {  
        $query = User::orderBy('id', 'asc');
        if(isset($request->txtsearch) || isset($request->status)) {
            if($request->txtsearch != "") {
                $s = $request->txtsearch;
                $query->where(function($q1) use ($s){
                    $q1->where('name', 'LIKE', '%'.$s.'%')
                    ->orWhere('firstname', 'LIKE', '%'.$s.'%')
                    ->orWhere('lastname', 'LIKE', '%'.$s.'%')
                    ->orWhere('email', 'LIKE', '%'.$s.'%');
                });
            }
            if($request->status != "") {
                $query->where("user_type","=",$request->status);
            }
        }  

        $users = $query->get();
        return view('users.user',compact('users'));
    }

    public function create()
    {   
        $catalogs = CategoryModel::with('catalogAssign')->get();
      
        return view('users.usercreate',compact('catalogs'));
    }

    public function save(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email:rfc,dns|unique:users_caldwelluni,email',
        ], 
        [
            'firstname.required' => 'First Name is required',
            'lastname.required' => 'Last Name is required',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password and Confirm Password not match',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email address is already exist',
        ]);
        if ($validator->passes()) 
        {
            $err = '';
            $catalog_ids = isset($request->catalog_assign) ? $request->catalog_assign : "";
            $selected_catalogs = ($request->catalog_option == "specific") ? implode(",", $catalog_ids) : "";
            $set_catalog_opt = $request->catalog_option;
            
            if ($request->user_role == "sadministrator") {
                $set_catalog_opt = "all";
                $selected_catalogs = "";
            }
            $user = User::Create([
                'name' => $request->firstname . " " . $request->lastname,
                'title' => null,
                'description' => null,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'userStatus' => ($request->status == 1) ? 'y' : 'n',
                'forgot_pass_code' => '',
                'catalog_assign_option' => $set_catalog_opt,
                'catalog_assign' => $selected_catalogs,
                'user_type' => $request->user_role,
                'revision' => '1',
                'google2fa_secret' => ""
            ]);
            
            $userid = $user->id;
            
            $request->session()->flash('message','User created successfully');
            
            return response()->json([ 'success' => true, 'url'=>route('users.index'), 'err' => $err ]);
        } 
        return response()->json(['error'=>$validator->messages()]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.useredit', compact(['user']));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ], 
        [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'email.required' => 'Email is required',
        ]);
        
        if ($validator->passes()) {
            $update = [
                'firstname' => $request->first_name,
                'lastname' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'userStatus' => ($request->status == 1) ? 'y' : 'n',
            ];

            User::where('id', $request->id)->update($update);
            
            $request->session()->flash('message','User Updated successfully');

            return redirect('admin/users');
        }
        return redirect()->back()->with('error', $validator->messages());
    }

    public function destroy($id, Request $request)
    {
        User::find($id)->delete();
        $request->session()->flash('message','User deleted successfully');
        return response()->json(['success'=>true]);
    }

    public function multiple_delete(Request $request)
    {   
        try {
            
            $ids = $request->ids;
            $err = '';
            User::destroy($ids);

            $request->session()->flash('message',"User's deleted successfully");
            
            return response()->json([ 'success' => true, 'url'=>route('users.index'), 'err' => $err ]);
        }
        catch(Throwable $e) {

            $request->session()->flash('error','Something Went Wrong');

            return response()->json(['error'=> 'Something Went Wrong']);
        }
    }

    public function profile($id,Request $request)
    {
        $user = User::findOrFail($id);
        return view('users.userprofile',compact('user'));
    }

    public function profile_edit(Request $request)
    {   
        $suffix = config('database.suffix');

        $user = User::find($request->id);
        $validation = [
            'firstname' => 'required',
            'lastname' => 'required',
        ];

        if ($user->email == $request->email) {
            $validation['email'] = 'required|email|max:255';
        } else {
            $validation['email'] = 'required|email|max:255|unique:users' . $suffix;
        }

        $validationMsg = [
            'firstname.required' => 'First Name is required',
            'lastname.required' => 'Last Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email address is already exist',
        ];

        $validator = Validator::make($request->all(), $validation, $validationMsg);
        
        if ($validator->passes()) {
            $err = '';
            $update = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'debug_mode' => $request->debug_mode
            ];
            User::where('id', $request->id)->update($update);
            
            $request->session()->flash('message','Profile Updated successfully');

            return response()->json([ 'success' => true, 'url'=>url("/admin/users/".$request->id."/profile"), 'err' => $err ]);
        }
        return response()->json(['error'=>$validator->messages()]);
    }

    public function changepassword($id,Request $request)
    {
        $user = User::find($id);
        return view('users.userchangepassword', compact('user'));
    }

    public function savepassword(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required|confirmed|min:6',
        ], 
        [
            'oldpassword.required' => 'Current Password is required',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password and Confirm Password not match',
        ]);
        if ($validator->passes()) {
            if (!(Hash::check($request->get('oldpassword'), Auth::user()->password))) {
                return response()->json(['success' => true, 'err'=>'Your current password does not matches with the password.']);
            } else if(strcmp($request->get('oldpassword'), $request->get('password')) == 0){
                return response()->json(['success' => true, 'err'=>'New Password cannot be same as your current password.']);
            } else {
                $userid = $request->id;
                User::updateOrCreate([
                    'id' => $request->id
                ],[
                    'password' => Hash::make($request->password)
                ]);
                $request->session()->flash('message','Password change successfully');
                return response()->json([ 'success' => true, 'err' => '' ]);
            }
        }
        return response()->json(['error'=>$validator->messages()]);
    }
}
