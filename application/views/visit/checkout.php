<!--<link rel="stylesheet" href="--><?//= base_url() ?><!--assets/js/vendor/daterangepicker/daterangepicker-bs3.css">-->
<!--<link rel="stylesheet" href="--><?//= base_url() ?><!--assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">-->
<!--<link rel="stylesheet" href="--><?//= base_url() ?><!--assets/css/vendor/bootstrap.min.css">-->
<!--<link href="--><?//= base_url() ?><!--assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />-->

<!-- project main css files -->
<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
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
                        <h1 class="custom-font"><strong>Visit </strong>Checkout</h1>

                    </div>
                    <!-- /tile header -->
                    <?php
                    if($checkout_status=="bad"){
                        echo "<br><font color='#ED4337'>Sorry you can`t checkout from this location as there is no checkin from this location!!!</font>";
                    }else {
                        ?>
                        <!-- tile body -->
                        <div class="tile-body table-custom">
						<?php
						$attributes=array(
							'id' => 'add_visitor_form', 
							'enctype' => "multipart/form-data"
						);
						echo form_open(base_url().'visit/checkout', $attributes);
						?>
                            <!--<form id="add_visitor_form" method="post" action="checkout">-->
                                <div class="row">
                                    <div class="col-xs-4 checkin">
                                        <label class="form_label">Check Out Time:</label>
                                        <input type="text" class="form-control checkout_datepicker"
                                               placeholder="Check Out Time" name="visit_checkout" id="visit_checkout">
                                        <input type="hidden" name="visit_id" value="<?php echo $id; ?>">
                                    </div>
                                </div>

                                <div class="row" style="margin-top:20px;">

                                    <div class="col-xs-2">
                                        <input type="submit" class="btn btn-success col-xs-12 save_visitor"
                                               value="Save">
                                        <!--                                    <a href="#" class="btn btn-success col-xs-12 save_visitor" id="">Save</a>-->
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