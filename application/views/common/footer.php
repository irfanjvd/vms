<?php
date_default_timezone_set('Asia/Karachi');
if ($this->session->userdata('logged_in')) {
    $session_data = $this->session->userdata('logged_in');
}
?>
<div class="row bg-slategray navbar-fixed-bottom footer">
    <div class="col-xs-12">

        <p style="margin:0;">© Copy Rights <?php echo date("Y"); ?>. Punjab Information Tecnology Board All Rights Reserved</p>

    </div>

</div>


</div>
<!--/ Application Content -->




<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->



<!--<script src="../ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= base_url() ?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
        -->
<!--        <script src="--><?//= base_url() ?><!--assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>-->

<script src="<?= base_url() ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/d3/d3.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/d3/d3.layout.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/rickshaw/rickshaw.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/daterangepicker/daterangepicker.js"></script>
<!--        -->
<script src="<?= base_url() ?>assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/flot/jquery.flot.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/flot-spline/jquery.flot.spline.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/raphael/raphael-min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/morris/morris.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>



<!--        <script src="--><?//= base_url() ?><!--assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>-->
<script src="<?= base_url() ?>assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/summernote/summernote.min.js"></script>

<script src="<?= base_url() ?>assets/js/vendor/coolclock/coolclock.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/coolclock/excanvas.js"></script>
<!--/ vendor javascripts -->

<!--        <script src="--><?//= base_url() ?><!--assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
<!--        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">-->
        <link href="<?= base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>assets/js/datatable_column_filter.js" type="text/javascript"></script>
<!--<script src="--><?//= base_url() ?><!--assets/js/jquery.dataTables.yadcf.js" type="text/javascript"></script>-->
<script src="<?= base_url() ?>assets/js/datatable-yadcf-new.js" type="text/javascript"></script>
<!--        <script src="--><?//= base_url() ?><!--assets/js/datatable_editable.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>


<script src="<?php echo base_url().'assets/js/sweetalert2.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/highcharts/'; ?>highcharts.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts/'; ?>data.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts/'; ?>drilldown.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts/'; ?>exporting.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts/'; ?>export-data.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts/'; ?>accessibility.js"></script>
<script src="<?php echo base_url().'assets/js/chosen.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/chosen.order.proto.min.js'; ?>"></script>

<!--        <script src="http://jquery-datatables-row-grouping.googlecode.com/svn/trunk/media/js/jquery.dataTables.rowGrouping.js" type="text/javascript"></script>-->
<!--        <script src="https://cdn.datatables.net/fixedheader/3.0.0/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>-->
<!--        <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js" type="text/javascript"></script>-->


<script type="text/javascript">
    $(function () {
//		var t = $('#private_members').DataTable();
	//	var private_members_counter = 1;
		
		
		
		
//        $("#example1").dataTable();
//        $("#list_visitors").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
		
		setInterval(function(){ 
		var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajax({
				method: "POST",
				url: "<?php echo base_url();?>PrivateVisits/get_notifications/",
				data: {},
				success: function(result) {
					response = JSON.parse(result);
					if(response.status=="success" && response.total>0){
						if(response.user_type!='TENANT'){
							$('.badge').show();
							$('.badge').html(response.total);	
						}
						
					}else{
						$('.badge').hide();
					}
					
					if(response.status=="logout"){
						//logout...
					}
					
				},
				async: false

			});
			
		}  , 5000 );
		
		
    });
	
	
</script>
<script type="text/javascript">
var t = $('#private_members').DataTable();
var private_members_counter = 1;
$('#private_members tbody').on( 'click', '.fa-remove', function () {
			var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
			// t
			// 	.row( $(this).parents('tr') )
			// 	.remove()
			// 	.draw();
	var id=$(this).attr('id');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url();?>PrivateVisits/remove_member/",
		data: "id="+id,
		success: function(result) {
			<?php
			$session_data=$this->session->userdata('logged_in');
			if(empty($session_data['private_visit']['p_members'])){
			?>
				$('.save-button').hide();
			<?php	
			}
			?>
		},
		async: false

	});
	
    t
        .row( $(this).parents('tr') )
        .remove()
        .draw();
} );

function verify_data(form){
	
	var isValid = true;
	$('.required-field', '#'+form).each(function() {
		if ( $(this).val() === '' ) {
			$(this).addClass('required');
			isValid = false;
		}else{
			$(this).removeClass('required');
		}
	});
	return isValid;
}

