<table  class="table table-bordered table-striped">
			<tbody>	 
		 
<?php foreach($record as $rec) { ?>  <tr>
                <td><strong>Name:</strong></td>
                <td><?php echo $rec->name; ?></td>
            </tr>
       
<?php } ?></tbody></table><p align='center'>
                        <input type='Button' value='Back' onclick='history.back();'  class='btn btn-default' /></p>
<?php echo form_close(); ?> 
