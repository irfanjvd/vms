<title>Add Visit</title>
<section id="content">
    <div class="page page-dashboard">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> VMS</a></li>
                    <li><a href="<?php echo base_url() . 'visitor/private_visits'; ?>"><i class="fa fa-dashboard"
                                                                                          style="margin-right:6px;"></i>Dashboard</a>
                    </li>
                    <li><a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Add Visit</a></li>
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
                        <h1 class="custom-font"><strong>Add </strong>Visit</h1>

                    </div>
                    <!-- /tile header -->
                    <?php
                    $attributes = array(
                        'id' => 'add_private_visit',
                        'name' => 'add_private_visit',
                        'enctype' => "multipart/form-data"
                    );
                    echo form_open('', $attributes);
                    ?>
                    <!-- tile body -->
                    <div class="tile-body table-custom" id="visit_data">

                        <!--<form name="add_private_visit" id="add_private_visit" action="" method="post" enctype="multipart/form-data">-->
                        <?php
                        $flash_message = $this->session->flashdata('message');
                        if (isset($flash_message['message']) && $flash_message['message']) {
                            if ($flash_message['type'] == "success") {
                                $class = "alert-success";
                                $class1 = "fa-check";
                            } else {
                                $class = "alert-danger";
                                $class1 = "fa-ban";
                            }
                            ?>
                            <div class="alert <?php echo $class; ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa <?php echo $class1; ?>"></i></h4>
                                <?php echo($flash_message['message']); ?>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-xs-4">
                                <label class="form_label">Visit Purpose <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control required-field" id="agenda" name="agenda"
                                       placeholder="Enter Agenda"
                                       value="<?php echo (isset($info['agenda'])) ? $info['agenda'] : '' ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="form_label">Is Cargo?:</label>
                                <br>
                                <input type="checkbox" class="" id="is_cargo" name="is_cargo" value="1">
                            </div>
                            <!-- <div class="col-xs-4">
							  <label class="form_label">Employee :</label>
							  <select class="form-control required-field" id="employee_id" name="employee_id">
								<?php
                            foreach ($tenant_employees as $key => $val) {
                                ?>
									<option value="<?php echo $val['id']; ?>"><?php echo $val['employee_name']; ?></option>
								<?php
                            }
                            ?>
							  </select>
							</div> -->
                        </div>


                        <?php

                        $flash_message = $this->session->flashdata('message');
                        if (isset($flash_message['message']) && $flash_message['message']) {
                            if ($flash_message['type'] == "success") {
                                $class = "alert-success";
                                $class1 = "fa-check";
                            } else {
                                $class = "alert-danger";
                                $class1 = "fa-ban";
                            }
                        }
                        ?>
                        <input type="hidden" name="private_visit_id" id="private_visit_id" value="">
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                <label class="form_label ">Date From <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control my_date required-field" name="date_from"
                                       id="date_from"
                                       placeholder="Enter date_from" value="" readonly="">
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <label class="form_label ">Date To <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control my_date required-field" name="date_to"
                                       id="date_to"
                                       onblur="verify_date()" placeholder="Enter date_to" value="" readonly="">
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="form_label ">Time <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control required-field" id="visit_time" name="time"
                                       placeholder="Enter time" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="form_label">Name <span class="text-red">*</span>:</label>
                                <input type="text" class="form-control required-field" name="name" id="name"
                                       placeholder="Enter name"
                                       value="<?php echo (isset($info['name'])) ? $info['name'] : '' ?>">
                            </div>
                            <div class="col-xs-4">
                                <label class="form_label">Cnic :</label>
                                <input type="text" class="form-control" id="cnic_no" name="cnic"
                                       placeholder="Enter cnic"
                                       value="<?php echo (isset($info['cnic'])) ? $info['cnic'] : '' ?>">
                            </div>
                            <div class="col-md-2 col-xs-4">
                                <label class="form_label">Mobile :</label>
                                <input type="text" class="form-control" name="mobile" placeholder="Enter mobile"
                                       id="mobile"
                                       value="<?php echo (isset($info['mobile'])) ? $info['mobile'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="form_label">Mode :</label>
                                <select class="form-control required-field" name="mode_transport" id="mode_transport"
                                        onchange="if(value=='Pedestrian' || value=='Other'){ $('.number_plate_div').hide(); }else{ $('.number_plate_div').show() }">
                                    <option value="Car">Car</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                    <option value="Taxi">Taxi</option>
                                    <option value="Pedestrian">Pedestrian</option>
                                    <option value="Other">Other</option>
                                </select>
                                <!--<input type="text" class="form-control" name="mode_transport" placeholder="Enter mode_transport" value="<?php echo (isset($info['mode_transport'])) ? $info['mode_transport'] : '' ?>">-->
                            </div>
                            <div class="col-xs-4 number_plate_div">
                                <label class="form_label">Number Plate :</label>
                                <input type="text" class="form-control" name="number_plate" id="number_plate"
                                       placeholder="Enter number_plate"
                                       value="<?php echo (isset($info['number_plate'])) ? $info['number_plate'] : '' ?>">
                            </div>

                        </div>
                        <!--<div class="row" id="msg" style="color:green;padding:10px;"></div>-->
                        <br>
                        <div class="row">
                            <div class="col-xs-2">
                                <input type="button" name="submit" value="Add Members" class="btn btn-success col-xs-12"
                                       onclick="return verify_data('add_private_visit')?add('member_data','add_private_visit','add_members'):false">
                            </div>

                            <div class="col-xs-2 save-button" style="display:none">
                                <input type="submit" value="Save" class="btn btn-success col-xs-12" id="save-visit">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-xs-8">
                                <div id="alert-info" class="alert alert-info hide">Please add visit/member detail!</div>
                            </div>
                        </div>

                    </div>
                    <?php
                    echo form_close();
                    ?>
                    <div class="tile-body table-custom" id="member_data">

                        <table id="private_members" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="width:10%">Name</th>
                                <th style="width:10%">Cnic</th>
                                <th style="width:10%">Mobile</th>
                                <th style="width:10%">Mode</th>
                                <th style="width:10%">Number Plate</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>


                    <!-- /tile body -->

                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->

        </div>
        <!-- /row -->


    </div>

    <div class="popinfo" style="display:none;">
        <h3>Please fill visit detail !!!</h3>
    </div>
</section>

<style>
    .popinfo {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50%;

        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin-top: -40px;
        width: 100%;
        max-width: 300px;
        background-color: #2e3744d9;
        border-radius: 15px;
        text-align: center;
        color: white;
        padding: 30px 40px 30px 40px;
        display: block;
        z-index: 100;
    }

    .pagination > .paginate_button {
        padding: 0px !important;
        margin-left: 0px !important;
    }

    .required {
        border: solid 1px red;
    }
</style>

<script>

    setTimeout(function () {
        $('.spopinfo').fadeOut('fast');
    }, 5000);

    $('.my_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        todayHighlight: true
    }).on('changeDate', function() {
        verify_date(); // Trigger validation when date changes
    });

    function verify_date() {
        let from_date = $('#date_from').val();
        let to_date = $('#date_to').val();

        if (!from_date) {
            swal("", "From Date can't be empty", "error");
            $("#date_to").val("");
            return;
        }

        if (!to_date) return; // Avoid unnecessary execution if to_date is empty

        // Convert to Date object
        let fromDateObj = new Date(from_date.split("-").reverse().join("-"));
        let toDateObj = new Date(to_date.split("-").reverse().join("-"));

        if (isNaN(fromDateObj) || isNaN(toDateObj)) {
            swal("", "Invalid date format!", "error");
            $('#date_to').val("");
            return;
        }

        if (toDateObj < fromDateObj) {
            swal("", "Date To must be greater than Date From!", "error");
            $('#date_to').val("");
            return;
        }

        // Difference in days
        const timeDiff = toDateObj - fromDateObj;
        const days = timeDiff / (1000 * 60 * 60 * 24);

        if (days + 1 > 30) {
            swal("", "Days cannot be greater than 1 month!", "error");
            $('#date_to').val("");
        }
    }
</script>