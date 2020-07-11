<?php 
$edit_data		=	$this->db->get_where('class' , array('class_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/classes/do_update/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('numeric_name');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_numeric" value="<?php echo $row['name_numeric'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('teacher');?></label>
                        <div class="col-sm-10">
                            <select name="teacher_id" class="form-control">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                                $teachers = $this->db->get('teacher')->result_array();
                                foreach($teachers as $row2):
                                ?>
                                    <option value="<?php echo $row2['teacher_id'];?>"
                                        <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_class');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>
<script type="text/javascript">
    $('a[href^="</div"]').each(function(){ 
            var oldUrl = $(this).attr("href"); // Get current url
            var newUrl = "#"; // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });
</script>

