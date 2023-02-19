@extends('superadmin.includes.admin_master')

@section('style')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{url('disc/select2.min.css')}}"  />
@endsection

@section('main-container') 
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Hi, welcome to Admin Dashboard</h4>
              <p class="font-weight-normal mb-2 text-muted">@php  echo date('d-M-Y'); @endphp</p>
            </div>
          </div>
          <!-- start form -->

          <section>
        <div class="container">
            @if(Session::has('msg'))
              <div class="alert alert-danger" role="alert"><em> {!! session('msg') !!}</em></div>
            @endif
            @if(session()->has('msg'))
    <div class="alert alert-{{ session('msg') }}"> 
    {!! session('message.content') !!}
    </div>
@endif
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="text-light">R<sub>x</sub></h3>
              </div>
             
                <div class="card-body">
                  <form class="needs-validation" id="mobid">
                    @csrf()
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group col-md-4 float-right">
                      <div class="input-group">
                      <input list="mobs"  id="mob"  name="mob" class="form-control" placeholder="Enter Mobile Number"aria-label="Recipient's username">
                        <datalist id="mobs" >
                        
                        @foreach($mobile as  $mob)
                          <option value=" {{$mob->contactno}}">

                         @endforeach
                        </datalist>
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" id="btnmob" type="submit">Enter</button>
                      </div>
                    </div>
                        @error('address')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                   </form><br>
             
                  
                  <form  class="needs-validation" id="med_form" method="POST" enctype="multipart/form-data">
                    @csrf
                  
                    <div class="row ">
                    <input type="hidden" class="readonly" name="id" id="id" required/>
                    <div class="form-group col-md-5 ">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control readonly"  name="name" id="name" placeholder="Name " autocomplete="off"  required>
                        @error('name')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                      </div> 
                    <div class="form-group col-md-2">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" name="age" id="age" placeholder="Enter Age NO." required max="200">
                        @error('address')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                      </div>    
                      <div class="form-group col-md-2">
                        <label for="weight">weight:</label>
                        <input type="text" class="form-control" name="weight" id="weight" placeholder="Enter Weight" required maxlength="3">
                        @error('address')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                      </div>
                      
                      <div class="form-group col-md-3 ">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date" id="date"  value="<?php echo date('Y-m-d'); ?>" required readonly >
                        @error('address')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                      </div>

                  <div class="form-group col-md-3">
                        <label for="search">Search Medicine</label>
                        
                        <select id="msearch"  class="js-example-basic-single form-control" name="search" > 
                        <option value="" selected disabled >Select Medicine Here</option>
                       
                          @foreach($med as $m)
                          
                            <option value="{{$m->id}}">{{$m->medname}}</option>
                          @endforeach
                        
                        </select>
                        
                      </div> 
                         <div class="form-group col-md-3 mb-2">
                        <label for="dose">Dose</label>
                        <input type="text" class="form-control" name="dose" id="dose" placeholder="Enter Medicine Dose"   >
                        @error('address')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                        
                        </div> 
                        <div class="dropdown col-md-3">
                        <label for="timing">Timing</label>
                    <select class="form-control form-control-lg mt-2 h-50  selectpicker" id="timing" name="timing"  data-live-search="true">
                    <option value="" selected disabled>-- Select Timing</option>  
                    <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>
                        @error('address')
                          <span class="text-danger">
                              {{$message}}
                          </span>
                        @enderror
                        
                        </div> 
                        <div class="form-group col-md-3 mt-4  " >
                       
                        <button type="button"  class="primary btn btn-primary"  id="createtr">ADD</button>
                      
                        <button type="button"    style="display:none" id="outer_med" class="btn btn-success " data-toggle="modal"  data-target="#exampleModal">Outer Medicine</button>                      
                         </div>
                         <table class="table table-bordered table-hover">
                           <thead class="bg-primary text-light">
                           <tr>
                             <th>Medicine</th>
                             <th>Dose</th>
                             <th>Timing</th>
                            </tr>

                            </thead>
                            <tbody id="tbody">

                            <tr>
                            </tr>
                            </tbody>
                        </table>
                         <div class="form-group col-12">
                        <label for="exampleFormControlTextarea1">Suggestion</label>
                         <textarea class="form-control" id="exampleFormControlTextarea1" name="sug"rows="3" required ></textarea>
                        </div>
                        <div class="form-group col-12">
                        <label for="exampleFormControlTextarea1">Disease</label>
                         <textarea class="form-control" id="exampleFormControlTextarea1" name="disease"rows="3" required ></textarea>
                        </div>
                        <button type="button" class="btn btn-danger" id="btn_save_med">Submit</button> 
                    </div>
                     
                  </form>
              
                
                </div>
                
            </div>
        </div>
    </section>

          <!-- End form -->

          
</div>


<!-- outer medicine modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Medicine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="outer_med_form"   action="{{url('superadmin/outer_med_data')}}"method="post">
        @csrf()
        <input type="hidden" id="out_med_set" name="out_med_set">
      <div class="modal-body">
        <div class="row">
          <input type="hidden" value="" name="reciept_id" id="receipt_id_out_med"/>
          <input type="hidden" value="" name="patient_id" id="patient_id_out_med"/>
          <div class="col-md-3">
          <lable>Medicine Name</lable>
           <input type="text" class="form-control" name="outer_does" id="outer_med_name" placeholder="Enter Medicine Outer_Name"   >

          </div>
          <div class="col-md-3">
          <lable>Medicine Dose</lable>
          <input type="text" class="form-control" name="outer_med_name" id="outer_dose" placeholder="Enter Medicine Outer_Dose"   >

          </div>
          <div class="col-md-3">
          <lable>Medicine Timing</lable>
      <input type="text" class="form-control" name="outer_does" id="outer_timing" placeholder="Enter Medicine Outer_Timing"   >

          </div>
          <div>
          <button type="button"  id="outer_med_add" class="btn btn-primary  mt-3 ml-4">Add</button>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">medicine Name</th>
      <th scope="col">Dose</th>
      <th scope="col">Timing</th>
    </tr>
  </thead>
  <tbody id="outer_med_list">
   
    <tbody>
      <thead>