function add(div_id, form_id, method = '') {
    // Show the alert info
    $('#alert-info').removeClass('hide');

    // Serialize form data
    var datastring = $("#" + form_id).serialize();

    // Increment the counter
    private_members_counter++;

    // Perform AJAX request
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>PrivateVisits/" + method + "/",
        data: datastring + '&private_members_counter=' + private_members_counter,
        success: function (result) {
            try {
                var final_result = JSON.parse(result);
                console.log(final_result);

                if (final_result.status === 'success') {
                    handleSuccess(final_result, div_id);
                }
            } catch (e) {
                console.error("Invalid JSON response:", result);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
        }
    });
}

// Separate function to handle the success result
function handleSuccess(final_result, div_id) {
    if (div_id === "visit_data") {
        $('#private_visit_id').val(final_result.id);
        $('#visit_data').hide();
        $('#member_data').show();
        hidePopInfo();
    } else {
        resetFormFields();
        if (final_result.data.name !== '' && final_result.data.mode_transport !== '') {
            addRowToTable(final_result.data);
        }
        hidePopInfo();
    }
    $('#alert-info').addClass('hide');
}

// Function to reset form fields
function resetFormFields() {
    $('#name').val("");
    $('#cnic_no').val("");
    $('#mobile').val("");
    $('#mode_transport').val("Car");
    $('#number_plate').val("");
    $('.save-button').show();
}

// Function to add row to the table
function addRowToTable(data) {
    t.row.add([
        data.name,
        data.cnic,
        data.mobile,
        data.mode_transport,
        data.number_plate,
        data.date_from,
        data.date_to,
        "<i class='fa fa-remove' id='" + private_members_counter + "'></i>"
    ]).draw(false);
}

// Function to hide pop-up info
function hidePopInfo() {
    $('.popinfo').hide();
}




/*$( ".checkin_datepicker" ).datetimepicker({sideBySide:true,widgetPositioning: {
    horizontal: 'left',
    vertical: 'bottom'
}});
$( ".checkout_datepicker" ).datetimepicker({ sideBySide:true,widgetPositioning: {
    dateFormat: 'yyyy:mm:dd',
    horizontal: 'right',
    vertical: 'bottom'
}});*/

$( ".checkin_datepicker" ).datetimepicker(
	{
		sideBySide:true,
		format:"YYYY-MM-DD H:m:s",
		ignoreReadonly:true,
		widgetPositioning: {
		    horizontal: 'left',
		    vertical: 'bottom'
		}
	}
);
$( ".checkout_datepicker" ).datetimepicker(
	{ 
		sideBySide:true,
		format:"YYYY-MM-DD H:m:s",
		ignoreReadonly:true,
		widgetPositioning: {
    		horizontal: 'right',
    		vertical: 'bottom'
		}
	}
);




function change_status(id,status){
	var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
	swal({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes!',
		cancelButtonText: 'No, cancel!',
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass: 'btn btn-danger',
		buttonsStyling: false
	}).then(function () {
		
		$.ajax({
		method: "POST",
		url: "<?php echo base_url();?>visitor/change_private_visit_status",
		data: "id="+id+"&status="+status+"&csrf_test_name="+ csrf_value,
		success: function(data) {
			if(data=="PENDING"){
				var color="orange";
			}else{
				var color="green";
			}
			
			//$('#visit_status_'+id).html("<span style=\"color:"+color+";cursor:pointer;\" onclick=\"change_status("+id+",'"+data+"')\">"+data+"</span>");
			$('#visit_status_'+id).html("<span class='btn btn-success' style=\"color:"+color+";cursor:pointer;\" >"+data+"</span>");
		},
		

	});
	return location_options;		
	}, function (dismiss) {
			  // dismiss can be 'cancel', 'overlay',
			  // 'close', and 'timer'
			  if (dismiss === 'cancel') {
			    /*swal(
			      'Cancelled',
			      'Your imaginary file is safe :)',
			      'error'
			      )*/
			      return false;
			    }
			  })
	
	
	
}



$(function() {
	<?php
	$session_data=$this->session->userdata('logged_in');
	if($session_data['login_user_type']=="TENANT"){
	?>
		$('#renderingEmployeeFilter').hide();
		$('#renderingTenantFilter').hide();

	<?php	
	}else{
	?>
		$('#renderingEmployeeFilter').show();
		$('#renderingTenantFilter').show();
	<?php	
	}
	?>
    $( ".my_date" ).datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD',
        ignoreReadonly: true,
         minDate: new Date()
    });
	
	$('#visit_time').datetimepicker({
		format: '',
		format: 'HH:mm'
	});
	
	
		
	 
	
	
 
