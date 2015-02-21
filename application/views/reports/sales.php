<div id="page-content-wrapper">
<!-- Page Content -->
  <div class="container-fluid" style="font-size:90%;">
  
    <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
      <a role="button" class="btn btn-primary" href="<?=base_url()?>reports/sales">&nbsp;&nbsp;&nbsp;Sales&nbsp;&nbsp;&nbsp;</a>
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/inventory">Inventory</a>              
      <a role="button" class="btn btn-default" href="<?=base_url()?>reports/cashflow">Cash Flow</a>     
    </div>                                                                       
    <hr style="margin-bottom:10px;margin-top:10px" />         
    
    <div class="row" style="padding-left: 15px">  
      <?php
        $attributes = array('class' => 'form-inline', 'id' => 'filter', 'role' => 'form');
        echo form_open('reports/sales',$attributes)
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
              <option value = "0">ALL Restaurants</option>
              <?php foreach($restaurants as $row){ ?>
              <option value = "<?=$row->REST_ID?>" <?= ($row->REST_ID==$rest_id)?'selected':''?> ><?=$row->NAME?></option>
              <?php } ?>
            </select>   
          </div>
        </div>
        <div class="form-group" style="margin-bottom:0px">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-file"></span></div>
            <select id = "repch" name="report_name" title="Choose Report" class="form-control" style="display:inline">
              <option value = "0">Choose Report</option>
              <option value = "Sales" <?=($report_name=='Sales')?'selected':''?>>Sales</option>
              <option value = "Void Items" <?=($report_name=='Void Items')?'selected':''?>>Void Items</option>
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
          <b><?=$report_name?> Report</b>  
        </div>
	      <div class="panel-body table-responsive">
	       <?php if($report_name!="Sales"){?>   
	        <table id="report" class="table table-striped" data-toggle="table" data-url="" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
					  <thead>
						  <tr>
						    <th data-field="state" data-checkbox="true" >Void ID</th>
						    <th data-field="name" data-sortable="true">Menu Name</th>
						    <th data-field="rson"  data-sortable="true">Void Reason</th>
						    <th data-field="onum" data-sortable="true">Order Number</th>
						    <th data-field="strd" data-sortable="true">Started</th>
						    <th data-field="endd"  data-sortable="true">Ended</th>
						  </tr>
						</thead>
						<tbody>           
						  <?php $i = 0;  foreach ($void_items as $row){ ?>
						  <tr>
						    <td data-field="state" data-checkbox="true" ><?=$i?></td>
						    <td data-field="name" data-sortable="true"><?=$row->NAME?></td>
						    <td data-field="rson"  data-sortable="true"><?=$row->VOID_REASON?></td>
						    <td data-field="onum" data-sortable="true"><?=$row->ORDER_NUMBER?></td>
						    <td data-field="strd" data-sortable="true"><?=$row->STARTED?></td>
						    <td data-field="endd"  data-sortable="true"><?=$row->ENDED?></td>
						  </tr>
						  <?php $i++; } ?>
						</tbody>
					</table>
				<?php } else {?>  
	         <table id="report" class="table table-striped dt-right">
					   <thead>
						  <tr class="tablehead text3D">
						    <th class="cin">Order Number</th>
						    <th class="cin">Table Number</th>
						    <th>Customer</th>
						    <th>Started</th>
						    <th>Ended</th>
						    <th class="cin">Num Of Guest</th>
						    <th class="cin no-sort"></th>
						    <th class="cin">Total</th>  
						    <th class="cin no-sort"></th>
						    <th class="cin">Tip</th>    
						    <th class="cin no-sort"></th>
						    <th class="cin">Discount</th> 
						    <th class="cin no-sort"></th>
						    <th class="cin">Paid Amount</th>
						  </tr>
						</thead>
						<tbody>   
						  <?php $i = 0;  foreach ($sales_report as $row){ ?>
						  <tr>
						    <td data-field="name" class="cin" data-valign="center">
                  <a href="#" style="font-size:90%" class="label label-lg label-success modalTrigger" data-toggle="modal" data-target="#bookModal" data-id="<?=$row->ID?>" data-odn="<?=$row->ORDER_NUMBER?>">
                    <?=$row->ORDER_NUMBER?>
                  </a>  
                </td>
						    <td class="cin"><?=$row->TABLE_NUMBER?></td>
						    <td><?=$row->CUSTOMER_NAME?></td>
						    <td><?=$row->STARTED?></td>
						    <td><?=$row->ENDED?></td>
						    <td class="cin"><?=$row->NO_OF_GUEST?></td>
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=$row->TOTAL?></td> 
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=$row->TIP?></td> 
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=$row->DISCOUNT?></td>
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=$row->PAID_AMOUNT?></td>
						  </tr>
						  <?php $i++; } ?>
						</tbody>
					</table> 
				<?php } ?>
			  </div>
			</div>
		</div>
  
  </div><!-- /.container-fluid -->
