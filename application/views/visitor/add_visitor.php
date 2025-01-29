
<section id="content">
    <div class="page page-dashboard">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
                    <li> <a href="<?php echo base_url() . 'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
                    <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>Add Visit</a> </li>
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
                        <h1 class="custom-font"><strong>Add </strong>Visit</h1>

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
                        if(isset($flash_message['message'])) 
                        {
                            if($flash_message['type']=="success")
                            {
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
    <div class="col-xs-2 pull-left text-center">
        <label class="form_label"></label>
        <img id="img_visitor" src="<?php echo (isset($post['visitor_picture']))? $post['visitor_picture'] : base_url().'assets/data/visitor_profile/no_image.png'; ?>"  style="width: 124px;height:124px;border: 1px solid blue;"/>
        
        <input type="hidden"  name="visitor_picture" id="visitor_picture" value="<?php echo (isset($post['visitor_picture']))? $post['visitor_picture'] : base_url().'assets/data/visitor_profile/no_image.png'; ?>">
    </div>
    <div class="col-xs-10">
        <div class="col-xs-12">
            <div class="col-xs-10">&nbsp;</div>
            <div class="col-xs-1">
                                    <input class="btn btn-success col-xs-12" type="submit" value="Save">
<!--                                    <a href="#" class="btn btn-success col-xs-12 save_visitor" id="">Save</a>-->
                                </div>
                                <div class="col-xs-1">
                                    <a href="<?php echo base_url() . 'visitor/addvisitor'; ?>" class="btn btn-warning col-xs-12">Reset</a>
                                </div>
        </div>

        <div class="col-xs-12">
            <div class="row">
                
                <div class="col-xs-3">
                                    <label class="form_label">Check Identity:</label>

                                    <select class="form-control" name="visitor_type" id="visitor_type">
                                        <option <?php echo (isset($post['visitor_type']) && $post['visitor_type']=="visitor_identity_no")?"selected":""; ?> value="visitor_identity_no">CNIC</option>
                                        <option <?php echo (isset($post['visitor_type']) && $post['visitor_type']=="visitor_employee_card")?"selected":""; ?> value="visitor_employee_card">Employee Card</option>
                                        <option <?php echo (isset($post['visitor_type']) && $post['visitor_type']=="visitor_driving_license")?"selected":""; ?> value="visitor_driving_license">Driving License</option>
                                        <option <?php echo (isset($post['visitor_type']) && $post['visitor_type']=="visitor_passport_id")?"selected":""; ?> value="visitor_passport_id">Passport ID</option>

                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <label class="form_label">Visit types <span class="redcolor">*</span>:</label>
                                    <select name="visit_types" id="visit_types" class="form-control" required="required">
                                        <?php foreach ($visit_types as $vt): ?>
                                            <option value="<?php echo  $vt['id']; ?>"><?php echo $vt['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>   
                                <div class="col-xs-2">
                                    
                                    <label class="form_label">Cargo/Parcel?</label><input type="checkbox" value="1" name="is_cargo" > 
                                </div> 

                                <div class="col-xs-3">
                                    <input type="hidden" id="visit_id" name="visit_id" value="">
                                    <input type="hidden" id="visit_status" name="visit_status" value="">
                                    <label class="form_label">Identity No <span class="redcolor">*</span>:</label>
                                    <input type="text" required="required"  class="form-control" placeholder="Identity No" name="visitor_identity_no" id="visitor_identity_no" value="<?php if(isset($post['visitor_identity_no'])){ echo $post['visitor_identity_no']; }else if(isset($member_info) && !empty($member_info)){ echo $member_info['cnic']; } ?>">
                                </div>
                                <div class="col-xs-2">
                                    <a style="display: none;" href="#" class="btn btn-success col-xs-12 other_identity_button" id="" onclick="$('.other_identity').toggle()">Other Identity</a>
                                </div>

                                                            
                                

            </div>


            <div class="row">

            </div>
        </div>

        

        <div class="col-xs-12">
            
        </div>
    </div>    
</div>    

                            

                            <div class="row checkcout other_identity" style="display: none;">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-3 visitor_employee_card">
                                    <label class="form_label">Employee ID</label>
                                    <input type="text"  class="form-control" placeholder="Identity No" name="visitor_employee_card" id="visitor_employee_card">
                                </div>
                                <div class="col-xs-3 visitor_driving_license" >
                                    <label class="form_label">Driving License ID</label>
                                    <input type="text"  class="form-control" placeholder="Identity No" name="visitor_driving_license" id="visitor_driving_license">
                                </div>
                                <div class="col-xs-3 visitor_passport_id">
                                    <label class="form_label">Passport ID</label>
                                    <input type="text"  class="form-control" placeholder="Identity No" name="visitor_passport_id" id="visitor_passport_id">
                                </div>
                            </div>


                            <div class="row checkout">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-3">
                                    <label class="form_label">Visitor Name <span class="redcolor">*</span>:</label>
                                    <input type="text" required="required" class="form-control" placeholder="Visitor Name" name="visitor_name" id="visitor_name" value="<?php if(isset($post['visitor_name'])){ echo $post['visitor_name']; }else if(isset($member_info['name'])){ echo $member_info['name']; }; ?>">
                                </div>
                                <div class="col-xs-3">
                                    <label class="form_label">Cell No :
                                        <div style="float:right;text-align: right; width: 238px;">Foreign No: <input type="checkbox" name="foreign_no" value="1"></div>
                                    </label>
                                    <input  type="text"  class="form-control" placeholder="Cell No" name="visitor_cell_no" id="visitor_cell_no" value="<?php if(isset($post['visitor_cell_no'])){ echo $post['visitor_cell_no']; }else if(isset($member_info['mobile'])){ echo $member_info['mobile']; } ?>">
                                </div>
                                <div class="col-xs-4">
                                    <label class="form_label">Address:</label>
                                    <input type="text" class="form-control" placeholder="Enter Address" name="visitor_address" id="visitor_address" value="<?php echo (isset($post['visitor_address']))?$post['visitor_address']:""; ?>">

                                </div>

                                <div class="col-xs-4">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-3 checkout marginTop20">
                                    <label class="form_label">From Company <span class="redcolor">*</span>:</label>
                                    <input required="required" type="text" class="form-control" placeholder="Company Name" name="visit_from_company" id="visit_from_company" value="<?php echo (isset($post['visit_from_company']))?$post['visit_from_company']:""; ?>">
                                </div>
                                <!-- <div class="col-xs-3 checkout marginTop20" style="display:none;" >
                                    <label class="form_label">Check In Time:</label>
                                    <input type="text" class="form-control checkin_datepicker" placeholder="Check In Time" name="visit_checkin" id="visit_checkin" value="" readonly="">
                                </div> -->
                                <div class="col-xs-3 checkout marginTop20" >
                                    <label class="form_label">Visitor City *:</label>
                                    <select required="required" class="form-control" placeholder="Visitor City" name="visitor_city" id="visitor_city">
                                    <option value="">Please Select</option>
                                    <?php
                                    foreach($cities as $key=>$val) {
                                        ?>
                                        <option value="<?php echo $val['Name']; ?>"><?php echo $val['Name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
<!--                                    <input type="text" required="required" class="form-control" placeholder="Visitor City" name="visitor_city" id="visitor_city" value="--><?php //echo (isset($post['visitor_city']))?$post['visitor_city']:""; ?><!--">-->
                                </div>
                                <div class="col-xs-4 checkin" style="display:none;">
                                    <label class="form_label">Check Out Time:</label>
                                    <input type="text"  class="form-control checkout_datepicker" placeholder="Check Out Time" name="visit_checkout" id="visit_checkout">
                                </div>
                            </div>
                            <!--owner profile form row ends here-->

                            <div class="row">
                                <div class="col-xs-12 ">

                                </div>
                            </div>

                            <div class="row checkout">
                                <div class="col-xs-2 ">
                                </div>
                                <div class="col-xs-2 marginTop20">
                                    <label class="form_label">Model of Transport:</label>
                                    <select class="form-control" name="visit_transport_mode" id="visit_transport_mode">
                                        <option <?php echo (isset($post['visit_transport_mode']) && $post['visit_transport_mode']=="Car")?"selected":""; ?> value="Car">Car</option>
                                        <option <?php echo (isset($post['visit_transport_mode']) && $post['visit_transport_mode']=="Motorcycle")?"selected":""; ?> value="Motorcycle">Motorcycle</option>
                                        <option <?php echo (isset($post['visit_transport_mode']) && $post['visit_transport_mode']=="Taxi")?"selected":""; ?> value="Taxi">Taxi</option>
										<option <?php echo (isset($post['visit_transport_mode']) && $post['visit_transport_mode']=="Pedestrian")?"selected":""; ?> value="Pedestrian">Pedestrian</option>
                                        <option <?php echo (isset($post['visit_transport_mode']) && $post['visit_transport_mode']=="Other")?"selected":""; ?> value="Other">Other</option>
                                    </select>

                                </div>
                                <div class="col-xs-2 marginTop20">
                                    <label class="form_label">Registration No:</label>
                                    <input type="text" class="form-control" placeholder="Registration No" name="visit_transport_registration_no" id="visit_transport_registration_no" value="<?php if(isset($post['visit_transport_registration_no'])){ echo $post['visit_transport_registration_no']; }else if(isset($member_info['number_plate'])){ echo $member_info['number_plate']; } ?>">
                                </div>
                                <div class="col-xs-3 marginTop20">
                                    <label class="form_label">Branches: <span class="redcolor">*</span></label>
                                    <select class="form-control chosen-select" name="tenant_id" required="required" id="tenant_id" onchange="get_employees(value)">
                                       
                                        <?php
                                        foreach ($tenants as $key => $val) {
                                            ?>
                                            <option <?php if (isset($member_info) && !empty($member_info) && $member_info['tenant_id'] == $val['id']) {
                                                echo "selected";
                                            } else if (isset($post['tenant_id']) && $post['tenant_id'] == $val['id']) {
                                                echo "selected";
                                            } ?> value="<?php echo $val['id']; ?>"><?php echo $val['tenant_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-3 marginTop20">
                                    <label class="form_label">Officers :</label>
                                    <select class="form-control chosen-select" name="employee_id" id="employee_id">

                                    </select>
                                </div>
                            </div>
                            <div class="row checkout" >
                                <div class="col-xs-2 marginTop20"></div>
                                <div class="col-xs-2 marginTop20">
                                <label class="form_label">No. of Minors (If any):</label>
                                    <input type="number" name="number_of_minors" value="0" min="0" class="form-control" />
                                </div>

                                <div class="col-md-2 col-xs-2">
                                <label class="form_label ">Date From <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control my_date required-field" name="date_from"
                                       id="date_from"
                                       placeholder="Enter date_from" value="" readonly="">
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="form_label ">Date To <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control my_date required-field" name="date_to"
                                       id="date_to"
                                       onblur="verify_date()" placeholder="Enter date_to" value="" readonly="">
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="form_label ">Time <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control required-field" id="visit_time" name="visit_time"
                                       placeholder="Enter time" value="">
                            </div>
                            </div>

                            <div class="row" >
                                <div class="col-xs-2"></div>
                                <div class="col-xs-10 marginTop20">
                                    <label class="form_label ">Gate <span class="text-red">*</span>:</label>

                                    <input type="radio" name="gate_number" value="" checked="checked" /> Any
                                    <?php if($visit_gates) { foreach ($visit_gates as $gate) { ?> 
                                    <input type="radio" name="gate_number" value="<?php echo $gate['id']; ?>" /> <?php echo $gate['name']; ?>
                                    <?php } } ?>
                                     
                                </div>
                            </div>
                            

                            <div class="row" >
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-6 marginTop20">
                                    <label class="form_label">Reason for Visit:</label>
                                    <textarea class="form-control" id="visit_reason" name="visit_reason" placeholder="Enter Comments" style="width:100%; height:100px; border-bottom:" ><?php if(isset($post['visit_reason'])){ echo $post['visit_reason']; }else if(isset($member_info['agenda'])){ echo $member_info['agenda']; } ?></textarea>
                                </div>

                            </div>

                            <div class="row" >
                                <div class="col-xs-12 marginTop20">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                </div>
                                <div class="col-xs-2 marginTop20">
                                    <label class="form_label">Issued Visitor Card <?php echo ($issue_card_required==1)?"":""; ?>:</label>
                                    <input type="text" class="form-control" placeholder="Visitor Card" name="visit_issued_card"
                                           id="visit_issued_card" value="<?php echo (isset($post['visit_issued_card']))?$post['visit_issued_card']:""; ?>">
                                </div>
<!--                                <div class="col-xs-3 checkout">-->
<!--                                    <label class="form_label">Next Location:</label>-->
<!--                                    <select name="next_location_id" class="form-control" placeholder="Location">-->
<!--                                        <option value="">Select Your Location</option>-->
<!--                                        --><?php
//                                        foreach ($locations as $key => $val) {
//                                            ?>
<!--                                            <option value="--><?php //echo $val['id']; ?><!--">--><?php //echo $val['location']; ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>-->


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
     var config = {
          '.chosen-select'           : {},
          '.chosen-select-deselect'  : { allow_single_deselect: true },
          '.chosen-select-no-single' : { disable_search_threshold: 10 },
          '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
          '.chosen-select-rtl'       : { rtl: true },
          '.chosen-select-width'     : { width: '95%' }
        }
        for (var selector in config) {
          $(selector).chosen(config[selector]);
        }


    <?php
	if(isset($member_info['tenant_id']) && $member_info['tenant_id']!=""){
        
	?>
		get_employees("<?php echo $member_info['tenant_id']; ?>","<?php echo $member_info['system_employee_id']; ?>");
	<?php	
	}
	?>

    <?php
    if(sessiondata('login_branch_id'))
    {
        
    ?>
        get_employees("<?php echo sessiondata('login_branch_id'); ?>","<?php echo sessiondata('login_employee_id'); ?>");
    <?php   
    }
    ?>

    <?php
    if(isset($post['tenant_id']) && $post['tenant_id']!=""){
        
    ?>
        get_employees("<?php echo $post['tenant_id']; ?>","<?php echo $post['employee_id']; ?>");
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
		var private_check = <?php echo $private_visit_check; ?>;
//        if (cnic != '')
        if (visitor_type != '' && private_check != -1){
            $.ajax({
                type: "POST",
                data: {"visitor_type": visitor_type,"cnic":cnic,'csrf_test_name': csrf_value},
                url: "<?= base_url() ?>visitor/scanned", 
                success: function (res){
                    res = $.parseJSON(res);
                    if(res.status!=2){
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
                    }
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
<style type="text/css">
    .redcolor { color:#ff0000; }
    .marginTop20 { margin-top:20px; }
</style>