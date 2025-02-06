<section id="content">
    <div class="page page-dashboard">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> VMS</a></li>
                    <li><a href="<?php echo base_url() . 'visitor/'; ?>"><i class="fa fa-dashboard"
                                                                            style="margin-right:6px;"></i>Dashboard</a>
                    </li>
                    <li></li>
                </ul>

            </div>
            <h2>Black listed <span>VMS - Visitors Management System</span></h2>
        </div>


        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile">

                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong> </strong>Black listed</h1>

                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body table-custom">

                        <?php if ($this->session->flashdata('error')) {
                            echo "<p style='color:#ff0000' >" . $this->session->flashdata('error') . "</p>";
                        } ?>

                        <?php if ($this->session->flashdata('success')) {
                            echo "<p style='color:#0ad41d' >" . $this->session->flashdata('success') . "</p>";
                        } ?>


                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>CNIC</th>
                                <th>Blacklist by</th>
                                <th>Blacklist date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($record) && is_array($record)) {
                                if ($this->uri->segment(3)) {
                                    $loopIndex = ($per_page * ($this->uri->segment(3) - 1)) + 1;
                                } else {
                                    $loopIndex = 1;
                                }
                                foreach ($record as $rec) {

                                    ?>
                                    <tr>
                                        <td><?php echo $loopIndex; ?></td>
                                        <td><?php echo $rec->visitor_name; ?></td>
                                        <td><?php echo $rec->visitor_cnic; ?></td>
                                        <td><?php echo $rec->first_name . " " . $rec->last_name . "(" . $rec->type . ")"; ?></td>
                                        <td><?php echo $rec->created_at; ?></td>
                                        <td><a href="javascript:void(0)"
                                               onclick="ConfirmDelete('<?php echo $rec->visit_idfk; ?>')">Remove from
                                                blacklist</a></td>

                                    </tr>

                                    <?php
                                    $loopIndex++;
                                }
                            }
                            ?>
                            </tbody>

                        </table>
                        <?php echo $links; ?>

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

<script type="text/javascript">
    function ConfirmDelete(id) {
        var x = confirm("Are you sure you want to remove from blacklist?");
        if (x) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>blacklisted/remove_from_list",
                contentType: 'application/x-www-form-urlencoded',
                //contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    location.reload();
                    // alert(response.data);
                },
                error: function (response) {
                    alert(response, "Unable to remove that user from the list.");
                }
            });
        }
    }
</script>

Share
Im
