@extends('supervisor.includes.principal_master')
@section('main-container') 
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Hi, welcome to Supervisor Dashboard</h4>
              <p class="font-weight-normal mb-2 text-muted"><?php  echo date('M - d - Y'); ?></p>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-xl-3 flex-column d-flex grid-margin stretch-card">
              <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Customers</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">43,981</h4>
                          <canvas id="customers"></canvas>
                      </div>
                    </div>
                </div>
                <div class="col-sm-12 stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Orders</h4>
                          <p>6% decrease in earnings</p>
                          <h4 class="text-dark font-weight-bold mb-2">55,543</h4>
                          <canvas id="orders"></canvas>
                      </div>
                    </div>
               </div>
              </div>
            </div> 
             <div class="col-xl-9 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Website Audience Metrics</h4>
                      <div class="row">
                        <div class="col-lg-5">
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit amet cumque cupiditate</p>
                        </div>
                        <div class="col-lg-7">
                          <div class="chart-legends d-lg-block d-none" id="chart-legends"></div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <canvas id="web-audience-metrics-satacked" class="mt-3"></canvas>
                          </div>
                      </div>
                        
                    </div>
                  </div>
            </div>

            <!-- shiva -->
          </div>


          <!-- <div class="row">
              <div class="col-xl-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between mb-3">
                          <h4 class="card-title">Market Trends</h4>
                          <div class="dropdown">
                              <button class="btn btn-sm dropdown-toggle text-dark pt-0 pr-0" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  This week
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <h6 class="dropdown-header">This week</h6>
                                <h6 class="dropdown-header">This month</h6>
                              </div>
                            </div>
                      </div>
                      <div id="chart-legends-market-trend" class="chart-legends mt-1">
                      </div>
                      <div class="row mt-2 mb-2">
                        <div class="col-6">
                          <div class="text-small"><span class="text-success">18.2%</span> higher </div>
                        </div>
                        <div class="col-6">
                          <div class="text-small"><span class="text-danger">0.7%</span> higher </div>
                        </div>
                      </div>
                      <div class="marketTrends mt-4">
                        <canvas id="marketTrendssatacked"></canvas>
                      </div>
                        
                    </div>
                  </div>
              </div>
              <div class="col-xl-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="d-flex justify-content-between mt-2 text-dark mb-2">
                              <div><span class="font-weight-bold">4453</span> Leads</div>
                              <div>Goal: 2000</div>
                            </div>
                        <div class="progress progress-md grouped mb-2">
                          <div class="progress-bar  bg-danger" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar  bg-primary" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-light" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="traffic-source-legend">
                          <div class="d-flex justify-content-between mb-1 mt-2">
                            <div class="font-weight-bold">SOURCE</div>
                            <div class="font-weight-bold">TOTAL</div>
                          </div>
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-danger"></span>Google Search</div>
                            <div>30%</div>
                          </div>
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-info"></span>Social Media</div>
                            <div>20%</div>
                          </div>
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-primary"></span>Referrals</div>
                            <div>10%</div>
                          </div>
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-warning"></span>Organic Traffic</div>
                            <div>10%</div>
                          </div>
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-success"></span>Google Search</div>
                            <div>5%</div>
                          </div>
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-light"></span>Email Marketing</div>
                            <div>25%</div>
                          </div>
                        </div>
                        
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="col-xl-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-3">Recent Activity</h4>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="text-dark">
                          <div class="d-flex pb-3 border-bottom justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Deposit has updated to Paid</div>
                              <div class="text-muted font-weight-normal mt-1">32 Minutes Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-info ml-sm-2">$325</h6></div>
                          </div>
                          <div class="d-flex pb-3 pt-3 border-bottom justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Your Withdrawal Proceeded</div>
                              <div class="text-muted font-weight-normal mt-1">45 Minutes Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-info ml-sm-2">$4987</h6></div>
                          </div>
                          <div class="d-flex pb-3 pt-3 border-bottom justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Deposit has updated to Paid                              </div>
                              <div class="text-muted font-weight-normal mt-1">1 Days Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-info ml-sm-2">$5391</h6></div>
                          </div>
                          <div class="d-flex pt-3 justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Deposit has updated to Paid</div>
                              <div class="text-muted font-weight-normal mt-1">3 weeks Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-info ml-sm-2">$264</h6></div>
                          </div> 
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
          </div> -->
          
        </div>
        <!-- content-wrapper ends -->
@endsection 

