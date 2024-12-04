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
              <h1 class="custom-font"><strong>Shelters </strong>Listing</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
                <?php
                $flash_message = $this->session->flashdata('message');
                if($flash_message['message']) {
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
                <table id="example122" class="table table-bordered table-striped listsheltertable">
                  <thead class="custom-font">
                    <tr role="row">
                      <th class="sorting" role="columnheader">Shelter</th>
                      <th class="sorting" role="columnheader">Rooms</th>
                      <th class="sorting" role="columnheader">Action</th>
<!--                      <th class="sorting" role="columnheader">Delete</th>-->

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