</div><!-- /#page-content-wrapper -->

<?php if($report_name=="Sales"){?>
<!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="ordnumb"></span> Order Detail List</h4>
      </div><!-- /.modal-header -->
      <div class="modal-body">    	 	 	 	 	
        <table id="modalTable" class="table table-striped compact hover">
					  <thead>
						  <tr class="tablehead text3D">
						    <th class="cin">No</th>
						    <th>Menu Name</th>
						    <th class="cin">Quantity</th>
						    <th>Kitchen Note</th>
						    <th class="cin"></th>
						    <th class="cin">Price</th>
						    <th class="cin">Void</th>
						    <th>Void Reason</th>
						  </tr>
						</thead>
						<tbody id="datarow">  
						</tbody>
					</table>
        </form>
      </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->                                                                                                                  
  </div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->
<div id="ajaxurl" data-url="<?=base_url()?>"></div>
<div id="cur" data-val="<?=$cur?>"></div>
<div id="rest_id" data-val="<?=$rest_id?>"></div>
<?php } ?>

<script type="text/javascript">      
  //datepickers    
  $("#startdate").datepicker({format: 'dd M yyyy'});
  $("#enddate").datepicker({format: 'dd M yyyy'});
  
  var ajaxurl = $("#ajaxurl").data('url');  
  var rest_id = $("#rest_id").data('val');
  
  var gOrdDet = function gOrdDet(){
       $(".modalTrigger").click(function () { 
        var odnP = $(this).data('odn');   
        $(".modal-title #ordnumb").html(odnP);
        var varP = $(this).data('id');  
        var dataP = "varP="+varP+"&rest_id="+rest_id;  
        $.ajax({
          type: "POST",
          url: ajaxurl+"process/orders",
          data: dataP,
          cache: false,
          success: function(result){
            $(".modal-body #datarow").html(result); 
            return false; 
          }
        }); 
       });
    }; 
  
  $(document).ready(function(){
    gOrdDet();  
    $('#report').DataTable({      
      columnDefs: [
        { targets: 'no-sort', orderable: false }
      ],
      "order": [[ 0, "asc" ]],
      url: ajaxurl+'reports/sales',
      method: 'get',
      onAll: function (name, args) {
        if (typeof gOrdDet == 'function') {  
          gOrdDet(); 
          console.log('inside fired');
        }
      }
    }).on('all.bs.table', function (e, name, args) { 
        if (typeof gOrdDet == 'function') { 
          gOrdDet();     
          console.log('triggered');
        }
      console.log('Event:', name, ', data:', args);
    }); 
  });
  
  $('#modalTable').DataTable({
    paging: false,    
    searching: false,
    ordering:  false,
    bInfo : false
  });
  
  jQuery(function($) {
    var cur = $("#cur").data('val');
    switch(cur) {
      case "RS":                  
        $('.cur').autoNumeric('init', { dGroup: 2 });
        break;
      case "RP":   
        $('.cur').autoNumeric('init', { aSep: '.', dGroup: 3, aDec: ',', aPad: false });
        break;
      default: 
        $('.cur').autoNumeric('init');
        break;
    }     
  });
  
</script>
