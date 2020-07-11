  <style>
#chartdiv2 {
	width		: 100%;
	height		: 250px;
	font-size	: 11px;
}					
.style2 {font-size: 24px}
</style>
<style>
#chartdiv {
	width		: 100%;
	height		: 250px;
	font-size	: 11px;
}							
</style>
          
               <div class="col-md-12" role="main">
        <div class="row">
            <div class="col-md-4">
                <ul class="site-stats">
                    <li><a href="<?php echo base_url(); ?>index.php?admin/student_report"><h3><div class="col-md-4 stats-left" style="background-color:#4e7d2a"><i class="fa fa-bar-chart-o"></i></div>  <div class="col-md-8 stats-right  text-right"> <?php echo get_phrase("students'_report"); ?></div></h3></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/attendance_report"><h3> <div class="col-md-4 stats-left" style="background-color:#489ee7"><i class="fa entypo-chart-area"></i></div>  <div class="col-md-8 stats-right  text-right"><?php echo get_phrase('attendance_report'); ?> </div></h3></a></li>

                </ul>
            </div>
            <div class="col-md-4">
                <ul class="site-stats">
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/payment_report"><h3> <div class="col-md-4 stats-left" style="background-color:#3bbc63"><i class="entypo-chart-bar"></i></div>  <div class="col-md-8 stats-right  text-right"><?php echo get_phrase('payment_report'); ?></div> </h3></a></li>
                    <li>  <a href="<?php echo base_url(); ?>index.php?admin/expense_report"><h3> <div class="col-md-4 stats-left" style="background-color:#fb5d5d"><i class="entypo-chart-line"></i></div>  <div class="col-md-8 stats-right  text-right"><?php echo get_phrase('view_expense_report'); ?></div></h3></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="site-stats">
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/tabulation_sheet"><h3> <div class="col-md-4 stats-left" style="background-color:#f7941d"><i class="entypo-chart-pie"></i></div>  <div class="col-md-8 stats-right  text-right"><?php echo get_phrase('exam_score_report'); ?></div></h3></a></li>
                    <li>  <a href="<?php echo base_url(); ?>index.php?admin/loan_report"><h3> <div class="col-md-4 stats-left" style="background-color:#797b0e"><i class="entypo-air"></i></div>  <div class="col-md-8  stats-right text-right"><?php echo get_phrase('view_loan_report'); ?></div></h3></a></li>
                </ul>
            </div>
        </div>
		</div>
		
		
			
<div class="col-md-6">
<div class="x_panel" >
 <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('chart Details'); ?>
					</div>
					</div>
											 <div id="chartdiv2"></div>	              


</div>
</div>

<div class="col-md-6">
<div class="x_panel" >
 <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('chart Details'); ?>
					</div>
					</div>
											 <div id="chartdiv"></div>	              


</div>
</div>

<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_classes'); ?>
					</div>
					</div>
