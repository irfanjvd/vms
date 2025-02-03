<!--
@author:irfan javed
@email: irfanjvd@gmail.com
@web:http://irfanjaved.com
-->
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>VMS - <?php echo $page_title; ?></title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        <!-- ============================================
================= Stylesheets ===================
============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/font-awesome/font-awesome.min.css">
        <!-- FontAwesome 4.3.0 -->
<!--        <link rel="stylesheet" href="--><?//= base_url() ?><!--assets/css/font-awesome.css">-->
        
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/morris/morris.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/rickshaw/rickshaw.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/chosen/chosen.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/js/vendor/summernote/summernote.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.dataTables.yadcf.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/sweetalert2.min.css">
<!--        <link href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />-->

        <!-- project main css files -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/colorbox.css">
        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.css">
        <link rel="icon" href="<?= base_url() ?>assets/images/logo.png" type="image/png" sizes="16x16">
<!--        <script src="--><?//= base_url() ?><!--assets/js/highlight.js"></script>-->

<!--        <script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.11/features/searchHighlight/dataTables.searchHighlight.min.js"></script>-->
<!--        <script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.11/features/searchHighlight/dataTables.searchHighlight.min.js"></script>-->
        <!--/ stylesheets -->

<!--        <link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/1.10.11/features/searchHighlight/dataTables.searchHighlight.css">-->

        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?= base_url() ?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
                <!-- jQuery 2.1.4 -->
<!--        <script src="--><?//= base_url() ?><!--assets/js/jquery-2.1.1.js"></script>-->

        <script src="<?= base_url() ?>assets/js/jquery.colorbox.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/js/jquery.cookie.js"></script>
        
        <!--/ modernizr -->

        <style>

            .complete-button{
                background:none;
                border:1px solid #fff;
                padding:5px;
                color:#FFF !important;
                width:100%;
                text-align:center;
                border-top:none !important; 
            }

            .complete-button:hover{
                background:none !important;
                border:1px solid #fff;
                padding:5px;
                color:#FFF !important;
                width:100%;
                text-align:center;
                border-top:none !important; 
            }

            .incomplete-button{
                background:none;
                border:1px solid #fff;
                border-top:none !important;
                padding:5px;
                color:#FFF !important;
                width:100%;
                text-align:center;

            }

            .incomplete-button:hover{
                background:none !important;
                border:1px solid #fff;
                border-top:none !important;
                padding:5px;
                color:#FFF !important;
                width:100%;
                text-align:center;
            }
            .flot-x-axis div {
                -ms-transform: rotate(55deg); /* IE 9 */
                -webkit-transform: rotate(55deg); /* Chrome, Safari, Opera */
                transform: rotate(55deg);
                padding-bottom:30px !important;

            }


            .btn_value{
                border:1px solid #FFF; border-bottom:none; padding-bottom:0; margin-bottom:0;
                padding-top:10px;
            }       


            .inner-logo{
                width: 13%;
                float: left;
                margin-right: 10px;
                padding-top: 4px;
            }
        </style> 
    </head>
    <body id="minovate" class="appWrapper hz-menu">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">

            <!-- ===============================================
            ================= HEADER Content ===================
            ================================================ -->
            <section id="header" class="scheme-black">
                <header class="clearfix"> 
					<div class='array' style='display:none'>
						<?php
						echo "<pre>";
						print_r($_SESSION);
						?>
					</div>
                    <!-- Branding -->
                    <div class="branding scheme-black"> <a class="brand" href="<?php echo base_url(); ?>"> <span><strong>VMS - </strong>Visitor Management System</span> </a> <a href="#" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a> </div>
                    <!--<div class="branding scheme-black"> <a class="brand" href="index.html"> <span><strong><img src="<?= base_url() ?>assets/images/logo2.png" class="img-responsive inner-logo"/> </strong>Visitors Management System</span> </a> <a href="#" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a> </div>-->
                    <!-- Branding end -->
                    <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">
                        <li class="dropdown nav-profile">
                            <a  class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $session_data = $this->session->userdata('logged_in');
                            if($session_data['login_user_image']!=''){
                                $p_image=base_url()."assets/images/user_images/".$session_data['login_user_image'];
                            }else{
                                $p_image=base_url()."assets/images/avatar5.png";
                            }
                            ?>
                            <img src="<?= $p_image; ?>" alt="Avatar" class="img-circle size-30x30" />
                            <span>
                                <?php echo ($session_data['login_user_location_title']); ?>