// setTimeout(function(){
//   $("td.details-control").trigger('click');
// }, 2000);    
	
	$('.private_visits_listing thead tr td.details-control').on('click',function(){
		$(".private_visits_listing tbody tr td.details-control").trigger('click');
	});
	
});
	function getTenantEmployeesForFilter(){
		var final_result='';
		$.ajax({
			method: "POST",
			url: "<?php echo base_url();?>Tenant/get_tenant_employees_for_filter",
			success: function(data) {
				data=JSON.parse(data);
				final_result=data;
				
			},async: false
			
			
		});
		console.log(final_result);
		return final_result;
	}
	
	function getTenantForFilter(){
		var final_result='';
		$.ajax({
			method: "GET",
			url: "<?php echo base_url();?>Tenant/get_tenant_for_filter",
			success: function(data) {
				data=JSON.parse(data);
				final_result=data;
				
			},async: false
			
			
		});
		console.log(final_result);
		return final_result;
	}
/* Formatting function for row details - modify as you need */
	function formatDate(date) {
		return date;
		
	 }

	//this is being used to show members of a visit...
	function format ( d ) {
		var html='';
		row_id=d.null;
		$.ajax({
			method: "POST",
			url: "<?php echo base_url();?>PrivateVisits/get_members",
			data: "id="+row_id,
			success: function(data) {
				members = JSON.parse(data);
				html= '<table class="display table table-bordered table-striped private_visits_listing dataTable no-footer private_member_listing">\
								<thead>\
									<tr>\
										<th>Name</th>\
										<th>Cnic</th>\
										<th>Mobile</th>\
										<th>Transport</th>\
										<th>Number Plate</th>\
										<th>From</th>\
										<th>To</th>\
										<th>Time</th>';
								<?php 
								$session_data=$this->session->userdata('logged_in');
								if($session_data['login_user_type']!="TENANT" && $session_data['login_user_type']!="SUPER"){
								?>
									html+=' <th>Action</th>';
								<?php
								}								
								?>		
								
								
							html+=' </tr>\
								</thead><tbody>';
				$.each( members, function( key, value ) {
					search_class_name='';
					search_class_cnic='';
					search_class_mobile='';
					search_class_number_plate='';
					search_class_name='';
					search_value_name=$('#name').val().toLowerCase();
					if(search_value_name!=""){
						if(value.name.toLowerCase().includes(search_value_name)) {
							search_class_name='search';	
						}	
					}
					
					search_class='';
					html+='<tr>\
						<td class=\"'+search_class_name+'\"><span >'+value.name+'</span></td>\
						<td class=\"'+search_class_cnic+'\"><span >'+value.cnic+'</span></td>\
						<td class=\"'+search_class_mobile+'\"><span >'+value.mobile+'</span></td>\
						<td class=\"'+search_class+'\"><span >'+value.mode_transport+'</span></td>\
						<td class=\"'+search_class_number_plate+'\"><span >'+value.number_plate+'</span></td>\
						<td><span >'+formatDate(value.date_from)+'</span></td>\
						<td><span >'+formatDate(value.date_to)+'</span></td>\
						<td><span >'+value.time+'</span></td>';
					<?php 
					$session_data=$this->session->userdata('logged_in');
					if($session_data['login_user_type']!="TENANT" && $session_data['login_user_type']!="SUPER"){
					?>
						html+='<td ><a href="<?php echo base_url();?>/visitor/addvisitor/'+value.id+'" title="Issue Card"><i class="fa fa-address-card-o fa-2x"></i></a></td>';
					<?php
					}								
					?>
					
					html+='</tr>';
				});
				html+='</tbody></table>';
				
			},async: false
			
			
		});
		
		return html;
		// `d` is the original data object for the row
		/*return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
			'<tr>'+
				'<td>Full name:</td>'+
				'<td>'+d.title+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extension number:</td>'+
				'<td>'+d.agenda+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extra info:</td>'+
				'<td>And any further details here (images etc)...</td>'+
			'</tr>'+
		'</table>';*/
	}

