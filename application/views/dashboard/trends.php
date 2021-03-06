<div id="page-content-wrapper" style="padding-bottom:0px !important">
<!-- Page Content -->
  <div class="container-fluid" style="font-size:90%;">
    
    <div class="row">
    
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-6">
            <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
              <a role="button" class="btn btn-default" href="<?=base_url()?>dashboard/sales">&nbsp;&nbsp;Sales&nbsp;&nbsp;</a>   
              <a role="button" class="btn btn-primary" href="<?=base_url()?>dashboard/trends">&nbsp;&nbsp;Trends&nbsp;&nbsp;</a>
              <a role="button" class="btn btn-default" href="<?=base_url()?>dashboard/inventory" <?=(count($nostock)>0)?'title="'.count($nostock).' no stock item(s)"':''?>>Inventory</a>
            </div>  
            <?php if(count($nostock)>0){ ?>
            <span class="label label-danger label-as-badge" style="margin-top:5px;margin-left:-10px;z-index:3;position:absolute">
              <?=count($nostock)?>
            </span>         
            <?php } ?>
          </div>
          <div class="col-md-6">    
            <!--<div style="display:inline-block;float:left" name="sales_tab" class="navdash navdash_first active">Sales</div>
            <div style="display:inline-block" name="inventory_tab" class="navdash navdash_last">Inventory</div>-->  
            <div class="pull-right">
              <div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
                <a id="print" role="button" class="btn btn-primary" href="<?=base_url()?>dashboard/trendsprint/<?=$hashvars?>" target="_blank">&nbsp;<span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print&nbsp;</a>
              </div>
            </div>    
            <!--<div class="btn-group" role="group" aria-label="..." style="margin-top:10px;">
              <a id="export" role="button" class="btn btn-primary" href="#"><span class="glyphicon glyphicon-export"></span>&nbsp;&nbsp;Export</a>        
            </div>--> 
            <!--<span class="pull-right">
              <div style="display:inline-block" name="print_tab" class="navdash navdash_alone">
                <span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print
              </div>
              <div style="display:inline-block" name="export_tab" class="navdash navdash_alone">
                <span class="glyphicon glyphicon-export"></span>&nbsp;&nbsp;Export
              </div>
            </span>-->
          </div> 
        </div>                          
        <hr style="margin-bottom:10px;margin-top:10px" /> 
                     
        <div class="row" style="padding-left: 15px">  
          <?php
            $attributes = array('class' => 'form-inline', 'id' => 'filter', 'role' => 'form');
            echo form_open('dashboard/trends',$attributes)
          ?>
            <!--<div class="form-group" style="margin-bottom:0px">
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
            </div>-->
            <div class="form-group" style="margin-bottom:0px">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-cutlery"></span></div>
                <select id = "myRestaurant" name="rest_id" title="Restaurant Name" class="form-control" style="display:inline">
                  <!--<option value = "0">ALL Restaurants</option>-->
                  <option value = "0">Select Restaurant</option>
                  <?php foreach($restaurants as $row){ ?>
                  <option value = "<?=$row->REST_ID?>" <?= ($row->REST_ID==$rest_id)?'selected':''?> ><?=$row->NAME?></option>
                  <?php } ?>
                </select>   
              </div>
            </div>
            <div class="form-group" style="margin-bottom:0px">
              <div class="input-group">
                <input type="submit" name="filter" class="btn btn-success" style="display:inline" value="Filter">
              </div>
            </div>
          <?=form_close()?>
	      </div>   
		    
        <hr style="margin-bottom:10px;margin-top:10px" />
		
	         <div class="row">
      			<div class="col-lg-12">
      				<div class="panel panel-default">
      					<div class="panel-heading">
      					  <div class="row" style="padding-left:10px;padding-right:10px">
        					  <b>
                      <span id="motit">Monthly Revenue - Last 6 Months</span>
                      <span id="wktit" style="display:none">Weekly Revenue - Last 12 Weeks</span>
                    </b>
                    <div class="btn-group pull-right" role="group" aria-label="...">
                      <a role="button" class="btn btn-sm btn-primary" id="mobutt" href="#monthly-line-chart">Monthly</a> 
                      <a role="button" class="btn btn-sm btn-default" id="wkbutt" href="#weekly-line-chart">Weekly</a>        
                    </div>
                  </div>
                </div>
      					<div class="panel-body">
      						<div class="canvas-wrapper">
      							<canvas class="main-chart" id="monthly-line-chart" height="125" width="600"></canvas>
      						</div>
      						<div class="canvas-wrapper">
      							<canvas class="main-chart" id="weekly-line-chart" height="125" width="600" style="display:none"></canvas>
      						</div>
      					</div>
      				</div>
      			</div>
      	</div><!--/.row-->
        
	         <div class="row">
      			<div class="col-lg-12">
      				<div class="panel panel-default">
      					<div class="panel-heading">
      					  <div class="row" style="padding-left:10px;padding-right:10px">
        					  <b>
                      <span id="pctit">Weekly Average Sales Per Customer - Last 12 Weeks</span>
                      <span id="pitit" style="display:none">Weekly Average Sales Per Invoice - Last 12 Weeks</span>
                    </b>
                    <div class="btn-group pull-right" role="group" aria-label="...">
                      <a role="button" class="btn btn-sm btn-primary" id="pcbutt" href="#davrspcust-line-chart">Per Customer</a> 
                      <a role="button" class="btn btn-sm btn-default" id="pibutt" href="#davrspinvo-line-chart">Per Invoice</a>        
                    </div>
                  </div>
                </div>
      					<div class="panel-body">
      						<div class="canvas-wrapper">
      							<canvas class="main-chart" id="davrspcust-line-chart" height="125" width="600"></canvas>
      						</div>
      						<div class="canvas-wrapper">
      							<canvas class="main-chart" id="davrspinvo-line-chart" height="125" width="600" style="display:none"></canvas>
      						</div>
      					</div>
      				</div>
      			</div>
      	</div><!--/.row-->
               
      </div><!-- /.col-sm-10 -->

      <div class="col-sm-2" style="padding:0;">
        
        <div class="list-group rightdash" style="margin-top:10px;"> 
          <div class="rdinfo">
            <?=$startdate." - ".$enddate?> 
          </div>    
        </div>    
        
        <div class="list-group rightdash">      
          <div class="rdtitle">Sales</div>
          <!--<a href="#" class="pull-right">See all</a>-->
          <span class="list-group-item noborder pad30" style="background-color:#e4843f;">
            <span class="text270"><?=$cur?> <span id="nsales" value="<?=$this->currency->decimal($net_sales->NET_SALES,$cur)?>" data-cur="<?=$cur?>"></span></span><br>  
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;<span style="font-size:105%;"><b>Net Sales</b></span><br>
          </span>   
          <div class="rdinfo"></div>   
          <span class="list-group-item orgbg noborder pad30"> 
            <span class="text270"><?=$cur?> <span id="tsales" value="<?=$this->currency->decimal($tot_sales->TOTAL_SALES,$cur)?>" data-cur="<?=$cur?>"></span></span><br>     
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;<span style="font-size:105%;"><b>Total Sales</b></span><br>
          </span> 
          <div class="rdinfo"></div> 
        </div>    
        
        <div class="list-group rightdash">            
          <div class="rdtitle">Customer</div>
          <!--<a href="#" class="pull-right">See all</a>-->
          <span class="list-group-item teabg noborder pad30">   
            <span class="text270"><?=$cur?> <span id="csales" value="<?=$this->currency->decimal($avrsls_percust->AVG_SALES_CUST,$cur)?>" data-cur="<?=$cur?>"></span></span> <br>  
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;<span style="font-size:105%;"><b>Average Sales/Customer</b></span>
          </span>   
          <div class="rdinfo"><?=$num_cust->TOTAL_CUST?> Customer(s)</div>
        </div>        
                  
        <div class="list-group rightdash">    
          <div class="rdtitle">Invoice</div>   
          <!--<a href="#" class="pull-right">See all</a>-->
          <span class="list-group-item redbg noborder pad30">
            <span class="text270"><?=$cur?> <span id="isales" value="<?=$this->currency->decimal($avrsls_perinv->AVG_SALES_INV,$cur)?>" data-cur="<?=$cur?>"></span></span> <br>  
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;<span style="font-size:105%;"><b>Average Sales/Invoice</b></span>
          </span>  
          <div class="rdinfo"><?=$com_inv->TOTAL_INV?> Invoice(s)</div> 
        </div>    
        
      </div><!-- /.col-sm-3 -->
      
    </div><!-- /.row -->
      
  </div><!-- /.container-fluid -->
  