<!--                                <i class="fa fa-angle-down"></i>-->
                            </span>
                            <span>
                                <?php echo ($session_data['login_user_fullname']); ?>
                                <i class="fa fa-angle-down"></i>
                            </span>
                            </a>
                            <ul class="dropdown-menu animated littleFadeInRight" role="menu">
                                <?php
                                if($session_data['login_user_type']!="TENANT"){
                                ?>
                                <li> <a href="<?php echo base_url()."user/edit_user/".$session_data['login_user_id']; ?>"> <i class="fa fa-user"></i>Profile </a> </li>
                                <li class="divider"></li>
                                <li> <a href="<?php echo base_url().'user/change_password'; ?>"> <i class="fa fa-sign-out"></i>Change Password </a> </li>
                                <li class="divider"></li>
                                <?php
                                }
                                ?>
                                <li> <a href="<?php echo base_url().'user/logout'; ?>"> <i class="fa fa-sign-out"></i>Logout </a> </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Right-side navigation end --> 

                </header>
            </section>
            <!--/ HEADER Content  --> 

            <!-- =================================================
                      ================= CONTROLS Content ===================
                      ================================================== -->
            <div id="controls"> 

                <!-- ================================================
                            ================= SIDEBAR Content ===================
                            ================================================= -->

<?php 
if($session_data['login_user_type'] != "VIEW_ONLY")
{ 
?>
                <aside id="sidebar" class="scheme-black">
                    <div id="sidebar-wrap">
                        <div class="panel-group slim-scroll" role="tablist">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title"> <a data-toggle="collapse" href="#sidebarNav"> Navigation <i class="fa fa-angle-up"></i> </a> </h4>
                                </div>
                                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body"> 

                                        <!-- ===================================================
                                                                ================= NAVIGATION Content ===================
                                                                ==================================================== -->
                                        <ul id="navigation">
                                        <?php if($session_data['login_user_type']!="TENANT" && $session_data['login_user_type']!="BARRIER") { ?>
                                            <li><a href="<?= base_url() ?>visitor/index"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                            <li><a href="<?= base_url() ?>visitor/visitors"><i class="fa fa-list-alt"></i> Visitors</a></li>
                                            <li><a href="<?=base_url() ?>visit/visits"><i class="fa fa-list-ol"></i> Visits</a></li>
<!--                                            <li> <a href="#"><i class="fa fa-list"></i> <span>List View</span> </a>-->
<!--                                                <ul>-->
<!--                                                    <li><a href="--><?//= base_url() ?><!--visit/visits"><i class="fa fa-list-ol"></i> Visit Listings</a></li>-->
<!--                                                    <li><a href="--><?//= base_url() ?><!--visitor/visitors"><i class="fa fa-list-alt"></i> Visitors Listing</a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
                                            <?php
                                            if($session_data['login_user_type']!="SUPER") {
                                                ?>
                                            <!--<li> <a href="#"><i class="fa fa-group"></i> <span>Visits(Phone Call)</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url() ?>CallVisitor/addvisitor"><i
                                                            class="fa fa-user-plus"></i>
                                                        <span>Add Visit</span></a>
                                                    </li>
                                                    
                                                    <li>
                                                    <a href="<?=base_url() ?>CallVisit/visits"><i class="fa fa-list-ol"></i>List</a>
                                                    </li>

                                                    <li>
                                                    <a href="<?=base_url() ?>CallVisitor/import_csv"><i class="fa fa-upload"></i>Import Data</a>
                                                    </li>
                                                </ul>
                                            </li>-->

                                                <li><a href="<?= base_url() ?>visitor/addvisitor"><i
                                                            class="fa fa-user-plus"></i>
                                                        <span>Add Visit</span></a>
                                                    </li>
                                                
                                                
                                            <?php
                                            }
                                            if($session_data['login_user_type']=="SUPER") {
                                            ?>
                                            <li> <a href="#"><i class="fa fa-group"></i> <span>Users</span> </a>
                                                <ul>
                                                    <li>
                                                        <a href="<?= base_url() ?>user/add_user"><i class="fa fa-user"></i> Add User</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url() ?>user/list_users"><i class="fa fa-user"></i> List Users</a>
                                                    </li>
                                                    <!-- <li>
                                                        <a href="<?php  //base_url() ?>user/user_visit_details"><i class="fa fa-user"></i> User Visits Details</a>
                                                    </li> -->
                                                </ul>
                                            </li>
                                            <!-- <li> <a href="#"><i class="fa fa-globe"></i> <span>Locations</span> </a>
                                                <ul>
                                                    <li><a href="<?= base_url() ?>location/add_location"><i
                                                                class="fa fa-user"></i> Add Location</a>
                                                    </li>
                                                    <li><a href="<?= base_url() ?>location/list_locations"><i class="fa fa-user"></i> List Locations</a></li>
                                                </ul>
                                            </li> -->
                                            
                                            <?php
                                            }
                                        }
                                        
                                            ?>

                                            <?php
                                            if($session_data['login_user_type']=="SUPER") 
                                            {
                                                ?>
                                                <li> <a href="#"><i class="fa fa-group"></i> <span>Visit Types</span> </a>
                                                <ul>
                                                    <li>
                                                        <a href="<?= base_url() ?>Visit_Types/adding"><i class="fa fa-user"></i> Add</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url() ?>Visit_Types/listing"><i class="fa fa-user"></i> List</a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                            <li> <a href="#"><i class="fa fa-group"></i> <span>Visit Gates</span> </a>
                                                <ul>
                                                    <li>
                                                        <a href="<?= base_url() ?>Visit_Gates/adding"><i class="fa fa-user"></i> Add</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= base_url() ?>Visit_Gates/listing"><i class="fa fa-user"></i> List</a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>

                                            <li> <a href="#"><i class="fa fa-group"></i> <span>Black listed</span> </a>
                                                <ul>
                                                   <li>
                                                        <a href="<?= base_url() ?>blacklisted/listing"><i class="fa fa-user"></i> List</a>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                                <?php 
                                            }
                                                ?>

                                            <?php if($session_data['login_user_type']=="TENANT") { ?>
                                            <li><a href="<?= base_url() ?>visitor/addvisitor"><i class="fa fa-user"></i> Add Visits</a></li>
                                            <?php
                                            //if($session_data['login_tenant_id']==33 || $session_data['login_tenant_id']==34 || $session_data['login_tenant_id']==36){
                                            ?>
                                            <li><a href="<?= base_url() ?>PrivateVisits/import_csv"><i class="fa fa-user"></i> Import Visitor Data</a></li>
                                            <?php    
                                            //}
                                            ?>
                                            
                                            
                                            <?php 
                                            }
                                            ?>
                                            <li>
                                                <a href="<?= base_url() ?>visit/visits"><i class="fa fa-user"></i>Visit Details</a>
                                                
                                            </li>
                                            
                                        </ul>
                                        <!--/ NAVIGATION Content --> 

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <!--/ SIDEBAR Content --> 
<?php } ?>
<style>
.badge {
    /*position: absolute;
    top:5px;
    right: -8px;
    padding: 3px 9px;
    border: 2px solid white;
    border-radius:100px;
    background: -webkit-linear-gradient(top, #FF6969 0%,#ff0000 100%);
    box-shadow: 0 1px 2px rgba(0,0,0,.5), 0 1px 4px rgba(0,0,0,.4), 0 0 1px rgba(0,0,0,.7) inset, 0 10px 0px rgba(255,255,255,.11) inset; 
    -webkit-background-clip: padding-box;
    font:bold 16px/20px "Helvetica Neue", sans-serif; 
    color: white;
    text-decoration: none;
    text-shadow: 0 -1px 0 rgba(0,0,0,.6);*/
    
    color: #fff;
    background: red;
    position: absolute;
    z-index: 99;
    font-size: 14px;
    padding: 5px 4px;
    border-radius: 10px;
    right: 5px;
    top: 2px;
}


​
</style>


            </div>
            <!--/ CONTROLS Content -->
<?php date_default_timezone_set('Asia/Karachi'); ?>