$(document).ready(function() {


    //locations listing...
    $('.listlocationtable').dataTable( {
//               "aaSorting": [[4,'desc']]
        "lengthMenu": [[25, 50, 100], [25, 50, 100]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true

        ,"aoColumns":[
            {"mDataProp":"location"}
            ,{"mDataProp":"created_datetime","bSortable": true}
            ,{"mDataProp":"issue_card","bSortable": true}
            ,{"mDataProp":"action","bSortable": false}
//                   ,{"mDataProp":"delete","bSortable": false}
        ]
        ,"sAjaxSource": "<?php echo base_url().'location/get_ajax_locations';  ?>"

    } );




    $('.listusertable').dataTable( {
//               "aaSorting": [[4,'desc']]
        "lengthMenu": [[25, 50, 100], [25, 50, 100]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true

        ,"aoColumns":[
            {"mDataProp":"first_name"}
            ,{"mDataProp":"last_name"}
            ,{"mDataProp":"email"}
            //if(Settings.super_admin){
            ,{"mDataProp":"status"}
            ,{"mDataProp":"type"}
            //}
            ,{"mDataProp":"created_datetime","bSortable": true}
            ,{"mDataProp":"action","bSortable": false}
//                   ,{"mDataProp":"delete","bSortable": false}
        ]
        ,"sAjaxSource": "<?php echo base_url().'user/get_ajax_users';  ?>"

//            ,"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
//                $('td:eq(1)', nRow).addClass('imagecenter');
//                $('td:eq(5)', nRow).addClass('imagecenter');
//                $('td:eq(2)', nRow).addClass('after');
//                $('td:eq(2)', nRow).attr('title', 'your new title');
//                return nRow;
//            }

    } );


    $('.uservisitdetailstable').dataTable( {
//               "aaSorting": [[4,'desc']]
        "lengthMenu": [[25, 50, 100, 500, 1000, 2000, 30000,4000,5000,6000,7000,8000,9000], [25, 50, 100, 500, 1000, 2000, 3000,4000,5000,6000,7000,8000,9000]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true

        ,"aoColumns":[
            {"mDataProp":"visitor_name","bSortable": false}
            ,{"mDataProp":"visitor_cell_no","bSortable": false}
            ,{"mDataProp":"identity_type","bSortable": false}
            ,{"mDataProp":"visitor_identity_no","bSortable": false}
            ,{"mDataProp":"visit_reason","bSortable": false}
            ,{"mDataProp":"visit_transport_mode","bSortable": false}
            ,{"mDataProp":"visit_transport_registration_no","bSortable": false}
            ,{"mDataProp":"visit_to_tenant","bSortable": false}
            ,{"mDataProp":"visit_to_employee","bSortable": false}
            ,{"mDataProp":"visit_issued_card","bSortable": false}
            ,{"mDataProp":"visit_from_company","bSortable": false}
            //if(Settings.super_admin){
            ,{"mDataProp":"action","bSortable": false}
            ,{"mDataProp":"user_id","bSortable": false}
            //}
            ,{"mDataProp":"created_datetime","bSortable": false}
//                   ,{"mDataProp":"delete","bSortable": false}
        ]
        <?php if($session_data['login_user_type']=="SUPER"){ ?>
        ,"dom": 'lBfrtip'
        ,"buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
//                           'copy',
                    'excel',
//                           'csv',
//                           'pdf',
//                           'print'
                ]
            }
        ]
        <?php } ?>
        ,"sAjaxSource": "<?php echo base_url().'user/get_ajax_user_visit_details';  ?>"

//            ,"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
//                $('td:eq(1)', nRow).addClass('imagecenter');
//                $('td:eq(5)', nRow).addClass('imagecenter');
//                $('td:eq(2)', nRow).addClass('after');
//                $('td:eq(2)', nRow).attr('title', 'your new title');
//                return nRow;
//            }

    }).
//        columnFilter({
//        sPlaceHolder: "head:before",
//        aoColumns: [
//            null,
//            null,
//            { sSelector:"#renderingActionFilter", type: "select",values:["CHECK_IN","CHECK_OUT"] },
//            { sSelector:"#renderingByUserFilter",type: "select",values:getUsers() },
//            { sSelector:"#renderingDateFilter",type: "date-range" },
//        ]
//
//    });
        yadcf([
            {column_number : 2, filter_type:"select" ,filter_container_id: "renderingActionFilter",filter_default_label: "Action", data: ["CHECK_IN", "CHECK_OUT"]},
            {column_number : 3, filter_container_id: "renderingByUserFilter",filter_default_label: "Add By User", data:getUsers() },
            {column_number : 4, filter_type:"range_date", filter_container_id: "renderingDateFilter",date_format: 'YYYY-MM-DD HH',datepicker_type: 'bootstrap-datetimepicker',filter_default_label: "Created Date",vertical: 'top'},

        ]);

    //visitors listing...
    $('.visitor_listing').dataTable( {
//               "aaSorting": [[4,'desc']]
        "lengthMenu": [[25, 50, 100], [25, 50, 100]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true

        ,"aoColumns":[
            {"mDataProp":"visitor_picture","bSortable": false}
            ,{"mDataProp":"visitor_identity_no"}
//                   ,{"mDataProp":"visitor_family_no","bSortable": false}
            ,{"mDataProp":"visitor_name"}
//                   ,{"mDataProp":"visitor_father_name","bSortable": false}
            ,{"mDataProp":"visitor_address","bSortable": false}
            ,{"mDataProp":"visitor_cell_no","bSortable": false}
            //if(Settings.super_admin){
//                   ,{"mDataProp":"visitor_district","bSortable": false}
            ,{"mDataProp":"visitor_city","bSortable": false}
//                   ,{"mDataProp":"visitor_registration_mode","bSortable": false}
            //}
            ,{"mDataProp":"created_datetime","bSortable": true}
            ,{"mDataProp":"edit","bSortable": false}
//                   ,{"mDataProp":"delete","bSortable": false}
        ]
        ,"aaSorting": [[6,'DESC']]
        ,"sAjaxSource": "<?php echo base_url().'visitor/get_ajax_visitors';  ?>"

    } ).
//        columnFilter({
//        sPlaceHolder: "head:before",
//        aoColumns: [
//            null,
//            null,
//            { sSelector:"#renderingNameFilter", type: "text"},
//            null,
//            { sSelector:"#renderingCellNoFilter",type: "text" },
//            { sSelector:"#renderingCityFilter",type: "text" },
//            null,
//            null
//        ]
//
//    });
        yadcf([
            {column_number : 2,filter_type:"text",filter_container_id: "renderingNameFilter",filter_default_label: "Visitor Name"},
            {column_number : 4,  filter_type: "text", filter_container_id: "renderingCellNoFilter",filter_default_label: "Visitor Cell No"},
            {column_number : 5, filter_type:"text", filter_container_id: "renderingCityFilter",filter_default_label: "Visitor City"},

        ]);
		
		
		
		
		
		

    //visits listing...
    visittable=$('.visit_listings').dataTable( {
//               "aaSorting": [[4,'desc']]
        "lengthMenu": [[25, 50, 100, 500, 1000, 2000, 3000], [25, 50, 100, 500, 1000, 2000, 3000]]
        ,"processing": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true
        ,searchHighlight : true
        ,stateSave: true
        ,"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'

        ,"aoColumns":[
            {"mDataProp":"visitor_picture","bSortable": false}
            ,{"mDataProp": "visitor_name"}
            ,{"mDataProp":"visitor_cell_no","bSortable": false}
            ,{"mDataProp":"identity_type"}
            ,{"mDataProp":"identity_no"}
            ,{"mDataProp":"visit_reason","bSortable": false}
            ,{"mDataProp":"visit_transport_mode","bSortable": false}
            ,{"mDataProp":"visit_transport_registration_no","bSortable": false}
            ,{"mDataProp":"visit_to_tenant","bSortable": false}
            ,{"mDataProp":"visit_to_employee","bSortable": false}
            ,{"mDataProp":"visit_issued_card","bSortable": false}
            ,{"mDataProp":"visit_from_company","bSortable": false}
            ,{"mDataProp":"visit_checkin","bSortable": false}
            ,{"mDataProp":"visit_checkout","bSortable": false}
            ,{"mDataProp":"visit_date","bSortable": true}
            ,{"mDataProp":"location","bSortable": false}
            ,{"mDataProp":"status","bSortable": false}
//                   ,{"mDataProp":"next_location","bSortable": false}
            ,{"mDataProp":"action","bSortable": false}
//                   ,{"mDataProp":"delete","bSortable": false}
        ]
        <?php if($session_data['login_user_type']=="SUPER"){ ?>
        
        ,"buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
//                           'excel',
                    {
                        extend: "excel",
                        text: 'Excel',
                        exportOptions: {
                            "columns": [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15 ]
                        }

                    },
                    {
                        extend: "print",
                        text: 'Print',
                        exportOptions: {
                            "columns": [ 1,2,3,4,5,6,7,8,9,10,11,12,14,15 ]
                        }

                    },
//                           'copy',

//                           'csv',
//                           'pdf',
//                           'print'
                ]
            }
        ]
        <?php } ?>

        ,"aaSorting": [[14,'DESC']]
        ,"sAjaxSource": "<?php echo base_url().'visit/get_ajax_visits_list';  ?>"
        ,"fnServerData": function ( sSource, aoData, fnCallback ) {

            $.getJSON( sSource, aoData, function (json) {
                if(json.critical > 0) {
                	
                    $("#critical_rows").show();
                    $("#critical_msg").html("<div style='cursor:pointer' id='load_critical'>Number of critical visit are <b>" + json.critical + "</b></div>");
                    $("#critical_msg1").html("<div style='cursor:pointer'> <b>" + json.critical + "</b></div>");
                }else{
                    $("#critical_rows").hide();
                }
                fnCallback(json)
            } );
        }
        ,"fnDrawCallback": function () {
			
		}
        ,"fnRowCallback": function( nRow, aData, iDisplayIndex) {
            var endTime = new Date();
            visit_date = aData.visit_checkin;
            //visit_date = visit_date.replace(/-/g, '/');
            visit_checkout_date = aData.visit_checkout.replace(/-/g, '/');
//                   console.log(visit_checkout_date);
            var startTime = new Date(visit_date);
            //var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds



			if (endTime < startTime)
			{
			endTime.setDate(endTime.getDate() + 1);
			}

			var difference = endTime - startTime;




            var resultInMinutes = Math.floor(difference / 3600000); 
            var timestamp=Date.parse(visit_checkout_date);
            if (isNaN(timestamp)==false) {
//                        console.log("good");
            }
            //console.log(startTime);
            console.log(difference);
            console.log("mm="+resultInMinutes);
            if(resultInMinutes >= 10  && isNaN(timestamp)==true){
                $('td', nRow).closest('tr').css('background', '#ED4337');
            }
            return nRow;
        }

    } ).yadcf([
            {column_number : 1,filter_type:"text",filter_container_id: "renderingNameFilter",filter_default_label: "Visitor Name"},
            {column_number : 2,  filter_type: "text", filter_container_id: "renderingCellNoFilter",filter_default_label: "Visitor Cell No"},
            {column_number : 4, filter_type:"text", filter_container_id: "renderingIdentityNoFilter",filter_default_label: "Visitor Identity No"},
            {column_number : 7, filter_type:"text", filter_container_id: "renderingVehicleNoFilter",filter_default_label: "Visitor Vehicle No"},
            {column_number : 8 ,filter_container_id: "renderingTenantFilter",filter_default_label: "Branch",data:getTenants()},
            {column_number : 10, filter_type:"text", filter_container_id: "renderingIssuedCardFilter",filter_default_label: "Issued Card"},
            {column_number : 11, filter_type:"text", filter_container_id: "renderingCompanyFromFilter",filter_default_label: "Company From"},
            {column_number : 13, filter_container_id: "renderingCheckoutFilter",filter_default_label: "Check Out", data: ["Not Checkout", "Critical"]},
            {column_number : 14, filter_type:"range_date", filter_container_id: "renderingDateFilter",date_format: 'YYYY-MM-DD',datepicker_type: 'bootstrap-datetimepicker',filter_default_label: "Visit Date"},
            {column_number : 15, filter_container_id: "renderingLocationFilter",filter_default_label: "Location",data:getLocations()}

        ]);
    <?php
    if(!empty($_POST) && $_POST['date']!=''){
    	$date=$_POST['date'];
    ?>
    yadcf.exFilterColumn(visittable, [
     [14, {
        from: "<?php echo $date; ?>",
        to: "<?php echo $date; ?>"
    }]
   ]); 
    <?php
	}
    ?>



    var dataTable=$('.visit_listing_dashboard').dataTable( {
        "lengthMenu": [[25, 50, 100], [25, 50, 100]]
        ,"processing": true
        ,"searchHighlight": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true

        ,"aoColumns":[
            {"mDataProp":"visitor_name"}
            ,{"mDataProp":"visitor_address","sClass": "category"}
            ,{"mDataProp":"visitor_cell_no"}
            ,{"mDataProp":"identity_type"}
            ,{"mDataProp":"identity_no"}
            ,{"mDataProp":"visit_reason","bSortable": true}
            ,{"mDataProp":"visit_from_company","bSortable": true}
            ,{"mDataProp":"visit_transport_mode","bSortable": true}
            ,{"mDataProp":"visit_transport_registration_no","bSortable": true}
            ,{"mDataProp":"visit_issued_card","bSortable": true}
            ,{"mDataProp":"visit_checkin","bSortable": false}
            ,{"mDataProp":"visit_checkout","bSortable": false}
            ,{"mDataProp":"visit_date","bSortable": true}
            ,{"mDataProp":"location","bSortable": false}
//                   ,{"mDataProp":"next_location","bSortable": false}
//                   ,{"mDataProp":"action","bSortable": false}
//                   ,{"mDataProp":"delete","bSortable": false}
        ]

        ,"aaSorting": [[12,'DESC']]
        ,"sAjaxSource": "<?php echo base_url().'visit/get_ajax_visits_list_dashboard';  ?>/"+$('#type').val()
        ,"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            var endTime = new Date();
            visit_date = aData.visit_date;
            visit_date = visit_date.replace(/-/g, '/');
            visit_checkout_date = aData.visit_checkout.replace(/-/g, '/');
//                   console.log(visit_checkout_date);
            var startTime = new Date(visit_date);
            var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
            var resultInMinutes = Math.round(difference / 3600000);
            var timestamp=Date.parse(visit_checkout_date);
            if (isNaN(timestamp)==false) {
//                        console.log("good");
            }
            if(resultInMinutes>12 && aData.next_location!='' && isNaN(timestamp)==true){
                $('td', nRow).closest('tr').css('background', '#ED4337');
            }

            return nRow;
        }

    } );
