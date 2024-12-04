<?php
// print_r($tenants);die;
date_default_timezone_set('Asia/Karachi');
if ($this->session->userdata('logged_in')) {
    $session_data = $this->session->userdata('logged_in');
}
?> 
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
              <h1 class="custom-font"><strong>Visits </strong>Listing</h1>
              
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

                                <div class="form-group col-md-3">
                                        <label class="form-label">Visitor Name:</label>
                                        <input class="form-control" id="visitor_name" type="text" name="search_visitor_name">
                                </div>

                                <div class="form-group col-md-3">
                                        <label class="form-label">Employee(Caller) Name:</label>
                                        <input class="form-control" id="employee_name" type="text" name="search_employee_name">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form_label">Caller Company:</label>
                                    <select class="form-control" id="tenant" name="visit_to_tenant" >
                                        <option value="">Select Tenant</option>
                                        <?php 
                                          foreach ($tenants as $key => $value) {
                                            echo '<option value='.$value['tenant_name'].'>'.$value['tenant_name'].'</option>';
                                          }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                  <label class="form_label"></label>
                                    <!-- <input class="form-control btn-success" type="submit" value="Search"> -->
                                    <button class="form-control btn btn-success" onclick="search_data()"><strong>Search</strong></button>
                                </div>
                          
                      </div>
                      

                      <br><br>
                      <?php if($this->session->flashdata('visit_delete')){ ?>
                          <div class="alert alert-success alert-dismissable">  
                      <?php }
                      else{ ?>
                          <div class="alert alert-danger alert-dismissable">
                      <?php } ?>  
<!--                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                          <?php 
                            if($this->session->flashdata('visit_delete')){
                                  echo '<h3><center>'. $this->session->flashdata('visit_delete').' </center></h3>';       
                              }

                            if($this->session->flashdata('not_visit_delete')){
                                  echo '<h3><center>'. $this->session->flashdata('not_visit_delete').' </center></h3>';       
                              }  
                          ?>
                      </div>
                      <div  style="color:red; width: 200px;"></div>
                      <br><br>
<!--                  </form>-->
                <table id="list_visits12" class="table table-bordered table-striped visit_listings_call">
                  <thead class="custom-font">
                    <tr role="row">
                      <!-- <th class="sorting" role="columnheader">Image</th> -->
                      <th class="sorting" role="columnheader">Visitor Name</th>
<!--                      <th class="sorting" role="columnheader">Visitor Address</th>-->
                      <!-- <th class="sorting" role="columnheader">Visitor Cell</th>
                      <th class="sorting" role="columnheader">Identity Type</th> -->
                      <th class="sorting" role="columnheader">Identity No</th>
                      <th class="sorting" role="columnheader">Visit Reason</th>
<!--                      <th class="sorting" role="columnheader">Company</th>-->

                      <!-- <th class="sorting" role="columnheader">Transport</th>
                      <th class="sorting" role="columnheader">Vehicle Number</th> -->
                      <th class="sorting" role="columnheader">Tenant</th>
                      <th class="sorting" role="columnheader">Employee</th>
                      <!-- <th class="sorting" role="columnheader">Issued Card</th>
                      <th class="sorting" role="columnheader">Company From</th>
                      <th class="sorting" role="columnheader">Check In</th>
                      <th class="sorting" role="columnheader">Check Out</th> -->
                      <th class="sorting" role="columnheader">Visit Date</th>
                        <!-- <th class="sorting" role="columnheader">Location</th> -->
<!--                        <th class="sorting" role="columnheader">Next Location</th>-->
                        <th class="sorting" role="columnheader">Action</th>

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
  //var visitcalltable = '';

  $(document).ready(function (){

    // Phone call visit listing starts
    visitcalltable=$('.visit_listings_call').dataTable( {
        
        "lengthMenu": [[25, 50, 100, 500, 1000, 2000, 3000], [25, 50, 100, 500, 1000, 2000, 3000]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true
        ,searchHighlight : true
        ,stateSave: true

        ,"aoColumns":[
            {"mDataProp": "visitor_name"}
           
            ,{"mDataProp":"identity_no"}
            ,{"mDataProp":"visit_reason","bSortable": false}
            
            ,{"mDataProp":"visit_to_tenant","bSortable": false}
            ,{"mDataProp":"visit_to_employee","bSortable": false}
            
            ,{"mDataProp":"visit_date","bSortable": true}
            ,{"mDataProp":"action","bSortable": false}
        ]
        ,"aaSorting": [[1,'DESC']]
        ,"sAjaxSource": "<?php echo base_url().'CallVisit/get_ajax_visits_list';  ?>"
        ,"fnServerParams": function ( aoData ) {
          aoData.push( { "name": "visitor_name", "value": $('#visitor_name').val() } );
          aoData.push( { "name": "employee_name", "value": $('#employee_name').val() } );
          aoData.push( { "name": "employee_company", "value": $('#tenant').val() } );
        }
    } )



  });

  function search_data(){
      table=$('.visit_listings_call').DataTable();
      table.draw();

  } // end search_data
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


 </style>