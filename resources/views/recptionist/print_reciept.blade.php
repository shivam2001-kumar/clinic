<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Saran Clinic</title>
  </head>
  <body>
  <section class="mt-5">
    <div id="printarea">
   <div class="container">
   <div class="row my-5">
   {{-- <div class="col-4"><img src="{{url('disc/img/logo1.png')}}" height="100px" width="100px"/></div>
   <div class="col-4"><h1 class="text-primary">Saran Clinic</h1></div>
   <div class="col-4"><b>Dr.</b><br/> <b>mob:</b> +91 xxxxx-xxxxx <br/></div> --}}
   </div>
   </div>
    <div class="container">

   <div class="row">
   <div class="col-4"><b>Name: </b> {{$patient->pname}}</div>
   <div class="col-2"><b>Age : </b> {{$patient->age}}</div>
   <div class="col-2"><b>Weight : </b> {{$patient->weight}}</div>
   <div class="col-4"><b>Date : </b> {{$patient->created_at}}</div>
   </div>
   </div>
   <hr/>
   <div class="container">
   <div class="row">
   <div class="col-4"><b>Reciept_id : </b> {{$patient->reciept_id}}</div>
   <div class="col-4"><b>Patient_id : </b> {{$patient->patient_id}}</div>
   <div class="col-4"><b>Mobile No : </b> {{$patient->contactno}}</div>

   </div>
   </div>
 <hr/>



    <div class="container" style="border:1px solid">
	<h5 class="ms-2 mt-3">R<sub>x</sub></h5>
    <div class="ms-5">
	<table class="table table-border">
  <thead>
    <tr>
      <th scope="col">SN.</th>
      <th scope="col">Medicine Name</th>
      <th scope="col">Dose</th>
      <th scope="col">Timing</th>
      <th scope="col">Disease</th>


    </tr>
  </thead>
  <tbody>
      @php $i=1; @endphp
    @foreach($medicine as $m)
  <tr>
      <th scope="row">{{$i}}@php $i++; @endphp</th>
      <td>{{$m->medname}}</td>
      <td>{{$m->dose}}</td>
      <td>{{$m->time}}</td>
      <td rowspan="{{ $i }}">{{$patient->disease}}</td>

    </tr>
   @endforeach
  </tbody>
</table>


	<h5 class="my-3">Outer Medicine</h5>



	<table class="table table-border ">

  <tbody>
      @php $c=count($outmed_name); @endphp
      @for($i=0; $i<$c; $i++)
      <tr>
      <th scope="row">{{($i+1)}}</th>
      <td>{{$outmed_name[$i]}}</td>
      <td>{{$outmed_dose[$i]}}</td>
      <td>{{$outmed_time[$i]}}</td>
    </tr>

      @endfor




  </tbody>
</table>
    </div>
</div>
    <div class="container" style="border:1px solid  ">
	<h5 class="ms-3 my-2">Suggestion</h5>
    <p class="ms-5">{{$patient->suggestion}}</p>
	</div>
    </div><!-- Print div close-->
    <div class="container mb-5 mt-2">
	<input type="button" class="btn btn-primary col-sm-12" value="Print" onclick="print()"/>
    </div>
    <a href="{{url('recptionist/bill/')}}/{{$patient->reciept_id}}" target="_blank" id="billprint">If bill not print automatically click here ....</a>
	</section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {


        $('#billprint')[0].click();
      });
      </script>
  </body>
</html>
