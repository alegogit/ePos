<div id="page-content-wrapper">
<!-- Page Content -->
	<div class="container-fluid" style="font-size:90%;">
  
    	<div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
      		<a role="button" class="btn btn-default" href="<?=base_url()?>setting/restaurant">Restaurant</a>                
	      	<a role="button" class="btn btn-default" href="<?=base_url()?>setting/category">Category</a>               
	      	<a role="button" class="btn btn-default" href="<?=base_url()?>setting/menu">Menu</a>                       
	      	<a role="button" class="btn btn-primary" href="<?=base_url()?>setting/menuinventory">Menu - Inventory</a>             
	      	<a role="button" class="btn btn-default" href="<?=base_url()?>setting/tableorder">Table Order</a>        
	      	<a role="button" class="btn btn-default" href="<?=base_url()?>setting/users">Users</a>               
	      	<a role="button" class="btn btn-default" href="<?=base_url()?>setting/printer">Printer</a>       
	      	<a role="button" class="btn btn-default" href="<?=base_url()?>setting/terminal">Terminal</a>           
	    </div>       
                                                                          
    	<hr style="margin-bottom:10px" />
    
    	<div class="row" style="padding-left: 15px">  
      	<?php
        	$attributes = array('class' => 'form-inline', 'id' => 'filter', 'role' => 'form');
        	echo form_open('setting/menuinventory',$attributes)
      	?>
        	<div class="form-group" style="margin-bottom:0px">
          		<div class="input-group">
            		<div class="input-group-addon"><span class="glyphicon glyphicon-cutlery"></span></div>
            		<select id = "myRestaurant" name="rest_id" title="Restaurant Name" class="form-control" style="display:inline">
              			<option value = "0">Select Restaurant</option>
              			<?php foreach($restaurants as $row){ ?>
              			<option value = "<?=$row->REST_ID?>" <?= ($row->REST_ID==$rest_id)?'selected':''?> ><?=$row->NAME?></option>
              			<?php } ?>
            		</select>   
          		</div>
        	</div>
        	<div class="form-group" style="margin-bottom:0px">
          		<div class="input-group">
            		<input type="submit" class="btn btn-success" style="display:inline" value="Filter" name="filter">
          		</div>
        	</div>
      		<?=form_close()?>     
    	</div>              
                                                     
    	<hr style="margin-bottom:10px;margin-top:10px" />
    
    	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Menu - Inventory Setting</b></div>
					<div class="panel-body">                 					                    
			      		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#bookModal">
              				<span class="glyphicon glyphicon-plus"></span> Add New Item
            			</button>             
            			<button type="button" class="btn btn-danger">
              				<span class="glyphicon glyphicon-remove"></span> Delete Selected Item(s)
            			</button>        
            			<div style="margin-bottom:15px"></div> 
            			<div class="table-responsive">
							<table id="setting" class="table table-striped dt-right compact">
						    <thead>
						    	<tr class="tablehead text3D">
						        	<th class="no-sort"><input type="checkbox" id="checkall" value="Check All"></th>
						        	<th>Menu</th>
						        	<th>Inventory</th>
						        	<th class="cin">Quantity</th>
						        	<th></th>  
                    <?php if ($role==1){ ?>
						        	<th>Created By</th>
						        	<th>Created Date</th>
						        	<th>Updated By</th>
						        	<th>Updated Date</th> 
                    <?php } ?>
						    	</tr>
						    </thead>  
						    <tbody>                    
						    <?php $i = 1;  foreach ($menuinventory as $row){ ?>
                  <tr data-index="<?=$i?>" class="datarow" id="<?=$row->ID.'_'.$row->MENU_NAME?>">
				            <td class="">
				              <input type="checkbox" class="case" tabindex="-1">
				            </td>
				            <td style="">
				              <a id="MENU_ID-<?=$row->ID?>" class="edit" tabindex="0"><?=$row->MENU_NAME." <span style='font-size:75%'>[".$this->setting->get_rest_category($row->MENU_ID)->CAT_NAME."]</span>"?></a>
				            </td>
                  	<td style="">
                      <a id="INVENTORY_ID-<?=$row->ID?>" class="edit" tabindex="0"><?=$row->INVENTORY_NAME?></a>
                  	</td>
                  	<td class="cin" style="">
                      <a id="QUANTITY-<?=$row->ID?>" class="edit" tabindex="0"><?=$row->QUANTITY?></a>
                  	</td>
                  	<td style="">
                      <?=$this->setting->get_metric($row->INVENTORY_METRIC)?>&nbsp;&nbsp;
                  	</td> 
                  <?php if ($role==1){ ?>
				            <td style=""><span id="crby<?=$row->ID?>"><?=$this->setting->get_username($row->CREATED_BY)->NAME?></span></td>
				            <td style=""><span id="crdt<?=$row->ID?>"><?=$row->CREATED_DATE?></span></td>
				            <td style=""><span id="upby<?=$row->ID?>"><?=$this->setting->get_username($row->LAST_UPDATED_BY)->NAME?></span></td>
				            <td style=""><span id="updt<?=$row->ID?>"><?=$row->LAST_UPDATED_DATE?></span></td>
                  <?php } ?>
				          </tr>
				          <?php $i++; } ?>
						    </tbody>
						  	</table>
             			</div> 
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div><!--/.col-lg-12-->
		</div><!--/.row-->
		
  	</div><!-- /.container-fluid -->
