
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



<div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('my_children_information'); ?>
					</div>
					</div>

             <table class=" table" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('roll'); ?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>
                            <th><div><?php echo get_phrase('name'); ?></div></th>
                            <th><div><?php echo get_phrase('surname'); ?></div></th>
                            <th><div><?php echo get_phrase('mother_tongue'); ?></div></th>
                            <th><div><?php echo get_phrase('age'); ?></div></th>
                            <th><div><?php echo get_phrase('religion'); ?></div></th>
                            <th><div><?php echo get_phrase('sex'); ?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address'); ?></div></th>
                            <th><div><?php echo get_phrase('email'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                    $children_of_parent = $this->db->get_where('student', array(
                                'parent_id' => $this->session->userdata('parent_id')
                            ))->result_array();
                    foreach ($children_of_parent as $row):
                        ?>
                            <tr>
                                <td><?php echo $row['roll']; ?></td>
                                <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" height="30" /></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['surname']; ?></td>
								<td><?php echo $row['m_tongue']; ?></td>
                                <td><?php echo $row['age']; ?></td>
                                <td><?php echo $row['religion']; ?></td>
                                <td><?php echo $row['sex']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>								 
								<a href="<?php echo base_url(); ?>index.php?parents/view_student/<?php echo $row['student_id'];?>/"> <button type="button" class="btn btn-orange btn-xs"><i class="entypo-user"></i>Full Details</button></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
				</div>
         
<div class="row">
    <div class="col-md-12">
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
