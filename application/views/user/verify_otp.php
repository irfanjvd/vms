<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]--><head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>VMS - Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/vendor/animate.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/animsition/css/animsition.min.css">
		

        <!-- project main css files -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?= base_url() ?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>





    <body id="minovate" class="appWrapper">

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <style>
            .logo-styling{
                width: 50%;
                margin-left: auto;
                margin-right: auto;
                position: relative;
                margin-bottom: 54px;
                margin-top: -100px;
            }

        </style>

        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">

            <div class="page page-core page-login">

                <div class="container w-420 p-15 bg-white mt-40 text-center"  style="background:rgba(255,255,255,0.5); ">
                    <div class="text-center"><img src="<?= base_url() ?>assets/images/logo.png" class="img-responsive logo-styling" /></div>

					<?php
						$attributes=array(
							'id' => 'login_form',
							'name' => 'form',
							'enctype' => "multipart/form-data"
						);
						echo form_open('', $attributes);
					?>
                        <div class="form-group">
                            <label class="pull-left">Enter Code</label>
                            <input type="text" name="otp_code" class="form-control underline-input" placeholder="Enter Code">
                        </div>

                        
						<div class="form-group">
                        
                        </div>
                        <?php
                        if($this->session->flashdata('message')){
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i></h4>
                            <div class="error_msg">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        </div>
                        <?php    
                        }
                        ?>
                            

                        <div class="bg-slategray lt wrap-reset mt-40">
                            
                            <input class="btn btn-primary" type="submit" value="Verify">
                            <p class="loader" style="display: none;">
                                <img src="<?php echo base_url(); ?>assets/images/loading.gif">
                            </p>
                        </div>
					<?php
					  echo form_close();
					  ?>
                </div>
            </div>
        </div>
        <!--/ Application Content -->


        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <!--<script src="../ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="<?= base_url() ?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?= base_url() ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?= base_url() ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url() ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url() ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url() ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <!--<script src="<?= base_url() ?>assets/js/vendor/screenfull/screenfull.min_2.js"></script>-->
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?= base_url() ?>assets/js/main.js"></script>
        <!--/ custom javascripts -->
		<script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/js/jquery.cookie.js"></script>

        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function () {
			 

            });
        </script>
        <!--/ Page Specific Scripts -->
    </body>
</html>
