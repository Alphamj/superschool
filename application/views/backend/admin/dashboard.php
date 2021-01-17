
<!-- Resources -->
<style>
    #chartdiv2, #chartdiv,#attandence_chart,#expence_chart {
        width		: 80%;
        height		: 300px;
        font-size	: 11px;
    }					
    .style2 {font-size: 24px}
</style>

<!-- FullCalendar -->
<link href="assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="assets/css/custom.css" rel="stylesheet">
<?php $count_all = $this->db->count_all('student') + $this->db->count_all('teacher') + $this->db->count_all('parent') + $this->db->count_all('librarian') + $this->db->count_all('accountant'); ?>
<?php
$check = array('date' => date('Y-m-d'), 'status' => '1');
$query = $this->db->get_where('attendance', $check);
$present_today = $query->num_rows();
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xm-12" role="main">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xm-4">
                <ul class="site-stats">
                    <li><a href="<?php echo base_url(); ?>index.php?admin/student_information"><h3><div class="col-md-4 col-xs-4 col-sm-4 stats-left" style="background-color:#4e7d2a"><i class="entypo-users"></i></div>  <div class="col-md-8 col-xs-8 col-sm-8 stats-right  text-right
                    "> Total <?php echo get_phrase('student'); ?> : <strong><?php echo $this->db->count_all('student'); ?></strong></div></h3></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/teacher"><h3> <div class="col-md-4 col-xs-4 col-sm-4 stats-left" style="background-color:#489ee7"><i class="entypo-users"></i></div>  <div class="col-md-8 col-xs-8 col-sm-8 stats-right  text-right">  Total <?php echo get_phrase('teacher'); ?>  :  <strong><?php echo $this->db->count_all('teacher'); ?></strong></div></h3></a></li>

                </ul>
            </div>
            <div class="col-md-4 col-sm-4 col-sm-4">
                <ul class="site-stats">
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/parent"><h3> <div class="col-md-4 col-xs-4 col-sm-4 stats-left" style="background-color:#3bbc63"><i class="entypo-users"></i></div>  <div class="col-md-8 col-xs-8 col-sm-8 stats-right  text-right">  Total <?php echo get_phrase('parent_users'); ?>  : <strong><?php echo $this->db->count_all('parent'); ?></strong></div> </h3></a></li>
                    <li>  <a href="<?php echo base_url(); ?>index.php?admin/librarian"><h3> <div class="col-md-4 col-xs-4 col-sm-4 stats-left" style="background-color:#fb5d5d"><i class="fa fa-book"></i></div>  <div class="col-md-8 col-xs-8 col-sm-8 stats-right  text-right">  Total <?php echo get_phrase('librarian'); ?>  : <strong><?php echo $this->db->count_all('librarian'); ?></strong></div></h3></a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-4 col-sm-4">
                <ul class="site-stats">
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/admin_list"><h3> <div class="col-md-4 col-xs-4 col-sm-4 stats-left" style="background-color:#f7941d"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div>  <div class="col-md-8 col-xs-8 col-sm-8 stats-right  text-right">  Total <?php echo get_phrase('admin_users'); ?>  :  <strong><?php echo $this->db->count_all('admin'); ?></strong></div></h3></a></li>
                    <li>  <a href="<?php echo base_url(); ?>index.php?admin/enquiry"><h3> <div class="col-md-4 col-xs-4 col-sm-4 stats-left" style="background-color:#797b0e"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>  <div class="col-md-8 col-xs-8 col-sm-8  stats-right text-right">  <?php echo get_phrase('all_enquiries'); ?>  : <strong><?php echo $this->db->count_all('enquiry'); ?></strong></div></h3></a></li>
                </ul>
            </div>
        </div>
