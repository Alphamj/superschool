
<!-- Resources -->

<style>
    #chartdiv2, #chartdiv {
        width		: 100%;
        height		: 300px;
        font-size	: 11px;
    }					
    .style2 {font-size: 24px}
</style>

<!-- FullCalendar -->
<link href="assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">

<?php $count_all = $this->db->count_all('student') + $this->db->count_all('teacher') + $this->db->count_all('parent') + $this->db->count_all('librarian') + $this->db->count_all('accountant'); ?>
<?php
$check = array('date' => date('Y-m-d'), 'status' => '1');
$query = $this->db->get_where('attendance', $check);
$present_today = $query->num_rows();
?>
<div class="row">
    <div class="col-md-12" role="main">
        <div class="row">
            <div class="col-md-4">
                <ul class="site-stats">
                    <li><a href=""><h3><div class="col-md-4 stats-left" style="background-color:#4e7d2a"><i class="fa fa-group"></i></div>  <div class="col-md-8 stats-right  text-right"> Total <?php echo get_phrase('student'); ?> : <strong><?php echo $this->db->count_all('student'); ?></strong></div></h3></a> </li>
                    <li><a href=""><h3> <div class="col-md-4 stats-left" style="background-color:#489ee7"><i class="entypo-user"></i></div>  <div class="col-md-8 stats-right  text-right">  Total <?php echo get_phrase('teacher'); ?>  :  <strong><?php echo $this->db->count_all('teacher'); ?></strong></div></h3></a></li>

                </ul>
            </div>
            <div class="col-md-4">
                <ul class="site-stats">
                    <li> <a href=""><h3> <div class="col-md-4 stats-left" style="background-color:#3bbc63"><i class="entypo-users"></i></div>  <div class="col-md-8 stats-right  text-right">  Total <?php echo get_phrase('parent'); ?>  : <strong><?php echo $this->db->count_all('parent'); ?></strong></div> </h3></a></li>
                    <li>  <a href=""><h3> <div class="col-md-4 stats-left" style="background-color:#fb5d5d"><i class="entypo-book"></i></div>  <div class="col-md-8 stats-right  text-right">  Total <?php echo get_phrase('librarian'); ?>  : <strong><?php echo $this->db->count_all('librarian'); ?></strong></div></h3></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="site-stats">
                    <li> <a href=""><h3> <div class="col-md-4 stats-left" style="background-color:#f7941d"><i class="entypo-user-add"></i></div>  <div class="col-md-8 stats-right  text-right">   <?php echo get_phrase('Accountant'); ?>  :  <strong><?php echo $this->db->count_all('accountant'); ?></strong></div></h3></a></li>
                    <li>  <a href=""><h3> <div class="col-md-4 stats-left" style="background-color:#797b0e"><i class="fa fa-gear"></i></div>  <div class="col-md-8  stats-right text-right">  <?php echo get_phrase('all_enquiry'); ?>  : <strong><?php echo $this->db->count_all('enquiry'); ?></strong></div></h3></a></li>
                </ul>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Calendar Events <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div id='calendar'></div>

            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo get_phrase('New_Students'); ?></h2>
                <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
                <?php
                $new_students_list = $this->crud_model->new_student_list();
                foreach ($new_students_list as $student):
                    ?>
                    <li class="media event">
                        <a class="pull-left border-aero profile_thumb" style="background-image:url('<?php echo $student['face_file'] ?>');">
                        </a>
                        <div class="media-body">
                            <?php echo $student['name'].' '.$student['surname'] ?>
                            <p><strong><?php echo $student['birthday'] ?>. </strong> <?php echo $student['sex'] ?> </p>
                            <p> <small>Phone: <?php echo $student['phone'] ?>,</small>
                                <strong>Email: <?php echo $student['email'] ?></strong>
                            </p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<script src="assets/vendors/echarts/dist/echarts.min.js"></script>

<!-- NProgress -->
<script src="assets/vendors/nprogress/nprogress.js"></script>
<!-- FullCalendar -->
<script src="assets/vendors/moment/min/moment.min.js"></script>
<script src="assets/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
<script>
  $(document).ready(function() {
	  
	  var calendar = $('#calendar');
				
				$('#calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
						<?php 
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>
