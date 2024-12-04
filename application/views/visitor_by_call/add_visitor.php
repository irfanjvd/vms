
<section id="content">
    <div class="page page-dashboard">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
                    <li> <a href="<?php echo base_url() . 'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
                    <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>Add Visit(Phone Call)</a> </li>
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
                        <h1 class="custom-font"><strong>Add </strong>Visit (Phone Call)</h1>

                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body table-custom">
					<?php
						$attributes=array(
							'id' => 'add_visitor_form',
							'enctype' => "multipart/form-data"
						);
						echo form_open('', $attributes);
					?>
                        <!--<form id="add_visitor_form" method="post">-->
                        <?php
                        $flash_message = $this->session->flashdata('message');
                        $post = $this->session->flashdata('post');
//                        if(isset($post)){
//                            echo "<pre>";
//                            print_r($post);die;
//                        }
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
                                                                
                                <div class="col-xs-3">
                                    <label class="form_label">Caller Name *:</label>
                                    <input type="text" required="required" class="form-control" placeholder="Employee Name" name="caller_name" id="caller_name" value="<?php if(isset($member_info['employee_name'])){ echo $member_info['employee_name']; }else if(isset($member_info['name'])){ echo $member_info['name']; }; ?>">
                                </div>

                                <div class="col-xs-3">
                                    <label class="form_label">Caller Designation *:</label>
                                    <input type="text" required="required" class="form-control" placeholder="Caller Designation" name="caller_designation" id="caller_designation" value="<?php if(isset($member_info['employee_designation'])){ echo $member_info['employee_designation']; }else if(isset($member_info['name'])){ echo $member_info['name']; }; ?>">
                                </div>

                                <div class="col-xs-3">
                                    <label class="form_label">Caller Company:</label>
                                    <select class="form-control" name="visit_to_tenant" id="visit_to_tenant" onchange="get_employees(value)">
                                        <option value="">Select Tenant</option>
                                        <?php
                                            //foreach($tenants as $key=>$val){
                                             if(isset($member_info)){ 
                                                
                                                foreach ($tenants as $key=>$val) { ?>
                                                    <option value="<?php echo $val['tenant_name'];?>" <?php if($val['tenant_name'] == $member_info['employee_company']){echo "selected";}?> >
                                                        <?php echo $val['tenant_name']; ?>                             
                                                    </option>; 
                                                <?php } // end foreach
                                        ?>

                                            
                                        <?php } 
                                        else { 
                                                foreach ($tenants as $key=>$val) {
                                                    echo '<option value='.$val['tenant_name'].'>'.$val['tenant_name'].'</option>';
                                                } // end foreach
                                         } // end else 
                                         ?>
                                        <?php
                                        

                                        ?>
                                    </select>
                                </div>

                                <div class="col-xs-3">
                                    <label class="form_label">Visitor Name *:</label>
                                    <input type="text" required="required" class="form-control" placeholder="Employee Name" name="visitor_name" id="visitor_name" value="<?php if(isset($member_info['visitor_name'])){ echo $member_info['visitor_name']; }else if(isset($member_info['name'])){ echo $member_info['name']; }; ?>">
                                </div>

                                <div class="col-xs-3">
                                    <label class="form_label">Visitor CNIC (Optional):</label>
                                    <input type="text" class="form-control" placeholder="Visitor CNIC" name="visitor_identity_no" id="visitor_identity" maxlength="13" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(isset($member_info['visitor_identity_no'])){ echo $member_info['visitor_identity_no']; }else if(isset($member_info['name'])){ echo $member_info['name']; }; ?>">
                                </div>

                                <div class="col-xs-6">
                                  <label class="form_label">Reason for Visit:</label>
                                  <textarea name="visit_reason" class="form-control" placeholder="Enter Comments" value="<?php if(isset($member_info['visit_reason'])){ echo $member_info['visit_reason']; }?>" style="width:100%; height:100px; border-bottom:" ></textarea>
                                </div>

                                <div class="col-xs-3 checkout" >
                                    <label class="form_label">Check In Time:</label>
                                    <input type="text"  class="form-control checkin_by_call_datepicker" placeholder="Check In Time" name="visit_checkin" id="visit_checkin" value="">
                                </div>
                                
                            </div>

                           

                            <div class="row checkout">
                                <div class="col-xs-2">
                                </div>
                                
                            </div>
                            
                            <!--owner profile form row ends here-->

                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-12">
                                </div>
                            </div>

                            <div class="row checkout" style="margin-top:20px;">
                                <div class="col-xs-2">
                                </div>

                            </div>

                            

                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-12">
                                </div>
                            </div>
                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-2">
                                </div>
                                


                            </div>
                            <!--owner profile form row ends here-->


                            <!--owner profile form row ends here-->


                            <!--owner profile form row ends here-->

                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-8"></div>
                                <div class="col-xs-1">
                                    <input class="btn btn-success col-xs-12" type="submit" value="Save">
