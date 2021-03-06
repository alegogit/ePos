<div id="page-content-wrapper">
<!-- Page Content -->
  <div class="container-fluid" style="font-size:90%;">
  
    <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/sales">&nbsp;&nbsp;&nbsp;Sales&nbsp;&nbsp;&nbsp;</a>
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/inventory">Inventory</a>          
      <a role="button" class="btn btn-primary" href="<?=base_url()?>reports/cashflow">Cash Flow</a>           
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/payment">Payment Type</a>           
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/attendance">Attendance</a>                
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/daily">&nbsp;&nbsp;<i class="fa fa-th-list"></i> Daily&nbsp;&nbsp;</a>              
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/weekly">&nbsp;<i class="fa fa-th"></i> Weekly&nbsp;</a>              
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/monthly">&nbsp;<i class="fa fa-th-large"></i> Monthly&nbsp;</a>       
    </div>      
    <div class="pull-right">
      <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
        <a id="print" role="button" class="btn btn-primary" href="<?=base_url()?>reports/cashflowprint/<?=$hashvars?>" target="_blank">&nbsp;<span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print&nbsp;</a>
      </div>
    </div>   
                                                                            
    <hr style="margin-bottom:10px;margin-top:10px" />         
    
    <div class="row" style="padding-left: 15px">  
      <?php
        $attributes = array('class' => 'form-inline', 'id' => 'filter', 'role' => 'form');
        echo form_open('reports/cashflow',$attributes)
      ?>
        <div class="form-group" style="margin-bottom:0px">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
            <input id="startdate" name="startdate" type="text" value="<?=$startdate?>" class="form-control datepicker" style="display:inline;padding-left:10px;padding-right:-20px" title="Start Date">
          </div>                                                                                                                                                              
        </div>
        <div class="form-group" style="margin-bottom:0px">
          <div class="input-group">       
            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
            <input id="enddate" name="enddate" type="text" value="<?=$enddate?>" class="form-control datepicker" style="display:inline;padding-left:10px;padding-right:-20px" title="End Date">
          </div>
        </div>
        <div class="form-group" style="margin-bottom:0px">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-cutlery"></span></div>
            <select id = "myRestaurant" name="rest_id" title="Restaurant Name" class="form-control" style="display:inline">
              <option value = "0">Select Restaurants</option>
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
          <b>Cash Flow Report</b>  
        </div>
	      <div class="panel-body table-responsive">   
	        <table id="report" class="table table-striped dt-right compact">
				<thead>
						  <tr class="tablehead text3D">
						    <th class="no-sort">Date</th>
						    <th class="no-sort">Terminal</th>  
						    <th class="cin"></th>
						    <th class="cin no-sort">Starting Day Cash Register</th>
						    <th class="cin"></th>
						    <th class="cin no-sort">Closing Day Cash Register</th>
						    <th class="cin"></th>
						    <th class="cin no-sort">Cash From Register</th>     
						    <th class="cin"></th>
						    <th class="cin no-sort">Cash From Order</th>       
						    <th class="cin"></th>
						    <th class="cin no-sort">Differences</th>  
						  </tr>
						</thead>
						<tbody>           
						  <?php 
                $i = 0;            
                $total['CASH_OPENING'] = 0;  
                $total['CASH_CLOSING'] = 0; 
                $total['CASH_FROM_REGISTER'] = 0;  
                $total['CASH_FROM_INVOICES'] = 0;   
                $total['DIFFERENCE'] = 0;  
                foreach ($cashflow as $row){ 
              ?>
						  <tr data-index="<?=$i?>">
						    <td><?=$row->TERMINAL_DATE?></td>
						    <td><?=$row->TERMINAL_NAME?></td>     
						    <td class="cin text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->CASH_OPENING, 2, '.', '')?></td> 
						    <td class="cin text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->CASH_CLOSING, 2, '.', '')?></td>    
						    <td class="cin text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->CASH_FROM_REGISTER, 2, '.', '')?></td> 
						    <td class="cin text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->CASH_FROM_INVOICES, 2, '.', '')?></td> 
						    <td class="cin text3D <?=(((float)$row->CASH_FROM_REGISTER-(float)$row->CASH_FROM_INVOICES)<0)?'text-danger':''?>"><?=$cur?></td>
						    <td class="cin cur text3D <?=(((float)$row->CASH_FROM_REGISTER-(float)$row->CASH_FROM_INVOICES)<0)?'text-danger':''?>"><?=$this->currency->my_number_format((float)$row->CASH_FROM_REGISTER-(float)$row->CASH_FROM_INVOICES, 2, '.', '')?></td> 
						  </tr>
						  <?php 
                $total['CASH_OPENING'] = $total['CASH_OPENING']+$row->CASH_OPENING;  
                $total['CASH_CLOSING'] = $total['CASH_CLOSING']+$row->CASH_CLOSING;  
                $total['CASH_FROM_REGISTER'] = $total['CASH_FROM_REGISTER']+$row->CASH_FROM_REGISTER;  
                $total['CASH_FROM_INVOICES'] = $total['CASH_FROM_INVOICES']+$row->CASH_FROM_INVOICES;  
                $total['DIFFERENCE'] = $total['DIFFERENCE']+((float)$row->CASH_FROM_REGISTER-(float)$row->CASH_FROM_INVOICES);  
                $i++; 
              } ?>
						</tbody>
						<tfoot>
						  <tr class="tablefoot text3D">
						    <th class="no-sort">Grand Total</th>
						    <th class="no-sort"></th> 
						    <th class="cin text3D no-sort"><?=$cur?></td>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['CASH_OPENING'], 2, '.', '')?></th>  
						    <th class="cin text3D no-sort"><?=$cur?></td>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['CASH_CLOSING'], 2, '.', '')?></th> 
						    <th class="cin text3D no-sort"><?=$cur?></td>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['CASH_FROM_REGISTER'], 2, '.', '')?></th>  
						    <th class="cin text3D no-sort"><?=$cur?></td>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['CASH_FROM_INVOICES'], 2, '.', '')?></th> 
						    <th class="cin text3D no-sort <?=((float)$total['DIFFERENCE']<0)?'text-danger':''?>"><?=$cur?></td>
						    <th class="cin cur text3D no-sort <?=((float)$total['DIFFERENCE']<0)?'text-danger':''?>"><?=$this->currency->my_number_format((float)$total['DIFFERENCE'],2,'.','')?></th> 
						  </tr>
						</tfoot>
					</table>      
			  </div>
			</div>
		</div>
		
  </div><!-- /.container-fluid -->
</div><!-- /#page-content-wrapper -->  
<div id="cur" data-val="<?=$cur?>"></div>

<script>  
  //datepickers    
  $("#startdate").datepicker({format: 'dd M yyyy'});
  $("#enddate").datepicker({format: 'dd M yyyy'});
    
  //inititate datatable
  var table = $('#report').DataTable({
    columnDefs: [
      { targets: 'no-sort', orderable: false }
    ],    
    searching: true,
    ordering:  false,
    bLengthChange: true,
    "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
    pageLength: 25,
    "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
    "bAutoWidth": false
  });
  
  //currency control
  jQuery(function($) {
    var cur = $("#cur").data('val');
    switch(cur) {
      case "RS":                  
        $('.cur').autoNumeric('init', { dGroup: 2, nBracket: '(,)', vMin: '-99999999.99' });
        break;
      case "RP":   
        $('.cur').autoNumeric('init', { aSep: '.', dGroup: 3, aDec: ',', aPad: false, nBracket: '(,)', vMin: '-99999999.99' });
        break;
      default: 
        $('.cur').autoNumeric('init', { nBracket: '(,)', vMin: '-99999999.99' });
        break;
    }     
  });

</script>
