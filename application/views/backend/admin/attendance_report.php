<style>
#chartdiv2 {
	width		: 100%;
	height		: 250px;
	font-size	: 11px;
}					
.style2 {font-size: 24px}
</style>

<style>
#chartdiv3 {
	width		: 100%;
	height		: 250px;
	font-size	: 11px;
}					
.style2 {font-size: 24px}
</style>

<script src="<?php echo base_url() ?>js/amcharts.js"></script>
<script src="<?php echo base_url() ?>js/serial.js"></script>

<script src="<?php echo base_url() ?>js/canvasjs.min.js"></script>
<script>
 $(function () {

        var chart = AmCharts.makeChart("chartdiv2", {
            "titles": [{
                    "text": "<?php echo get_phrase('general_attendance_for');?> <?php echo date('Y-m-d')?>",
                    "size": 15,
                    "color": '#FF0000'
                }],
            "type": "serial",
            "theme": "light",
            "marginTop": 50,
            "marginRight": 40,
            "dataProvider": [
			
							<?php 
							$check	=	array(	'date' => date('Y-m-d') , 'status' == '1' && 'status' == '2' && 'status' == '3' && 'status' == '4' && 'status' == '5' );
							$query = $this->db->get_where('attendance' , $check);
							$students		=	$query->result_array();
							foreach ($students as $row):
							?>
		
				{
                    "index": "<?php echo $row['date'];?>",
                    "value": <?php echo $row['status'];?>			
                },
                        <?php endforeach;?>
				],
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

		
		<div class="col-md-12">
		<div class="x_panel" >
	<div id="chartdiv2"></div>	              

		</div>
		</div>
		
		<div class="col-md-12">
		 <div class="x_panel" align="center">
KEYS: Present&nbsp;-&nbsp; <span class="badge bg-green">1</span>&nbsp;&nbsp;Absent&nbsp;-&nbsp; <span class="badge bg-green">2</span>&nbsp;&nbsp;Holiday&nbsp;-&nbsp;<span class="badge bg-green">3</span>&nbsp;&nbsp;Half Day&nbsp;-&nbsp; <span class="badge bg-green">4</span>&nbsp;&nbsp;Late&nbsp;-&nbsp; <span class="badge bg-green">5</span>
			</div>
			</div>
		





<?php 
    $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
?>
<div class="col-md-12">

        <div class="x_panel" >
<div class="row">

    <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
            <tr>
                <th>Class</th>
               
                <th>Month</th>
                <th>Academic Session</th>
                <th></th>
           </tr>
       </thead>
        <tbody>
            <form method="post" action="<?php echo base_url();?>index.php?admin/attendance_report_view" class="form">
                <tr class="gradeA">
                    <td>
                        <select name="class_id" id="class_id" class="form-control"  required>
                            <option value="">Select a class</option>
                            <?php 
                            $classes    =   $this->db->get('class')->result_array();
                            foreach($classes as $row):?>
                            <option value="<?php echo $row['class_id'];?>"
                                <?php if(isset($class_id) && $class_id==$row['class_id'])echo 'selected="selected"';?>>
                                    <?php echo $row['name'];?>
                                        </option>
                            <?php endforeach;?>
                        </select>

                    </td>
                    
                    <td>
                        <select name="month" class="form-control" required>
                            <option value="1" <?php if(isset($month) && $month=="1")echo 'selected="selected"';?>>January</option>
                            <option value="2" <?php if(isset($month) && $month=="2")echo 'selected="selected"';?>>February</option>
                            <option value="3" <?php if(isset($month) && $month=="3")echo 'selected="selected"';?>>March</option>
                            <option value="4" <?php if(isset($month) && $month=="4")echo 'selected="selected"';?>>April</option>
                            <option value="5" <?php if(isset($month) && $month=="5")echo 'selected="selected"';?>>May</option>
                            <option value="6" <?php if(isset($month) && $month=="6")echo 'selected="selected"';?>>June</option>
                            <option value="7" <?php if(isset($month) && $month=="7")echo 'selected="selected"';?>>July</option>
                            <option value="8" <?php if(isset($month) && $month=="8")echo 'selected="selected"';?>>August</option>
                            <option value="9" <?php if(isset($month) && $month=="9")echo 'selected="selected"';?>>September</option>
                            <option value="10" <?php if(isset($month) && $month=="10")echo 'selected="selected"';?>>October</option>
                            <option value="11" <?php if(isset($month) && $month=="11")echo 'selected="selected"';?>>November</option>
                            <option value="12" <?php if(isset($month) && $month=="12")echo 'selected="selected"';?>>December</option>
                        </select>
                    </td>
                    <td>
                        <select name="year" class="form-control" required>
                            <option value="2017" <?php if(isset($year) && $year=="2017")echo 'selected="selected"';?>>2017</option>
                            <option value="2018" <?php if(isset($year) && $year=="2018")echo 'selected="selected"';?>>2018</option>
							 <option value="2019" <?php if(isset($year) && $year=="2019")echo 'selected="selected"';?>>2019</option>
							  <option value="2020" <?php if(isset($year) && $year=="2020")echo 'selected="selected"';?>>2020</option>
							   <option value="2021" <?php if(isset($year) && $year=="2021")echo 'selected="selected"';?>>2021</option>
							    <option value="2022" <?php if(isset($year) && $year=="2022")echo 'selected="selected"';?>>2022</option>
								 <option value="2023" <?php if(isset($year) && $year=="2023")echo 'selected="selected"';?>>2023</option>
								  <option value="2024" <?php if(isset($year) && $year=="2024")echo 'selected="selected"';?>>2024</option>
								   <option value="2025" <?php if(isset($year) && $year=="2025")echo 'selected="selected"';?>>2025</option>
								    <option value="2026" <?php if(isset($year) && $year=="2026")echo 'selected="selected"';?>>2026</option>
									 <option value="2027" <?php if(isset($year) && $year=="2027")echo 'selected="selected"';?>>2027</option>
									 <option value="2028" <?php if(isset($year) && $year=="2028")echo 'selected="selected"';?>>2028</option>
									 <option value="2029" <?php if(isset($year) && $year=="2029")echo 'selected="selected"';?>>2029</option>
									 <option value="2030" <?php if(isset($year) && $year=="2030")echo 'selected="selected"';?>>2030</option>
                        </select>
                    </td>
                    <td align="center">
         <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-search"></i>&nbsp;<?php echo get_phrase('browse_report'); ?></button>

                    
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</div>
</div>
</div>
<br>

<?php if( $month!='' && $year!='' && $class_id!=''):?>
<div class="col-md-12">
<div class="x_panel" >
    <div class="col-md-12" style="text-align: center;">
        <div class="tile-stats tile-white">
            <h3 style="color: #696969;">Attendance Sheet</h3>
            <?php 
                $classes    =   $this->db->get('class')->result_array();
                foreach ($classes as $row) {
                    if(isset($class_id) && $class_id==$row['class_id']) $calss_name = $row['name'];
                }
               
            ?>
            <?php
                $full_date = "5"."-".$month."-".$year;
                $full_date = date_create($full_date);
                $full_date = date_format($full_date,"F, Y");
            ;?>
            <h4 style="color: #696969;">Class <?php echo $calss_name; ?> ,<?php echo $full_date; ?></h4>
        </div>
    </div>
	</div>
    <div class="col-md-4"></div>
</div>

<hr/>
<div class="col-md-12">

        <div class="x_panel" >
<div class="row">
    <div class="col-md-12">
    <table cellpadding="0" cellspacing="0" border="0" class="table">
	
	        <div class="x_panel">
			<span class="label label-success">Click student name to view profile</span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KEYS: Present&nbsp;-&nbsp; <i class="entypo-record" style="color: #00a651;"></i>&nbsp;&nbsp;Absent&nbsp;-&nbsp; <i class="entypo-record" style="color: #EE4749;"></i>&nbsp;&nbsp;Holiday&nbsp;-&nbsp;<i class="entypo-record" style="color: #000000;"></i>&nbsp;&nbsp;Half Day&nbsp;-&nbsp; <i class="entypo-record" style="color: #0000FF;"></i>&nbsp;&nbsp;Late&nbsp;-&nbsp; <i class="entypo-record" style="color: #FF6600;"></i>&nbsp;&nbsp;Undefine&nbsp;-&nbsp;  <i class="entypo-record" style="color: #CCCCCC;"></i>
			</div>
            <thead>
                <tr>
                    <td style="text-align: left;">Students<i class="entypo-down-thin"></i>| Date:</td>
                    <?php
                    $days = date("t",mktime(0,0,0,$month,1,$year)); 
                        for ($i=0; $i < $days; $i++) { 
                           ?>
                            <td style="text-align: center;"><?php echo ($i+1);?></td>   
                           <?php 
                        }
                    ;?>
                </tr>
            </thead>
            <tbody>
            <?php 
                //STUDENTS ATTENDANCE
                $students   =   $this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
                foreach($students as $row)
                {
                    ?>
                <tr class="gradeA">
                    <td align="left"><a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');"><?php echo $row['name'].' '.$row['surname'];;?></a></td>
                    <?php 
                         for ($i=1; $i <= $days; $i++) {
                            $full_date = $year."-".$month."/".$i;
                            $verify_data    =   array(  'student_id' => $row['student_id'],
                                                    'date' => $full_date);
                            $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                            $status     = $attendance->status;
                            ?>
                            <td style="text-align: center;">
                                <?php if ($status == "1"):?>
                                    <i class="entypo-record" style="color: #00a651;"></i>
                                <?php endif;?>
                                <?php if ($status == "2"):?>
                                    <i class="entypo-record" style="color: #EE4749;"></i>
                                <?php endif;?>
								
								<?php if ($status == "3"):?>
                                    <i class="entypo-record" style="color: #000000;"></i>
                                <?php endif;?>
								
								<?php if ($status == "0"):?>
                                    <i class="entypo-record" style="color: #CCCCCC;"></i>
                                <?php endif;?>
								
								<?php if ($status == "4"):?>
                                    <i class="entypo-record" style="color: #0000FF;"></i>
                                <?php endif;?>
								
								<?php if ($status == "5"):?>
                                    <i class="entypo-record" style="color: #FF6600;"></i>
                                <?php endif;?>
                            </td>    
                           <?php 
                        }
                    ;?>
                </tr>
                <?php
                }
                ;?>
            </tbody>
        </table>
        <center>
            <a href="<?php echo base_url(); ?>index.php?admin/attendance_report_print_view/<?php echo $class_id; ?>/<?php echo $month; ?>/<?php echo $year; ?>" class="btn btn-orange btn-xs btn-icon icon-left" target="_blank"><i class="entypo-print"></i>Print Attendance Sheet</a>
        </center>
		
		<hr>
		
		<script>
 $(function () {

        var chart = AmCharts.makeChart("chartdiv3", {
            "titles": [{
                    "text": "Class <?php echo $calss_name; ?> ,<?php echo $full_date; ?>",
                    "size": 15,
                    "color": '#FF0000'
                }],
            "type": "serial",
            "theme": "light",
            "marginTop": 50,
            "marginRight": 40,
            "dataProvider": [
							<?php  
							$verify_data = array('student_id' => $row['student_id'], 'date' == $full_date);
                            $attendance = $this->db->get_where('attendance' , $verify_data)->result_array();
                            foreach ($attendance as $row) :
                            ?>
				
				{
                    "index": "<?php echo $row ['date'];?>",
                    "value":  <?php echo $row ['status'];?>
                },
				<?php endforeach; ?>
  
				],
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
	<div id="chartdiv3"></div>	              
		
    </div>
</div>
</div>
</div>

<?php endif;?>

<script type="text/javascript">

$("#update_attendance").hide();

function update_attendance() {

    $("#attendance_list").hide();
       $("#update_attendance_button").hide();
        $("#update_attendance").show();

    }

    function select_section(class_id) {

        var sections = $(".section");
        for (var i = sections.length - 1; i >= 0; i--) {
           sections[i].style.display = "none";
           if (sections[i].value == class_id){
               sections[i].style.display = "block";
              sections[i].selected = "selected";
           }
        }
   }

    //function mark_all_present() {
      //  var status = $(".status");
        //for(var i = 0; i < status.length; i++)
          //  status[i].value = "1";
    //}

    //function mark_all_absent() {
      //  var status = $(".status");
        //for(var i = 0; i < status.length; i++)
       //     status[i].value = "2";
    //}//

</script>
<style>
    div.datepicker{
        border: 1px solid #c4c4c4 !important;
    }
</style>
