
<section id="content">
    <div class="page page-dashboard">
      <div class="pageheader">
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li> <a href="#"><i class="fa fa-home"></i> VMS</a> </li>
            <li> <a href="<?php echo base_url().'visitor/'; ?>"><i class="fa fa-dashboard" style="margin-right:6px;"></i>Dashboard</a> </li>
            <li> <a href="#"><i class="fa fa-user-plus" style="margin-right:6px;"></i>Add Gates</a> </li>
          </ul>
          
        </div>
        <h2>Visit Gates <span>VMS - Visitors Management System</span></h2>
      </div>
      
     
      
      <!-- row -->
      <div class="row"> 
        <!-- col -->
        <div class="col-md-12"> 
          <!-- tile -->
          <section class="tile"> 
            
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
              <h1 class="custom-font"><strong> </strong>Visit Gates</h1>
              
            </div>
            <!-- /tile header --> 
            
            <!-- tile body -->
            <div class="tile-body table-custom">

<?php if($this->session->flashdata('error')) { echo "<p style='color:#ff0000' >".$this->session->flashdata('error')."</p>"; } ?>

<?php if($this->session->flashdata('success')) { echo "<p style='color:#0ad41d' >".$this->session->flashdata('success')."</p>"; } ?>

 <input type="button" value="Add Record" onclick="window.location='<?php echo base_url().'Visit_Gates/adding'; ?>'" class='btn btn-primary pull-right' />
 
                        		<table id='example1' class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>#</th> <th>name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
if(isset($record) && is_array($record))
{
	if($this->uri->segment(3))
		{
			$loopIndex = ($per_page*($this->uri->segment(3)-1))+1;
		}else{
				$loopIndex = 1;
		     }
	foreach($record as $rec) 
	{ 
	
?> 

                                    <tr>
<td><?php echo $loopIndex; ?></td>
 <td><?php echo $rec->name; ?></td>
 <td>
                        <a href="<?php echo base_url().'Visit_Gates/updating/'.$rec->id; ?>">Edit</a> 
                        
                       
                          
                        </td>
            </tr>
<?php	$loopIndex++;
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


