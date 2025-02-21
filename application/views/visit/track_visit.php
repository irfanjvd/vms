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

if (!empty($track_info)) {

    $visitor = $track_info['visitor'][0];
    $logs = $track_info['logs'];
    $uniqueIds = array_unique(array_column($logs, 'visit_id_fk'));
    $uniqueCount = count($uniqueIds);

    $count = count($logs);


    date_default_timezone_set('Asia/Karachi');
    if ($count > 1 ) {
        if ($logs[0]['visit_id_fk'] != $logs[1]['visit_id_fk']) {
            $end_date = date("Y-m-d H:i:s", time());
            $visit_status = "<font color='orange'>IN PROGRESS</font>";
        } else {
            $start_date = $logs[0]['created_datetime'];
            $start_action = $logs[0]['action'];
            $end_date = $logs[1]['created_datetime'];
            $end_action = $logs[1]['action'];

            if ($start_action == "CHECK_OUT" && $end_action == "CHECK_IN") {
                $visit_status = "<font color='green'>COMPLETED</font>";
            } else {
                $visit_status = "<font color='orange'>IN PROGRESS</font>";
            }
        }
    } else {
        $visit_status = "<font color='orange'>PENDING</font>";
    }
    ?>
    <h2>Visitor Track</h2>

    <table width="100%">
        <tr>
            <th style="text-align: left">Visitor Name</th>
            <th style="text-align: left">CNIC</th>
            <th style="text-align: left">Total visits</th>
            <th style="text-align: left">Latest Visit Status</th>
            <td rowspan="2"><img src="<?php echo $visitor['visitor_picture']; ?>" width="80px" alt="no image"></td>
        </tr>
        <tr>
            <td><?php echo $visitor['visitor_name']; ?></td>
            <td><?php echo $visitor['visitor_identity_no']; ?></td>
            <td><?php echo $uniqueCount; ?></td>
            <td><?php echo $visit_status; ?></td>


        </tr>
    </table>
    <table class="customers">
        <tbody>
        <!--<tr>
            <th>Visitor Name</th>
            <th>Location</th>
            <th>Action</th>
            <th>By User</th>
            <th>Time</th>

        </tr>-->
        <tr>
            <th>Officer Name</th>
            <th>Branch Name</th>
            <th>Visit Type</th>
            <th>Status</th>
            <th>Time</th>

        </tr>
        <?php if ($count) { ?>
        <?php foreach ($logs as $key => $val) { ?>
        <tr>
            <td>
                <?php echo $val['officer_name']; ?>
            </td>
            <td>
                <?php echo $val['location_title']; ?>
            </td>
            <td>
                <?php echo $val['visit_type']; ?>
            </td>
            <td>
                <?php echo str_replace("_", " ", $val['action']); ?>
            </td>
            <td>
                <?php echo $val['created_datetime']; ?>
            </td>
        <tr>
        <?php }} else { ?>
        <tr>
            <td colspan="5">
                <?php echo 'No Visit Entry'; ?>
            </td>
        </tr>
        <?php }  ?>
        </tbody>
    </table>
    <?php
    /*$date1 = $end_date;
    $date2 = $start_date;
    $diff = strtotime($date1) - strtotime($date2);
    $diff_in_hrs = $diff / 3600;
    if ($diff_in_hrs < 1) {
        echo "<br><b>Total Visit Duration : </b> " . round(abs($diff) / 60, 2) . " Minutes";
    } else {
        echo "<br><b>Total Visit Duration : </b> " . round(abs($diff) / 3600, 2) . " Hours";
    }

    echo "<br><br>";
    echo "<b>Visit Status : </b>$visit_status";*/

} else {
    echo "<b>No Record Found!!!</b>";
}
?>