</div><!-- /#page-content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:900px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Menu - Inventory Item</h4>
      </div><!-- /.modal-header -->
      <div class="modal-body"> 
        <div id="combresp" class="alert alert-danger alert-dismissable" style="margin-top:10px;display:none;"> 
          <a class="panel-close close" data-dismiss="alert">x</a>
          <span id="combout"></span>
        </div>
        <?php
          $attributes = array('class' => 'form-inline', 'id' => 'newmeninv', 'role' => 'form');
          echo form_open('setting/menuinventory',$attributes)
        ?>
        <div class="row"> 
          <div class="col-md-6">       
            <div class="form-group" style="margin-bottom:10px">   
              <label for="menu">Menu</label><br />  
              <div class="input-group" style="z-index:10001;">   
                <div class="input-group-addon"><span class="fa fa-coffee"></span></div> 
                <select id="menu" name="menu" class="form-control selectpicker show-tick" data-size="25" data-width="auto" data-live-search="false" required>
                <?php
                  $i=0;
                  $catwoman = ""; 
                  $n = count($menus);
                  foreach($menus as $rowm){ 
                    if($i==0){
                ?>  
                    <optgroup label="<?=$rowm->CAT_NAME?>">
                <?php
                    } 
                ?>
                  <option value="<?=$rowm->ID?>"><?=$rowm->NAME?></option> 
                <?php
                    if(($rowm->CAT_NAME!=$catwoman)&&($i!=0)){
                ?>
                  </optgroup> 
                  <optgroup label="<?=$rowm->CAT_NAME?>">
                <?php
                    } else {
                      if($i==$n){
                ?>   
                  </optgroup>
                <?php
                      }
                    } 
                    $catwoman = $rowm->CAT_NAME;
                    $i++;
                  } 
                ?>
                </select>
              </div>
            </div><br />  
            <div class="form-group" style="margin-bottom:10px;">      
              <label for="resto">Restaurant</label><br />     
              <div class="input-group"> 
                <div class="input-group-addon"><span class="fa fa-cutlery"></span></div>
                <input type="text" class="form-control" id="resto" placeholder="" name="resto" value="<?=$def_rest_name?>" disabled>
              </div>
            </div><br />
            <div class="form-group text-right" style="margin-bottom:10px">
              <div class="input-group">       
                <button type="submit" class="btn btn-success">Submit</button>&nbsp;
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
              </div>
            </div><br />  
          </div><!-- class="col-md-6" -->
          <div class="col-md-6">     
            <div class="form-group" style="margin-bottom:10px;">   
              <label for="inv">Inventory</label><br />  
              <div class="input-group" style="z-index:10000;">   
                <div class="input-group-addon"><span class="fa fa-cubes"></span></div> 
                <select id="inv" name="inv" class="form-control selectpicker show-tick" data-size="25" data-width="auto" data-live-search="false" required>  
                <?php foreach($inventories as $rowi){ ?>
                  <option value="<?=$rowi->ID?>" data-mtr="<?=$this->setting->get_metric($rowi->METRIC)?>"><?=$rowi->NAME?></option>
                <?php } ?>  
                </select>
              </div>
            </div><br />    
            <div class="form-group" style="margin-bottom:10px">      
              <label for="qty"></label>     
              <div class="input-group" style="width:200px;"> 
                <div class="input-group-addon"><span class="fa fa-cube"></span></div>
                <input type="text" class="form-control" style="text-align:right;" id="qty" placeholder="Quantity" name="qty" required>
                <div class="input-group-addon"><span id="metric">metric</span></div>
              </div>
            </div><br />    
          </div><!-- class="col-md-6" --> 
        </div><!-- class="row" -->  
        <?=form_close()?>
      </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->
