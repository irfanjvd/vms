<style>
    .customers {
        font-size: 16px;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }
    .customers th {
        padding-top: 11px;
        padding-bottom: 11px;
        background-color: #2da5da;
        color: white;
    }
    .customers td, .customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        /*width:200px;*/
    }
    /*.customers tr:nth-child(even) {*/
        /*background-color: #f2f2f2;*/
    /*}*/

</style>
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

      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            <input type="hidden" id="visitor_id" value="<?php echo $visitor_id; ?>">
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong>Visitor </strong>Track</h1>

<!--                <input type="button" value="Print Track" onclick="printDiv('print_data')" style="float:right;">-->
                <i class="fa fa-print fa-2x" onclick="printDiv('col-sm-12')" style="float:right; cursor: pointer" title="Print Visitor Track"></i>
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">
              <div class="table-responsive">
                  <h4>Search By:</h4>
                  <!--                      <input type="submit" name="submit" value="Export"></div>-->

                  <div class="row">
                      <div class="col-xs-3">
                          <p id="renderingTimeFilter"></p>
                      </div>
                  </div>
<!--                  <table style="width: 60%">-->
<!--                      <tr id="filter_global">-->
<!--                          <td>Search By: </td>-->
<!--                          <td style="padding:10px;" class="custom_filters" align="center"> <p id="renderingTimeFilter"></p></td>-->
<!---->
<!--                      </tr>-->
<!--                  </table>-->
                  <div id="print_data">
                  <table class="customers visitor_full_track_listing">
                      <thead class="custom-font">
                      <tr role="row">
                          <th>Visitor Name</th>
                          <th>Location</th>
                          <th>Action</th>
                          <th>Date</th>

                      </tr>
                      </thead>
                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                      <?php
//                      $visit_number=1;
//                      $i=1;
//                      $first_action='';
//                      $total_records=count($track_info);
//                      foreach ($track_info as $key => $val) {
//                      if($val['action']=="CHECK_IN"){
//                          if($first_action!="CHECK_IN") {
//                              $first_action = "CHECK_IN";
//                              $first_location = $val['location_title'];
//                              $visit_status = "start";
//                          }
//                      }else{
//                          $next_action=$val['action'];
//                          $next_location=$val['location_title'];
//                          if($next_action=="CHECK_OUT" && $next_location==$first_location){
//                              $visit_status="end";
//                              $first_action='';
//                              $visit_number++;
//                          }
//                      }
//
//                      if($i==1) {
//                              ?>
<!--                              <tr style="background-color: lightgreen;">-->
<!--                                  <td colspan="4"><b>Visit # --><?php //echo $visit_number; ?><!--</b></td>-->
<!--                              </tr>-->
<!--                          --><?php
//                          }
//                       ?>
<!--                      <tr>-->
<!--                          <td>-->
<!--                              --><?php //echo $val['visitor_name']; ?>
<!--                          </td>-->
<!--                          <td>-->
<!--                              --><?php //echo $val['location_title']; ?>
<!--                          </td>-->
<!--                          <td>-->
<!--                              --><?php //echo str_replace("_"," ",$val['action']); ?>
<!--                          </td>-->
<!--                          <td>-->
<!--                              --><?php //echo $val['created_datetime']; ?>
<!--                          </td>-->
<!--                      <tr>-->
<!--                      --><?php
//
//                         if($total_records!=$i && $visit_status=="end") {
//                             ?>
<!--                             <tr style="background-color: lightgreen;">-->
<!--                                 <td colspan="4"><b>Visit # --><?php //echo $visit_number; ?><!--</b></td>-->
<!--                             </tr>-->
<!--                         --><?php
//                         }
//
//                          $i++;
//                      }
                          ?>
                      </tbody>
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
  <!--/ CONTENT --> 
<script>
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = $('.'+divID).html();
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }

</script>