//               .columnFilter({
//               sPlaceHolder: "head:before",
//               aoColumns: [
//                   { sSelector:"#renderingNameFilter", type: "text"},
//                   null,
//                   //if(Settings.super_admin){
//                   { sSelector:"#renderingCellNoFilter",type: "text" },
////                   null,
////                   null,
//                   null,
//                   null,
//                   null,
//                   null,
//                   null,
//                   null,
//                   { sSelector:"#renderingIssuedCardFilter", type: "text"},
//                   null,
//                   null,
//                   { sSelector:"#renderingDateFilter",type: "date-range" },
//                   { sSelector:"#renderingLocationFilter", type: "select",values:getLocations() },
//                   //}
//
//               ]
//
//           });

    //visitor full track listing...
    var visitorfulltrackdataTable=$('.visitor_full_track_listing').dataTable( {
        "lengthMenu": [[10, 50, 100], [10, 50, 100]]
        ,"processing": true
        ,"fixedHeader": true
        ,"searchHighlight": true
        ,"serverSide": true
        ,"sPaginationType": "full_numbers"
        ,"bJQueryUI":true
        ,"aoColumns":[
            {"mDataProp":"visitor_name","bSortable": false}
            ,{"mDataProp":"visitor_location","bSortable": false}
            ,{"mDataProp":"action","bSortable": false}
            ,{"mDataProp":"created_datetime","bSortable": false}

        ]

        ,"sAjaxSource": "<?php echo base_url().'visitor/get_ajax_full_visit_track/';  ?>"+$("#visitor_id").val()
        ,"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            visitor_name = aData.visitor_name;
            var i=0;
            if(visitor_name.indexOf("Visit #") > -1){

//                       console.log(nRow);
                $('td:eq(1)',nRow).remove();
                $('td:eq(2)',nRow).remove();
//                       $('td:eq(3)',nRow).remove();
                $('td:eq(0)',nRow).attr('colspan',3).closest('tr').css('background', '#E0EEE0').addClass("odd");
                $('td:eq(0)',nRow).css('border-right','none');
                $('td:eq(1)',nRow).css('border-left','none');
            }
            return nRow;
        }

    } ).