<!--        <div class="row tile_count">
            <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-group"></i> Total <?php echo get_phrase('student'); ?></span>
                <div class="count"><?php echo $this->db->count_all('student'); ?></div>
                <span class="count_bottom"><i class="green"><?php echo intval($this->db->count_all('student') * 100 / $count_all) ?>% </i> From all Account</span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="entypo-user"></i> Total <?php echo get_phrase('teacher'); ?></span>
                <div class="count"><?php echo $this->db->count_all('teacher'); ?></div>
                <span class="count_bottom"><i class="green"><?php echo intval($this->db->count_all('teacher') * 100 / $count_all) ?>% </i> From all Account</span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="entypo-users"></i> Total <?php echo get_phrase('parent'); ?></span>
                <div class="count"><?php echo $this->db->count_all('parent'); ?></div>
                <span class="count_bottom"><i class="green"><?php echo intval($this->db->count_all('parent') * 100 / $count_all) ?>% </i> From all Account</span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="entypo-book"></i> Total <?php echo get_phrase('librarian'); ?></span>
                <div class="count"><?php echo $this->db->count_all('librarian'); ?></div>
                <span class="count_bottom"><i class="green"><?php echo intval($this->db->count_all('librarian') * 100 / $count_all) ?>% </i> From all Account</span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="entypo-user-add"></i> Total <?php echo get_phrase('Accountant'); ?></span>
                <div class="count"><?php echo $this->db->count_all('accountant'); ?></div>
                <span class="count_bottom"><i class="green"><?php echo intval($this->db->count_all('accountant') * 100 / $count_all) ?>% </i> From all Account</span>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-gear"></i> <?php echo get_phrase('all_enquiry'); ?></span>
                <div class="count"><?php echo $this->db->count_all('enquiry'); ?></div>
                <span class="count_bottom"><i class="green"><?php echo intval($this->db->count_all('enquiry') * 100 / $count_all) ?>% </i> From all Enquiries</span>

            </div>
                        <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-envelope"></i> <?php echo get_phrase('all_message'); ?></span>
                            <div class="count"><?php echo $this->db->count_all('message'); ?></div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-clock-o"></i> <?php echo get_phrase('attendance'); ?></span>
                            <div class="count">0</div>
                        </div>
        </div>-->
    </div>

</div>

<!--
<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12">    
        <div class="x_panel " data-collapsed="0">
            <div class="x_title">
                <?php //echo get_phrase('Charts'); ?>
            </div>
            <div class="x-content">
                <div id="chartdiv2"></div> 
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">    
        <div class="x_panel " data-collapsed="0">
            <div class="x_title">
                <?php //echo get_phrase('Charts'); ?>
            </div>
            <div class="x-content">
                <div id="chartdiv"></div>
            </div>
        </div>
    </div>
   
</div>


<div class="row">
	 <div class="col-md-6 col-sm-12 col-xs-12">    
        <div class="x_panel " data-collapsed="0">
            <div class="x_title">
                <?php //echo get_phrase('attendance charts current month'); ?>
            </div>
            <div class="x-content">
                <div id="attandence_chart"></div>
            </div>
        </div>
    </div>
	 <div class="col-md-6 col-sm-12 col-xs-12">    
        <div class="x_panel " data-collapsed="0">
            <div class="x_title">
                <?php //echo get_phrase('expence charts'); ?>
            </div>
            <div class="x-content">
                <div id="expence_chart"></div>
            </div>
        </div>
    </div>
