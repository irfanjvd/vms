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
    .customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .btn-success {
        background-color: #5cb85c;
        border-color: #4cae4c;
        color: #fff;
    }
    .btn {
        border-radius: 0;
        outline: 0 none !important;
        -moz-user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857;
        margin-bottom: 0;
        padding: 6px 12px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

</style>
<?php
//echo "<pre>";
//print_r($visit_info);
if(!empty($visit_info)) {
    $visit_id=$visit_info['visit_id'];
    $next_result=$this->db->query("select * from visit where visit_id = (select min(visit_id) from visit where visit_id > $visit_id)")->row_array();
    $prev_result=$this->db->query("select * from visit where visit_id = (select max(visit_id) from visit where visit_id < $visit_id)")->row_array();

//    echo $result->visit_id;

    ?>
    <h2>Visit Info</h2>
    <img src="<?php echo $visit_info['visitor_picture'];  ?>" width="200" height="150">
    <br>
    <br>
    <table class="customerss" style="width: 100%">
        <tbody>
        <tr>
            <td><b>Visitor Name : </b></td>
            <td><?php echo $visit_info['visitor_name'];  ?></td>
            <td><b>Visit Type : </b></td>
            <td><?php echo $visit_info['visit_type'];  ?></td>
        </tr>
        <tr>
            <td><b>Branch : </b></td>
            <td><?php echo $visit_info['tenant_name'];  ?></td>
            <td><b>Officer : </b></td>
            <td><?php echo $visit_info['officer_name'];  ?></td>
        </tr>
        <tr>
            <td><b>Transport : </b></td>
            <td><?php echo $visit_info['visit_transport_mode'];  ?></td>
            <td><b>Transport Number : </b></td>
            <td><?php echo $visit_info['visit_transport_registration_no'];  ?></td>
        </tr>
        <tr>
            <td><b>Visitor Cell : </b></td>
            <td><?php echo $visit_info['visitor_cell_no'];  ?></td>
            <td><b>Visit Reason : </b></td>
            <td><?php echo $visit_info['visit_reason'];  ?></td>
        </tr>
        <tr>
            <td><b>Visit From Company : </b></td>
            <td><?php echo $visit_info['visit_from_company'];  ?></td>
            <td><b>No. of Minors: </b></td>
            <td><?php echo $visit_info['number_of_minors'];  ?></td>
        </tr>
        <tr>
            <td><b>Identity Type : </b></td>
            <td>
                <?php
                if($visit_info['identity_type']=="visitor_identity_no"){
                    echo "CNIC";
                }elseif($visit_info['identity_type']=="visitor_employee_card"){
                    echo "Employee Card";
                }elseif($visit_info['identity_type']=="visitor_driving_license"){
                    echo "Driving License";
                }elseif($visit_info['identity_type']=="visitor_passport_id"){
                    echo "Passport ID";
                }

                ?>
            </td>
            <td><b>Identity Number : </b></td>
            <td><?php
                if($visit_info['identity_type']=="visitor_identity_no"){
                    echo $visit_info['visitor_identity_no'];
                }elseif($visit_info['identity_type']=="visitor_employee_card"){
                    echo $visit_info['visitor_employee_card'];
                }elseif($visit_info['identity_type']=="visitor_driving_license"){
                    echo $visit_info['visitor_driving_license'];
                }elseif($visit_info['identity_type']=="visitor_passport_id"){
                    echo $visit_info['visitor_passport_id'];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Visit CHECK IN : </b></td>
            <td><?php echo $visit_info['visit_checkin'];  ?></td>
            <td><b>Visit CHECK OUT : </b></td>
            <td><?php echo (isset($visit_info['visit_checkout']) && $visit_info['visit_checkout']!="")?
                    $visit_info['visit_checkout'] : "No Action";  ?></td>
        </tr>

        </tbody>
    </table>
    <?php
    if(!empty($prev_result)){
        ?>
        <a class="btn btn-success" style="text-decoration: none" href="<?php echo base_url().'visit/visit_info/'.$prev_result['visit_id']; ?>" id="prev">Previous</a> |
    <?php
    }
    if(!empty($next_result)){
        ?>
        <a class="btn btn-success" style="text-decoration: none" href="<?php echo base_url().'visit/visit_info/'.$next_result['visit_id']; ?>" id="next">Next</a>
    <?php
    }
    ?>
<?php
}else{


    echo "<b>No Record Found!!!</b>";
}
?>

<script>
    document.onkeydown = function(e) {
        switch (e.keyCode) {
            case 37:
                var prev = document.getElementById('prev');
                prev.click();
                //alert('left');
                break;
            case 38:
                //alert('up');
                break;
            case 39:
                //alert('right');
                var next = document.getElementById('next');
                next.click();
                break;
            case 40:
                //alert('down');
                break;
        }
    };
</script>