<title><?php echo $title; ?></title>
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Edit User</a> </li>
          </ul>
          
        </div>
        <h2>Edit User <span>VMS - Visitors Management System</span></h2>
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Edit </strong>User</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
                <!--<form name="add_user" action="" method="post" enctype="multipart/form-data">-->
				<?php
				$attributes=array(
					'name' => 'add_user',
					'enctype' => "multipart/form-data"
				);
				echo form_open('', $attributes);
			
                    $flash_message = $this->session->flashdata('message');
                    if((isset($flash_message['message'])) && $flash_message['message']) {
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
                    <?php
                    if(isset($info['image_file']) && $info['image_file']!=''){
                        $image_name= $info['image_file'];
                        $p_image=base_url()."assets/images/user_images/".$info['image_file'];
                        echo "<input type='hidden' name='old_image' value='$image_name;'>";

                    }else{
                        $p_image=base_url()."assets/images/avatar5.png";
                    }
                    ?>
                    <div class="row">
                            <div class="col-xs-2">
                              <label class="form_label">Profile Image :</label>
                              <input type="file" class="form-control" name="image_file"  value="">
                            </div>
                        <div class="col-xs-1">
                            <label class="form_label" style="color: white">Image *:</label>
                            <img src="<?php echo $p_image ?>" class="img-circle size-30x30">
                        </div>
                        <div class="col-xs-4">
                              <label class="form_label">First Name *:</label>
                              <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo (isset($info['first_name']))? $info['first_name']: '' ?>">
                            </div>
                            <div class="col-xs-4">
                              <label class="form_label">Last Name:</label>
                              <input type="text"  class="form-control" name="last_name" placeholder="Last Name" value="<?php echo (isset($info['last_name']))? $info['last_name']: '' ?>">
                            </div>
<!--                            <div class="col-xs-4">-->
<!--                              <label class="form_label">Email:</label>-->
<!--                              <input type="text"  class="form-control" name="email" placeholder="Email" value="--><?php //echo (isset($info['email']))? $info['email']: '' ?><!--">-->
<!--                            </div>-->
                    </div>
                          <!--owner profile form row ends here-->
                          
                    <!--<div class="row" style="margin-top:20px;">
                            <div class="col-xs-3">
                              <label class="form_label">Password :</label>
                              <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password" value="">
                            </div>-->
                        <?php
                        /*if($_SESSION['logged_in']['login_user_type']=="SUPER") {
                            ?>
                            <div class="col-xs-3">
                              <label class="form_label">Type:</label>
                              
                              <select class="form-control" name="type">
                              	<option value="NORMAL" <?php echo ($info['type'] == "NORMAL") ? "selected" : "" ?> >Normal</option>
                              	<option value="SUPER"  <?php echo ($info['type'] == "SUPER") ? "selected" : "" ?> >Super Admin</option>
                              	<option value="TENANT"  <?php echo ($info['type'] == "TENANT") ? "selected" : "" ?> >Tenant</option>

                              </select>
                            </div>
                            <?php
                        }*/
                        ?>

              <div class="row" style="margin-top:20px;">
                  <div class="col-xs-3">
                      <label class="form_label">Type:</label>
                      <select class="form-control" disabled onchange="populateBranch(this.value)" id="userTypes">
                          <option value="SUPER" <?php echo $info['type']=='SUPER' ? 'selected':''; ?> >Admin</option>
                          <option value="NORMAL" <?php echo $info['type']=='NORMAL' ? 'selected':''; ?> >Operator</option>
                          <option value="TENANT" <?php echo $info['type']=='TENANT' ? 'selected':''; ?> >Tenant/Department</option>
                          <option value="VIEW_ONLY" <?php echo $info['type']=='VIEW_ONLY' ? 'selected':''; ?> >View Only</option>
                      </select>
                  </div>
                  <div class="col-xs-3" id="userBranch">
                      <label class="form_label">Branches: <span class="redcolor">*</span></label>
                      <select class="form-control" disabled id="tenant_id" onchange="get_employees(value)">
                            <option ></option>
                          <?php
                          foreach ($tenants as $key => $val) {
                              ?>
                              <option <?php if (isset($member_info) && !empty($member_info) && $member_info['tenant_id'] == $val['id']) {
                                  echo "selected";
                              } else if (isset($info['tenant_id']) && $info['tenant_id'] == $val['id']) {
                                  echo "selected";
                              } ?> value="<?php echo $val['id']; ?>"><?php echo $val['tenant_name']; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                  </div>
              </div>
            </div>
                          <!--owner profile form row ends here-->

                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-2">
                                <input type="submit" name="submit" value="Update User" class="btn btn-success col-xs-12">
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