//        columnFilter({
//        sPlaceHolder: "head:before",
//        aoColumns: [
//            null,
//            null,
//            null,
//            { sSelector:"#renderingTimeFilter",type: "date-range" },
//        ]
//
//    });
        yadcf([
            {column_number : 3, filter_type:"range_date", filter_container_id: "renderingTimeFilter",date_format: 'YYYY-MM-DD HH',datepicker_type: 'bootstrap-datetimepicker',filter_default_label: "Date"},

        ]);

//           new $.fn.dataTable.FixedHeader( visitorfulltrackdataTable );

    $(".dataTables_filter").hide();
    $("#list_visits_filter").hide();
    $("#list_visitors_filter").hide();

} );

var location_options=[];
function getLocations(){
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>location/get_locations_for_filter",
        success: function(data) {
            arr=data.split(",");
            for (i = 0; i < arr.length; i++){
                location_options[i]=arr[i];
            }
        },
        async: false

    });
    return location_options;
}

var tenant_options=[];
function getTenants(){
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>tenant/get_tenants_for_filter",
        success: function(data) {
        	tenant_options = JSON.parse(data);
        	//console.log(tenant_options[0].id);
            // arr=data.split(",");
            // for (i = 0; i < tenant_options.length; i++){

            //     tenant_options[i]=arr[i];
            // }
        },
        async: false

    });
    return tenant_options;
}


