
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
		<?php echo form_open(base_url() . 'index.php?head/student_information');?>

					 <?php echo get_phrase('get_students'); ?>
					</div>
					</div>
					                       
                        <div class="form-group class-list">
                        <div class="col-sm-12">
                            <select name="class_id" class="form-control select2" onchange="this.form.submit()" required>
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

<noscript><button type="submit" class="btn btn-green btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_student_list');?></button></noscript>

		<?php echo form_close();?>
		
		<?php echo form_open(base_url() . 'index.php?admin/student_information');?>
			 <div class="form-group list-search">
                        <div class="col-sm-12">
                            <input type="text" placeholder ="Search Student" name="student_search" value="<?php if(isset($_REQUEST['student_search'])){echo $_REQUEST['student_search']; } ?>">
                            <input type="hidden" name="Search">
                        </div>
                    </div> 
		<?php echo form_close();?>
</div>
<?php if ($class_id != '' || isset($_REQUEST['student_search'])): ?>


<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('list_students'); ?>
			<!--<a href="<?php echo base_url(); ?>index.php?head/student_class/"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-back"></i>Back</button></a>
			
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_other_student/');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-users"></i><?php echo get_phrase('other_student'); ?></button></a>-->
			
        </div>
    </div>
    <div class="table-responsive">
      
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students'); ?></span>
                </a>
            </li>
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
                    ?>
                    <li>
                        <a href="#<?php echo $row['section_id']; ?>" data-toggle="tab">
                            <span class="visible-xs"><i class="entypo-user"></i></span>
                            <span class="hidden-xs"><?php echo get_phrase('section'); ?> <?php echo $row['name']; ?> ( <?php echo $row['nick_name']; ?> )</span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">

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
                      if(isset($_REQUEST['student_search'])){
						   $search_text = trim($_REQUEST['student_search']);
							$this->db->like('name', $search_text);
							$this->db->or_like('surname', $search_text);
							$this->db->or_like('sex', $search_text);
							$this->db->or_like('age', $search_text);
							$this->db->or_like('roll', $search_text);
							$this->db->or_like('email', $search_text);
							$this->db->or_like('phone', $search_text);
							$query = $this->db->get('student');
							$nested_object =  (object)$query->result();
							$students = json_decode(json_encode($nested_object), true);
							//print_r($students);
						}else{
							$students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
						}
                        foreach ($students as $row):
                            ?>
                            <tr>
                                <td><?php echo $row['roll']; ?></td>
                                <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" height="30" /></td>
                                <td><a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');"><?php echo $row['name']; ?></a></td>
								<td><?php echo $row['surname']; ?></td>
								<td><?php echo $row['m_tongue']; ?></td>
                                <td><?php echo $row['age']; ?></td>
                                <td><?php echo $row['religion']; ?></td>
                                <td><?php echo $row['sex']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
								
								
								 								 
								<a href="<?php echo base_url(); ?>index.php?head/view_student/<?php echo $row['student_id'];?>/"> <button type="button" class="btn btn-orange btn-xs"><i class="entypo-user"></i></button></a>
								 <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_message/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>
								
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
                    ?>
                    <div class="tab-pane" id="<?php echo $row['section_id']; ?>">

						<table class=" table " id="table_export2">
                            <thead>
                                <tr>
                                    <th width="80"><div><?php echo get_phrase('roll'); ?></div></th>
                                    <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>
                                    <th><div><?php echo get_phrase('name'); ?></div></th>
                                    <th><div><?php echo get_phrase('surname'); ?></div></th>
                            		<th><div><?php echo get_phrase('mother_tongue'); ?></div></th>
                            		<th><div><?php echo get_phrase('age'); ?></div></th>
                            		<th><div><?php echo get_phrase('religion'); ?></div></th>
                                    <th class="span3"><div><?php echo get_phrase('address'); ?></div></th>
                                    <th><div><?php echo get_phrase('email'); ?></div></th>
                                    <th><div><?php echo get_phrase('options'); ?></div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $students = $this->db->get_where('student', array(
                                            'class_id' => $class_id, 'section_id' => $row['section_id']
                                        ))->result_array();
                                foreach ($students as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row['roll']; ?></td>
                                        <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" height="30" /></td>
                                <td><a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');"><?php echo $row['name']; ?></a></td>
								<td><?php echo $row['surname']; ?></td>
								<td><?php echo $row['m_tongue']; ?></td>
                                <td><?php echo $row['age']; ?></td>
                                <td><?php echo $row['religion']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>

								 
								<a href="<?php echo base_url(); ?>index.php?head/view_student/<?php echo $row['student_id'];?>/"> <button type="button" class="btn btn-orange btn-xs"><i class="entypo-user"></i></button></a>
								
																								 <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_message/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif;?>

<?php if ($class_id == '' && isset($_REQUEST['student_search']) ==''):?>



<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('list_students'); ?>
			<!--<a href="<?php echo base_url(); ?>index.php?head/student_class/"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-back"></i>Back</button></a>
			
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_other_student/');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-users"></i><?php echo get_phrase('other_student'); ?></button></a>-->
			
        </div>
    </div>
    <div class="">
      
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_students'); ?></span>
                </a>
            </li>
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
                    ?>
                    <li>
                        <a href="#<?php echo $row['section_id']; ?>" data-toggle="tab">
                            <span class="visible-xs"><i class="entypo-user"></i></span>
                            <span class="hidden-xs"><?php echo get_phrase('section'); ?> <?php echo $row['name']; ?> ( <?php echo $row['nick_name']; ?> )</span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">

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
                        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                        foreach ($students as $row):
                            ?>
                            <tr>
                                <td><?php echo $row['roll']; ?></td>
                                <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" height="30" /></td>
                                <td><a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');"><?php echo $row['name']; ?></a></td>
								<td><?php echo $row['surname']; ?></td>
								<td><?php echo $row['m_tongue']; ?></td>
                                <td><?php echo $row['age']; ?></td>
                                <td><?php echo $row['religion']; ?></td>
                                <td><?php echo $row['sex']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
								
								 <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
								 								 
								<a href="<?php echo base_url(); ?>index.php?head/view_student/<?php echo $row['student_id'];?>/"> <button type="button" class="btn btn-orange btn-xs"><i class="entypo-user"></i></button></a>
								
																 <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_message/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>
								
								

								
								<!--<a href="<?php echo base_url(); ?>index.php?head/student_marksheet/<?php echo $row['student_id']; ?>" target="_blank"><button type="button" class="btn btn-success btn-xs"><i class="entypo-chart-bar"></i></button></a>-->
								 
								 <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?head/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>

                                   
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
			<div class="alert alert-danger" align="center">No Information Selected</div>

            </div>
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
                    ?>
                    <div class="tab-pane" id="<?php echo $row['section_id']; ?>">

						<table class=" table " id="table_export2">
                            <thead>
                                <tr>
                                    <th width="80"><div><?php echo get_phrase('roll'); ?></div></th>
                                    <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>
                                     <th><div><?php echo get_phrase('surname'); ?></div></th>
                                    <th><div><?php echo get_phrase('name'); ?></div></th>
                                    <th class="span3"><div><?php echo get_phrase('address'); ?></div></th>
                                    <th><div><?php echo get_phrase('email'); ?></div></th>
                                    <th><div><?php echo get_phrase('options'); ?></div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $students = $this->db->get_where('student', array(
                                            'class_id' => $class_id, 'section_id' => $row['section_id']
                                        ))->result_array();
                                foreach ($students as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row['roll']; ?></td>
                                        <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" height="30" /></td>
                                <td><a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');"><?php echo $row['name']; ?></a></td>
                                        <td><?php echo $row['surname']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>

                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
								 
								<a href="<?php echo base_url(); ?>index.php?head/view_student/<?php echo $row['student_id'];?>/"> <button type="button" class="btn btn-orange btn-xs"><i class="entypo-user"></i></button></a>
								
																								 <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_message/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>

								
								<!--<a href="<?php echo base_url(); ?>index.php?head/student_marksheet/<?php echo $row['student_id']; ?>"><button type="button" class="btn btn-success btn-xs"><i class="entypo-chart-bar"></i></button></a>-->
								 
								 <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?head/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
			<div class="alert alert-danger" align="center">No Information Selected</div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
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