</div><!-- /#page-content-wrapper -->     
<div id="cur" data-val="<?=$cur?>"></div>
                    
<?php
  //line chart script  
  $i = 0;
  $n = count($dmorevenue);  
  $labels = "";
  $data = "";
  foreach ($dmorevenue as $row){  
    $labels .= ($i==($n-1))?"'".date('M', strtotime($row->REC_MONTH))."'":"'".date('M', strtotime($row->REC_MONTH))."',"; 
    $data .=  ($i==($n-1))?(float)$row->AMT:(float)$row->AMT.","; 
    $i++;
  }
  $chart_script = "<script>"; 
  $chart_script .= "var lineChartData = {";
	$chart_script .= "		labels : [".$labels."],";
	$chart_script .= "		datasets : [";
	$chart_script .= "			{ ";
	$chart_script .= "				label: 'Monthly Revenue - Last 6 Months',";
	$chart_script .= "				fillColor : 'rgba(48, 164, 255, 0.2)', ";
	$chart_script .= "				strokeColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointStrokeColor : '#fff', ";
	$chart_script .= "				pointHighlightFill : '#fff', ";
	$chart_script .= "				pointHighlightStroke : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				data : [".$data."]";
	$chart_script .= "			}";
	$chart_script .= "		]";
  $chart_script .= "	};";
	$chart_script .= "var chart3 = document.getElementById('monthly-line-chart').getContext('2d');";    
  $chart_script .= "chart3.canvas.height = 115;";
	$chart_script .= "window.myLine1 = new Chart(chart3).Line(lineChartData, { ";
	$chart_script .= "	responsive: true, tooltipFontSize : 12,";
	$chart_script .= "	legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%>eek<%=datasets[i].label%><%}%></li><%}%></ul>', ";
	$chart_script .= "	tooltipTemplate: '<%if (label){%><%=label%>: ".$cur."<%}%> <%= ".$this->currency->jsformat($cur)." %>' ";  
	$chart_script .= "}); ";
	$chart_script .= '</script>';
  echo $chart_script;
