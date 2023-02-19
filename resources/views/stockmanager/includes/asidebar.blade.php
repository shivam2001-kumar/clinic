
<div class="container-fluid page-body-wrapper">
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="{{asset('/disc/img/logo.png')}}" style="background:white;">
          </div>
          <div class="user-name">
             <!-- {{Session::get('spvisorid')}} -->
          </div>
          <div class="user-designation">
              Stock-Manager
          </div>
        </div>
       <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#medstock" aria-expanded="false" aria-controls="medstock">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">Medicine Stock</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="medstock">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('/stockmanager/add-stock')}}">Add</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/stockmanager/view-stock')}}">View</a></li>
              </ul>
            </div>
           
          </li>
          
          
        
          <!-- <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Students</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/feather-icons.html">
              <i class="icon-help menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#bulk_bill" aria-expanded="false" aria-controls="auth">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Bull Medicine</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="bulk_bill">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('/stockmanager/genrate_bill')}}">Genrate Bill</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/stockmanager/bulkdata')}}">Bulk Data</a></li>
              </ul>
            </div>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link" href="docs/documentation.html">
              <i class="icon-book menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> -->
        </ul> 
      </nav>
      <!-- partial -->