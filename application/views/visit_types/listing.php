<section id="content">
    <div class="page page-dashboard">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> VMS</a></li>
                    <li><a href="<?php echo base_url() . 'visitor/'; ?>"><i class="fa fa-dashboard"
                                                                            style="margin-right:6px;"></i>Dashboard</a>
                    </li>
                    <li><a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i> Visit Types</a></li>
                </ul>

            </div>
            <h2>Visit types <span>VMS - Visitors Management System</span></h2>
        </div>


        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong> </strong>Visit types</h1>

                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body table-custom">


                        <?php if ($this->session->flashdata('error')) {
                            echo "<p style='color:#ff0000' >" . $this->session->flashdata('error') . "</p>";
                        } ?>

                        <?php if ($this->session->flashdata('success')) {
                            echo "<p style='color:#0ad41d' >" . $this->session->flashdata('success') . "</p>";
                        } ?>

                        <input type="button" value="Add Record"
                               onclick="window.location='<?php echo base_url() . 'Visit_Types/adding'; ?>'"
                               class='btn btn-primary pull-right'/>
                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-4">Branch</th>
                                <th class="col-md-4">Name</th>
                                <th class="col-md-3">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($record) && is_array($record)) {
                                if ($this->uri->segment(3)) {
                                    $loopIndex = ($per_page * ($this->uri->segment(3) - 1)) + 1;
                                } else {
                                    $loopIndex = 1;
                                }
                                foreach ($record as $rec) {

                                    ?>

                                    <tr>
                                        <td><?php echo $loopIndex; ?></td>
                                        <td><?php echo $rec->tenant_name; ?></td>
                                        <td><?php echo $rec->name; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'Visit_Types/updating/' . $rec->id; ?>">Edit</a>
                                            <?php if (in_array($this->session->userdata('logged_in')['login_user_type'], ['SUPER','TENANT'])) { ?>
                                            | <a href="<?php echo base_url() . 'Visit_Types/deleting/' . $rec->id; ?>">Delete</a>
                                            <?php } ?>
                                            <!-- <a href="<?php echo base_url() . 'Visit_Types/adding/detail/' . $rec->id; ?>">Detail</a> /  -->

                                        </td>
                                    </tr>
                                    <?php $loopIndex++;
                                }
                            }
                            ?>
                            </tbody>

                        </table>
                        <?php echo $links; ?>


                        </form>

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

    //console.log(escape("2’/ F/E            "));
    $('#save_visitor').click(function () {
        $('#add_visitor_form').submit();
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

            console.log(i + '==' + e + '===' + e.length);
            //return false;

            if (e.length == 25 && i == 1) {//Get cnic number from New CNIC
                cnic = e.substr(12, 13);
                cnic_status = 'new';
                call_ajax = true;
                //i = 0;
            } else {
                cnic_status = 'old';
                if (i == 1) {
                    i++;
                } else if (i == 2) {
                    i++;
                    old_val = e;
                } else if (i == 3) {

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
                } else if (i == 4) {
                    if (e.length == 6) {
                        family_no = e;
                        cnic = old_val
                        cnic = cnic.substr(0, 13);
                        i = 6;
                    }
                } else if (i == 6) {

                    if (e.length == 8) {
                        dob = e.substr(0, 2) + '-' + e.substr(2, 4) + '-' + e.substr(4)

                    } else if (e.length > 8) {
                        dob = e;
                    }

                    i++;
                } else if (i == 7) {
                    name = decodeURIComponent(escape(e));
                    call_ajax = true;
                    i++;
                } else if (i == 8) {
                    father_name = e;
                    call_ajax = true;
                    i++;
                } else if (i == 9) {
                    address = e;
                    call_ajax = true;
                    i++;
                }


            }

            //console.log(i+'=='+cnic+'==='+cnic.length);
            if (call_ajax) {
                call_ajax = false;
                $.ajax({
                    type: "POST",
                    data: {
                        "cnic": cnic,
                        "family_no": family_no,
                        "dob": dob,
                        "name": name,
                        "father_name": father_name,
                        "address": address,
                        "cnic_status": cnic_status
                    },
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
                    }

                });
            }
        }

    });


</script>


