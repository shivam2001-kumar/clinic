<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\supervisor;
use Log;
use App\Models\patient;
use App\Models\tbl_reciept;
use App\Models\MedicineStock;
use App\Models\tbl_reciepts_medicine;
use App\Models\tbl_receipt_outermed;
use App\Models\superadmin;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;
class SuperadminController extends Controller
{
    //
    function index()
    {
       // Log::info('index function of sp called');
        return view('superadmin.login');
    }

// add vendor
function superadminlogin(Request $req)
{
   // Log::info('request'.json_encode($req->all()));
    $email=$req->get('Username');
   // Log::info('email'.json_encode($email));
    $pass=md5($req->get('Password'));
   // Log::info('password'.json_encode($pass));
    $adarr=array(
        'emailx'=>$email,
        'passx'=>$pass
    );
   // Log::info('adarr'.json_encode($adarr));
    $res=DB::select('CALL superadmin(:emailx,:passx)',$adarr);
   // Log::info('result'.json_encode($res));
    if(count($res)>0)
    {
       // Log::info('if part');
        $spadmin=$res[0]->id;
        Session::put('spadmin',$spadmin);
        return redirect('superadmin/supdash');
    }
    else
    {
      //  Log::info('else part');
        Session::flash('msg', 'Invalid user');
        return view('superadmin.login');
     //   return "error";
    }


}

// super admin dashboard
function dashboard()
{


    $tdate=Carbon::now()->format('d-M-Y h:m a');
   //return $tdate;
    $todaysale=tbl_reciept::where('date',date('Y-m-d'))->sum('total');
   // return $todaysale;
    $todaypatient=tbl_reciept::where('date',date('Y-m-d'))->count();
   // return $todaypatient;
      return view('superadmin.dashboard',['tsale'=>$todaysale,'tpatient'=>$todaypatient,'tdate'=>$tdate]);
}

// add supervisor
function addsupervisor()
{
    return view('superadmin.addsupervisor');
}
// function for get city with country Id and  state id
public function get_city($stid)
{
    $resq="<option disabled selected>--Select City---</option>";
    $city = DB::table('cities')::where(['state_id'=>$stid, 'is_del'=>false])->get();
    //return $city;
    foreach($city as $c){
        $resq=$resq."<option value='".$c['id']."'>".$c['city_name']."</option>";
    }
    return $resq;
}
 // function for get state with country id
 public function get_state($id)
 {
     $resq="<option disabled selected>--Select State---</option>";
     $state = DB::table('states')::where(['country_id'=>$id])->get();
     foreach($state as $st){
         $resq=$resq."<option value='".$st['id']."'>".$st['state_name']."</option>";
     }
     return $resq;
 }

 // ADD super admin code
 function addsupercode(Request $req)
 {
//return $req;
$filename='Image'.time()."_".rand().".".$req->pic->extension();
if($req->pic->move(public_path('staffimage'),$filename))
{
//echo "file upoaded"
}

$as=new supervisor();
$as->name=$req->get('name');
$as->role=$req->get('role');
$as->email=$req->get('email');
$as->contactno=$req->get('contactno');
$as->profile=$filename;
$as->pincode=$req->get('pincode');
$as->address=$req->get('address');
$as->qualification=$req->get('highest_qualification');
$as->password=$req->get('password');
$as->is_del=false;
$as->status=true;
if($as->save())
{
    Session::flash('msg','!! Super-Visor Added Successfully !!');
    return redirect('/superadmin/addsupervisor');
}
else{
    Session::flash('msg','@@ Super-Visor can\'t added at this moment @@');
    return redirect('superadmin/addsupervisor');
}


 }



