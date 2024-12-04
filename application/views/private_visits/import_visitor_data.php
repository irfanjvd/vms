
<section id="content">
    <div class="page page-dashboard">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
                    <li> <a href="<?php echo base_url() . 'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
                    <li> <a href="#"><i class="fa fa-upload" style="margin-right:6px;"></i>Import Visitor Data</a> </li>
                </ul>

            </div>
    
        </div>



        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Import </strong>Visitor Data</h1>

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
                        if($this->session->flashdata('error_msg')){
                            echo $this->session->flashdata('error_msg');
                        }

                        if($this->session->flashdata('success_msg')){
                        ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success_msg'); ?>
                            </div>
                        <?php    
                        }

                        
                    ?>
                            
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label id="csv_label" class="form-label">Visit Purpose</label>
                                    <input class="form-control" id="agenda" type="text" name="agenda" placeholder="Visit Purpose" required="">    
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label id="csv_label" class="form-label">Upload only CSV File!</label>
                                    <input class="form-control" id="picture" type="file" accept=".csv" name="csv_data" placeholder="Upload only CSV Files">    
                                    
                                </div>

                                <p class="form-input" id="error1" style="display:none; color:#FF0000;">
                                Invalid File Format! File Format Must Be CSV Only.
                                </p>
                                <p class="form-input" id="error2" style="display:none; color:#FF0000;">
                                Maximum File Size Limit is 5MB.
                                </p class="form-input">

                                <div class="form-group col-md-4">
                                    <label id="csv_label" class="form-label">Download Sample CSV File</label>
                                    <a href="<?php echo base_url().'assets/visitor_sample/sample_visitor.csv'; ?>">
                                        <p><i class="fa fa-download"></i></p>
                                    </a>
                                    
                                </div>
                            </div>

                            <div class="row" style="margin-top:20px;">
                                <div class="col-xs-1">
                                    <input class="btn btn-success col-xs-12 import_csv_file" type="submit" value="Import">
                                </div>
                            </div>

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
<script type="text/javascript">
        
    // by Default it will remain Disabled until a file is uploaded
    $('input[type="submit"]').prop("disabled", true);

    $('#picture').bind('change', function() {
    if ($('input:submit').attr('disabled',false)){
     $('input:submit').attr('disabled',true);
     }
    var ext = $('#picture').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['csv']) == -1){
     $('#error1').slideDown("slow");
     $('#error2').slideUp("slow");
     a=0;
     }else{
     var picsize = (this.files[0].size);
     if (picsize > 5000000){
     $('#error2').slideDown("slow");
     a=0;
     }else{
     a=1;
     $('#error2').slideUp("slow");
     }
     $('#error1').slideUp("slow");
     if (a==1){
     $('input:submit').attr('disabled',false);
     $('#csv_label').hide();

     $('.import_csv_file').click(function () {
        $('#add_visitor_form').submit();
    });

     }
    }
    });


</script>
