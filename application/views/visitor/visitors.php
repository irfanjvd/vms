 <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
  <section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-list" style="margin-right:6px;"></i>List View</a> </li>
          </ul>
          
        </div>
<!--        <h2>Visitors Listing <span>VMS - Visitors Management System</span></h2>-->
      </div>
      
      <!-- cards row --> 
<!--        <div class="row">-->
<!--            <div class="col-md-12 col-xs-12  filter_back">-->
<!--              <div class="box box-primary" style="margin-top:15px;">-->
<!--                -->
<!--                <div class="box-body-white col-md-12">-->
<!--                    <div class="form-group col-md-5" >-->
<!--                      <div class="col-md-3">-->
<!--                        <label class="filter_label">From</label>-->
<!--                      </div>-->
<!--                      <div class="col-md-9">-->
<!--                        <div class="input-group">-->
<!--                          <div class="input-group-addon">-->
<!--                            <i class="fa fa-calendar"></i>-->
<!--                          </div>-->
<!--                          <input type="text" name="dob" placeholder="example: 12/31/2015" class="form-control datepicker" />-->
<!--                        </div>-->
<!--                      </div>-->
<!--                     </div>-->
<!--                     <div class="form-group col-md-5">-->
<!--                      <div class="col-md-3">-->
<!--                        <label class="filter_label">To</label>-->
<!--                      </div>-->
<!--                      <div class="col-md-9">-->
<!--                        <div class="input-group">-->
<!--                          <div class="input-group-addon">-->
<!--                            <i class="fa fa-calendar"></i>-->
<!--                          </div>-->
<!--                          <input type="text" name="dob" placeholder="example: 12/31/2015" class="form-control datepicker" />-->
<!--                        </div>-->
<!--                      </div>-->
<!--                     </div>-->
<!--                     <div class="col-md-2"><button class="btn btn-lightred no-border col-md-12" type="submit">Filter</button></div>-->
<!--                  </div>-->
<!--          -->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
      <!-- /row --> 
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Visitors </strong>Listing</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
              <div class="table-responsive">
                  <table style="width: 60%">
                      <tr id="filter_global">
                          <td>Search By: </td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingNameFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingCellNoFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingCityFilter"></p></td>
                      </tr>
                  </table>
                <table id="list_visitors" class="table table-bordered table-striped visitor_listing">
                  <thead class="custom-font">
                    <tr role="row">
                      <th class="sorting_asc" role="columnheader">Picture.</th>
                      <th class="sorting_asc" role="columnheader">Visitor No.</th>
<!--                      <th class="sorting" role="columnheader">Visitor Family No.</th>-->
                      <th class="sorting" role="columnheader">Visitor Name</th>
<!--                      <th class="sorting" role="columnheader">Visitor Father Name</th>-->
                      <th class="sorting" role="columnheader">Visitor Address</th>
                      <th class="sorting" role="columnheader">Visitor Cell</th>
<!--                      <th class="sorting" role="columnheader">Visitor District</th>-->
                      <th class="sorting" role="columnheader">Visitor City</th>
<!--                      <th class="sorting" role="columnheader">Type</th>-->
                      <th class="sorting" role="columnheader">Date</th>
                      <th class="sorting" role="columnheader">Action</th>
<!--                      <th class="sorting" role="columnheader">Check Out</th>-->
                    </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">

                      
                    </tbody>
                                
                  <tfoot>
                  </tfoot>
                </table>
              </div>
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
  <!--/ CONTENT --> 