?> 
  
<?php
  //line chart script  
  $i = 0;
  $n = count($dwkrevenue);  
  $labels = "";
  $data = "";
  foreach ($dwkrevenue as $rowk){  
    $labels .= ($i==($n-1))?"'".date('M d', strtotime($rowk->REC_WEEK))."'":"'".date('M d', strtotime($rowk->REC_WEEK))."',"; 
    $data .=  ($i==($n-1))?(float)$rowk->AMT:(float)$rowk->AMT.","; 
    $i++;
  }
  $chart_script = "<script>"; 
  $chart_script .= "var lineChartData = {";
	$chart_script .= "		labels : [".$labels."],";
	$chart_script .= "		datasets : [";
	$chart_script .= "			{ ";
	$chart_script .= "				label: 'Weekly Revenue - Last 12 Weeks',";
	$chart_script .= "				fillColor : 'rgba(48, 164, 255, 0.2)', ";
	$chart_script .= "				strokeColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointStrokeColor : '#fff', ";
	$chart_script .= "				pointHighlightFill : '#fff', ";
	$chart_script .= "				pointHighlightStroke : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				data : [".$data."]";
	$chart_script .= "			}";
	$chart_script .= "		]";
  	$chart_script .= "	};";
	$chart_script .= "var chart5 = document.getElementById('weekly-line-chart').getContext('2d');";    
  	$chart_script .= "chart5.canvas.height = 115;";
	$chart_script .= "window.myLine2 = new Chart(chart5).Line(lineChartData, { ";
	$chart_script .= "	responsive: true, tooltipFontSize : 12,";
	$chart_script .= "	tooltipTemplate: '<%if (label){%><%=label%>: ".$cur." <%}%><%= ".$this->currency->jsformat($cur)." %>' ";
	$chart_script .= "});  ";
	$chart_script .= '</script>';
  echo $chart_script;
