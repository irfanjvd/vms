<?php
//print_r($users);die;
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
<!--        <h2>View Listings <span>VMS - Visitors Management System</span></h2>-->
      </div>

      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>User Visit Details </strong>Listing</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
                <?php
                $flash_message = $this->session->flashdata('message');
                if(isset($flash_message['message'])) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i></h4>
                        <?php echo ($flash_message['message']); ?>
                    </div>
                <?php
                }
                ?>
              <div class="table-responsive">
                  <div><h4>Search By:</h4>
                      <!--                      <input type="submit" name="submit" value="Export"></div>-->
<!--                      <table style="width: 100%">-->
<!--                          <tr id="">-->
<!--                              <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingActionFilter"></p></td>-->
<!--                              <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingByUserFilter"></p></td>-->
<!--                              <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingDateFilter"></p></td>-->
<!--                          </tr>-->
<!--                      </table>-->
                      <div class="row">

                          <div class="col-xs-2">
                              <p id="renderingActionFilter"></p>
                          </div>
                          <div class="col-xs-3">
                              <p id="renderingByUserFilter"></p>
                          </div>
                          <div class="col-xs-3">
                              <p id="renderingDateFilter"></p>
                          </div>

                      </div>

                <table id="example122" class="table table-bordered table-striped uservisitdetailstable" style="width: 100%">
                  <thead class="custom-font">
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader">Visitor Name</th>
                        <th class="sorting" role="columnheader">Cell Number</th>
                        <th class="sorting" role="columnheader">Identity Type</th>
                        <th class="sorting" role="columnheader">Identity No</th>
                        <th class="sorting" role="columnheader">Visit Reason</th>
                        <th class="sorting" role="columnheader">Transport</th>
                        <th class="sorting" role="columnheader">Vehicle Number</th>
                        <th class="sorting" role="columnheader">Tenant</th>
                        <th class="sorting" role="columnheader">Tenant Employee</th>
                        <th class="sorting" role="columnheader">Issued Card</th>
                        <th class="sorting" role="columnheader">From Company</th>
                        <th class="sorting" role="columnheader">Action</th>
                        <th class="sorting" role="columnheader">Visit By User</th>
                      <th class="sorting" role="columnheader">Created Date</th>

<!--                      <th class="sorting" role="columnheader">Delete</th>-->

                    </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">
<!--                  --><?php
//                  foreach($users as $key=>$val) {
//                  ?>
<!--                      <tr>-->
<!--                          <td>--><?php //echo $val['first_name'] ?><!--</td>-->
<!--                          <td>--><?php //echo $val['last_name'] ?><!--</td>-->
<!--                          <td>--><?php //echo $val['email'] ?><!--</td>-->
<!--                          <td>--><?php //echo $val['status'] ?><!--</td>-->
<!--                          <td>--><?php //echo $val['type'] ?><!--</td>-->
<!--                          <td>--><?php //echo $val['created_datetime'] ?><!--</td>-->
<!--                          <td><a href="--><?php //echo base_url().'user/edit_user/'.$val['id']; ?><!--"><i class="fa fa-pencil"></i></a></td>-->
<!--                          <td>-->
<!--                              --><?php
//                              if($val['type']!="SUPER") {
//                                  ?>
<!--                                  <a href="--><?php //echo base_url() . 'user/delete_user/' . $val['id']; ?><!--" onclick="return confirm('Are you sure you want to delete this user?');">-->
<!--                                      <i class="fa fa-lock"></i>-->
<!--                                  </a>-->
<!--                              --><?php
//                              }
//                              ?>
<!--                          </td>-->
<!--                      </tr>-->
<!--                  --><?php
//                  }
//                  ?>
                      
                      
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
<style>
    .bootstrap-datetimepicker-widget{
        z-index: 1000 !important;
    }
</style>