<div id="baseurl" data-url="<?=base_url()?>"></div>
<div id="combo" data-stat=""></div>
<?php  
  //editable script
  $i = 0;
  $edit_script = "<script>";
  $edit_script .= "$(document).ready(function(){";
	$edit_script .= "  $.fn.editable.defaults.mode = 'inline';";
	$edit_script .= "  $.fn.editable.defaults.showbuttons = false;";
	//$edit_script .= "  $.fn.editable.defaults.onblur = 'ignore';";
  $edit_script .= "  var updateurl = '".base_url()."process/menuinventory?p=update';";
  
  foreach ($menuinventory as $row){
    $edit_script .= "  $('#MENU_ID-".$row->ID."').editable({
		                        type: 'select',  
		                        value: ".$row->MENU_ID.", 
		                        source: [ ";
		$k = 1;
		$q = count($menus);
		foreach($menus as $rowc){
			$edit_script .= "  {value: ".$rowc->ID.", text: '".addslashes($rowc->NAME)." [".addslashes($rowc->CAT_NAME)."]'}";
		    $edit_script .= ($k<$q)?", ":"";
		    $k++;
		}
		$edit_script .= "    ],
		                        url: updateurl,
		                        pk: ".$row->ID.", 
		                        validate: function(v) {
                              var c = ".$row->INVENTORY_ID."; 
                              if (isTakenC(v,c)) return 'The combination already exists!';
		                        },
		                        success: function(result){  
		                          var data = result.split(',');
		                          $('#upby".$row->ID."').html(data[0]);
		                          $('#updt".$row->ID."').html(data[1]);  
		                        }  
		                      });
                        $('#MENU_ID-".$row->ID."').on('save', function(e) {  
                          return $(this).parents().nextAll(':has(.editable:visible):first').find('.editable:first').focus();
                        });";
  		$edit_script .= "  $('#INVENTORY_ID-".$row->ID."').editable({
		                        type: 'select',  
		                        value: ".$row->INVENTORY_ID.", 
		                        source: [ ";
		$i = 1;
		$j = count($inventories);
		foreach($inventories as $rowi){
			$edit_script .= "  {value: ".$rowi->ID.", text: '".addslashes($rowi->NAME)."'}";
		    $edit_script .= ($i<$j)?", ":"";
		    $i++;
		}
		$edit_script .= "    ],
		                        url: updateurl,
		                        pk: ".$row->ID.", 
		                        validate: function(v) {
                              var m = ".$row->MENU_ID.";    
                              if (isTakenC(m,v)) return 'The combination already exists!';
		                        },
		                        success: function(result){  
		                          var data = result.split(',');
		                          $('#upby".$row->ID."').html(data[0]);
		                          $('#updt".$row->ID."').html(data[1]); 
		                        }  
		                      });
                        $('#INVENTORY_ID-".$row->ID."').on('save', function(e) {  
                          return $(this).parents().nextAll(':has(.editable:visible):first').find('.editable:first').focus();
                        });";
  		$edit_script .= "  $('#QUANTITY-".$row->ID."').editable({
		                        url: updateurl,
		                        pk: ".$row->ID.", 
		                        validate: function(v) {
		                          	if (!v) return 'don\'t leave it blank!';
		                          	if (isNaN(v)) return 'please fill in a number format!';
		                        },
		                        success: function(result){  
		                          var data = result.split(',');
		                          $('#upby".$row->ID."').html(data[0]);
		                          $('#updt".$row->ID."').html(data[1]);
		                      } 
		                    });
                        $('#QUANTITY-".$row->ID."').on('save', function(e) {  
                          return $(this).parents().nextAll(':has(.editable:visible):first').find('.editable:first').focus();
                        });";  
  	}
  	$edit_script .= "}); ";
	$edit_script .= '</script>';
  	echo $edit_script;