var user_options=[];
function getUsers(){
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>user/get_users_for_filter",
        success: function(data) {
            arr=data.split(",");
            for (i = 0; i < arr.length; i++){
                user_options[i]=arr[i];
            }
        },
        async: false

    });
    return user_options;
}


function opencolorbox(href){
    $.colorbox({innerWidth: 785, innerHeight: 350,href: "<?php echo base_url(); ?>visit/"+href});
}
function opencolorboximage(href){
    $.colorbox({innerWidth: 785, innerHeight: 350,href: href});
}

function open_track(href){
    $.colorbox({iframe:true, innerWidth: 785, innerHeight: 350,href: href});
}

function open_visit_info(href,next,prev){
    $.colorbox({iframe:true, innerWidth: 785, innerHeight: 450,href: href+"?next="+next+"&&prev="+prev});
}

$(document).ready(function(e) {
    $(".date_range_filter").change(function () {
        from = $('#list_visits12_range_from_13').val();
        to = $('#list_visits12_range_to_13').val();
        if(from==""){
            from = new Date();
        }
        if(to==""){
            to = new Date();
        }

        var date1 = new Date(from);
        var date2 = new Date(to);
        console.log(date1);
        console.log(date2);
        if (date1 <= date2) {
            console.log('good');
        }else {
            $('#list_visits12_range_to_13').val("");
//                $('.date_range_filter').val("");
            console.log('bad');
        }

    })

    $("#visitor_type").change(function(){
        $('#visitor_identity_no').unmask('00000-0000000-0');
        if($('#visitor_type').val()=="visitor_identity_no") {
            $('#visitor_identity_no').mask('00000-0000000-0');
        }
    });

    if($('#visitor_type').val()=="visitor_identity_no") {
        $('#visitor_identity_no').mask('00000-0000000-0');
    }

    $("#critical_rows").click(function(){
        $('#yadcf-filter--visit_listings-13').val("Critical");
        $('#yadcf-filter--visit_listings-13').trigger("change");

    });

	
	
//    $("#critical_msg1").click(function(){
//        $('#yadcf-filter--visit_listings-13').val("Critical");
//        $('#yadcf-filter--visit_listings-13').trigger("change");
//
//    });
});