?> 
           
<?php
  //line chart script  
  $i = 0;
  $n = count($davrspcust);  
  $labels = "";
  $data = "";
  foreach ($davrspcust as $rowc){  
    $labels .= ($i==($n-1))?"'".date('M d', strtotime($rowc->REC_WEEK))."'":"'".date('M d', strtotime($rowc->REC_WEEK))."',"; 
    $amountc = (strtolower($cur)=="rp")?number_format((float)$rowc->AVG_SALES_CUST, 0, '.', ''):number_format((float)$rowc->AVG_SALES_CUST, 2, '.', '');
    $data .=  ($i==($n-1))?$amountc:$amountc.","; 
    $i++;
  }
  $chart_script = "<script>"; 
  $chart_script .= "var lineChartData = {";
	$chart_script .= "		labels : [".$labels."],";
	$chart_script .= "		datasets : [";
	$chart_script .= "			{ ";
	$chart_script .= "				label: 'Weekly Average Sales Per Customer - Last 12 weeks',";
	$chart_script .= "				fillColor : 'rgba(48, 164, 255, 0.2)', ";
	$chart_script .= "				strokeColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointStrokeColor : '#fff', ";
	$chart_script .= "				pointHighlightFill : '#fff', ";
	$chart_script .= "				pointHighlightStroke : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				data : [".$data."]";
	$chart_script .= "			}";
	$chart_script .= "		]";
  	$chart_script .= "	};";
	$chart_script .= "var chart7 = document.getElementById('davrspcust-line-chart').getContext('2d');";    
  	$chart_script .= "chart7.canvas.height = 115;";
	$chart_script .= "window.myLine7 = new Chart(chart7).Line(lineChartData, { ";
	$chart_script .= "	responsive: true, tooltipFontSize : 12,";
	$chart_script .= "	tooltipTemplate: '<%if (label){%><%=label%>: ".$cur." <%}%><%= ".$this->currency->jsformat($cur)." %>' ";
	$chart_script .= "});  ";
	$chart_script .= '</script>';
  echo $chart_script;
?>  
       
<?php
  //line chart script  
  $i = 0;
  $n = count($davrspinvo);  
  $labels = "";
  $data = "";
  foreach ($davrspinvo as $rowi){  
    if($rowi->AVG_SALES_INV==NULL){ $rowi->AVG_SALES_INV = 0; }
    $labels .= ($i==($n-1))?"'".date('M d', strtotime($rowi->REC_WEEK))."'":"'".date('M d', strtotime($rowi->REC_WEEK))."',"; 
    $amounti = (strtolower($cur)=="rp")?number_format((float)$rowi->AVG_SALES_INV, 0, '.', ''):number_format((float)$rowi->AVG_SALES_INV, 2, '.', '');
    $data .=  ($i==($n-1))?$amounti:$amounti.","; 
    $i++;    
  }
  $chart_script = "<script>"; 
  $chart_script .= "var lineChartData = {";
	$chart_script .= "		labels : [".$labels."],";
	$chart_script .= "		datasets : [";
	$chart_script .= "			{ ";
	$chart_script .= "				label: 'Weekly Average Sales Per Invoice - Last 12 weeks',";
	$chart_script .= "				fillColor : 'rgba(48, 164, 255, 0.2)', ";
	$chart_script .= "				strokeColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointColor : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				pointStrokeColor : '#fff', ";
	$chart_script .= "				pointHighlightFill : '#fff', ";
	$chart_script .= "				pointHighlightStroke : 'rgba(48, 164, 255, 1)', ";
	$chart_script .= "				data : [".$data."]";
	$chart_script .= "			}";
	$chart_script .= "		]";
  	$chart_script .= "	};";
	$chart_script .= "var chart9 = document.getElementById('davrspinvo-line-chart').getContext('2d');";    
  	$chart_script .= "chart9.canvas.height = 115;";
	$chart_script .= "window.myLine9 = new Chart(chart9).Line(lineChartData, { ";
	$chart_script .= "	responsive: true, tooltipFontSize : 12,";
	$chart_script .= "	tooltipTemplate: '<%if (label){%><%=label%>: ".$cur." <%}%><%= ".$this->currency->jsformat($cur)." %>' ";
	$chart_script .= "});  ";
	$chart_script .= '</script>';
  echo $chart_script;
