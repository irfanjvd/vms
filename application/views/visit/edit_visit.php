<section id="content">
<div class="page page-dashboard">
<div class="pageheader">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url() . 'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>Edit Visit</a> </li>
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
                <h1 class="custom-font"><strong>Edit </strong>Visit</h1>

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
                    date_default_timezone_set('Asia/Karachi');
                    $flash_message = $this->session->flashdata('message');
                    if(isset($flash_message['message']) && $flash_message['message']) {
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

                        <div class="col-xs-3 checkout">
                            <label class="form_label">Company Name *:</label>
                            <input type="text" class="form-control" placeholder="Company Name" name="visit_from_company" id="visit_from_company" value="<?php echo (isset($info['visit_from_company']))?$info['visit_from_company']:"";  ?>">
                        </div>
                        <div class="col-xs-3 checkout" >
                            <label class="form_label">Check In Time *:</label>
                            <input type="text"  class="form-control checkin_datepicker" placeholder="Check In Time" name="visit_checkin" id="visit_checkin" value="<?php echo date("Y-m-d H:i:s",strtotime($info['visit_checkin']));  ?>">
                        </div>
                        <div class="col-xs-2 hidden">
                            <label class="form_label">Issued Visitor Card *:</label>
                            <input type="text" class="form-control" placeholder="Visitor Card" name="visit_issued_card" id="visit_issued_card" value="<?php echo (isset($info['visit_issued_card']))?$info['visit_issued_card']:"";  ?>">
                        </div>
                        <div class="col-xs-2">
                            <label class="form_label">Model of Transport:</label>
                            <select class="form-control" name="visit_transport_mode" id="visit_transport_mode">
                                <option <?php echo ($info['visit_transport_mode']=="Car")?"selected":""; ?> value="Car">Car</option>
                                <option <?php echo ($info['visit_transport_mode']=="Motorcycle")?"selected":""; ?> value="Motorcycle">Motorcycle</option>
                                <option <?php echo ($info['visit_transport_mode']=="Taxi")?"selected":""; ?> value="Taxi">Taxi</option>
                                <option <?php echo ($info['visit_transport_mode']=="Other")?"selected":""; ?> value="Other">Other</option>
                            </select>

                        </div>
<!--                        <div class="col-xs-4 checkin" >-->
<!--                            <label class="form_label">Check Out Time:</label>-->
<!--                            <input type="text"  class="form-control checkout_datepicker" placeholder="Check Out Time" name="visit_checkout" id="visit_checkout" value="--><?php //echo (isset($info['visit_checkout']))?$info['visit_checkout']:"";  ?><!--">-->
<!--                        </div>-->
                    </div>
                    <!--owner profile form row ends here-->

                    <div class="row" style="margin-top:20px;">

                    </div>

                    <div class="row checkout" style="margin-top:20px;">

<!--                        <div class="col-xs-2">-->
<!--                            <label class="form_label">Model of Transport:</label>-->
<!--                            <select class="form-control" name="visit_transport_mode" id="visit_transport_mode">-->
<!--                                <option>Car</option>-->
<!--                            </select>-->
<!---->
<!--                        </div>-->
                        <div class="col-xs-3">
                            <label class="form_label">Registration No :</label>
                            <input type="text" class="form-control" placeholder="Regitration No" name="visit_transport_registration_no" id="visit_transport_registration_no" value="<?php echo (isset($info['visit_transport_registration_no']))?$info['visit_transport_registration_no']:"";  ?>">
                        </div>
                        <div class="col-xs-3">
                            <label class="form_label">Branch:</label>
<!--                            <input type="text" class="form-control" placeholder="visit to tenant" name="visit_to_tenant" id="visit_to_tenant" value="--><?php //echo (isset($info['visit_to_tenant']))?$info['visit_to_tenant']:""; ?><!--">-->
                            <select class="form-control" name="visit_to_tenant" id="visit_to_tenant" onchange="get_employees(value)">
                                <option value="">Select Branch</option>
                                <?php
                                $trigger=0;
                                foreach($tenants as $key=>$val){
                                    if($info['visit_to_tenant']==$val['tenant_name']){
                                        $trigger=1;
                                    }
                                    ?>
                                    <option <?php echo ($info['tenant_id']==$val['id'])?"selected":""; ?> value="<?php echo $val['tenant_name']; ?>"><?php echo $val['tenant_name']; ?></option>
                                <?php
                                }

                                if($trigger==1){
                                ?>
                                <script>
                                    $( document ).ready(function() {
                                        $('#visit_to_tenant').trigger('change');
                                        $('#visit_to_employee').val('<?php echo $info['visit_to_employee']; ?>');
                                    });
                                </script>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-2 col-md-2">
                            <label class="form_label">Visitor Cell No :</label>

                            <input type="hidden" name="visitor_id" value="<?php echo (isset($info['visitor_id'])) ? $info['visitor_id']:""; ?>">
                            <input type="hidden" name="old_visitor_cell_no" value="<?php echo (isset($info['visitor_cell_no'])) ? $info['visitor_cell_no']:""; ?>">
                            <input type="text" class="form-control" placeholder="03009999999" name="visitor_cell_no"
                                   id="visitor_cell_no" value="<?php echo (isset($info['visitor_cell_no'])) ? $info['visitor_cell_no']:""; ?>">
                        </div>
                        <div class="col-xs-3 hidden">
                            <label class="form_label">Officer:</label>
<!--                            <input type="text" class="form-control" placeholder="visit to employee" name="visit_to_employee" id="visit_to_employee" value="--><?php //echo (isset($info['visit_to_employee']))?$info['visit_to_employee']:""; ?><!--">-->
                            <select class="form-control" name="visit_to_employee" id="visit_to_employee">
                                <!--                                        <option value="Sardar Ali Syed">Sardar Ali Syed</option>-->
                            </select>

                        </div>

                    </div>

                    <div class="row checkout" style="margin-top:20px;">

                        <div class="col-xs-6">
                            <label class="form_label">Reason for Visit :</label>
                            <textarea class="form-control" id="visit_reason" name="visit_reason" placeholder="Enter Comments" style="width:100%; height:100px; border-bottom:" ><?php echo (isset($info['visit_reason']))?trim($info['visit_reason']):"";  ?></textarea>
                        </div>
                        <div class="col-xs-6">
                            <label class="form_label">Visitor Photo :</label><br/>
                            <?php if(!empty($info['visitor_picture'])) { ?>
                                <img src="<?php echo $info['visitor_picture']; ?>" style="width: 124px;height:124px;border: 1px solid black;" alt="no image">
                            <?php } else { ?>
                            <img id="img_visitor" src="<?php echo base_url().'assets/data/visitor_profile/no_image.png'; ?>"
                                 style="width: 124px;height:124px;border: 1px solid blue;"/>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row" style="margin-top:20px;">

                    </div>
                    <div class="row" style="margin-top:20px;">
<!--                        <div class="col-xs-2">-->
<!--                            <label class="form_label">Issued Visitor Card *:</label>-->
<!--                            <input type="text" class="form-control" placeholder="Visitor Card" name="visit_issued_card" id="visit_issued_card" value="--><?php //echo (isset($info['visit_issued_card']))?$info['visit_issued_card']:"";  ?><!--">-->
<!--                        </div>-->
<!--                        <div class="col-xs-3 checkout">-->
<!--                            <label class="form_label">Next Location:</label>-->
<!--                            <select name="next_location_id" class="form-control" placeholder="Location">-->
<!--                                <option value="">Select Your Location</option>-->
<!--                                --><?php
//                                foreach ($locations as $key => $val) {
//                                    ?>
<!--                                    <option value="--><?php //echo $val['id']; ?><!--">--><?php //echo $val['location']; ?><!--</option>-->
<!--                                --><?php
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </div>-->


                    </div>
                    <!--owner profile form row ends here-->


                    <!--owner profile form row ends here-->


                    <!--owner profile form row ends here-->

                    <div class="row" style="margin-top:20px;">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-8"></div>
                        <div class="col-xs-1">
                            <a href="#" class="btn btn-success col-xs-12 save_visitor" id="">Save</a>
                        </div>
                        <div class="col-xs-1">
                            <a href="<?php echo base_url() . 'visitor/addvisitor'; ?>" class="btn btn-warning col-xs-12">Reset</a>
                        </div>
                        <!--                            <div class="col-xs-1">-->
                        <!--                              <a href="#" class="btn btn-danger col-xs-12">Close</a>-->
                        <!--                            </div>-->

                    </div>
                    <!--owner profile form row ends here-->


				<?php
					echo form_close();
				?>
                <!--</form>-->

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



    $("#img_visitor").click(function () {
        //var a = $("#app_id").val();
        $.colorbox({innerWidth: 485, innerHeight: 350, href: "<?php echo base_url(); ?>visitor/takepicture"});
    });
    //console.log(escape("2’/ F/E            "));
    $('.save_visitor').click(function () {
        $('#add_visitor_form').submit();
    });
    $('#visitor_identity_no').blur(function () {
        var cnic = $('#visitor_identity_no').val();
        if (cnic != '')
        {
            $.ajax({
                type: "POST",
                data: {"cnic": cnic},
                url: "<?= base_url() ?>visitor/scanned", //here we are calling our user controller and get_cities method with the country_id

                success: function (res) //we're calling the response json array 'cities'
                {
                    res = $.parseJSON(res);
                    //i = 1;
                    if(res.visitor_status=="CHECK_OUT"){
                        $('.checkout').hide();
                    }else{
                        $('.checkin').hide();
                    }
                    $('#visit_id').val(res.visit_id);
                    $('#visitor_identity_no').val(res.visitor_identity_no);
                    $('#visitor_name').val(res.visitor_name);
                    $('#visitor_address').val(res.visitor_address);
                    $('#visitor_cell_no').val(res.visitor_cell_no);
                    $('#visit_transport_registration_no').val(res.visit_transport_registration_no);
                    $('#visit_transport_mode').val(res.visit_transport_mode);
                    $('#visit_from_company').val(res.visit_from_company);
                    $('#visit_reason').val(res.visit_reason);
                    $('#visit_issued_card').val(res.visit_issued_card);
                    $('#img_visitor').attr('src', res.visitor_picture);
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

    var call_ajax = false;
    $(window).scannerDetection({
        onComplete: function (e, data) {
            //console.log(data);

            //return false;

            if (e.length == 25 && i == 1) {//Get cnic number from New CNIC
                cnic = e.substr(12, 13);
                cnic_status = 'new';
                call_ajax = true;
                //i = 0;
            }
            else {
                cnic_status = 'old';
                if (i == 1) {
                    i++;
                }
                else if (i == 2) {
                    i++;
                    old_val = e;
                }
                else if (i == 3) {

                    if (e.length == 6) {
                        family_no = e;
                        cnic = old_val
                        cnic = cnic.substr(0, 13);
                        //call_ajax = true;
                        i = 6;
                    } else {
                        old_val = e;
                        i++;
                    }
                }
                else if (i == 4) {
                    if (e.length == 6) {
                        family_no = e;
                        cnic = old_val
                        cnic = cnic.substr(0, 13);
                    }
                    i = 6;
                }
                else if (i == 6) {

                    if (e.length == 8)
                    {
                        dob = e.substr(0, 2) + '-' + e.substr(2, 4) + '-' + e.substr(4)

                    }
                    else if (e.length > 8)
                    {
                        dob = e;
                    }

                    i++;
                }
                else if (i == 7) {
                    console.log(i + '==' + e + '===' + e.length);
                    name = encodeURIComponent(e);
                    call_ajax = true;
                    i++;
                }
                else if (i == 8) {
                    father_name = encodeURIComponent(e);
                    call_ajax = true;
                    i++;
                }
                else if (i == 9) {
                    address = encodeURIComponent(e);
                    call_ajax = true;
                    i++;
                }


            }

            //console.log(i+'=='+cnic+'==='+cnic.length);
            if (call_ajax) {
                call_ajax = false;
                $.ajax({
                    type: "POST",
                    data: {"cnic": cnic, "family_no": family_no, "dob": dob, "name": name, "father_name": father_name, "address": address, "cnic_status": cnic_status},
                    url: "<?= base_url() ?>visitor/scanned", //here we are calling our user controller and get_cities method with the country_id

                    success: function (res) //we're calling the response json array 'cities'
                    {
                        res = $.parseJSON(res);

                        i = 1;
                        $('#visitor_identity_no').val(res.visitor_identity_no);
                        $('#visitor_name').val(res.visitor_name);
                        $('#visitor_address').val(res.visitor_address);
                        $('#visitor_cell_no').val(res.visitor_cell_no);
                        $('#visit_transport_registration_no').val(res.visit_transport_registration_no);
                        $('#visit_transport_mode').val(res.visit_transport_mode);
                        $('#visit_from_company').val(res.visit_from_company);
                        $('#img_visitor').attr('src', res.visitor_picture);
                    }

                });
            }
        }

    });


</script>