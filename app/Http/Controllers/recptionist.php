<?php

namespace App\Http\Controllers;
use App\Models\tbl_reciept;
use App\Models\patient;
use App\Models\receipt_bill;
use App\Models\tbl_receipt_outermed;
use App\Models\tbl_reciepts_medicine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;



class recptionist extends Controller
{
    //
    function  dashboard()
    {

        return view('recptionist.dashboard');
    }
    // Leatest Reciept

    function  todayrecpt()
    {
        $tr=tbl_reciept::join('patients','patients.id','tbl_reciepts.patient_id')
        ->where('tbl_reciepts.is_del',false)->where('tbl_reciepts.date',date('Y-m-d'))->get();
        //return $tr;
        return view('recptionist.todayreciept',['data'=>$tr]);
    }


    //todayreciepts

    function todayreciepts($rid,$pid)
    {
        $pt=patient::where('is_del',false)->where('id',$pid)->get();
        //return $pt;
        $mt=tbl_reciept::join('tbl_reciepts_medicines','tbl_reciepts_medicines.reciept_id','tbl_reciepts.reciept_id')
        ->join('medicine_stocks','medicine_stocks.id','tbl_reciepts_medicines.id')
        ->where('tbl_reciepts.is_del',false)->where('tbl_reciepts.reciept_id',$rid)->get();
       // return $mt;
       return view('recptionist.recieptbill',['data'=>$mt,'pdata'=>$pt]);

    }


    function generateptbill(Request $req)
    {
        if(receipt_bill::where('receipt_id',$req->receipt_id)->first())
        {
            return redirect("/recptionist/printreceipt/$req->receipt_id");
        }
        else
        {
           // return $req;
            $data=[];
            $tmedstock=new tbl_reciepts_medicine();
            for($i=0;$i<count($req->medicine);$i++)
            {
               $med_qty=$req->qty[$i];
                //exit();
                $med_id=$req->medicine[$i];
                $ttprice=$req->ta[$i];
                DB::statement("update medicine_stocks set totalquantity=(totalquantity-$med_qty), totalprice=(totalprice-$ttprice) where id='$med_id'");
               array_push($data,['receipt_id'=>$req->receipt_id,'med_id'=>$req->medicine[$i],'quantity'=>$req->qty[$i],'per_qty_amt'=>$req->peramt[$i],'net_amt'=>$req->ta[$i],'created_at'=>now(),'updated_at'=>now()]);
            }
            receipt_bill::insert($data);
            tbl_reciept::where('reciept_id',$req->receipt_id)->update((['total'=>$req->sumtotal]));

           return redirect("/recptionist/printreceipt/$req->receipt_id");
        }


    }


    function printreceipt($rec_id){

        $patient_receipt=patient::join('tbl_reciepts','patients.id','tbl_reciepts.patient_id')->where('tbl_reciepts.reciept_id',$rec_id)->first();

        $tbl_rec_med=tbl_reciepts_medicine::join('medicine_stocks','tbl_reciepts_medicines.id','medicine_stocks.id')->where('tbl_reciepts_medicines.reciept_id',$patient_receipt->reciept_id)->get();
        $tbl_rec_outmed=tbl_receipt_outermed::where('receipt_id',$patient_receipt->reciept_id)->first();
       // return $tbl_rec_outmed;
       //return $tbl_rec_outmed->outer_med_name;
       if(!empty($tbl_rec_outmed))
       {
        $outmed_name=explode('@$',$tbl_rec_outmed->outer_med_name);
        $outmed_dose=explode('@$',$tbl_rec_outmed->outer_med_dose);
        $outmed_time=explode('@$',$tbl_rec_outmed->outer_med_time);

       }
       else
       {
       $outmed_name[0]='No Medicine Written';
       $outmed_dose[0]='No Medicine Written';
       $outmed_time[0]='No Medicine Written';
       }

        return view('recptionist.print_reciept',["patient"=>$patient_receipt,"medicine"=>$tbl_rec_med,"medout"=>$tbl_rec_outmed,"outmed_name"=>$outmed_name,"outmed_dose"=>$outmed_dose,"outmed_time"=>$outmed_time]);
    }

    function bill($receipt_id)
    {
       $rec_id=$receipt_id;
       $p_data=tbl_reciept::join('patients','patients.id','tbl_reciepts.patient_id')->where('reciept_id',$rec_id)->first();
       $bill_data=receipt_bill::join('medicine_stocks','receipt_bills.med_id','medicine_stocks.id')->where('receipt_id',$rec_id)->get();
       //return $bill_data;
       //return $p_data;
       return view('recptionist.print_bill',['p_r_data'=>$p_data,'bill_data'=>$bill_data]);
    }


}
