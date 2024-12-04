<title><?php echo $title; ?></title>
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Edit Reservation</a> </li>
          </ul>
          
        </div>
<!--        <h2>Add User <span>VMS - Visitors Management System</span></h2>-->
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
<!--            <div class="tile-header dvd dvd-btm">-->
<!--              <h1 class="custom-font"><strong>Add </strong>User</h1>-->
<!--              -->
<!--            </div>-->
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
                <form name="add_user" action="" method="post" enctype="multipart/form-data">
                    <?php
                    $flash_message = $this->session->flashdata('message');
                    if($flash_message['message']) {
                        if($flash_message['type']=="success"){
                            $class="alert-success";
                            $class1='fa-check';
                        }else{
                            $class="alert-danger";
                            $class1='fa-ban';
                        }
                        ?>
                        <div class="alert <?php echo $class; ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa <?php echo $class1; ?>"></i></h4>
                            <?php echo ($flash_message['message']); ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">

                        <div class="col-xs-4">
                            <label class="form_label">CNIC *:</label>
                            <input type="text" class="form-control cnic" name="cnic" placeholder="Enter cnic" value="<?php echo (isset($info['cnic']))? $info['cnic']: '' ?>">
                        </div>

                        <div class="col-xs-4">
                            <label class="form_label">Visitor Name *:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo (isset($info['name']))? $info['name']: '' ?>">
                        </div>

                        <div class="col-xs-4">
                            <label class="form_label">Employee Name *:</label>
                            <input type="text" class="form-control" name="employee_name" placeholder="Enter Employee Name" value="<?php echo (isset($info['employee_name']))? $info['employee_name']: '' ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <label class="form_label">Vehicle Type :</label>
                            <select class="form-control" name="vehicle_type" >
                                <option <?php if($info['vehicle_type']=="Car"){ echo "selected"; } ?> value="Car">Car</option>
                                <option <?php if($info['vehicle_type']=="Motorcycle"){ echo "selected"; } ?> value="Motorcycle">Motorcycle</option>
                                <option <?php if($info['vehicle_type']=="Taxi"){ echo "selected"; } ?> value="Taxi">Taxi</option>
                                <option <?php if($info['vehicle_type']=="Other"){ echo "selected"; } ?>value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-xs-4">
                            <label class="form_label">Vehicle Number :</label>
                            <input type="text" class="form-control" name="vehicle_no" placeholder="Enter Vehicle Number" value="<?php echo (isset($info['vehicle_no']))? $info['vehicle_no']: '' ?>">
                        </div>

                        <div class="col-xs-4">
                            <label class="form_label">Reservation Date :</label>
                            <input type="text" class="form-control date-picker" name="reservation_date" placeholder="" value="<?php echo (isset($info['reservation_date']))? $info['reservation_date']: '0000-00-00' ?>">
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xs-6">
                            <label class="form_label">Address :</label>
                            <textarea class="form-control" id="location" name="location" placeholder="Enter Address" style="width:100%; height:100px; border-bottom:"><?php echo (isset($info['location']))? $info['location']: '' ?></textarea>
                        </div>
                    </div>

                          <div class="row" style="margin-top:20px;">
<!--                            <div class="col-xs-9"></div>-->
                            <div class="col-xs-2">
                                <input type="submit" name="submit" value="Update Reservation" class="btn btn-success col-xs-12">
<!--                              <a href="#" class="btn btn-success col-xs-12">Save</a>-->
                            </div>
<!--                            <div class="col-xs-1">-->
<!--                              <a href="#" class="btn btn-warning col-xs-12">Reset</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-1">-->
<!--                              <a href="#" class="btn btn-danger col-xs-12">Close</a>-->
<!--                            </div>-->
                          </div>

                          </form>
                          <!--owner profile form row ends here-->





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