<!--                                    <a href="#" class="btn btn-success col-xs-12 save_visitor" id="">Save</a>-->
                                </div>
                                <div class="col-xs-1">
                                    <a href="<?php echo base_url() . 'visitor/addvisitor'; ?>" class="btn btn-warning col-xs-12">Reset</a>
                                </div>
                                <!--                            <div class="col-xs-1">-->
                                <!--                              <a href="#" class="btn btn-danger col-xs-12">Close</a>-->
                                <!--                            </div>-->

                            </div>
                            <!--owner profile form row ends here-->



                        <!--</form>-->
						<?php
							  echo form_close();
							  ?>

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




<script src="<?= base_url() ?>assets/js/jquery.scannerdetection.js"></script>


<script>





$( document ).ready(function() {
    
    $( ".checkin_by_call_datepicker" ).datetimepicker(
    { 
    sideBySide:true,
    minDate:new Date(),
    widgetPositioning: {
    horizontal: 'left',
    vertical: 'bottom'
    }
});
    


    <?php
	if(isset($member_info['tenant_name']) && $member_info['tenant_name']!=""){
	?>
		get_employees("<?php echo $member_info['tenant_name']; ?>","<?php echo $member_info['employee_name']; ?>");
	<?php	
	}
	?>
});


    $("#img_visitor").click(function () {
        //var a = $("#app_id").val();
        $.colorbox({innerWidth: 485, innerHeight: 350, href: "<?php echo base_url(); ?>visitor/takepicture"});
    });