function get_employees(value,employee_id=''){
	console.log(employee_id);
	var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>tenant/get_tenant_employees/",
        data: "tenant="+value+"&csrf_test_name="+ csrf_value,
        success: function(data) {
            $('#visit_to_employee').empty();
            tenants = JSON.parse(data);
            var option = "";
            
            option += '<option value="">Select One</option>';
            $.each( tenants, function( key, val ) {

				if(employee_id==val.id){
					add_class="selected=selected";
				}else{
					add_class="";
				}
                option += '<option '+add_class+' value="'+ val.id + '">' + val.employee_name + '</option>';
            });
            
            $('#employee_id').html(option);
            $('#employee_id').trigger("chosen:updated");
        },
        async: false

    });
//        return user_options;
}

$('#cnic_no').mask('00000-0000000-0');	
$('#yadcf-filter--private_visits_listing-1').mask('00000-0000000-0');	

//    $( "#clear_search" ).click(function() {
//        $('.text_filter').val("");
//        $('.text_filter').blur();
//    });

/*jQuery.ajaxSetup({
      beforeSend: function (x, o)
      {
          o.data = o.data + "&<?php echo $this->security->get_csrf_token_name(); ?>=" + jQuery.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>');
      },
  });*/

function populateBranch(type)
{
	if(type == 'TENANT')
	{
		$('#userBranch').show();
	}else{
			$('#userBranch').hide();
	     }

	var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
        method: "POST",
        url: "<?php echo base_url();?>tenant/get_branches/",
        data: "csrf_test_name="+ csrf_value,
        success: function(data) 
        {
            $('#branch_id').empty();
            tenants = JSON.parse(data);

            var option = "";
            
            //option += '<option value="">Select One</option>';
            $.each( tenants, function( key, val ) 
            {

				// if(employee_id==val.id){
				// 	add_class="selected=selected";
				// }else{
				// 	add_class="";
				// }
                option += '<option  value="'+ val.id + '">' + val.tenant_name + '</option>';
            });
            
            $('#branch_id').html(option);
            //$('#branchesDD').trigger("chosen:updated");
        },
        async: false

    });
}
</script>



<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="<?= base_url() ?>assets/js/main.js"></script>
<!--/ custom javascripts -->


</body>
</html>
