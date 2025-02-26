<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
<script>
    $(document).ready(function(e) {
        $('#btn-checkin').on('click',function () {
            console.log('aa:' + $('#visit_checkin').val());
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajax({
                method: "POST",
                url: "<?php echo base_url();?>visit/checkin_store",
                data: "id="+$('#visit_checkin').val()+"&csrf_test_name="+ csrf_value,
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status) {
                        window.open('<?php echo base_url('visit/visits');?>','_self');
                    } else {

                    }
                }

            });
        })
    });

</script>
<section id="content">
    <div class="page page-dashboard">
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile" style="margin-top: -100px;">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Visit </strong>Check-in</h1>

                    </div>
                    <!-- /tile header -->
                    <?php
                    if (isset($visit) && $visit['status'] == "bad") {
                        echo "<br><font color='#ED4337'>Sorry you can`t checkout from this location as there is no checkin from this location!!!</font>";
                    } else {
                        ?>
                        <!-- tile body -->
                        <div class="tile-body table-custom">
						<?php
						$attributes=array(
							'id' => 'add_visitor_form', 
							'enctype' => "multipart/form-data"
						);
						echo form_open(base_url().'visit/visits', $attributes);
						?>
                            <!--<form id="add_visitor_form" method="post" action="checkout">-->
                                <div class="row">
                                    <div id="modal-alert" class="alert danger" style="display: none"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 checkin">
                                        <label class="form_label">Check In Time:</label>
                                        <input type="text" class="form-control checkout_datepicker"
                                               placeholder="Check Out Time" name="visit_checkin" id="visit_checkin">
                                        <input type="hidden" name="visit_id" value="<?php echo $visit['visit_id']; ?>">
                                    </div>
                                </div>

                                <div class="row" style="margin-top:20px;">
                                    <div class="col-xs-2">
                                        <input type="button" class="btn btn-success col-xs-12" onclick="checkinOnClick('<?php echo $visit['visit_id']; ?>')" value="Save" />
<!--                                        <a href="#" class="btn btn-success col-xs-12 save_visitor" id="">Save</a>-->
                                    </div>
                                </div>
                                <!--owner profile form row ends here-->
                            <!--</form>-->
							<?php
							  echo form_close();
							  ?>

                        </div>
                    <?php
                    }
                    ?>
                    <!-- /tile body -->

                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->

        </div>
        <!-- /row -->

    </div>


</section>


<!--<script src="--><?//= base_url() ?><!--assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>-->
<script src="<?= base_url() ?>assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script>
$( ".checkout_datepicker" ).datetimepicker(
	{ 
		sideBySide:true,
		format:"YYYY-MM-DD H:m:s",
		widgetPositioning: {
			horizontal: 'left',
			vertical: 'bottom'
		}
	}
);

</script>