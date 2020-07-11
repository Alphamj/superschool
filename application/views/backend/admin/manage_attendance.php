
<style>
#chartdiv2 {
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
                    "text": "<?php echo get_phrase('attendance_for');?> <?php echo date('Y-m-d')?>",
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
    $get_system_settings	=	$this->crud_model->get_system_settings();
    $sessoin_id = $get_system_settings[17]['description'];
    $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
?>
<div class="col-md-12">

        <div class="x_panel" >
		
<div class="row">
  <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('manage_attendance'); ?>
					</div>
					</div>

    <table cellpadding="0" cellspacing="0" border="0" class="table">
    	<thead>
        	<tr>
                <th>Term</th>
                <th>Class</th>
                <th>Date</th>
                <th></th>
           </tr>
       </thead>
		<tbody>
        	<form method="post" action="<?php echo base_url();?>index.php?admin/attendance_selector" class="form">
            	<tr class="gradeA">
                <td>
                        <select name="exam_id" id="exam_id" class="form-control" required>
                            <option value="">Select a term</option>
                            <?php 
                            $terms    =   $this->db->get('exam')->result_array();
                            foreach($terms as $row):?>
                            <option value="<?php echo $row['exam_id'];?>"
                                <?php if(isset($exam_id) && $exam_id==$row['exam_id'])echo 'selected="selected"';?>>
                                    <?php echo $row['name'];?>
                                        </option>
                            <?php endforeach;
                            ?>
                        </select>

                    </td>
                    
                    <td>
                        <select name="class_id" id="class_id" class="form-control" required>
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
                        <input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy" value="<?php echo $year."-".$month."-".$date ;?>">
                    </td>
                    <td align="center">
    <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-search"></i>&nbsp;<?php echo get_phrase('browse_attendance'); ?></button>

                    
                    </td>
                </tr>
            </form>
		</tbody>
    </table>
   
</div>
</div>
</div>

<hr />

<?php if($date!='' && $month!='' && $year!='' && $class_id!='' && $exam_id != ''):?>
<div class="col-md-12">

        <div class="x_panel" >
<div class="row" style="text-align: center;">
    <div class="col-sm-12">
        <div class="tile-stats tile-white">
            <?php 
                $classes    =   $this->db->get('class')->result_array();
                foreach ($classes as $row) {
                    if(isset($class_id) && $class_id==$row['class_id']) $calss_name = $row['name'];
                }
            ?>
            <h3 style="color: #696969;">Attendance For Class <?php echo $calss_name;?></h3>
           
            <?php
                $full_date = $date."-".$month."-".$year;
                $full_date = date_create($full_date);
                $full_date = date_format($full_date,"d M Y");
             ;?>
            <h4 style="color: #696969;"><?php echo $full_date;?></h4>
        </div>
    </div>
	</div>
    <div class="col-sm-4"></div>
</div>
</div>
<div class="col-md-12">

        <div class="x_panel" >
<center>
    <a class="btn btn-green btn-sm btn-icon icon-left" onclick="mark_all_present()">
        <i class="entypo-check"></i> Mark All Present    </a>
		
		 <a class="btn btn-orange btn-sm btn-icon icon-left" onclick="mark_all_late()">
        <i class="entypo-check"></i> Mark All Late</a>
		
		 <a class="btn btn-blue btn-sm btn-icon icon-left" onclick="mark_all_half()">
        <i class="entypo-check"></i> Mark All Half Day   </a>
		
		 <a class="btn btn-green btn-sm btn-icon icon-left" onclick="mark_all_holiday()">
        <i class="entypo-check"></i> Mark All Holiday    </a>
		
    <a class="btn btn-red btn-sm btn-icon icon-left" onclick="mark_all_absent()">
        <i class="entypo-cancel"></i> Mark All Absent    </a>
		
		 <a class="btn btn-red btn-sm btn-icon icon-left" onclick="mark_all_undefined()">
        <i class="entypo-cancel"></i> Mark All Undefined    </a>
</center>
</div>
</div>

<br>