 // View how many supervisor added
 function viewsupervisor()
 {
     $dt=supervisor::where('is_del',false)->get();
     return view('superadmin.viewsupervisor',['supervisor'=>$dt]);
 }
//  active deactive supervisor
 function updatesupervisor($id,$status)
 {
     $as=supervisor::find($id);
     $as->status=$status;
     if($as->save())
     {
         session::flash('msg','Supervisor deactiveted');
         return redirect('superadmin/viewsupervisor');
     }
     else{
        session::flash('msg','supervisor cant deactiveted this time');
     }
 }
 // delete supervisor
 function delsupervisor($id)
 {
$as=supervisor::find($id);
$as->is_del=true;
if($as->save())
{
    session::flash('msg','supervisor is deleted');
    return redirect('superadmin/viewsupervisor');

}
else{
    session::flash('msg','supervisor can\'t not deleted');
    }
 }

    // Add patient superadmin
    function addpatient()
    {
        return view('superadmin.addpatient');
    }

    function addpatientcode(Request $req)
    {
        //return $req;
        $ps=new patient();
        $ps->pname=$req->get('pname');
        $ps->pemail=$req->get('pemail');
        $ps->contactno=$req->get('contactno');
        $ps->age=$req->get('age');
        $ps->dob=$req->get('dob');
        $ps->address=$req->get('address');
        $ps->is_del=false;
        if($ps->save())
        {
            session::flash('msg','Patient Add');
            return redirect('superadmin/addpatient');
        }
        else{
            session::flash('msg','Patient not Add');
            return redirect('superadmin/addpatient');
        }
    }
    // view Pattient
    function viewpatient()
    {
        $ps=patient::where('is_del',false)->get();
        //return $ps;
        return view('superadmin.viewpatient',['data'=>$ps]);
    }
    // edit patient

    function editpatient($id)
    {
       $ps=patient::find($id);
       return view('superadmin.editpatient',['data'=>$ps]);
    }

    // Edit post patient
     function editpostpatientcode(Request $req)
     {
        //return $req;
        $id=$req->get('id');
        $ps=patient::find($id);
        $ps->pname=$req->get('pname');
        $ps->pemail=$req->get('pemail');
        $ps->contactno=$req->get('contactno');
        $ps->age=$req->get('age');
        $ps->address=$req->get('address');
        $ps->is_del=false;
        if($ps->update())
        {
           session::flash('msg','Profile is updated');
           return redirect('superadmin/viewpatient');
        }
        else{
            session::flash('msg','Profile not updated ');
            return redirect('superadmin/viewpatient');
        }
     }

     // delete patient
     function delpatient($id)
     {
        $ps=patient::find($id);
        $ps->is_del=true;
        if($ps->save())
        {
            session::flash('msg','patient deleted');
            return redirect('superadmin/viewpatient');
        }
        else{
            session::flash('msg','Patient can\'t deleted');
            return redirect('superadmin/viewpatient');
        }
     }

     // Reception
     function reception()
     {
         $m=patient::where('is_del','false')->get('contactno');
         $med=MedicineStock::where('is_del','0')->get();
        // var_dump($med);
        // return;

         return view("superadmin.reception",['mobile'=>$m,'med'=>$med]);
     }

     // fetching mobile data
     function fetchprec(Request $req)
     {
        $mob=$req->get('mob');
        $em=patient::where('is_del','false')->where('contactno',$mob)->get();
        return $em[0];

     }

     function fetchmed(Request $req)
     {
         log::info('fetchmed'.json_encode($req->all()));
        $med=$req->get('me');

       // $medi=MedicineStock::where('isdel','0')->get();
        //log::info('medicine'.json_encode($medi));
        $medicine=MedicineStock::where('isdel','0')
            ->Where('medname','LIKE',$med)
            ->orWhere('medname','LIKE',$med.'%')->get();
      //  log::info('medicine originial'.json_encode($medicine));
        //return $medicine;
       return response()->json([
           'medicine' => $medicine
       ]);
     }

     // Add receipt

