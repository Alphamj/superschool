
        <div class="x_panel">
            <div class="x_title">
                <div class="panel-title" >
                    <?php echo get_phrase('import_student'); ?>
					
					 <a href="<?php echo base_url(); ?>uploads/blank_excel_file.xlsx" target="_blank" 
                           class="btn btn-orange btn-xs"><i class="entypo-download"></i> <strong style="color:#FFFFFF">Download Sample</strong></a>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/student_bulk_add/import_excel/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_excel_file'); ?></label>

                    <div class="col-sm-9">
                   <input type="file" name="userfile" class="form-control" data-validate="required" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                    <div class="col-sm-9">
                        <select name="class_id" class="form-control" required>
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div> 
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-upload"></i><?php echo get_phrase('upload'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>