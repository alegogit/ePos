<div id="page-content-wrapper">
<!-- Page Content -->
  <div class="container-fluid" style="font-size:90%;">
  
    <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/sales">&nbsp;&nbsp;&nbsp;Sales&nbsp;&nbsp;&nbsp;</a>
      <a role="button" class="btn btn-primary" href="<?=base_url()?>reports/inventory">Inventory</a>          
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/cashflow">Cash Flow</a>           
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/payment">Payment Type</a>           
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/attendance">Attendance</a>                
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/daily">&nbsp;&nbsp;<i class="fa fa-th-list"></i> Daily&nbsp;&nbsp;</a>              
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/weekly">&nbsp;<i class="fa fa-th"></i> Weekly&nbsp;</a>              
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/monthly">&nbsp;<i class="fa fa-th-large"></i> Monthly&nbsp;</a>       
    </div>      
    <div class="pull-right">
      <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
        <a id="print" role="button" class="btn btn-primary" href="<?=base_url()?>reports/inventoryprint/<?=$hashvars?>" target="_blank">&nbsp;<span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print&nbsp;</a>
      </div>
    </div>    
                                                                            
    <hr style="margin-bottom:10px;margin-top:10px" />         
    
    <div class="row" style="padding-left: 15px">  
      <?php
        $attributes = array('class' => 'form-inline', 'id' => 'filter', 'role' => 'form');
        echo form_open('reports/inventory',$attributes)
      ?>
        <div class="form-group" style="margin-bottom:0px">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-cutlery"></span></div>
            <select id = "myRestaurant" name="rest_id" title="Restaurant Name" class="form-control" style="display:inline">
              <option value = "0">ALL Restaurants</option>
              <?php foreach($restaurants as $row){ ?>
              <option value = "<?=$row->REST_ID?>" <?= ($row->REST_ID==$rest_id)?'selected':''?> ><?=$row->NAME?></option>
              <?php } ?>
            </select>   
          </div>
        </div>
        <div class="form-group" style="margin-bottom:0px">
          <div class="input-group">
            <button type="submit" class="btn btn-success" style="display:inline">Filter</button>   
          </div>
        </div>
      <?=form_close()?>
	  </div>            
    
    <hr style="margin-bottom:10px;margin-top:10px" />
	   
    <div class="panel panel-default">
		    <div class="panel-heading">
          <b>Inventory Report</b>  
        </div>
	      <div class="panel-body table-responsive">   
	        <table id="report" class="table table-striped dt-right compact">
				<thead>
						  <tr class="tablehead text3D">
						    <th>Name</th>
						    <th class="cin">Quantity</th>
						    <th>Status</th>
						  </tr>
						</thead>
						<tbody>           
						  <?php $i = 0;  foreach ($inventory as $row){ ?>
						  <tr class="<?=$this->inventory->inv_status_class($row->STATUS)?>" data-index="<?=$i?>">
						    <td><?=$row->NAME?></td>
						    <td class="cin"><?=$row->QUANTITY?></td>
						    <td><?=$row->STATUS?></td>
						  </tr>
						  <?php $i++; } ?>
						</tbody>
					</table>      
			  </div>
			</div>
		</div>
		
  </div><!-- /.container-fluid -->
</div><!-- /#page-content-wrapper -->

<script>                     
  //inititate datatable
  var table = $('#report').DataTable({
    columnDefs: [
      { targets: 'no-sort', orderable: false }
    ],
    "order": [[ 0, "asc" ]],
    "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
    pageLength: 25,
    "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
    "bAutoWidth": false
  });    
</script> 