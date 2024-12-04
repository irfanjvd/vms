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

                    <!--<form name="form" class="form-validation mt-20" id="login_form" novalidate method="POST">-->

                        <!--<div class="form-group">
                            <select name="location" class="form-control" id="location" placeholder="Location">
                            <option value="">Select Your Location</option>
                                <?php
                                foreach($locations as $key=>$val){
                                ?>
                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['location']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>-->

                        <div class="form-group">
                            <label class="pull-left">Username</label>
                            <input type="text" name="email" class="form-control underline-input" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label class="pull-left">Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control underline-input">
                        </div>
						
						<div class="form-group">
                            <?php 
						
						//echo $this->recaptcha->getWidget();
						//echo $this->recaptcha->getScriptTag();
						?>
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
                            <!--<p class="m-0">
                                <a href="javascript:void(0)" class="text-uppercase" onclick="login_user()">LOGIN</a>
                            </p>-->
                            <input class="btn btn-primary" type="submit" value="Login">
                            <p class="loader" style="display: none;">
                                <img src="<?php echo base_url(); ?>assets/images/loading.gif">
                            </p>
                        </div>

                    <!--</form>-->
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

//$.cookie("example", "foo");
//console.log($.cookie("example"));

	//	  console.log($.cookie('ywqir'));
		/*	$.ajaxSetup({
      beforeSend: function (x, o)
      {
		  console.log('<?php echo $this->config->item('csrf_cookie_name'); ?>');
		  console.log($.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>'));
      },
  });*/
			 

            });

            function login_user(){
				
				var form = $('#login_form');
                $('.loader').show();
				if($("#location").val()==3){
					var url="<?= base_url().'user/tenant_login' ?>";
				}else{
					var url="<?= base_url().'user/login' ?>";
				}
                $.ajax({
                    type:"POST",
                    url:url,
                    data:form.serialize(),
                    success: function(response){
                        result = JSON.parse(response);
						
                        if(result.status=="success") {
                            if(result.type=="SUPER"){
                                window.location = "<?php echo base_url().'visitor'; ?>";
                            }else if(result.type=="TENANT"){
								window.location = "<?php echo base_url().'visitor/private_visits'; ?>";	
							}else if(result.type=="BARRIER"){
								window.location = "<?php echo base_url().'visitor/private_visits'; ?>";
							}else{
                                window.location = "<?php echo base_url().'visitor/addvisitor'; ?>";
                            }

                        }else{
                            $('.loader').hide();
                            $('.m-0').show();
                            $('.alert').show();
                            $('.error_msg').html(result.status);
							//regenerat csrf token....
							//var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
							//$('input[name="csrf_test_name"]').val(csrf_value);
							//$('#login_form')[0].reset();
                        }
                    }
                });
            }
        </script>
        <!--/ Page Specific Scripts -->





        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = 'https://www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X', 'auto');
            ga('send', 'pageview');
			
			
			
        </script>

    </body>
</html>
