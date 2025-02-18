<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>Edit Visitor</a> </li>
          </ul>
          
        </div>
<!--        <h2>Add Visit <span>VMS - Visitors Management System</span></h2>-->
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Edit </strong>Visitor</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
			<?php
				$attributes=array(
					'name' => 'edit_visitor',
					'enctype' => "multipart/form-data"
				);
				echo form_open('', $attributes);
			?>
              <!--<form name="edit_visitor" method="post" enctype="multipart/form-data" action="">-->
            <div class="tile-body table-custom">
                <?php
                $flash_message = $this->session->flashdata('message');
                if(isset($flash_message['message']) && $flash_message['message']) {
                if(isset($flash_message['type']) && $flash_message['type']=="success"){
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
                            <div class="col-xs-3 checkout marginTop20"  >
                                    <label class="form_label">Check In Time:</label>
                                    <input type="text" class="form-control checkin_datepicker" placeholder="Check In Time"
                                           name="visit_checkin" id="visit_checkin"
                                           value="<?php echo isset($info['visit_checkin']) ? $info['visit_checkin']:''; ?>"
                                           readonly="">
                                </div>

                        <!-- <div class="col-xs-3">
                            <label class="form_label">Check Identity:</label>

                            <select class="form-control" name="visitor_type" id="visitor_type">
                                <option value="visitor_identity_no">CNIC</option>
                                <option value="visitor_employee_card">Employee Card</option>
                                <option value="visitor_driving_license">Driving License</option>
                                <option value="visitor_passport_id">Passport ID</option>

                            </select>
                        </div> -->
                           <!--  <div class="col-xs-3">
                              <label class="form_label">Visitor Identity No *:</label>
                              <input type="text" class="form-control" placeholder="Visitor Identity No" Name="visitor_identity_no" value="<?php //echo (isset($info['visitor_identity_no']))? $info['visitor_identity_no']: '' ?>">
                            </div> -->
<!--                            <div class="col-xs-4">-->
<!--                              <label class="form_label">Visitor Family No :</label>-->
<!--                              <input type="text"  class="form-control" placeholder="Visitor Family No" name="visitor_family_no" value="--><?php //echo (isset($info['visitor_family_no']))? $info['visitor_family_no']: '' ?><!--">-->
<!--                            </div>-->
                            <!-- <div class="col-xs-3">
                              <label class="form_label">Visitor Name *:</label>
                              <input type="text"  class="form-control" placeholder="Visitor Name" name="visitor_name" value="<?php //echo (isset($info['visitor_name']))? $info['visitor_name']: '' ?>">
                            </div> -->
                            <!-- <div class="col-xs-3">
                                <label class="form_label">Cell No :</label>
                                <input type="text"  class="form-control" placeholder="Cell No" name="visitor_cell_no" value="<?php //echo (isset($info['visitor_cell_no']))? $info['visitor_cell_no']: '' ?>">
                            </div> -->
                    </div>
                          <!--owner profile form row ends here-->
                          
                           <div class="row" style="margin-top:20px;">
<!--                            <div class="col-xs-4">-->
<!--                              <label class="form_label">Visitor Father Name :</label>-->
<!--                              <input type="text" class="form-control" placeholder="Visitor Fater Name" name="visitor_father_name" value="--><?php //echo (isset($info['visitor_father_name']))? $info['visitor_father_name']: '' ?><!--">-->
<!--                            </div>-->

                               <!-- <div class="col-xs-3">
                                   <label class="form_label">Visitor City :</label>
                                   <input type="text"  class="form-control" placeholder="Visitor City" name="visitor_city" value="<?php //echo (isset($info['visitor_city']))? $info['visitor_city']: '' ?>">
                               </div>
                               <div class="col-xs-6">
                                   <label class="form_label">Address *:</label>
                                   <textarea class="form-control" placeholder="Enter Address" name="visitor_address" style="width:100%; height:100px; border-bottom:" ><?php //echo (isset($info['visitor_address']))? $info['visitor_address']: '' ?></textarea>
                               </div> -->
                          </div>
                          <!--owner profile form row ends here-->

                          <div class="row" style="margin-top:20px;">

<!--                              <div class="col-xs-3">-->
<!--                                  <label class="form_label">Registration Mode :</label>-->
<!--                                  <input type="text"  class="form-control" placeholder="Registration Mode" name="visitor_registration_mode" value="--><?php //echo (isset($info['visitor_registration_mode']))? $info['visitor_registration_mode']: '' ?><!--">-->
<!--                              </div>-->




                            
                          </div>

                          <!--owner profile form row ends here-->
                          
                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-2">
                                <input type="submit" name="submit" value="Update" class="btn btn-success col-xs-12">
<!--                                <a href="#" class="btn btn-success col-xs-12">Save</a>-->
                            </div>
<!--                            <div class="col-xs-1">-->
<!--                              <a href="#" class="btn btn-warning col-xs-12">Reset</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-1">-->
<!--                              <a href="#" class="btn btn-danger col-xs-12">Close</a>-->
<!--                            </div>-->

                          </div>
                          <!--owner profile form row ends here-->
                          

            
        
             
            </div>
			<?php
				echo form_close();
			?>
              <!--</form>-->
            <!-- /tile body --> 
            
          </section>
          <!-- /tile --> 
        </div>
        <!-- /col --> 
        
      </div>
      <!-- /row --> 
      
    </div>
      

  </section>







<!-- Full Width Column -->
<!--<div class="content-wrapper">
    <div class="container-fluid">
         Content Header (Page header) 
        <section class="content-header">
            <h1>
                Punjab
                <small>Visitors Management System</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            </ol>
        </section>



         Main content 
        <section class="content">
            <form method="post" action="" id="add_visitor_form">
                
            <div class="col-sm-12 pie_chart">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">District Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="form_label">Visitor Name *:</label>
                                <input type="text" id="visitor_name" name="visitor_name" class="form-control" placeholder="Visitor Name">
                            </div>
                            <div class="col-xs-4">
                                <label class="form_label">Visiting Date:</label>
                                <input type="text"  class="form-control" placeholder="Visiting Date">
                            </div>
                            <div class="col-xs-4">
                                <label class="form_label">Check In Time:</label>
                                <input type="text"  class="form-control" placeholder="Check In Time" id='visit_checkin' name='visit_checkin'>
                            </div>
                        </div>
                        owner profile form row ends here

                        <div class="row" style="margin-top:20px;">
                            <div class="col-xs-3">
                                <label class="form_label">Company Name *:</label>
                                <input type="text" class="form-control" placeholder="Company Name" id='visit_from_company' name='visit_from_company'>
                            </div>
                            <div class="col-xs-3">
                                <label class="form_label">Check Identity:</label>

                                <select class="form-control">
                                    <option>CNIC</option>

                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label class="form_label">Identity No. *"</label>
                                <input type="text"  class="form-control" id="visitor_identity_no" name="visitor_identity_no" placeholder="Identity No">
                            </div>
                            <div class="col-xs-3">
                                <label class="form_label">Cell No. *"</label>
                                <input type="text"  class="form-control" placeholder="Cell No" name='visitor_cell_no' id='visitor_cell_no'>
                            </div>
                        </div>
                        owner profile form row ends here

                        <div class="row" style="margin-top:20px;">
                            <div class="col-xs-6">
                                <label class="form_label">Address:</label>
                                <textarea class="form-control" placeholder="Enter Address" style="width:100%; height:100px; border-bottom:" id="visitor_address" name="visitor_address"></textarea>

                            </div>
                            <div class="col-xs-6">
                                <label class="form_label">Reason for Visit:</label>
                                <textarea class="form-control" placeholder="Enter Comments" style="width:100%; height:100px; border-bottom:" ></textarea>
                            </div>

                        </div>
                        owner profile form row ends here

                        <div class="row" style="margin-top:20px;">
                            <div class="col-xs-2">
                                <label class="form_label">Model of Transport:</label>
                                <select class="form-control" id="visit_transport_mode" name="visit_transport_mode">
                                    <option>Car</option>
                                </select>

                            </div>
                            <div class="col-xs-3">
                                <label class="form_label">Tenant:</label>
                                <select class="form-control">
                                    <option>Apex Consulting Pakistan</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label class="form_label">Employee"</label>
                                <select class="form-control">
                                    <option>Sardar Ali Syed</option>
                                </select>

                            </div>

                            <div class="col-xs-2">
                                <label class="form_label">Regitration No.:</label>
                                <input type="text" class="form-control" placeholder="Regitration No" id='visit_transport_registration_no' name='visit_transport_registration_no'>
                            </div>
                            <div class="col-xs-2">
                                <label class="form_label">Issued Visitor Card *:</label>
                                <input type="text" class="form-control" id="visit_issued_card" name="visit_issued_card" placeholder="Visitor Card">
                            </div>
                        </div>
                        owner profile form row ends here

                        <div class="row" style="margin-top:20px;">

                            <div class="col-xs-2">
                                <a class="btn btn-success col-xs-12" id="save_visitor">Save</a>
                            </div>
                            <div class="col-xs-2">
                                <a href="#" class="btn btn-warning col-xs-12">Reset</a>
                            </div>
                            <div class="col-xs-2">
                                <a href="#" class="btn btn-danger col-xs-12">Close</a>
                            </div>

                        </div>
                        owner profile form row ends here






                    </div> /.box-body 
                </div> /.box 

            </div>


            </form>

        </section> /.content 
    </div> /.container 
</div> /.content-wrapper -->


<script>
//
//    $('#save_visitor').click(function () {
//        $('#add_visitor_form').submit();
//    });
//    
//    var i = 1;
//    var old_val = '';
//    var cnic = '';
//    var family_no = '';
//    var dob = '';
//    var name = '';
//    var father_name = '';
//    var address = '';
//    var cnic_status = '';
//    
//    var call_ajax = false;
//    $(window).scannerDetection({
//        onComplete: function (e, data) {
//            
//            console.log(i+'=='+e+'==='+e.length);
//            //return false;
//
//            if (e.length == 25 && i == 1) {//Get cnic number from New CNIC
//                cnic = e.substr(12, 13);
//                cnic_status = 'new';
//                call_ajax = true;
//                //i = 0;
//            }
//            else {
//                    cnic_status = 'old';
//                    if(i == 1){
//                        i++;
//                    }
//                    else if(i == 2){
//                        i++;
//                        old_val = e;
//                    }
//                    else if(i == 3){
//                        
//                        if (e.length == 6){
//                            family_no = e;
//                            cnic = old_val
//                            cnic = cnic.substr(0, 13);
//                            //call_ajax = true;
//                            i=6;
//                        }else{
//                            old_val = e;
//                            i++;
//                        }
//                    }
//                    else if(i == 4){
//                        if (e.length == 6){
//                            family_no = e;
//                            cnic = old_val
//                            cnic = cnic.substr(0, 13);
//                            i=6;
//                        }
//                    }
//                    else if (i == 6){
//                        
//                        if(e.length==8)
//                        {
//                                dob = e.substr(0,2)+'-'+e.substr(2,4)+'-'+e.substr(4)
//			
//                        }
//                        else if(e.length>8)
//                        {
//                                dob = e;
//                        }
//                        
//                        i++;
//                    }
//                    else if (i == 7){
//                        name = escape(e);
//                        call_ajax = true;
//                        i++;
//                    }
//                    else if (i == 8){
//                        father_name = e;
//                        call_ajax = true;
//                        i++;
//                    }
//                    else if (i == 9){
//                        address = e;
//                        call_ajax = true;
//                        i++;
//                    }
//         
//                
//            }
//
//            //console.log(i+'=='+cnic+'==='+cnic.length);
//            if (call_ajax) {
//                call_ajax = false;
//                $.ajax({
//                    type: "POST",
//                    data: {"cnic": cnic,"family_no":family_no,"dob":dob,"name":name,"father_name":father_name,"address":address,"cnic_status":cnic_status},
//                    url: "<?= base_url() ?>visitor/scanned", //here we are calling our user controller and get_cities method with the country_id
//
//                    success: function (res) //we're calling the response json array 'cities'
//                    {
//                        res = $.parseJSON(res);
//                        i = 1;
//                        $('#visitor_identity_no').val(res.visitor_identity_no);
//                        $('#visitor_name').val(res.visitor_name);
//                        $('#visitor_address').val(res.visitor_address);
//                        $('#visitor_cell_no').val(res.visitor_cell_no);
//                        $('#visit_transport_registration_no').val(res.visit_transport_registration_no);
//                        $('#visit_transport_mode').val(res.visit_transport_mode);
//                        $('#visit_from_company').val(res.visit_from_company);
//                    }
//
//                });
//            }
//        }
//
//    });


</script>