?>
<script>   
$(document).ready(function(){ 
	var baseurl = $("#baseurl").data('url');
	
  //$('.dropdown-menu li').css('font-size','8px'); 
  $('.dropdown-menu li').blur(function(){
    alert('eek');
  });
  
	//autoresizing inputs
  $('#newmeninv input').autoResize(); 
    
  //auto metrics  
  $('#inv').change(function() {
    var metric = $(this).find(':selected').data('mtr');
    $('#metric').html(metric);
    //console.log(metric); 
  });
	                   
	//make editable on focus  
  	$('.edit').focus(function(e) {
    	e.stopPropagation();
    	$(this).editable('toggle');
  	});
  
  	//inititate datatable
  	var table = $('#setting').DataTable({
    	columnDefs: [
      		{ targets: 'no-sort', orderable: false }
    	],
    	"order": [[ 1, "asc" ]],
      "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
      pageLength: 25,
      "aLengthMenu": [[10, 25, 100, -1], [10, 25, 100, "All"]],
      "bAutoWidth": false
  	});
  
  	//check all
  	$("#checkall").click(function(){
    	$('.case').prop('checked',this.checked);
  	});
  	$(".case").click(function(){
    	if($(".case").length==$(".case:checked").length){
      		$("#selectall").prop("checked","checked");
    	}else{
      		$("#selectall").removeAttr("checked");
    	}
  	}); 
  
  	//function to delete selected row
  	$('.btn-danger').on("click", function(event){
  		var sel = false;	
  		var ch = $('#setting').find('tbody input[type=checkbox]');
    	var dt = '';	
  		ch.each(function(){  
	      	if($(this).is(':checked')) { 
	        	var idf = $(this).parents('tr').attr('id');
	        	var idm = idf.substring(idf.indexOf('_')+1,idf.length);
	  		  	dt = dt+' '+idm+',';
	      	}    
    	}); 
    	if(dt==''){
      		var c = false;
    	} else {  	
  	  		var c = confirm('Continue delete \n'+dt.substring(1,dt.length-1)+'?');
    	}
  		if(c) {
  	  		ch.each(function(){
  		 		var $this = $(this);
  				if($this.is(':checked')) {
  					sel = true;	//set to true if there is/are selected row
          	var idf = $(this).parents('tr').attr('id');
          	var dataP = "idf="+idf;
  					$.ajax({
            			type: "POST",
            			url: baseurl+"process/menuinventory?p=delete",
            			data: dataP,
            			cache: false,
            			success: function(result){ 
              				if(result.trim()!='OK'){    
                				alert(result); 
              				} else {    
        						    $this.parents('tr').fadeOut(function(){
        							     $this.remove(); //remove row when animation is finished
        						    }); 
                        var page = window.location.href;
                        window.location.assign(page);     
              				}   
            			}
            });   
  				}
  	  	  });
  		  	if(!sel) alert('No data selected');	
  		}
  		return false;
  	}); 
});


$(function(){
	var baseurl = $("#baseurl").data('url');
	$("#newmeninv").validate({ 
    	rules: {
      		qty: { 
        		number: true 
      		},
      		menus: { 
        		remote: { 
              url: baseurl+"process/menuinventory?p=takene",
              type: "post",
              data: {
                menu: function() {
                  return $( "#menu" ).val();
                },   
                inv: function() {
                  return $( "#inv" ).val(); 
                }
              }
            } 
      		},
      		invs: { 
        		remote: { 
              url: baseurl+"process/menuinventory?p=takene",
              type: "post",
              data: {
                menu: function() {
                  return $( "#menu" ).val();
                },   
                inv: function() {
                  return $( "#inv" ).val();
                }
              }
            } 
      		}
	    },
	    messages:{ 
	      	qty: "Please enter a valid number.",
	      	menu: { 
	        	remote: "The combination already exists"
	      	},
	      	inv: {
	        	remote: "The combination already exists"
	      	}
	    },
      submitHandler: function(form) {
        $.ajax({ 
            url: baseurl+"process/menuinventory?p=takene",
            type: "post",
            data: {
              menu: function() {
                return $( "#menu" ).val();
              },   
              inv: function() {
                return $( "#inv" ).val();
              }
            },
            success: function(response) {
              if(response.trim()!="true"){  
                $("#combresp").show(); 
                $('#combout').html("The combination already exists"); 
              } else {  
                form.submit();   
                //console.log("fgd");
              } 
              //console.log(response);
            }            
        });
      }    
  });
});

$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
}); 
 
function isCombo(){
  return $('#combo').data('stat');
};
  
function isTakenC(mnu,inv) {
  var mic = mnu+","+inv;  
  var regex = /^(<?php $l = 1; $n = count($miclist); $micnum = ""; foreach ($miclist as $row){ $micnum .= $row->MENU_ID.",".$row->INVENTORY_ID; $micnum .= ($l<$n)?"|":""; $l++; } echo $micnum; ?>)$/;
  return regex.test(mic);
}        
  
</script>