</table>
</div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="outer_med_cancel">Close</button>
        <button type="button" id="btn_outer_med" class="btn btn-primary" data-dismiss="modal">Save Medicine</button>
      </div>
</form>
    </div>
  </div>
</div>


<!-- End outer medicine modal -->


<script>




    $(".readonly").keydown(function(e){
        e.preventDefault();
    });
</script>
<script>
  $('#btnmob').click(function(d){
 d.preventDefault();
  $.ajax(
    {
      url:"fetchprec", 
      method:"post",
      data:$('#mobid').serialize(),
      beforeSend:function(){
        $('#btnmob').text("fetching...");
        $('#btnmob').attr('disabled','disabled');
      },
      success:function(x){
        
       // alert(x.pemail);
       // alert(x.contactno);
        $('#name').val(x.pname);
        $('#id').val(x.id);
        $('#btnmob').text("Enter");
        $('#btnmob').removeAttr('disabled');
        $('#outer_med').removeAttr("style");
        //set patient id in modal for outer medicine
        $('#patient_id_out_med').val(x.id);
      }
    }
  );
});

 

  





  // add medicine in table
  $(document).ready(function(){

$('#createtr').click(function(){


  var m=$('#msearch').val();
  //alert(m);
  var d=$('#dose').val();
  var t=$('#timing').val();
  if(d=="" || m=="" || t==""|| d==null || m==null || t==null)
  {
    alert("Please fill all filed in Medicine block");

  }
  else
  {
    $('#tbody').append("<tr><td><input type='hidden' name='medicine[]' value='"+m+"'/>"+m+"</td><td><input type='hidden' name='dose[]' value='"+d+"'/>"+d+"</td><td><input type='hidden' name='dtime[]' value='"+t+"'/>"+t+"</td></tr>");

var m=$('#msearch').val("");
var d=$('#dose').val("");
var t=$('#timing').val("");
if(m=="" || d=="" || t==""|| d==null || m==null || t==null)
  {
    alert("Please fill all filed in Medicine block");

  }

    
  }

});


  });


// Modal  outer medicine 
$(document).ready(function(){

$('#outer_med_add').click(function(){

//alert("Hii hred");
var om=$('#outer_med_name').val();
//alert(m);
var od=$('#outer_dose').val();
//alert(d);
var ot=$('#outer_timing').val();
//alert(t);
if(om=="" || od=="" || ot=="")
  {
    alert("Please fill all filed in Outer Medicine block");

  }
  else{

    $('#outer_med_list').append("<tr><td><input type='text' value='"+om+"'  name= 'om_name[]' style='border:none;' readonly /> </td><td><input type='text' value='"+od+"'  name= 'om_dose[]' style='border:none;' readonly /> </td><td><input type='text' value='"+ot+"'  name= 'om_timing[]' style='border:none;' readonly /> </td></tr>")
    var om=$('#outer_med_name').val("");
  var od=$('#outer_dose').val("");
  var ot=$('#outer_timing').val("");
  $('#out_med_set').val('1');
  if(om=="" || od=="" || ot=="")
  {
    alert("Please fill all filed in Outer Medicine block");

  }


  }
  
 
});

});
  

  // outer from medicine submition
  /*
  $('#outer_med_form').on('submit',function(e){

e.preventDefault();
//alert("vf");

$.ajax(
{
  url:"outer_med_data", 
      type:"post",
      data:$('#outer_med_form').serialize(),
      beforeSend:function(){
        $('#btn_outer_med').attr('disabled');
        $('#btn_outer_med').text('Data Saving...');

      },
      success:function(t){
        alert(t);
      }
}
);

  });*/

// for setting outer medicine 
  $('#outer_med_cancel').on('click',function(){

    $('#outer_med_list').text('');
    $('#out_med_set').val('');
    $('#exampleModal').modal('toggle');

  });




  
</script>


<script>
  
    // submit form
    $('#btn_save_med').on('click',function(f){
      f.preventDefault();
      //alert(f);
      var fid=$('#id').val();
      var fname=$('#name').val();
      var fage=$('#age').val();
      var fweight=$('#weight').val();
      if(fid=='' || fname=='' || fage=='' || fweight=='' || fid==null || fname==null || fage==null || fweight==null)
      {
        alert('Please Fill all field in Patient Section ');
      }
      else{
      $.ajax({
        url:"addreceipt",
        method:"post",
        data:$('#med_form').serialize(),
        beforeSend:function(){
          $('#btn_save_med').text('Saving  Data......');
          $('#btn_save_med').attr('disabled','disabled');
        },
        success:function(v){
          //alert(v);
          $('#btn_save_med').removeAttr('disabled','disabled');
          $('#btn_save_med').text('Submit');
          $('#med_form').trigger('reset');
          $('#tbody').text('');
          //alert(v);

          $('#receipt_id_out_med').val(v);
          var oms=$('#out_med_set').val();
          if(oms==1)
          {
            $('#outer_med_form').submit();

          }
          else{
            alert('outer medicine not added');
            location.reload();
          }



        }
     
      });
      }

    });
  </script>

@endsection 


