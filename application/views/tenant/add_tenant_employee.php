<title><?php echo $title; ?></title>
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Add Tenant Employee</a> </li>
          </ul>
          
        </div>
<!--        <h2>Add Location <span>VMS - Visitors Management System</span></h2>-->
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Add </strong>Tenant Employee</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
                <form name="add_user" action="" method="post" enctype="multipart/form-data">
                    <?php
                    $flash_message = $this->session->flashdata('message');
                    if($flash_message['message']) {
                        if($flash_message['type']=="success"){
                            $class="alert-success";
                            $class1="fa-check";
                        }else{
                            $class="alert-danger";
                            $class1="fa-ban";
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
                            <label class="form_label">Tenant :</label>
                            <select name="tenant_name" class="form-control">
                                <option value="">Select One</option>
                                <?php
                                foreach($tenants as $key=>$val){
                                ?>
                                    <option value="<?php echo $val['id'].'_'.$val['tenant_name']; ?>"><?php echo $val['tenant_name']; ?></option>
                                <?php
                                }

                                ?>
                            </select>
<!--                            <input type="text" class="form-control" name="tenant_name" placeholder=""  value="--><?php //echo (isset($info['employee_name']))? $info['employee_name']: '' ?><!--">-->
                        </div>

                        <div class="col-xs-4">
                          <label class="form_label">Employee Name *:</label>
                          <input type="text" class="form-control" name="employee_name" placeholder="Enter Tenant Employee"  value="<?php echo (isset($info['employee_name']))? $info['employee_name']: '' ?>">
                        </div>
                        <div class="col-xs-4">
                            <label class="form_label">Mobile #:</label>
                            <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile Number"  value="<?php echo (isset($info['mobile_no']))? $info['mobile_no']: '' ?>">
                        </div>

                    </div>

                          <div class="row" style="margin-top:20px;">
<!--                            <div class="col-xs-9"></div>-->
                            <div class="col-xs-2">
                                <input type="submit" name="submit" value="Add Tenant Employee" class="btn btn-success col-xs-12">
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