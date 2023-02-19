@extends('stockmanager.includes.stockmanager_master')
@section('main-container')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- start form -->

        <section>
            <div class="container">
            @if(Session::has('flash_message'))
                <div class="alert {!! session('status') !!}" role="alert"><em> {!! session('flash_message') !!}</em>
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="text-light">genrate Bill</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/stockmanager/post_bill')}}" class="needs-validation" id="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medcode">Bill No .  :</label>
                                        <input type="text" class="form-control" name="billno" id="billno"
                                            placeholder="Enter Bill No. " required>
                                        @error('medcode')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medcode">Bill ammount:</label>
                                        <input type="number" min="1.00" max="10000000.00" step="0.1" class="form-control" name="billamt" id="billamt"
                                            placeholder="Enter Bill Ammount" required>
                                        @error('medcode')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paidamt">Paid Ammount:</label>
                                        <input type="text" class="form-control" name="paidamt" id="paidamt"
                                            placeholder="Enter Paid Ammount" required>
                                        @error('medname')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dueamt">Due Ammount:</label>
                                        <input type="text" class="form-control" name="dueamt" id="dueamt"
                                            placeholder="Enter Due Ammount" required>
                                        @error('medname')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billdate">Bill Date:</label>
                                        <input type="date" class="form-control" name="billdate" id="billdate"
                                             required>
                                        @error('')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billpic">Bill Picture:</label>
                                        <input type="file" class="form-control" name="billpic" id="billpic"
                                            placeholder="" required>
                                        @error('')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                 <textarea class="form-control" id="desc" name="desc"rows="3"></textarea>
                                        @error('medquantity')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <input type="submit" id="button" class="form-control btn btn-info">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- End form -->
    </div>
    <div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $('input').keyup(function() {
                // var type = $("#medtype option:selected").text();
                var billamt = $("#billamt").val();
                 var paidamt = $("#paidamt").val();
                 var tq = billamt - paidamt;
                $("#dueamt").val(tq);
                
            });
        });
        </script>
        @endsection

        