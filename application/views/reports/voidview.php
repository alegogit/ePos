<div id="page-content-wrapper">
<!-- Page Content -->
  <div class="container-fluid" style="font-size:90%;">  
              
    <div class="row" style="">  
      <div class="col-md-4">
        <h1>
          <img class="img-thumbnail" style="width:53px; height:53px; margin-top:-10px;" src="<?=$reslogo?>"/> <?=$restaurants->NAME?> 
        </h1>
      </div>
      <div class="col-md-4" style="text-align:center;">
        <h1>
           <?=$report_name?> Report 
        </h1>
      </div>
      <div class="col-md-4" style="text-align:right;vertical-align:bottom !important;">
        <h3>
           <?=$startdate." - ".$enddate?>
        </h3>
      </div>
    </div>
    
    <hr style="margin-bottom:10px;margin-top:10px" />
        
	  <div class="panel panel-default">
		    <div class="panel-heading">
          <b></b>  
        </div>
	      <div class="panel-body table-responsive" style="">
	       <?php if($report_name!="Sales"){?>   
	        <table id="void" class="table table-striped" data-toggle="table" data-url="" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="false" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
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
						    <td data-field="name" data-sortable="true"><?=$row->MENU_NAME?></td>
						    <td data-field="rson"  data-sortable="true"><?=$row->VOID_REASON?></td>
						    <td data-field="onum" data-sortable="true"><?=$row->ORDER_NUMBER?></td>
						    <td data-field="strd" data-sortable="true"><?=$row->STARTED?></td>
						    <td data-field="endd"  data-sortable="true"><?=$row->ENDED?></td>
						  </tr>
						  <?php $i++; } ?>
						</tbody>
					</table>
				<?php } else {?>  
	         <table id="sales" class="table table-striped dt-right" data-search="false">
					   <thead>
						  <tr class="tablehead text3D">
						    <th class="cin">Order Number</th>
						    <th class="cin">Table Number</th>
						    <th>Customer Name</th>
						    <th>Started</th>
						    <th>Ended</th>
						    <th class="cin">No. Of Guest</th>
						    <th class="cin no-sort"></th>
						    <th class="cin">Total Bill</th>  
						    <th class="cin no-sort"></th>
						    <th class="cin">Tip</th>    
						    <th class="cin no-sort"></th>
						    <th class="cin">Discount</th> 
						    <th class="cin no-sort"></th>
						    <th class="cin">Service Charge</th> 
						    <th class="cin no-sort"></th>
						    <th class="cin">Total Tax</th> 
						    <th class="cin no-sort"></th>
						    <th class="cin">Paid Amount</th>
						    <th>Payment Method</th>
						  </tr>
						</thead>
						<tbody>   
						  <?php 
                $i = 0;
                $total['NO_OF_GUEST'] = 0;  
                $total['TOTAL_BILL'] = 0;  
                $total['TIP'] = 0;  
                $total['DISCOUNT'] = 0; 
                $total['SERVICE_CHARGE'] = 0;  
                $total['TOTAL_TAX'] = 0;  
                $total['PAID_AMOUNT'] = 0;
                foreach ($sales_report as $row){ 
              ?>
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
						    <td class="cin cur text3D"><?=number_format((float)$row->TOTAL_BILL, 2, '.', '')?></td> 
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->TIP, 2, '.', '')?></td> 
						    <td class="cin cur text3D text-danger"><?=$cur?></td>
						    <td class="cin cur text3D text-danger"><?=number_format((float)$row->DISCOUNT, 2, '.', '')?></td>
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->SERVICE_CHARGE, 2, '.', '')?></td>
						    <td class="cin cur text3D"><?=$cur?></td>
						    <td class="cin cur text3D"><?=number_format((float)$row->TOTAL_TAX, 2, '.', '')?></td>
						    <td class="cin cur text3D"><strong><?=$cur?></strong></td>
						    <td class="cin cur text3D" style="font-weight:bolder"><strong><?=number_format((float)$row->PAID_AMOUNT, 2, '.', '')?></strong></td>
						    <td><?=$row->PAYMENT_METHOD?></td>
						  </tr>
						  <?php  
                  $total['NO_OF_GUEST'] = $total['NO_OF_GUEST']+$row->NO_OF_GUEST;  
                  $total['TOTAL_BILL'] = $total['TOTAL_BILL']+$row->TOTAL_BILL;  
                  $total['TIP'] = $total['TIP']+$row->TIP;  
                  $total['DISCOUNT'] = $total['DISCOUNT']+$row->DISCOUNT; 
                  $total['SERVICE_CHARGE'] = $total['SERVICE_CHARGE']+$row->SERVICE_CHARGE;  
                  $total['TOTAL_TAX'] = $total['TOTAL_TAX']+$row->TOTAL_TAX;  
                  $total['PAID_AMOUNT'] = $total['PAID_AMOUNT']+$row->PAID_AMOUNT;
                  $i++; 
                } 
              ?>
						</tbody>
            <tfoot> 
						  <tr class="tablefoot text3D">
						    <th> </th>
						    <th> </th>
						    <th> </th>
						    <th> </th>
						    <th class="cin no-sort">Grand Total</th>
						    <th class="cin text3D no-sort"><?=$total['NO_OF_GUEST']?></th>
						    <th class="cin text3D no-sort"><?=$cur?></th>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['TOTAL_BILL'], 2, '.', '')?></th>  
						    <th class="cin text3D no-sort"><?=$cur?></th>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['TIP'], 2, '.', '')?></th>    
						    <th class="cin text3D no-sort text-danger"><?=$cur?></th>
						    <th class="cin cur text3D no-sort text-danger"><?=number_format((float)$total['DISCOUNT'], 2, '.', '')?></th> 
						    <th class="cin text3D no-sort"><?=$cur?></th>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['SERVICE_CHARGE'], 2, '.', '')?></th> 
						    <th class="cin text3D no-sort"><?=$cur?></th>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['TOTAL_TAX'], 2, '.', '')?></th> 
						    <th class="cin text3D no-sort"><?=$cur?></th>
						    <th class="cin cur text3D no-sort"><?=number_format((float)$total['PAID_AMOUNT'], 2, '.', '')?></th>
						    <th class="no-sort"></th>
						  </tr>
            </tfoot>
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
  <div class="modal-dialog" style="width:65% !important;">
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
						    <th>Menu</th>
						    <th>Category</th>  
						    <th>Kitchen Note</th>
						    <th class="cin">Quantity</th>
						    <th class="cin"></th>
						    <th class="cin">Price</th>  
						    <th class="cin"></th>
						    <th class="cin">Total</th>
						    <th class="cin">Void</th>
                <!--
						    <th class="cin" colspan="2">Price</th>
						    <th class="cin" colspan="2">Total</th> 
						    <th class="cin" colspan="2">Void</th>
                -->
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
	  
  //inititate datatable
  var table1 = $('#sales').DataTable({
    columnDefs: [
      { targets: 'no-sort', orderable: false }
    ],
    "order": [[ 0, "asc" ]],
    "bAutoWidth": false,
    "bPaginate": false,
    bFilter: false, 
    bInfo: false
  }); 
  
  //inititate datatable
  var table2 = $('#void').DataTable({
    columnDefs: [
      { targets: 'no-sort', orderable: false }
    ],
    "order": [[ 0, "asc" ]],
    "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
    pageLength: 25,
    "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
    "bAutoWidth": false
  }); 
  
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

  //currency control
  jQuery(function($) {
    var cur = '<?=$cur?>';
    //var cur = $("#cur").data("val");
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