<div class="table-responsive">				
<table class="table" id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('class_name');?></div></th>
                    		<th><div><?php echo get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($classes as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['name_numeric'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
							
							<a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i>View Student</button></a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
			
            <!----TABLE LISTING ENDS--->
    <script src="<?php echo base_url() ?>js/amcharts.js"></script>
<script src="<?php echo base_url() ?>js/serial.js"></script>

<script src="<?php echo base_url() ?>js/canvasjs.min.js"></script>
<script>

 $(function () {
//        $('#sel_location_modal').slideDown('slow');
<?php if ($this->session->userdata('isFirst')) { ?>
            showSelectLocationModal();
<?php } ?>

        var chart = AmCharts.makeChart("chartdiv2", {
            "titles": [{
                    "text": "Basic Chart Information",
                    "size": 15,
                    "color": '#FF0000'
                }],
            "type": "serial",
            "theme": "light",
            "marginTop": 50,
            "marginRight": 40,
            "dataProvider": [{
                    "index": " <?php echo get_phrase('payment');?>",
                    "value": <?php echo $this->db->count_all('payment');?>
                }, {
                    "index": " <?php echo get_phrase('all_invoice');?>",
                    "value": <?php echo $this->db->count_all('invoice');?>
                }, {
                    "index": " <?php echo get_phrase('help_desk');?>",
                    "value": <?php echo $this->db->count_all('help_desk');?>
                }, {
                    "index": " <?php echo get_phrase('results');?>",
                    "value": <?php echo $this->db->count_all('exam_result');?>
                }, {
                    "index": " <?php echo get_phrase('enquiry');?>",
                    "value": <?php echo $this->db->count_all('enquiry');?>
                }, {
                    "index": " <?php echo get_phrase('media');?>",
                    "value": <?php echo $this->db->count_all('media');?>
                }],
            "valueAxes": [{
                    "axisAlpha": 0.5,
                    "position": "left"
                }],
            "graphs": [{
                    "id": "g1",
                    "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                    "bullet": "round",
                    "bulletSize": 8,
                    "lineColor": "#4e7d2a",
                    "lineThickness": 2,
                    "negativeLineColor": "#4e7d2a",
                    "type": "smoothedLine",
                    "valueField": "value",
                    "balloonColor": "#f7941d",
                    "balloon": {
                        "adjustBorderColor": true,
                        "color": "#fff",
                        "cornerRadius": 5,
                        "fillColor": "#FF0000"
                    }
                }],
//            "chartScrollbar": {
//                "graph": "g1",
//                "gridAlpha": 0,
//                "color": "#888888",
//                "scrollbarHeight": 55,
//                "backgroundAlpha": 0,
//                "selectedBackgroundAlpha": 0.1,
//                "selectedBackgroundColor": "#888888",
//                "graphFillAlpha": 0,
//                "autoGridCount": true,
//                "selectedGraphFillAlpha": 0,
//                "graphLineAlpha": 0.2,
//                "graphLineColor": "#c2c2c2",
//                "selectedGraphLineColor": "#888888",
//                "selectedGraphLineAlpha": 1
//
//            },
            "chartCursor": {
//                "categoryBalloonDateFormat": "YYYY",
                "cursorAlpha": 0,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": 0.5,
                "fullWidth": true,
                "color":"#fff",
                "cursorColor": "#4e7d2a",
                "zoomable": false
            },
//            "dataDateFormat": "YYYY",
            "categoryField": "index",
            "categoryAxis": {
//                "minPeriod": "YYYY",
                "parseDates": false,
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true,
                "autoWrap":true,

            },
            "export": {
                "enabled": true
            }
        });
//
//        chart.addListener("rendered", zoomChart);
//        if (chart.zoomChart) {
//            chart.zoomChart();
//        }
//
//        function zoomChart() {
//            chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
//        }


    });
</script>


<script>
var chart;
var legend;
var selected;

var types = [{
  type: "<?php echo get_phrase('section');?>",
  percent: <?php echo $this->db->count_all('section');?>,
  color: "#ff9e01",
  subs: [{
    type: "<?php echo get_phrase('class');?>",
    percent: <?php echo $this->db->count_all('class');?>,
  }, {
    type: "<?php echo get_phrase('subject');?>",
    percent: <?php echo $this->db->count_all('subject');?>,
  }, {
    type: "<?php echo get_phrase('study_material');?>",
    percent: <?php echo $this->db->count_all('document');?>,
  }]
}, {
  type: "<?php echo get_phrase('transportations');?>",
  percent: <?php echo $this->db->count_all('transport');?>,
  color: "#b0de09",
  subs: [{
    type: "<?php echo get_phrase('assignments');?>",
    percent: <?php echo $this->db->count_all('assignment');?>
  }, {
    type: "<?php echo get_phrase('syllabus');?>",
    percent: <?php echo $this->db->count_all('document');?>
  }, {
    type: "<?php echo get_phrase('task_manager');?>",
    percent: <?php echo $this->db->count_all('task_manager');?>
  }]
  
  }, {
  type: "<?php echo get_phrase('expenses');?>",
  percent: <?php echo $this->db->count_all('expense_category');?>,
  color: "#FF0000",
  subs: [{
    type: "<?php echo get_phrase('all_news');?>",
    percent: <?php echo $this->db->count_all('news');?>
  }, {
    type: "<?php echo get_phrase('exam_question');?>",
    percent: <?php echo $this->db->count_all('question');?>
  }, {
    type: "<?php echo get_phrase('thoughts');?>",
    percent: <?php echo $this->db->count_all('todays_thought');?>
  }]
}];

function generateChartData() {
  var chartData = [];
  for (var i = 0; i < types.length; i++) {
    if (i == selected) {
      for (var x = 0; x < types[i].subs.length; x++) {
        chartData.push({
          type: types[i].subs[x].type,
          percent: types[i].subs[x].percent,
          color: types[i].color,
          pulled: true
        });
      }
    } else {
      chartData.push({
        type: types[i].type,
        percent: types[i].percent,
        color: types[i].color,
        id: i
      });
    }
  }
  return chartData;
}

AmCharts.makeChart("chartdiv", {
  "type": "pie",
"theme": "light",

  "dataProvider": generateChartData(),
  "labelText": "[[title]]: [[value]]",
  "balloonText": "[[title]]: [[value]]",
  "titleField": "type",
  "valueField": "percent",
  "outlineColor": "#FFFFFF",
  "outlineAlpha": 0.8,
  "outlineThickness": 2,
  "colorField": "color",
  "pulledField": "pulled",
  "titles": [{
    "text": "Click a slice to see the details"
	
  }],
  "listeners": [{
    "event": "clickSlice",
    "method": function(event) {
      var chart = event.chart;
      if (event.dataItem.dataContext.id != undefined) {
        selected = event.dataItem.dataContext.id;
      } else {
        selected = undefined;
      }
      chart.dataProvider = generateChartData();
      chart.validateData();
    }
  }],
  "export": {
    "enabled": true
  }
});
</script>

        

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
		