<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DB;
use Auth;
use Mail;
use Hash;
class AdminController extends Controller
{
    //
    public function login()
    {if(!session()->has('adminLogindata'))
        {
             return view('login');
        }
        // dd("fdf");
        return view('dashboard');
    }

    public function logindata(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $count = Student::where('email', $email)->count();
        $data = Student::where('email', $email)->first();
       
        if($count == 1)
        {
            if(Hash::check($password,$data->password)){
            $request->session()->put('adminLogindata',$count,$data);

                        return view('dashboard');
            }else{
                return redirect()->back()->with('message','wrong password');
            }
      
         }else
            {dd("gbdfg");
                return redirect()->route('login')->with('msg','something went wrong!!');
            }

    }
    public function gotologin() 
    {
        if(!session()->has('adminLogindata'))
        { 
            return view('login');    
        }else{
            // dd("fff");
            return view('dashboard');
        }

    }
    public function logout()
    {   
        session()->forget('adminLogindata');
        return view('login')->with('msg','logut sucesss');
    }
    public function fpassword()
    {
        return view('fpassword');
    }
    public function fpassworddata(Request $request)
    {
        $email = $request->get('email');
        $data = Student::where('email', $email)->count();
        if($data == 1)
        {
            $alldata = Student::where('email', $email)->first();
            $to_name = "Testing mail";
            $to_email = $alldata->email;
            $otp = rand(10000,99999);
            $request->session()->put('adminotp',$otp);
            echo $check_email = $request->session()->put('adminemail',$alldata->email);
            $data = array('name'=>$alldata->name, 'body'=>$otp);

            Mail::send('mail',$data,function($message) use ($to_name,$to_email){
                $message->to($to_email)
                        ->subject('for varifimng otp');
            });
             return view('checkotp');

        }else
        {
            return redirect()->back()->with('message','wrong detail');
        }

        

    }
    public function checkotp(Request $request)
    {
        $checkotp = session()->get('adminotp');
        $otp = $request->get('checkotp');
        if($checkotp == $otp)
        {
            return view('changepassword');
        }else
        {
            // dd("gsdfg");
            return view('checkotp')->with('success', 'your message,here');   

        }
    }
    public function changepass(Request $request)
    {
        $npass = $request->get('npass');
        $cpass = $request->get('cpass');
        if($cpass == $npass)
        {
            $email = session()->get('adminemail');
            $pass_c = Hash::make($npass);
            $data = array('password'=>$pass_c);
            $change = Student::where('email',$email)->update($data);

            return redirect()->route('login')->with('msg','change password succesfully');

        }else
        {
            return view('changepassword')->with('msg','change password');
        }

    }
    // public function gotologin()
    // {
    //     // session()->forget();
    //     return redirect()->route('login');
    // }
    public function list()
    {
        $data = Student::all();
        return view('list',compact('data'));
    }
}
