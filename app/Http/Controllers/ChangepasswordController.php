<?php

namespace App\Http\Controllers;
use App\Models\supervisor;
use Session;
use Illuminate\Http\Request;
use Log;

class ChangepasswordController extends Controller
{
    //

    public function stockchangepwd(Request $req)
    {
        //return $req;
        $op=$req->op;
        $np=$req->np;
        $cp=$req->cp;
      
       if(Session::get('stemail')!=null)
       {
        $role=101;
        $email=Session::get('stemail');
       return ChangePasswordController::chpass($email,$role,$op,$np,$cp);
        
        }
       else if(Session::get('recemail')!=null)
       {
          // return "recipt";
        $role=102;
        $email=Session::get('recemail');
       return ChangePasswordController::chpass($email,$role,$op,$np,$cp);
        }
       else
       {
              Session::flash('msg','You are not authroized');
              return redirect('/');
       }
       // $data=supervisor::where('');
      
    }

    public function chpass($email,$role,$op,$np,$cp)
    {
    
        $data=supervisor::where('role',$role)
            ->where('email',$email)
            ->first();
       
        //die();
       
        if($np==$cp)
         {
             if($op==$data->password){
                    $data->password=$np;
                    $res=$data->save();
                    //return $res;
                    session::flash('msg','password Changed Successfully !!! Login with new Password');
                   
                    return redirect('logout');
                }
                else{
                 
                    session::flash('msg','password does\'t match');
                   
                }

        }
        else{
            
            session::flash('msg','Confirm password and new password does\'t match');
     
        }
        return redirect('stockmanager/dashboard');
    }
}
