<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Models\bulk_bill;
use App\Models\bulk_data;

use Session;
use Log;

class StockmanagerController extends Controller
{
    //
    public function dashboard()
    {
        return view('stockmanager.dashboard');
    }
    public function addstock()
    {
        return view('stockmanager.add_stock');
    }
    public function saveStock(Request $req)
    {
        $data = new MedicineStock;
        $data->medcode=$req->get('medcode');
        $data->medname=$req->get('medname');
        $data->medtype=$req->get('medtype');
        $data->medunit=$req->get('medunit');
        $data->price=$req->get('price');
        $data->medquantity=$req->get('medquantity');
        $totalqty=explode(' ',$req->get('totalquantity'));
        $data->totalquantity=$totalqty[0];
        $data->totalprice=$req->get('totalprice');
        $tq=floatval($req->get('totalquantity'));
        $am=floatval($req->get('totalprice'));

        $perqtamt=$am/$tq;
 // return $perqtamt;
 $data->perqtamount=$perqtamt;
        $data->is_del=false;
       // Log::info('data'.json_encode($data));
        if($data->save())
        {
            Session::flash('status', 'alert-success');
            Session::flash('flash_message', 'Medicine Successfully Add!!!');
            return redirect('/stockmanager/add-stock');
        }
        else
        {
            Session::flash('status', 'alert-danger');
            Session::flash('flash_message', 'Medicine Not Add!!');
            return redirect('/stockmanager/add-stock');
        }
    }
    public function viewstock()
    {
        $stock=MedicineStock::where('is_del',false)->get();
        return view('stockmanager.view_stock',['stock'=>$stock]);
    }
    public function saveUpdateStock(Request $req)
    {
       // Log::info('data'.json_encode($req->all()));
       $id=$req->get('id');
       $medcode=$req->get('medcode');
       $medname=$req->get('medname');
       $medtype=$req->get('medtype');
       $medunit=$req->get('medunit');
       $price=$req->get('price');
       $medquantity=$req->get('medquantity');
       $totalquantity=$req->get('totalquantity');
       $totalprice=$req->get('totalprice');
    //    Log::info('data',[
    //        $medcode,$medname,$medtype,$medunit,$price,$medquantity,$totalquantity,$totalprice
    //    ]);
        $uptstock = MedicineStock::where('id',$id)->update(['medcode'=>$medcode,'medname'=>$medname,'medtype'=>$medtype,'medunit'=>$medunit,'price'=>$price,'medquantity'=>$medquantity,'totalquantity'=>$totalquantity,'totalprice'=>$totalprice]);
        if($uptstock)
        {
            Session::flash('status','alert-success');
            Session::flash('flash_message','Details Successfully Updated!');
            return redirect('/stockmanager/view-stock');
        }
        else
        {
            Session::flash('status','alert-danger');
            Session::flash('flash_message','Details Not Updated!');
            return redirect('/stockmanager/view-stock');
        }
    }
    public function updatestock($id)
    {
        Log::info('id'.json_encode($id));
        $stock=MedicineStock::where('is_del',false)->where('id',$id)->first();
        return view('stockmanager.update_stock',['stock'=>$stock]);
    }

    // Genrate Bill id for bulk stock manage
    // Bulk  Bill

    public function genrate_bill()
    {
        return view('stockmanager/genrate_bill');
    }

    public function post_bill(Request $req)
    {

        $bill_genrate=new bulk_bill();
        $filename='Image'.time()."_".rand().".".$req->billpic->extension();
        if($req->billpic->move(public_path('billimage'),$filename))
            {
            //echo "file upoaded"
            }
        $bill_genrate->billno=$req->billno;
        $bill_genrate->	billamount=$req->billamt;
        $bill_genrate->	piadamount=$req->paidamt;
        $bill_genrate->	dueamount=$req->dueamt;
        $bill_genrate->	billdate=$req->billdate;
        $bill_genrate->	billpic=$filename;
        $bill_genrate->	description=$req->desc;
        $bill_genrate->is_del=false;
        $bill_genrate->status=true;
        if($bill_genrate->save())
        {
            Session::flash('flash_message','!! Genrate Bill  Successfully !!');
            return view('stockmanager.genrate_bill');
        }
        else{
            Session::flash('flash_message','!!  Bill Not Genrated Successfully !!');
            return view('stockmanager.genrate_bill');

        }

    }
 // upload data

            public function bulk_data()
            {
                $bulkdata=bulk_bill::where('is_del',false)->get();

                return view('/stockmanager/bulk_data',['bulkdata'=>$bulkdata]);
            }

            public function save_bulk_data(Request $req)
            {
                $medcode=MedicineStock::where('is_del',false)
                ->where('medcode',$req->medcode)
                ->first('medcode');
              //  return $medcode; die();
                $bulkdata=new bulk_data();
            $bulkdata->billno=$req->get('billno');
            $bulkdata->medcode=$req->get('medcode');
            $bulkdata->medname=$req->get('medname');
            $bulkdata->medtype=$req->get('medtype');
            $bulkdata->medunit=$req->get('medunit');
            $bulkdata->price=$req->get('price');
            $bulkdata->medquantity=$req->get('medquantity');
            $bulkdata->totalquantity=$req->get('totalquantity');
            $bulkdata->totalprice=$req->get('totalprice');
            $tq=floatval($req->get('totalquantity'));
            $am=floatval($req->get('totalprice'));
            $perqtamt=$am/$tq;
            if($bulkdata->save())
            {
                
                if(strtolower($medcode->medcode)==strtolower($req->medcode))
                {

                        //Update

                }
                else
                {
                     // new insert in stock
                     
                     $data = new MedicineStock;
                     $data->medcode=$req->get('medcode');
                     $data->medname=$req->get('medname');
                     $data->medtype=$req->get('medtype');
                     $data->medunit=$req->get('medunit');
                     $data->price=$req->get('price');
                     $data->medquantity=$req->get('medquantity');
                     $totalqty=explode(' ',$req->get('totalquantity'));
                     $data->totalquantity=$totalqty[0];
                     $data->totalprice=$req->get('totalprice');
                     $tq=floatval($req->get('totalquantity'));
                     $am=floatval($req->get('totalprice'));
             
                     $perqtamt=$am/$tq;
              // return $perqtamt;
                     $data->perqtamount=$perqtamt;
                     $data->is_del=false;
                    // Log::info('data'.json_encode($data));
                     if($data->save())
                     {
                         Session::flash('status', 'alert-success');
                         Session::flash('flash_message', 'Medicine Successfully Add in stock and bulk!!!');
                         
                     }
                     else
                     {
                         Session::flash('status', 'alert-danger');
                         Session::flash('flash_message', 'Medicine Not Add in stock!!');
                         
                     }


                }
            }
            else
            {
                // bulk not save
            }
        
        }

            public function stockchangepwd(Request $req)
            {

         $op=md5($req->op);
         $np=$req->np;
         $cp=$req->cp;
         $data=supervisor::find(Session::get('spadmin'));
            }


}
