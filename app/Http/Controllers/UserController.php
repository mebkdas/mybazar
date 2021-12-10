<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    public function viewDashboard(){
        if(auth()->user()){
        if (Auth::user()->role->name == 'admin') {
            $this->redirectTo = route('admin.dashboard');
        } elseif(Auth::user()->role->name == 'customer') {
             return view('home');
        } elseif(Auth::user()->role->name == 'vendor') {
            $this->redirectTo = route('vendorUser.dashboard');
        }        
        }
        else {
             return view('home');
        }
        return redirect($this->redirectTo);
    }

    //Customer
    public function userDataShow(){
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('userprofile',['user'=>$user]);
    }

    public function updateAccount(Request $req){
        $model = User::find(auth()->user()->id);
        $model->name = $req->name;
        $model->email = $req->email;
        $model->phone_number = $req->phone_number;
        $model->address_1 = $req->address_1;
        $model->address_2 = $req->address_2;
        $model->country_id = $req->country_id;
        $model->state_id = $req->state_id;
        $model->city_id = $req->city_id;
        $model->zip_code = $req->zip_code;

        if($req->hasFile('profile_pic')){
            $Oldfilename = $model->profile_pic;
            
            $file = $req->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $filename = time().".".$ext;
            $path = $file->storeAs('files', $filename,'public');
            $model->profile_pic = $filename;

            if($path){
                if(Storage::exists('public/files/'.$Oldfilename)){
                    Storage::delete('public/files/'.$Oldfilename);
                }else{
                    dd('File does not exists.');
                }
            }
        }

        $model->save();
        $req->session()->flash('flashuser','Update Done!!');
        return redirect()->back();

    }


    

    //Admin    
    public function adminLogin(Request $req){
        dd("hello");
        $user = user::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            return "Username or Password not match!!";
        }
        else{
            $req->session()->put('alfa',$user);
            return redirect('/admin');
        }
    }
    public function logout(){
        if(session()->has('alfa')){
            session()->pull('alfa',null);
            return redirect('/admin');
        }   
    }
    public function checkLogin(Request $request){
        dd('test');
        if($request->path()=="adminlogin" && session()->has('alfa')){
            return redirect('/admin');
        }
        return redirect('/adminlogin');
    }

}
