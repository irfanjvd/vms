<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>Add Visit</a> </li>
          </ul>
          
        </div>
        <h2>Add Visit <span>VMS - Visitors Management System</span></h2>
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
                <form id="add_visitor_form" method="post">
                    <div class="row">
                            <div class="col-xs-4">
                              <label class="form_label">Visitor Name *:</label>
                              <input type="text" class="form-control" placeholder="Visitor Name" name="visitor_name" id="visitor_name">
                            </div>
                            <div class="col-xs-4">
                              <label class="form_label">Visiting Date:</label>
                              <input type="text"  class="form-control" placeholder="Visiting Date">
                            </div>
                            <div class="col-xs-4">
                              <label class="form_label">Check In Time:</label>
                              <input type="text"  class="form-control" placeholder="Check In Time" name="visit_checkin" id="visit_checkin">
                            </div>
                          </div>
                          <!--owner profile form row ends here-->
                          
                           <div class="row" style="margin-top:20px;">
                            <div class="col-xs-3">
                              <label class="form_label">Company Name *:</label>
                              <input type="text" class="form-control" placeholder="Company Name" name="visit_from_company" id="visit_from_company">
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Check Identity:</label>
                              
                              <select class="form-control">
                              	<option>CNIC</option>
                              
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Identity No. *"</label>
                              <input type="text"  class="form-control" placeholder="Identity No" name="visitor_identity_no" id="visitor_identity_no">
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Cell No. *"</label>
                              <input type="text"  class="form-control" placeholder="Cell No" name="visitor_cell_no" id="visitor_cell_no">
                            </div>
                          </div>
                          <!--owner profile form row ends here-->
                          
                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-6">
                              <label class="form_label">Address:</label>
                              <textarea class="form-control" placeholder="Enter Address" style="width:100%; height:100px; border-bottom:"  name="visitor_address" id="visitor_address"></textarea>

                            </div>
                            <div class="col-xs-6">
                              <label class="form_label">Reason for Visit:</label>
                              <textarea class="form-control" placeholder="Enter Comments" style="width:100%; height:100px; border-bottom:" ></textarea>
                            </div>
                            
                          </div>
                          <!--owner profile form row ends here-->
                          
                           <div class="row" style="margin-top:20px;">
                            <div class="col-xs-2">
                              <label class="form_label">Model of Transport:</label>
                              <select class="form-control" name="visit_transport_mode" id="visit_transport_mode">
                              	<option>Car</option>
                              </select>

                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Tenant:</label>
                              <select class="form-control">
                              	<option>Apex Consulting Pakistan</option>
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Employee"</label>
                              <select class="form-control">
                              	<option>Sardar Ali Syed</option>
                              </select>

                            </div>
                            
                            <div class="col-xs-2">
                              <label class="form_label">Regitration No.:</label>
                              <input type="text" class="form-control" placeholder="Regitration No" name="visit_transport_registration_no" id="visit_transport_registration_no">
                            </div>
                            <div class="col-xs-2">
                              <label class="form_label">Issued Visitor Card *:</label>
                              <input type="text" class="form-control" placeholder="Visitor Card" name="visit_issued_card" id="visit_issued_card">
                            </div>
                          </div>
                          <!--owner profile form row ends here-->
                          
                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-1">
                              <a href="#" class="btn btn-success col-xs-12" id="save_visitor">Save</a>
                            </div>
                            <div class="col-xs-1">
                              <a href="#" class="btn btn-warning col-xs-12">Reset</a>
                            </div>
                            <div class="col-xs-1">
                              <a href="#" class="btn btn-danger col-xs-12">Close</a>
                            </div>

                          </div>
                          <!--owner profile form row ends here-->
                          

            
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
            
            console.log(i+'=='+e+'==='+e.length);
            //return false;

            if (e.length == 25 && i == 1) {//Get cnic number from New CNIC
                cnic = e.substr(12, 13);
                cnic_status = 'new';
                call_ajax = true;
                //i = 0;
            }
            else {
                    cnic_status = 'old';
                    if(i == 1){
                        i++;
                    }
                    else if(i == 2){
                        i++;
                        old_val = e;
                    }
                    else if(i == 3){
                        
                        if (e.length == 6){
                            family_no = e;
                            cnic = old_val
                            cnic = cnic.substr(0, 13);
                            //call_ajax = true;
                            i=6;
                        }else{
                            old_val = e;
                            i++;
                        }
                    }
                    else if(i == 4){
                        if (e.length == 6){
                            family_no = e;
                            cnic = old_val
                            cnic = cnic.substr(0, 13);
                            i=6;
                        }
                    }
                    else if (i == 6){
                        
                        if(e.length==8)
                        {
                                dob = e.substr(0,2)+'-'+e.substr(2,4)+'-'+e.substr(4)
			
                        }
                        else if(e.length>8)
                        {
                                dob = e;
                        }
                        
                        i++;
                    }
                    else if (i == 7){
                        name = decodeURIComponent(escape(e));
                        call_ajax = true;
                        i++;
                    }
                    else if (i == 8){
                        father_name = e;
                        call_ajax = true;
                        i++;
                    }
                    else if (i == 9){
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
                    data: {"cnic": cnic,"family_no":family_no,"dob":dob,"name":name,"father_name":father_name,"address":address,"cnic_status":cnic_status},
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