     function addreceipt(Request $req)
     {
        // return $req;
        $tr=new tbl_reciept();
        $id=$req->get('id');
        //return $id;
        $tr->patient_id=$id;
        $tr->date=$req->get('date');
        $tr->weight=$req->get('weight');
        $tr->age=$req->get('age');
        $tr->suggestion=$req->get('sug');
        $tr->disease=$req->get('disease');
        $tr->is_del=false;
        $tr->total=0;
        if($tr->save())
        {

            $reciept_id=$tr->id;
            $data=[];


            for($i=0;$i<count($req->medicine);$i++)
            {
               // echo $req->medicine[$i]."<br/>";
                //echo $req->dose[$i];
                array_push($data,array('reciept_id'=>$reciept_id,'id'=>$req->medicine[$i],'dose'=>$req->dose[$i],'time'=>$req->dtime[$i],'is_del'=>false,'created_at'=>now(),'updated_at'=>now()));
            }

            if(tbl_reciepts_medicine::insert($data))
            {
                session::flash('msg','receipt generated');
                echo $reciept_id;
                //return redirect('superadmin/reception');
            }


        }
     }

     //  patient reciepts
     function patient_reciepts($id)
     {
         $pt=patient::where('is_del',false)->where('id',$id)->first();
         $dt=tbl_reciept::where('is_del',false)->where('patient_id',$id)->get();

        return view('superadmin.patient_reciepts',['data'=>$dt,'pdata'=>$pt]);
     }


       // Delete patient reciept
       public function delreciept($delid)
       {
        echo "fhd";
       } 
     //  patient reciept medicines
     function patient_rec_medcs($id,$pid)
     {
        //return $id;
        $pt=patient::where('is_del',false)->where('id',$pid)->first();
        $tr=tbl_reciept::where('is_del',false)->where('reciept_id',$id)->first();
         $prm=tbl_reciepts_medicine::join('medicine_stocks','medicine_stocks.id','tbl_reciepts_medicines.id')
         ->where('tbl_reciepts_medicines.reciept_id',$id)
         ->where('tbl_reciepts_medicines.is_del',false)
         ->get();
         //return $prm;
         return view('superadmin.patient_rec_medcs',['data'=>$prm,'pdata'=>$pt,'tdata'=>$tr]);
     }


// outer medicine code

function outer_med_data(Request $req)
{
    $reciept_id=$req->get('reciept_id');
  //  echo $reciept_id;
    $patient_id=$req->get('patient_id');
  //  echo $patient_id;
   $med_name=implode('@$',$req->get('om_name'));
 //   echo $med_name;
    $med_dose=implode('@$',$req->get('om_dose'));
    //echo $med_dose;
    $med_time=implode('@$',$req->get('om_timing'));
   // echo $med_time;
   $outmed=new tbl_receipt_outermed();
   $outmed->patient_id=$patient_id;
   $outmed->receipt_id=$reciept_id;
   $outmed->outer_med_name=$med_name;
   $outmed->outer_med_dose=$med_dose;

   $outmed->outer_med_time=$med_time;
   if($outmed->save())
   {
       session::flash('msg','Both Receipt Generated Successfully');
       return redirect('superadmin/reception');
   }

}
     //Mobile Number validate no reapted

     function getmobdata($mob)
     {
      $pt=patient::where('is_del',false)->where('contactno',$mob)->get('contactno');
       if(count($pt)>0)
       {
           echo '1';
       }
       else
       {
           echo '0';
       }
       //return "welcome";

     }

     //Admin  change pasowrd
     public function changepwd(Request $req)
     {
         $op=md5($req->op);
         $np=$req->np;
         $cp=$req->cp;
         $data=superadmin::find(Session::get('spadmin'));
         if($np==$cp)
         {
             if($op==$data->password){
                    $data->password=md5($np);
                    $res=$data->save();
                    session::flash('msg','password Changed Successfully !!! Login with new Password');
                    return redirect('logout');
                }
                else{
                    session::flash('msg','password does\'t match');
                    return redirect('superadmin/supdash');
                }

        }
        else{
            session::flash('msg','Confirm password and new password does\'t match');
            return redirect('superadmin/supdash');
        }
        return redirect('superadmin/supdash');
     }


}
