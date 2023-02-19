<!-- partial:partials/_footer.html -->
<footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Saran Clinic <?php echo date('Y'); ?></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Developed By : <a href="http://www.softproindia.in/">Softpro India Computer Techologies (P) Ltd.</a></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!--Change Password Modal -->
<div class="modal fade" id="recptmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('recptionist/chpass')}}" method="post">
          @csrf
      <div class="col-md-12">
                         <div class="form-group">
                          <label for="email">Old Password:</label>
                          <input type="text" class="form-control" name="op" id="op" placeholder="Enter Enter Old Password" required> 
                        </div>
                      </div>
                      <div class="col-md-12">
                         <div class="form-group">
                          <label for="email">New Password:</label>
                          <input type="text" class="form-control" name="np" id="newpwd" placeholder="Enter New Password" required>
                          
                        </div>
                      </div>
                      <div class="col-md-12">
                         <div class="form-group">
                          <label for="email">Confirm Password:</label>
                          <input type="text" class="form-control" name="cp" id="cp" placeholder="Enter Confirm Password" required>
                          
                        </div>
                      </div>  
                     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- endChange Password Modal -->
  <!-- container-scroller -->
  @include('recptionist.includes.foot')
  
</body>

</html>