 <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
  <section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/private_visits'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
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
              <h1 class="custom-font"><strong>Private Visits </strong>Listing</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
              <div class="table-responsive">
				<div class="row">
					<div class="col-md-2">
						<h3>Search By:</h3> 
					</div>	
				</div>
				<div class="row">
					<div class="col-md-2">
            <label>Name</label>
            <input type="text" class="form-control" id='name'>
            
          </div>
					<div class="col-md-2">
            <label>Cnic</label>
            <input type="text" class="form-control" id='cnic'>
            
          </div>
					<div class="col-md-2">
            <label>Mobile</label>
            <input type="text" class="form-control" id='mobile'>
            
          </div>
          <div class="col-md-2">
            <label>Date Range</label>
            <input type="text" class="form-control" id='date_range' autocomplete="off">
          </div>
					

					<div class="col-md-2" id="renderingTenantFilter">
            <label>Tenant</label>
            <select id="tenant_id" class="form-control chosen-select" onchange="get_employees(value)">
              <option value="">Select One</option>
              <?php
              if(!empty($tenants)){
                foreach($tenants as $key=>$val){
                ?>
                <option value="<?php echo $val['id']; ?>"><?php echo $val['tenant_name']; ?></option>
                <?php  
                } 
              }
              ?>
            </select>
          </div>
					<div class="col-md-2" id="renderingEmployeeFilter">
            <label>Employees</label>
            <select id="employee_id" class="form-control chosen-select">
              <option value="">Select One</option>
              
            </select>
          </div>

          <div class="col-md-2">
            <label>Number Plate</label>
            <input type="text" class="form-control" id='number_plate'>
          </div>
				
					
          <div class="col-md-2">
            <label>Status</label>
            <select class="form-control" id="status">
              <option value="">Select One</option>
              <option value="MARKED">Marked</option>
			  <option value="PENDING">Pending</option>
              <option value="VISITED">Visited</option>
            </select>
          </div>

          <div class="col-md-2">
            <label>Visit Code</label>
            <input type="text" class="form-control" id='visit_code'>
          </div>

          <div class="col-md-2">
            <div style="clear:both;color:white">.</div>
            <input type="button" class="btn btn-primary" value="Search" onclick="filter_data()">
          </div>
					
				</div>
        <div class="row" style="margin-bottom: 10px;">
          <br>
          

        </div>
                  <!--<table style="width: 100%">
                      <tr id="filter_global">
                          <td>Search By: </td>
						  
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingNameFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingCnicFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingMobileFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingNumberPlateFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingStatusFilter"></p></td>
                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingEmployeeFilter"></p></td>
                      </tr>
					  <tr>
						<td class="custom_filters" align="center"> <p id="renderingDateFilter"></p></td>
					  </tr>
                  </table>-->
				<div class="col-md-12">  
                <table id="list_visitors" class="table table-bordered table-striped private_visits_listing" style="width:100%">
                  <thead class="custom-font">
                    <tr role="row">
					  <td style="width:2%"></td>
                      <!-- <th class="sorting_asc" style="width:15%" role="columnheader">Title</th> -->
                      <th class="sorting_asc" style="width:15%" role="columnheader">Visit Purpose</th>
                      <th class="sorting" style="width:10%" role="columnheader">Date Time</th>
                      <th class="sorting" style="width:15%" role="columnheader">Tenant</th>
                      <th class="sorting" style="width:15%" role="columnheader">Employee</th>
                      <th class="sorting" style="width:5%" role="columnheader">Is Cargo</th>
                      <th class="sorting" style="width:5%" role="columnheader">Visit Code</th>
					  <th class="sorting" style="width:5%" role="columnheader">No. Of Members</th>
                      <th class="sorting" style="width:10%" role="columnheader">Status</th>
                      <!--<th class="sorting" role="columnheader">Action</th>-->
                    </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">

                      
                    </tbody>
                                
                  <tfoot>
                  </tfoot>
                </table>
				</div>
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
  <script>

    $(function() {

      //private visits listing...
    var private_table = $('.private_visits_listing').dataTable( {
//               "aaSorting": [[4,'desc']]
        "lengthMenu": [[15, 25, 50], [15, 25, 50]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true
        ,"searchHighlight": true
  
            ,"aoColumns":[
            {
                "className":      'details-control',
                "orderable":      false,
                "mDataProp":           null,
                "defaultContent": ''
            }
            // ,{"mDataProp":"title","bSortable": true}
            ,{"mDataProp":"agenda"}
            ,{"mDataProp":"date_time","bSortable": true}
            ,{"mDataProp":"tenant","bSortable": true}
            ,{"mDataProp":"employee","bSortable": true}
            ,{"mDataProp":"is_cargo","bSortable": true}
            ,{"mDataProp":"visit_code","bSortable": true}
			,{"mDataProp":"total","bSortable": true}
            ,{"mDataProp":"status","bSortable": true}
        ]
        ,"aaSorting": [[0,'DESC']]
        ,"sAjaxSource": "<?php echo base_url().'visitor/get_ajax_private_visits';  ?>"
        ,"sServerMethod": "POST"
        ,"fnServerParams": function (aoData) {
          var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
          aoData.push({
          "name": "name",
          "value": $('#name').val()
          })
          aoData.push({
          "name": "cnic",
          "value": $('#cnic').val()
          })
          aoData.push({
          "name": "mobile",
          "value": $('#mobile').val()
          })
          aoData.push({
          "name": "number_plate",
          "value": $('#number_plate').val()
          })
          aoData.push({
          "name": "status",
          "value": $('#status').val()
          })
          aoData.push({
          "name": "tenant_id",
          "value": $('#tenant_id').val()
          })
          aoData.push({
          "name": "employee_id",
          "value": $('#employee_id').val()
          })
          aoData.push({
          "name": "date_range",
          "value": $('#date_range').val()
          })
          aoData.push({
          "name": "csrf_test_name",
          "value": csrf_value
          })
          aoData.push({
          "name": "visit_code",
          "value": $('#visit_code').val()
          })
          
          }
        ,'fnCreatedRow': function (nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData.null); // or whatever you choose to set as the id
          //$('td', nRow).css('background-color', '#6FD5EF ');
          
        }
        ,"fnInitComplete": function (oSettings, json) {
          //$("#list_visitors thead tr td.details-control").trigger('click');
                /*setTimeout(function() {
            
          },10);*/
            }
        ,"drawCallback": function( settings ) {
          // setTimeout(function() {
          //  $("td.details-control").trigger('click'); 
          // },10);
        }

    } );

    // Add event listener for opening and closing details
    $('.private_visits_listing tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = private_table.api().row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide('slow');
            tr.removeClass('shown');
        }
        else {
            // Open visit members ...
            row.child( format(row.data()) ).show('slow');
            tr.addClass('shown');
        }
    } );


      var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : { allow_single_deselect: true },
        '.chosen-select-no-single' : { disable_search_threshold: 10 },
        '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
        '.chosen-select-rtl'       : { rtl: true },
        '.chosen-select-width'     : { width: '95%' }
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }


      //$('#cnic').mask('00000-0000000-0');
      $('#mobile').mask('0000000000000');
      $('#date_range').daterangepicker({
      separator : ' ~ ',
      format: 'YYYY-MM-DD',
      autoClose: false,
      
    })

});
    //$('#date_range').daterangepicker();
    function filter_data(){
      private_table = $('.private_visits_listing').DataTable().ajax.reload();
    }
    
  </script>
  <style>
  /*td.details-control {
    background: url("https://datatables.net/examples/resources/details_open.png") no-repeat center center;
    cursor: pointer;
}

tr.shown td.details-control {
    background: url("https://datatables.net/examples/resources/details_close.png") no-repeat center center;
}*/

