<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
		<?php echo form_open(base_url() . 'index.php?teacher/academic_syllabus');?>

					 <?php echo get_phrase('get_academic_syllabus'); ?>
					</div>
					</div>
					                       
                        <div class="form-group">
                        <div class="col-sm-10">
                            <select name="class_id" class="form-control" required>
                              <option value=""><?php echo get_phrase('select_class_first');?></option>
                              		 <?php $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
					foreach ($classes as $row):
   					 ?>
                                		<option value="<?php echo $row['class_id'];?>">
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
                        </div>
                    </div> 

				<input type="hidden" name="operation" value="selection">

<button type="submit" class="btn btn-green btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_student_list');?></button>

		<?php echo form_close();?>
</div>
<?php if ($class_id != ''):?>


	<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('list_academic_syllabus'); ?>
        </div>
    </div>
    <div class="table-responsive">
      
       <table class="table table-bordered responsive" id="table_export">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('title');?></th>
								<th><?php echo get_phrase('description');?></th>
                                 <th><?php echo get_phrase('subject');?></th>
								<th><?php echo get_phrase('uploader');?></th>
								<th><?php echo get_phrase('date_submitted');?></th>
								<th><?php echo get_phrase('file_name');?></th>
								<th><?php echo get_phrase('download_document');?></th>
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							$academic_syllabus = $this->db->get_where('academic_syllabus' , array(
								'class_id' => $class_id))->result_array();
							foreach ($academic_syllabus as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['title'];?></td>
								<td><?php echo $row['description'];?></td>
                                                                <td>
									<?php 
										echo $this->db->get_where('subject' , array(
											'subject_id' => $row['subject_id']
										))->row()->name;
									?>
								</td>
								<td>
									<?php 
										echo $this->db->get_where($row['uploader_type'] , array(
											$row['uploader_type'].'_id' => $row['uploader_id']
										))->row()->name;
									?>
								</td>
								<td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td>
									<?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
								</td>
								<td align="center">
									<a href="<?php echo base_url();?>index.php?teacher/download_academic_syllabus/<?php echo $row['academic_syllabus_code'];?>"
										class="btn btn-orange btn-xs">
										<i class="entypo-download"></i>
									</a>
									
									
								</td>
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table>
</div>
</div>
<?php endif;?>




<?php if ($class_id == ''):?>


	<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('list_academic_syllabus'); ?>
        </div>
    </div>
    <div class="table-responsive">
      
       <table class="table table-bordered responsive" id="table_export">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('title');?></th>
								<th><?php echo get_phrase('description');?></th>
                                 <th><?php echo get_phrase('subject');?></th>
								<th><?php echo get_phrase('uploader');?></th>
								<th><?php echo get_phrase('date_submitted');?></th>
								<th><?php echo get_phrase('file_name');?></th>
								<th><?php echo get_phrase('download_document');?></th>
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							$academic_syllabus = $this->db->get_where('academic_syllabus' , array(
								'class_id' => $class_id))->result_array();
							foreach ($academic_syllabus as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['title'];?></td>
								<td><?php echo $row['description'];?></td>
                                                                <td>
									<?php 
										echo $this->db->get_where('subject' , array(
											'subject_id' => $row['subject_id']
										))->row()->name;
									?>
								</td>
								<td>
									<?php 
										echo $this->db->get_where($row['uploader_type'] , array(
											$row['uploader_type'].'_id' => $row['uploader_id']
										))->row()->name;
									?>
								</td>
								<td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td>
									<?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
								</td>
								<td align="center">
									<a href="<?php echo base_url();?>index.php?teacher/download_academic_syllabus/<?php echo $row['academic_syllabus_code'];?>"
										class="btn btn-orange btn-xs btn-icon icon-left">
										<i class="entypo-download"></i>
									</a>
									
									
								</td>
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table>
					
					<div class="alert alert-danger" align="center">No Information Selected</div>
</div>
</div>
<?php endif;?>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(1, false);
                            datatable.fnSetColumnVis(5, false);

                            this.fnPrint(true, oConfig);

                            window.print();

                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(1, true);
                                    datatable.fnSetColumnVis(5, true);
                                }
                            });
                        },
                    },
                ]
            },
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>



<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(1, false);
                            datatable.fnSetColumnVis(5, false);

                            this.fnPrint(true, oConfig);

                            window.print();

                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(1, true);
                                    datatable.fnSetColumnVis(5, true);
                                }
                            });
                        },
                    },
                ]
            },
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>