//console.log(escape("2’/ F/E            "));
    $('.save_visitor').click(function () {
        $('#add_visitor_form').submit();
    });
    $('#visitor_identity_no').blur(function () {
		var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        $('.checkout').show();
        var visitor_type=$("#visitor_type").val();
        var cnic = $('#visitor_identity_no').val();
//        if (cnic != '')
        if (visitor_type != '')
        {
            $.ajax({
                type: "POST",
                data: {"visitor_type": visitor_type,"cnic":cnic,'csrf_test_name': csrf_value},
                url: "<?= base_url() ?>visitor/scanned", //here we are calling our user controller and get_cities method with the country_id

                success: function (res) //we're calling the response json array 'cities'
                {
                    res = $.parseJSON(res);
//                    console.log(res);
                    //i = 1;
                    if(res.visitor_status=="CHECK_OUT"){
                        $('.checkout').hide();
                        $('.checkin').show();
                        $('.other_identity_button').hide();
                        $('#visit_status').val("CHECK_OUT");
                        $('#visit_issued_card').removeAttr("required");
                    }else{
                        $('.checkin').hide();
                        $('.other_identity_button').show();
                        $('#visit_status').val("");
                    }
                    if(res.visitor_employee_card!=""){
                        $(".visitor_employee_card").html("Visitor Employee Card: "+res.visitor_employee_card);
                    }
                    if(res.visitor_driving_license!=""){
                        $(".visitor_driving_license").html("Visitor Driving License: "+res.visitor_driving_license);
                    }
                    if(res.visitor_passport_id!=""){
                        $(".visitor_passport_id").html("Visitor Passport ID: "+res.visitor_passport_id);
                    }

                    $('#visit_id').val(res.visit_id);
                    $('#visitor_identity_no').val(res.visitor_identity_no);
                    $('#visitor_name').val(res.visitor_name);
                    $('#visitor_address').val(res.visitor_address);
                    $('#visitor_cell_no').val(res.visitor_cell_no);
                    $('#visitor_city').val(res.visitor_city);
                    $('#visit_transport_registration_no').val(res.visit_transport_registration_no);
                    $('#visit_to_tenant').val(res.visit_to_tenant);
                    $('#visit_to_tenant').trigger("change")
                    $('#visit_to_employee').val(res.visit_to_employee);
                    $('#visit_transport_mode').val(res.visit_transport_mode);
                    $('#visit_from_company').val(res.visit_from_company);
                    $('#visit_reason').val(res.visit_reason);
//                    $('#visit_issued_card').val(res.visit_issued_card);
                    console.log($('#img_visitor').attr('src'));
                    console.log(res.visitor_picture.indexOf('no_image.png'));
                    console.log($('#img_visitor').attr('src').indexOf('no_image.png'));
                    if(res.visitor_picture.indexOf('no_image.png') >= 0 && $('#img_visitor').attr('src').indexOf('no_image.png')<=0 ){

                    }else{
                        $('#img_visitor').attr('src', res.visitor_picture);
                    }
//                    if($('#img_visitor').attr(src)!='') {

//                    }
                }

            });
        }
    });

    var i = 1;
    var old_val = '';
    var cnic = '';
    var family_no = '';
    var dob = '';
    var name = '';
    var father_name = '';
    var address = '';
    var cnic_status = '';
    var all_vals=[];

    var call_ajax = false;
    $(window).scannerDetection({
        onComplete: function (e, data) {

//            console.log(e);

            //return false;

            if (e.length == 25 && i == 1) {//Get cnic number from New CNIC
                cnic = e.substr(12, 13);
                cnic_status = 'new';
                call_ajax = true;
                //i = 0;
            }
            else {
//                cnic_status = 'old';
//                if (i == 1) {
//                    i++;
//                }
//                else if (i == 2) {
//                    i++;
//                    old_val = e;
//                }
//                else if (i == 3) {
//
//                    if (e.length == 6) {
//                        family_no = e;
//                        cnic = old_val
//                        cnic = cnic.substr(0, 13);
//                        //call_ajax = true;
//                        i = 6;
//                    } else {
//                        old_val = e;
//                        i++;
//                    }
//                }
//                else if (i == 4) {
//                    if (e.length == 6) {
//                        family_no = e;
//                        cnic = old_val
//                        cnic = cnic.substr(0, 13);
//                    }
//                    i = 6;
//                }
//                else if (i == 6) {
//
//                    if (e.length == 8)
//                    {
//                        dob = e.substr(0, 2) + '-' + e.substr(2, 4) + '-' + e.substr(4)
//
//                    }
//                    else if (e.length > 8)
//                    {
//                        dob = e;
//                    }
//
//                    i++;
//                }
//                else if (i == 7) {
//                    console.log(i + '==' + e + '===' + e.length);
//                    name = encodeURIComponent(e);
//                    call_ajax = true;
//                    i++;
//                }
//                else if (i == 8) {
//                    father_name = encodeURIComponent(e);
//                    call_ajax = true;
//                    i++;
//                }
//                else if (i == 9) {
//                    address = encodeURIComponent(e);
//                    call_ajax = true;
//                    i++;
//                }

                if (e.length == 6) {
                    family_no = e;
                    cnic = all_vals.slice(-1).pop()
                    cnic = cnic.substr(0, 13);
                    call_ajax = true;
                }
            }

            all_vals.push(e);
//            console.log(cnic);
//            console.log(call_ajax);
//            console.log(all_vals);
            //console.log(i+'=='+cnic+'==='+cnic.length);
            if (call_ajax) {
                call_ajax = false;
                $('#visitor_identity_no').val(cnic);
                $( "#visitor_identity_no" ).blur();
//                $.ajax({
//                    type: "POST",
//                    data: {"cnic": cnic, "family_no": family_no, "dob": dob, "name": name, "father_name": father_name, "address": address, "cnic_status": cnic_status,"visitor_type":"visitor_identity_no"},
//                    url: "<?//= base_url() ?>//visitor/scanned", //here we are calling our user controller and get_cities method with the country_id
//
//                    success: function (res) //we're calling the response json array 'cities'
//                    {
//                        res = $.parseJSON(res);
//
//                        i = 1;
//                        $('#visitor_identity_no').val(res.visitor_identity_no);
//                        $('#visitor_name').val(res.visitor_name);
//                        $('#visitor_address').val(res.visitor_address);
//                        $('#visitor_cell_no').val(res.visitor_cell_no);
//                        $('#visit_transport_registration_no').val(res.visit_transport_registration_no);
//                        $('#visit_transport_mode').val(res.visit_transport_mode);
//                        $('#visit_from_company').val(res.visit_from_company);
//                        $('#img_visitor').attr('src', res.visitor_picture);
//                    }
//
//                });
            }
        }

    });



</script>