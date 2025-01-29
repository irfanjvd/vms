 <section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>update Visit types</a> </li>
          </ul>
          
        </div>
        <h2>Visit types <span>VMS - Visitors Management System</span></h2>
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong> </strong>Visit types</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">


 <?php echo form_open('', array('method' => 'POST')); ?>
	<p><?php echo validation_errors(); ?></p>
		<table  class="table table-bordered table-striped">
			<tbody>

<?php foreach($record as $rec) { ?>  <tr>
<td><strong>Name:</strong></td>
<td><input type='text' name='form_name' value='<?php echo $rec->name; ?>' class='form-control' placeholder='form_name'></td>
</tr>


<?php } ?></tbody></table><p align='center'><input type='submit' value='Update Record' class='btn btn-primary' /> 
                        <input type='Button' value='Back' onclick='history.back();'  class='btn btn-default' /></p>
<?php echo form_close(); ?> 


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