<div class="col-md-12">

        <div class="x_panel" >
        <form action="<?php echo base_url();?>index.php?admin/manage_attendance/<?php echo $date.'/'.$month.'/'.$year.'/'.$class_id .'/'.$exam_id;?>" method="post" accept-charset="utf-8">
		
        <div id="attendance_update">
    <table cellpadding="0" cellspacing="0" border="0" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Sex</th>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //STUDENTS ATTENDANCE
                    $students   =   $this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
                    $full_date = $year."-".$month."-".$date;
                    $i = 1;
                    foreach($students as $row)
                    {
                        ?>
                    <tr class="gradeA">
                        <td><?php echo $i;?></td>
                        <td> <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" style="max-height:30px;margin-right: 30px;"></td>
                        <td><?php echo $row['sex'];?></td>
                        <td><?php echo $row['roll'];?></td>
                        <td><?php echo $row['name'].' '.$row['surname'];?></td>
                        <td>
                            <?php 
                            //inserting blank data for students attendance if unavailable
                            $verify_data    =   array('class_id' => $class_id,'exam_id' => $exam_id,'session_year' => $sessoin_id, 'student_id' => $row['student_id'], 'date' => $full_date);
                            $query = $this->db->get_where('attendance' , $verify_data);
                            if($query->num_rows() < 1)
                                $this->db->insert('attendance' , $verify_data);
                            
                            //showing the attendance status editing option
                            $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                            $status     = $attendance->status;
                            ?>
                                <select class="status form-control" name="status_<?php echo $row['student_id'];?>" required>
                                    <option value="">Undefined</option>
                                    <option value="1" <?php if($status == 1)echo 'selected="selected"';?>>Present</option>
                                    <option value="2" <?php if($status == 2)echo 'selected="selected"';?>>Absent</option>
                                    <option value="3" <?php if($status == 3)echo 'selected="selected"';?>>Holiday</option>
                                    <option value="4" <?php if($status == 4)echo 'selected="selected"';?>>Half Day</option>
                                    <option value="5" <?php if($status == 5)echo 'selected="selected"';?>>Late</option>
                                </select>
                        </td>
                    </tr>
                    <?php
                        $i++; 
                    }
                    ;?>
                </tbody>
            </table>
        </div>
        <center>
            <button type="submit" class="btn btn-green btn-sm btn-icon icon-left" id="submit_button"><i class="entypo-check"></i> Save Changes</button>
        </center>
        </form>
        <?php echo $class_id, '_ _', $exam_id, '_ _', $sessoin_id; ?>
    </div>
</div>

<br>

<?php 
        if ($active_sms_service == ''):
    ?>
    <div class="row">
        <div class="col-md-12">
           <div class="alert alert-blue">
                SMS <?php echo get_phrase('service_is_not_selected');?>
           </div> 
        </div>
        <div class="col-md-4"></div>
    </div>
    <?php endif;?>
    <?php 
        if ($active_sms_service == 'disabled'):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                SMS <?php echo get_phrase('service_is_disabled');?>
           </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <?php endif;?>
    <?php 
        if ($active_sms_service == 'clickatell'):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                SMS <?php echo get_phrase('will_be_sent_by_clickatell');?>
           </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <?php endif;?>
    <?php 
        if ($active_sms_service == 'twilio'):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                SMS <?php echo get_phrase('will_be_sent_by_twilio');?>
           </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <?php endif;?>

<?php endif;?>
<!-----  add code on 26 may 2018 ---->   
 
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
<script type="text/javascript">
	 $( function() {
		
		$( ".datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			maxDate: new Date()
			
		});
	} );
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

    function mark_all_present() {
        var status = $(".status");
        for(var i = 0; i < status.length; i++)
            status[i].value = "1";
    }

    function mark_all_absent() {
        var status = $(".status");
        for(var i = 0; i < status.length; i++)
            status[i].value = "2";
    }
	
	function mark_all_late() {
        var status = $(".status");
        for(var i = 0; i < status.length; i++)
            status[i].value = "5";
    }
	
	function mark_all_half() {
        var status = $(".status");
        for(var i = 0; i < status.length; i++)
            status[i].value = "4";
    }
	
	function mark_all_holiday() {
        var status = $(".status");
        for(var i = 0; i < status.length; i++)
            status[i].value = "3";
    }
	
	function mark_all_undefined() {
        var status = $(".status");
        for(var i = 0; i < status.length; i++)
            status[i].value = "";
    }


</script>
<style>
    div.datepicker{
        border: 1px solid #c4c4c4 !important;
    }
</style>