.display {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.display td, .display th {
    
    padding: 8px;
}



.display tr:hover {background-color: #ddd;}

.display th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}

table.dataTable.no-footer{
	border-bottom:none !important;
}

.searched{
	background-color: #21ff00;
}

.highlight{
	background-color: #21ff00;
}

.yadcf-filter {
	width:150px !important;
}

.bootstrap-datetimepicker-widget{
	z-index:999 !important;
}

td[colspan]:not([colspan="1"]) {
	border-bottom: solid 2px #ff9900;
	border-style: dashed;
}

tr.shown td.details-control {
    background: url(../assets/images/details_close.png) no-repeat center center;
}

td.details-control {
    background: url(../assets/images/details_open.png) no-repeat center center;
    cursor: pointer;
}





table tr.even , table tr.odd {
  font-weight:bold;
  background-color: white;
  color:black;
}

table tr.even td,table tr.odd td{
  vertical-align: middle;
  background-color: white;
  //margin-top:24px ;
  border-top:2px solid gray;
  //padding:0px 6px;
}

table tr.even td p,table tr.odd td p {
  vertical-align: middle;
  margin:auto;
  text-align: center;
}





table tr.even td:nth-child(2):after, table tr.even td:nth-child(2):before,table tr.odd td:nth-child(2):after, table tr.odd td:nth-child(2):before {
	top: 100%;
	left: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	z-index:3;
}


table tr.even.shown td:nth-child(2):after , table tr.odd.shown td:nth-child(2):after {
	border-color: transparent;
	border-top-color: white;
	border-width: 10px;
	margin-left: -10px;
}
table tr.even.shown td:nth-child(2):before,table tr.odd.shown td:nth-child(2):before {
	border-color: transparent;
	border-top-color: lightgray;
	border-width: 13px;
	margin-left: -13px;
}








table tr.even.shown td:first-child, table tr.odd.shown td:first-child{
	border-radius: 20px 0 0 0;
	border-left:2px solid grey;
}
table tr.even.shown td:last-child, table tr.odd.shown td:last-child{
	border-radius: 0 20px 0 0;
	border-right:2px solid grey;
}





td[colspan]:not([colspan="1"]) {
  padding:14px; 
	background-color: lightgray;
	border-radius: 0 0 20px 20px;
	border:0px;
	border-bottom:2px solid white;
  border-radius: 0 0 20px 20px;
	box-shadow:         inset 0 0 10px #000000;
}


table tr td[colspan]:not([colspan="1"]) table tr {
  color:white;
}

table tr td[colspan]:not([colspan="1"]) table thead tr th {
  color:black;
	font-weight: normal;
	background-color:seagreen
}

table tr td[colspan]:not([colspan="1"]) table tr td {
  background-color:grey;
	padding: 0px;
	margin:auto;
	vertical-align: middle;
	text-align: center;
}

table tr td[colspan]:not([colspan="1"]) table tr td .fa {
	color:white;
}


#list_visitors {
	border:0px;
	background-color: white;
}

#list_visitors.table-striped > tbody > tr:nth-of-type(2n+1) {
	background-color:white;
}

.search{
  background-color: #0f8e2a !important;
}


</style>
<!--/ CONTENT --> 


