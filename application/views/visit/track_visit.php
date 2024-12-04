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

</style>
<?php

if(!empty($track_info)) {
    $count=count($track_info);
    $start_date=$track_info[0]['created_datetime'];
    $start_location_title=$track_info[0]['location_title'];
    $start_action=$track_info[0]['action'];
    $end_date=$track_info[$count-1]['created_datetime'];
    $end_location_title=$track_info[$count-1]['location_title'];
    $end_action=$track_info[$count-1]['action'];
    date_default_timezone_set('Asia/Karachi');
    if($count-1==0){
        $end_date=date("Y-m-d H:i:s",time());
        $visit_status="<font color='orange'>IN PROGRESS</font>";
    }else{
        if($start_action=="CHECK_IN" && $end_action=="CHECK_OUT" && $start_location_title==$end_location_title){
            $visit_status="<font color='green'>COMPLETED</font>";
        }else{
            $visit_status="<font color='orange'>IN PROGRESS</font>";
        }
    }
    ?>
    <h2>Visitor Track</h2>
    <table class="customers">
        <tbody>
        <tr>
            <th>Visitor Name</th>
            <th>Location</th>
            <th>Action</th>
            <th>By User</th>
            <th>Time</th>

        </tr>
        <?php
        foreach ($track_info as $key => $val) {
            ?>
                <tr>
                    <td>
                        <?php echo $val['visitor_name']; ?>
                    </td>
                    <td>
                        <?php echo $val['location_title']; ?>
                    </td>
                    <td>
                        <?php echo str_replace("_"," ",$val['action']); ?>
                    </td>
                    <td>
                        <?php echo $val['first_name']." ".$val['last_name']; ?>
                    </td>
                    <td>
                        <?php echo $val['created_datetime']; ?>
                    </td>
                <tr>
                <?php

        }
        ?>
        </tbody>
    </table>
<?php
    $date1 = $end_date;
    $date2 = $start_date;
    $diff = strtotime($date1) - strtotime($date2);
    $diff_in_hrs = $diff/3600;
    if($diff_in_hrs<1){
        echo "<br><b>Total Visit Duration : </b> ".round(abs($diff) / 60,2). " Minutes";
    }else {
        echo "<br><b>Total Visit Duration : </b> ".round(abs($diff) / 3600,2). " Hours";
    }

    echo "<br><br>";
    echo "<b>Visit Status : </b>$visit_status";
}else{


    echo "<b>No Record Found!!!</b>";
}
?>