<?php 
$class_info                 = $this->db->get('class')->result_array();
$single_study_material_info = $this->db->get_where('assignment', array('assignment_id' => $param2))->result_array();
foreach ($single_study_material_info as $row) {
?>
        <div class="col-md-12">


                <div class="x_title">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_assignment'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?admin/assignment/do_update/<?php echo $row['assignment_id'] ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-10">
                                <div class="date-and-time">
                                    <input type="text" name="timestamp" class="form-control datepicker" data-format="yyyy-m-d" 
                                           placeholder="date here" value="<?php echo date("Y-m-d", $row['timestamp']); ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('title'); ?></label>

                            <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="field-1" value="<?php echo $row['title']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-10">
                                <textarea name="description" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url(); ?>assets/css/wysihtml5-color.css"
                                          id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('class'); ?></label>

                            <div class="col-sm-10">
                                <select name="class_id" class="form-control">
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                    <?php foreach ($class_info as $row2) { ?>
                                        <option value="<?php echo $row2['class_id']; ?>" <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                       <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('update_assignment');?></button>
						</div>
					</div>
                    </form>

        </div>
    </div>
<?php } ?>
