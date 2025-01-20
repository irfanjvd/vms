<title><?php echo $title; ?></title>
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Add User</a> </li>
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
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Add </strong>User</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
			<?php
				$attributes=array(
					'name' => 'add_user',
					'enctype' => "multipart/form-data"
				);
				echo form_open('', $attributes);
			?>
                <!--<form name="add_user" action="" method="post" enctype="multipart/form-data">-->
                    <?php
                    $flash_message = $this->session->flashdata('message');
                    if(isset($flash_message['message'])) {
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
                            <label class="form_label">Profile Image :</label>
                            <input type="file" class="form-control" name="image_file" placeholder="Choose Image" value="">
                        </div>

                        <div class="col-xs-4">
                          <label class="form_label">First Name *:</label>
                          <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo (isset($info['first_name']))? $info['first_name']: '' ?>">
                        </div>

                        <div class="col-xs-4">
                          <label class="form_label">Last Name:</label>
                          <input type="text"  class="form-control" name="last_name" placeholder="Last Name" value="<?php echo (isset($info['last_name']))? $info['last_name']: '' ?>">
                        </div>

                    </div>
                          <!--owner profile form row ends here-->
                          
                    <div class="row" style="margin-top:20px;">
                        <div class="col-xs-4">
                            <label class="form_label">Email/Username:</label>
                            <input type="text"  class="form-control" name="email" placeholder="Email" value="<?php echo (isset($info['email']))? $info['email']: '' ?>">
                        </div>
                        <div class="col-xs-3">
                          <label class="form_label">Password *:</label>
                          <input type="password" class="form-control" name="password" placeholder="Password" value="">
                        </div>
                        <div class="col-xs-3">
                          <label class="form_label">Type:</label>

                          <select class="form-control" name="type" onchange="populateBranch(this.value)" id="userTypes">
                            <option value="SUPER">Admin</option>
                            <option value="NORMAL">Operator</option>
                            <option value="TENANT">Tenant/Department</option>
                            <option value="VIEW_ONLY">View Only</option>
                          </select>
                        </div>

                        <div class="col-xs-3" id="userBranch">
                          <label class="form_label">Branch:</label>

                          <select class="form-control" name="branch_id" id="branch_id">
                          </select>
                        </div>
                    </div>
                          <!--owner profile form row ends here-->

                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-1">
                                <input type="hidden" name="status" value="1">
                                <input type="submit" name="submit" value="Add User" class="btn btn-success col-xs-12">
<!--                              <a href="#" class="btn btn-success col-xs-12">Save</a>-->
                            </div>
<!--                            <div class="col-xs-1">-->
<!--                              <a href="#" class="btn btn-warning col-xs-12">Reset</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-1">-->
<!--                              <a href="#" class="btn btn-danger col-xs-12">Close</a>-->
<!--                            </div>-->
                          </div>

                          <!--</form>-->
						  <?php
						  echo form_close();
						  ?>
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
  <script type="text/javascript">
    $('#userBranch').hide();
  </script>