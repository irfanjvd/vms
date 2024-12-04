<title><?php echo $title; ?></title>
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user" style="margin-right:6px;"></i>Add User</a> </li>
          </ul>
          
        </div>
        <h2>Add User <span>VMS - Visitors Management System</span></h2>
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Add </strong>User</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
          
                    <div class="row">
                            <div class="col-xs-4">
                              <label class="form_label">Visitor Name *:</label>
                              <input type="text" class="form-control" placeholder="Visitor Name">
                            </div>
                            <div class="col-xs-4">
                              <label class="form_label">Visiting Date:</label>
                              <input type="text"  class="form-control" placeholder="Visiting Date">
                            </div>
                            <div class="col-xs-4">
                              <label class="form_label">Check In Time:</label>
                              <input type="text"  class="form-control" placeholder="Check In Time">
                            </div>
                          </div>
                          <!--owner profile form row ends here-->
                          
                           <div class="row" style="margin-top:20px;">
                            <div class="col-xs-3">
                              <label class="form_label">Company Name *:</label>
                              <input type="text" class="form-control" placeholder="Company Name">
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Check Identity:</label>
                              
                              <select class="form-control">
                              	<option>CNIC</option>

                              </select>
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Identity No. *"</label>
                              <input type="text"  class="form-control" placeholder="Identity No">
                            </div>
                            <div class="col-xs-3">
                              <label class="form_label">Cell No. *"</label>
                              <input type="text"  class="form-control" placeholder="Cell No">
                            </div>
                          </div>
                          <!--owner profile form row ends here-->
                          
                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-6">
                              <label class="form_label">Address:</label>
                              <textarea class="form-control" placeholder="Enter Address" style="width:100%; height:100px; border-bottom:" ></textarea>

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
                              <select class="form-control">
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
                              <input type="text" class="form-control" placeholder="Regitration No">
                            </div>
                            <div class="col-xs-2">
                              <label class="form_label">Issued Visitor Card *:</label>
                              <input type="text" class="form-control" placeholder="Visitor Card">
                            </div>
                          </div>
                          <!--owner profile form row ends here-->
                          
                          <div class="row" style="margin-top:20px;">
                            <div class="col-xs-9"></div>
                            <div class="col-xs-1">
                              <a href="#" class="btn btn-success col-xs-12">Save</a>
                            </div>
                            <div class="col-xs-1">
                              <a href="#" class="btn btn-warning col-xs-12">Reset</a>
                            </div>
                            <div class="col-xs-1">
                              <a href="#" class="btn btn-danger col-xs-12">Close</a>
                            </div>

                          </div>
                          <!--owner profile form row ends here-->
                          

            
        
             
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