</div>
-->
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
                            <a class="title" href="<?php echo base_url(); ?>index.php?<?php echo $this->session->userdata('login_type') ?>/student_information/<?php echo $student["class_id"] ?>"><?php echo $student['name'] ?></a>
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
<?php   //print_r($this->crud_model->get_expence_reports()); ?>
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
                    		<th><div><?php echo get_phrase('students_information');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <?php $classes = $this->db->get('class')->result_array();
                        $count = 1;foreach($classes as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['name_numeric'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
							
							<a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>"><button type="button" class="btn btn-green btn-xs"><i class="entypo-users"></i>All Student</button></a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
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
						?>,
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

<script>

    $(function () {
        //        $('#sel_location_modal').slideDown('slow');
<?php if ($this->session->userdata('isFirst')) { ?>
            showSelectLocationModal();
<?php } ?>
        init_echarts1();
       
    });
    function init_echarts1() {
        if (typeof (echarts) === 'undefined') {
            return;
        }
        console.log('init_echarts');
        var theme = {
            color: [
                '#3498DB', '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
            ],
            textStyle: {
                fontFamily: 'Arial, Verdana, sans-serif'
            }
        };
        if ($('#chartdiv2').length) {

            var echartLine = echarts.init(document.getElementById('chartdiv2'), theme);
            echartLine.setOption({
                title: {
                    text: 'Statics Chart',
                    //                    subtext: 'Subtitle'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    x: 220,
                    y: 40,
                    data: ['<?php echo get_phrase('section'); ?>', '<?php echo get_phrase('transportations'); ?>', '<?php echo get_phrase('expenses'); ?>']
                },
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            title: {
                                line: 'Line',
                                bar: 'Bar',
                                stack: 'Stack',
                                tiled: 'Tiled'
                            },
                            type: ['line', 'bar', 'stack', 'tiled']
                        },
                        restore: {
                            show: true,
                            title: "Restore"
                        },
                        saveAsImage: {
                            show: true,
                            title: "Save Image"
                        }
                    }
                },
                calculable: true,
                xAxis: [{
                        type: 'category',
                        boundaryGap: false,
                        data: ['class', 'subject', 'document']
                    }],
                yAxis: [{
                        type: 'value'
                    }],
                series: [{
                        name: '<?php echo get_phrase('section'); ?>',
                        type: 'line',
                        smooth: true,
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: [<?php echo $this->db->count_all('class'); ?>, <?php echo $this->db->count_all('subject'); ?>, <?php echo $this->db->count_all('document'); ?>,<?php echo $this->db->count_all('news'); ?>, <?php echo $this->db->count_all('question'); ?>, <?php echo $this->db->count_all('todays_thought'); ?>]
                    }, {
                        name: '<?php echo get_phrase('transportations'); ?>',
                        type: 'line',
                        smooth: true,
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: [<?php echo $this->db->count_all('assignment'); ?>, <?php echo $this->db->count_all('document'); ?>, <?php echo $this->db->count_all('task_manager'); ?>,<?php echo $this->db->count_all('news'); ?>, <?php echo $this->db->count_all('question'); ?>, <?php echo $this->db->count_all('todays_thought'); ?>]
                    }, {
                        name: '<?php echo get_phrase('expenses'); ?>',
                        type: 'line',
                        smooth: true,
                        itemStyle: {
                            normal: {
                                areaStyle: {
                                    type: 'default'
                                }
                            }
                        },
                        data: [<?php echo $this->db->count_all('news'); ?>, <?php echo $this->db->count_all('question'); ?>, <?php echo $this->db->count_all('todays_thought'); ?>,<?php echo $this->db->count_all('assignment'); ?>, <?php echo $this->db->count_all('document'); ?>, <?php echo $this->db->count_all('task_manager'); ?>]
                    }]
            });
        }
        if ($('#chartdiv').length) {

            var echartPie = echarts.init(document.getElementById('chartdiv'), theme);
            echartPie.setOption({
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: ['<?php echo get_phrase('section'); ?>', '<?php echo get_phrase('transportations'); ?>', '<?php echo get_phrase('expenses'); ?>']
                },
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: "Restore"
                        },
                        saveAsImage: {
                            show: true,
                            title: "Save Image"
                        }
                    }
                },
                calculable: true,
                series: [{
                        name: 'Current Status',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '48%'],
                        data: [{
                                value: <?php echo $this->db->count_all('section'); ?>,
                                name: '<?php echo get_phrase('section'); ?>'
                            }, {
                                value: <?php echo $this->db->count_all('transport'); ?>,
                                name: '<?php echo get_phrase('transportations'); ?>'
                            }, {
                                value: <?php echo $this->db->count_all('expense_category'); ?>,
                                name: '<?php echo get_phrase('expenses'); ?>'
                            }]
                    }]
            });
            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                }
            };
            var placeHolderStyle = {
                normal: {
                    color: 'rgba(0,0,0,0)',
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };
        }
        if ($('#attandence_chart').length) {

            var echartPie = echarts.init(document.getElementById('attandence_chart'), theme);
            echartPie.setOption({
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: ['<?php echo get_phrase('absent'); ?>', '<?php echo get_phrase('present'); ?>']
                },
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: "Restore"
                        },
                        saveAsImage: {
                            show: true,
                            title: "Save Image"
                        }
                    }
                },
                calculable: true,
                series: [{
                        name: 'Current Status',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '48%'],
                        data: [{
                                value: <?php echo  $this->crud_model->get_absent_student(); ?>,
                                name: '<?php echo get_phrase('absent'); ?>'
                            }, {
                                value: <?php echo  $this->crud_model->get_present_student(); ?>,
                                name: '<?php echo get_phrase('present'); ?>'
                            }]
                    }]
            });
            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                }
            }; 
            var placeHolderStyle = {
                normal: {
                    color: 'rgba(0,0,0,0)',
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };
        }
        if ($('#expence_chart').length) {

            var echartPie = echarts.init(document.getElementById('expence_chart'), theme);
            echartPie.setOption({
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: [<?php echo $this->crud_model->get_expence_reports(); ?>]
                   
                },
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        restore: {
                            show: true,
                            title: "Restore"
                        },
                        saveAsImage: {
                            show: true,
                            title: "Save Image"
                        }
                    }
                },
                calculable: true,
                series: [{
                        name: 'Current Status',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '48%'],
                        data: [<?php echo $this->crud_model->get_expence_reports1(); ?>]
                    }]
            });
            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                }
            }; 
            var placeHolderStyle = {
                normal: {
                    color: 'rgba(0,0,0,0)',
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };
        }
       
    }
  
</script>

