<title><?php echo $title; ?></title>
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Add Banned CNIC</a> </li>
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
              <h1 class="custom-font"><strong>Add </strong>Banned CNIC</h1>
              
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
                          <label class="form_label">CNIC *:</label>
                          <input type="text" class="form-control cnic" name="cnic" placeholder="Enter CNIC" value="" required>
                        </div>
                        <div class="col-xs-4">
                            <label class="form_label">Reason :</label><br>
                            <input type="text" class="form-control" name="reason" placeholder="Enter Reason" value="">
                        </div>
                        <div class="col-xs-4">
                            <label class="form_label">Type :</label><br>
                            <select name="type" class="form-control" onchange="if(value=='NO_OF_VISITS'){ $('.visit_left').show();$('.range').hide();$('.range').val(''); }else if(value=='DATE_RANGE'){ $('.range').show();$('.visit_left').hide();$('.visit_left').val(''); }else if(value=='BANNED'){ $('.visit_left_val').val('');$('.date_range').val('');$('.range').hide();$('.visit_left').hide(); }">
                                <option value="BANNED">BANNED</option>
                                <option value="NO_OF_VISITS">NO OF VISITS</option>
                                <option value="DATE_RANGE">DATE RANGE</option>

                            </select>
                        </div>
                        <div class="col-xs-4 visit_left" style="display:none">
                            <label class="form_label">Visits Allowed :</label><br>
                            <input type="text" class="form-control visit_left_val" name="visit_left" value="">
                        </div>
                        <div class="col-xs-4 range" style="display:none">
                            <label class="form_label">Date Range :</label><br>
                            <input type="text" class="form-control date_range" name="date_range" value="">
                        </div>


                    </div>

                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-2">
                                <input type="submit" name="submit" value="Add CNIC" class="btn btn-success col-xs-12">

                            </div>

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