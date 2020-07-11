<div class="col-md-6">

        <div class="x_panel" >
				<!-- creation of single invoice -->
				<?php echo form_open(base_url() . 'index.php?admin/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
	                            <div class="x_title">
	                                <div class="panel-title"><?php echo get_phrase('invoice_informations');?></div>
	                            </div>

                                    <?php $get_system_settings	=	$this->crud_model->get_system_settings();?>
			                        <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('select_session');?></label>
                                        <div class="col-sm-9">
			                        		<select name="session_year" id="session_year" class="form-control" onchange="show_students_session(this.value)">

                                                <?php 
                                                $sessions = $this->db->get('session')->result_array();
                                                foreach($sessions as $row):
                                                ?>
                                                    <option value="<?php echo $row['name'];?>"
                                                    	<?php if($sessoin_id){if (trim($sessoin_id) == trim($row['name'])){ echo 'selected'; }}else {if($row['name'] ==$get_system_settings[17]['description']){ echo 'selected'; } } ?>>
                                                    		 <?php echo $row['name'];?>
                                                    </option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
			                        	</div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('select_term');?></label>
                                        <div class="col-sm-9">
			                        	    <select name="exam_id" class="form-control"  style="float:left;" required>
                                                <option value=""><?php echo get_phrase('select_term');?></option>
                                                <?php 
                                                $exams = $this->db->get('exam')->result_array();
                                                foreach($exams as $row):
                                                ?>
                                                    <option value="<?php echo $row['exam_id'];?>"
                                                        <?php if($exam_id == $row['exam_id'])echo 'selected';?>>
                                                           <?php echo $row['name'];?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                         	</select>	
			                        	</div>
                                    </div>
	                                
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
	                                    <div class="col-sm-9">
	                                        <select name="class_id" class="form-control"
	                                        	onchange="return get_class_students(this.value)">
	                                        	<option value=""><?php echo get_phrase('select_class');?></option>
	                                        	<?php 
	                                        		$classes = $this->db->get('class')->result_array();
	                                        		foreach ($classes as $row):
	                                        	?>
	                                        	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	                                        	<?php endforeach;?>
	                                            
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="form-group">
		                                <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
		                                <div class="col-sm-9">
		                                    <select name="student_id" class="form-control" style="width:100%;" id="student_selection_holder">
		                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
		                                    	
		                                    </select>
		                                </div>
		                            </div>

	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="form-control" name="title" value="School Fees" readonly="true"/>
	                                    </div>
	                                </div>
	                            <!--    
                                    <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="form-control" name="description"/>
	                                    </div>
	                                </div>

							    <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php //echo get_phrase('total');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php //echo get_phrase('enter_total_amount');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php //echo get_phrase('payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php //echo get_phrase('enter_payment_amount');?>"/>
                                    </div>
                                </div> -->

                                    <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="datepicker form-control" name="date"/>
	                                    </div>
	                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                            <option value="part payment"><?php echo get_phrase('part_payment');?></option>
                                            <option value="paid"><?php echo get_phrase('paid');?></option>
                                        </select>
                                    </div>
                                </div>
                                <!--
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php //echo get_phrase('method');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control">
                                            <option value="1"><?php //echo get_phrase('bank_payment');?></option>
                                            <option value="2"><?php //echo get_phrase('bank_transfer');?></option>
                                            <option value="3"><?php //echo get_phrase('card');?></option>
                                        </select>
                                    </div>
                                </div> -->

                        		<div class="form-group">
							        <div class="col-sm-5 col-sm-offset-3">                                
							            <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('generate_invoice');?></button>
                                </div>
                       		 </div>
			
	              	<?php echo form_close();?>
<br>

				<!-- creation of single invoice -->
</div>
</div>

<div class="col-md-6">
        <div class="x_panel" >

				<!-- creation of mass invoice -->
				<?php echo form_open(base_url() . 'index.php?admin/invoice/create_mass_invoice' , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
							<div class="x_title">
	                                <div class="panel-title"><?php echo get_phrase('generate_mass_invoice');?></div>
                                </div>

                    <?php $get_system_settings	=	$this->crud_model->get_system_settings(); ?>            
                    
                    <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('select_session');?></label>
                        <div class="col-sm-9">
			        		<select name="session_year" id="session_year" class="form-control" onchange="show_students_session(this.value)">
                                <?php 
                                $sessions = $this->db->get('session')->result_array();
                                foreach($sessions as $row):
                                ?>
                                    <option value="<?php echo $row['name'];?>"
                                    	<?php if($sessoin_id){if (trim($sessoin_id) == trim($row['name'])){ echo 'selected'; }}else {if($row['name'] ==$get_system_settings[17]['description']){ echo 'selected'; } } ?>>
                                    		 <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
			        	</div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('select_term');?></label>
                        <div class="col-sm-9">
			        	    <select name="exam_id" class="form-control"  style="float:left;" required>
                                <option value=""><?php echo get_phrase('select_term');?></option>
                                <?php 
                                $exams = $this->db->get('exam')->result_array();
                                foreach($exams as $row):
                                ?>
                                    <option value="<?php echo $row['exam_id'];?>"
                                        <?php if($exam_id == $row['exam_id'])echo 'selected';?>>
                                           <?php echo $row['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                         	</select>	
			        	</div>
                    </div>
                    	
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        <div class="col-sm-9">
                            <select name="class_id" class="form-control"
                            	onchange="return get_class_students_mass(this.value)">
                            	<option value=""><?php echo get_phrase('select_class');?></option>
                            	<?php 
                            		$classes = $this->db->get('class')->result_array();
                            		foreach ($classes as $row):
                            	?>
                            	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            	<?php endforeach;?>
                                
                            </select>
                        </div>
                    </div>
					
					<div class="col-md-12">
					<div id="student_selection_holder_mass"></div>
										<hr>

					</div>
					<hr>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="School Fees" readonly="true"/>
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php //echo get_phrase('description');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="description"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php //echo get_phrase('total');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="amount"
                                placeholder="<?php //echo get_phrase('enter_total_amount');?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php //echo get_phrase('payment');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="amount_paid"
                                placeholder="<?php //echo get_phrase('enter_payment_amount');?>"/>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                <option value="part payment"><?php echo get_phrase('part_payment');?></option>
                                <option value="paid"><?php echo get_phrase('paid');?></option>
                            </select>
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php //echo get_phrase('method');?></label>
                        <div class="col-sm-9">
                            <select name="method" class="form-control">
                                <option value="1"><?php //echo get_phrase('bank_payment');?></option>
                                <option value="2"><?php //echo get_phrase('bank_transfer');?></option>
                                <option value="3"><?php //echo get_phrase('card');?></option>
                            </select>
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                        <div class="col-sm-9">
                            <input type="text" id="datepicker" class="datepicker form-control" name="date"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-3">
                                <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('generate_mass_invoice');?></button>
                        </div>
                    </div>
					
<br>
                    
				
				<?php echo form_close();?>

				<!-- creation of mass invoice -->
			
	</div>
</div>
<!-- added on 26 may 2018-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	 $( function() {
		$( "#datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
			
		});
	});
	function check() {
 	$("#selectall").click(function () {
 		$("input:checkbox").prop('checked', $(this).prop("checked"));
		});
	}

	function select() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = true ;
			}

		//alert('asasas');
	}
	function unselect() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = false ;
			}
	}

    function get_class_students(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }

    function get_class_students_mass(class_id) {
    	
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students_mass/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });
    }

    function show_students_session(session_year){
	    var class_id = $("#class_ids").val();
	    var current_session = $("#current_session").val();
	    if(current_session == session_year){
			if(class_id && session_year){
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/student_session_year/' + session_year +'/'+class_id+'/current',
					success: function(response){
						if($.trim(response)){
							$("#student_id_0").html(response);
						}else{
							$("#student_id_0").html('');
						}
					}
				});
			}
		}else{
			if(class_id && session_year){
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/student_session_year/' + session_year +'/'+class_id,
					success: function(response){
						if($.trim(response)){
							$("#student_id_0").html(response);
						}else{
							$("#student_id_0").html('');
						}
					}
				});
			}
		}
  }
</script>
