<?php
$edit_data = $this->db->get_where('admin', array('admin_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
        <div class="col-md-12">
                <div class="x_title">
                    <div class="panel-title" >
                        <?php echo get_phrase('edit_administrator'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?admin/admins/do_update/' . $row['admin_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'form1', 'enctype' => 'multipart/form-data')); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('photo'); ?></label>

                        <div class="col-sm-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo $this->crud_model->get_image_url('admin', $row['admin_id']); ?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $row['name']; ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('email'); ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('password'); ?></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('confirm_password'); ?></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="conf_pass" value="<?php echo $row['password']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_admin');?></button>
						</div>
					</div>
                    <?php echo form_close(); ?>
                </div>
    </div>

    <?php
endforeach;
?>

<script type="text/javascript">

    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

    var class_id = $("#class_id").val();

    $.ajax({
        url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
        success: function (response)
        {
            jQuery('#section_selector_holder').html(response);
        }
    });

    $(function () {
        $('#form1').submit(function (e) {
            if ($('input[name=password]').val() != $('input[name=conf_pass]').val()) {
                alert('Password confirmation does not match.');
                e.preventDefault();
                return;
            }
        });
    });

</script>