?>                  

<script>
$(document).ready(function(){
    
  $.each($('td.trunk').not(':empty'), function(i,v){
    var count = parseInt($(this).text().length);
    var maxChars = 6;
    if(count > maxChars){
      var str = $(this).text();
      var trimmed = str.substr(0, maxChars);
      $(v).html('<b>'+trimmed + '<a href="#" title="'+str+'">...</a></b>');          
    }
       
  });
  
}); 
  /*
     //datepickers
     $("#startdate").datepicker({format: 'dd M yyyy'});
     $("#enddate").datepicker({format: 'dd M yyyy'});
  */
     
     //switch chart
     $("#mobutt").click(function(){      
        $("#monthly-line-chart,#motit").show(); 
        $("#weekly-line-chart,#wktit").hide();  
        $("#mobutt").removeClass("btn-default").addClass("btn-primary"); 
        $("#wkbutt").removeClass("btn-default").removeClass("btn-primary").addClass("btn-default");
     });  
     $("#wkbutt").click(function(){
        $("#monthly-line-chart,#motit").hide(); 
        $("#weekly-line-chart,#wktit").show();  
        $("#mobutt").removeClass("btn-default").removeClass("btn-primary").addClass("btn-default"); 
        $("#wkbutt").removeClass("btn-default").addClass("btn-primary");         
     });          
     $("#pcbutt").click(function(){      
        $("#davrspcust-line-chart,#pctit").show(); 
        $("#davrspinvo-line-chart,#pitit").hide();  
        $("#pcbutt").removeClass("btn-default").addClass("btn-primary"); 
        $("#pibutt").removeClass("btn-default").removeClass("btn-primary").addClass("btn-default");
     });  
     $("#pibutt").click(function(){
        $("#davrspcust-line-chart,#pctit").hide(); 
        $("#davrspinvo-line-chart,#pitit").show();  
        $("#pcbutt").removeClass("btn-default").removeClass("btn-primary").addClass("btn-default"); 
        $("#pibutt").removeClass("btn-default").addClass("btn-primary");         
     });                                  
     
     //print page
     $("#print").click(function(){      
        //window.print();
     });   
       
    //animating numbers 
    $(document).ready(function () {
      animateNumbers("#nsales");
      animateNumbers("#tsales");
      animateNumbers("#csales");
      animateNumbers("#isales");
    });
           
    function animateNumbers0(ale) {    
        var num = $(ale).attr("value");
        $(ale).countTo({
            from: 0,
            to: num,
            speed: 1000,
            refreshInterval: 50,
            onComplete: function(value) {
                $(ale).html(currencyFormat(num));
                console.debug(this);
            }
        });
    }
           
    function animateNumbers(ale) {    
        var num = $(ale).attr("value"); 
        var cur = $(ale).data("cur");
        $(ale).countTo({
            from: 0,
            to: num,
            speed: 1000,
            refreshInterval: 50,
            onComplete: function(value) {
      				if(cur.toLowerCase() == "RP".toLowerCase()){
                $(ale).html(currencyFormat(num));
      				} else if(cur.toLowerCase() == "RS".toLowerCase()){
                $(ale).html(currencyFormatRS(num));
      				} else {
      					$(ale).html(numberWithCommas(num));
      				}
                //console.debug(this);
            }
        });
    }

  function currencyFormat(number){   
		return (number + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
  }  
          
  function currencyFormatRS0(number){
    return (number + "").replace(/(\d)(?=((\d)(\d{2}?)+)$)/g, "$1,");
  }          
  
  function currencyFormatRS(x){
    	var parts = x.toString().split(".");
    	parts[0] = parts[0].replace(/(\B)(?=((\d)(\d{2}?)+)$)/g, "$1,");
    	return parts.join(".");
  }          
    
	function numberWithCommas(x) {
    	var parts = x.toString().split(".");
    	parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    	return parts.join(".");
	}
	
    (function($) {
      $.fn.countTo = function(options) { 
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(currencyFormat(value.toFixed(options.decimals)));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
      };

      $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
      };
        
    })(jQuery);
    
    
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