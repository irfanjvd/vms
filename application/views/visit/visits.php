 <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
  <section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-list" style="margin-right:6px;"></i>List View</a> </li>
          </ul>
          
        </div>
<!--        <h2>Visits Listing <span>VMS - Visitors Management System</span></h2>-->
      </div>

      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Visits </strong>Listing
			  
			  
			  </h1>
              <div id="critical_rows" class="" style="float:right;background-color:red;color:white;padding:5px;border-radius:3px;height:30px;">
<!--                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                          
                          <p id="critical_msg"></p>
              </div>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body table-custom">
              <div class="table-responsive">
<!--                  <input type="button" id="clear_search" value="Clear Search">-->
<!--                  <form action="--><?php //echo base_url().'visit/export'; ?><!--" method="post" >-->
                  <div><h4>Search By:</h4>
<!--                      <input type="submit" name="submit" value="Export"></div>-->

                      <div class="row">

                          <div class="col-xs-2">
                              <p id="renderingNameFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingCellNoFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingVehicleNoFilter"></p>
                          </div>
                          <div class="col-xs-4">
                              <p id="renderingTenantFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingLocationFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingIssuedCardFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingDateFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingCompanyFromFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingIdentityNoFilter"></p>
                          </div>
                          <div class="col-xs-2">
                              <p id="renderingCheckoutFilter"></p>
                          </div>
                      </div>
                      
                      
<!--                  </form>-->
                <table id="list_visits12" class="table table-bordered table-striped visit_listings">
                  <thead class="custom-font">
                    <tr role="row">
                      <th class="sorting" role="columnheader">Image</th>
                      <th class="sorting" role="columnheader">Visitor Name</th>
<!--                      <th class="sorting" role="columnheader">Visitor Address</th>-->
                      <th class="sorting" role="columnheader">Visitor Cell</th>
                      <th class="sorting" role="columnheader">Identity Type</th>
                      <th class="sorting" role="columnheader">Identity No</th>
                      <th class="sorting" role="columnheader">Visit Code</th>
                      <th class="sorting" role="columnheader">Visit Reason</th>
<!--                      <th class="sorting" role="columnheader">Company</th>-->

                      <th class="sorting" role="columnheader">Transport</th>
                      <th class="sorting" role="columnheader">Vehicle Number</th>
                      <th class="sorting" role="columnheader">Branches</th>
                      <th class="sorting" role="columnheader">Officers</th>
                      <th class="sorting" role="columnheader">Issued Card</th>
                      <th class="sorting" role="columnheader">Company From</th>
                      <th class="sorting" role="columnheader">Check In</th>
                      <th class="sorting" role="columnheader">Check Out</th>
                      <th class="sorting" role="columnheader">Visit Date</th>
                      <th class="sorting" role="columnheader">Location</th>
                      <th class="sorting" role="columnheader">Status</th>
<!--                        <th class="sorting" role="columnheader">Next Location</th>-->
<?php //if(sessiondata('login_user_type')!="VIEW_ONLY") { ?>
                      <th class="sorting" role="columnheader">Action</th>
<?php //} ?>                      
<!--                      <th class="sorting" role="columnheader">Check Out</th>-->
                    </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">

                      
                    </tbody>
                                
                  <tfoot>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- /tile body --> 
            
          </section>
          <!-- /tile --> 
        </div>
        <!-- /col --> 
        
      </div>
      <!-- /row --> 
      
      
    </div>
      

  </section>
  <!--/ CONTENT --> 


<script>


</script>
 <style>
     .dt-buttons{
         float:right;
     }

     #list_visits12_processing{
         background-color: #CCCCCC;
         width: 100%;
         height: 100%;
         opacity: 0.5;
         top:123px;
     }

     .dataTables_length{
        margin-left: 56px;
        margin-top: 18px;
     }

 </style>