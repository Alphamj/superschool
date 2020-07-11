<div class="x_panel admin-table" style="float: left;" >
    <div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('administrator_information_page'); ?>
        </div>
    </div>
    <div class="table-responsive">

        &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/admin_add/');" 
                                   class="btn btn-orange btn-xs">
            <i class="entypo-plus"></i>
            <?php echo get_phrase('add_admin'); ?>
        </a>
        <br>


        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('all_administrator'); ?></span>
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
                <table class="table"  id="table_export">
                    <thead>
                        <tr>
                            <th width="1"><div><?php echo get_phrase('no'); ?></div></th>
                            <th width="1"><div><?php echo get_phrase('photo'); ?></div></th>
                            <th width="80"><div><?php echo get_phrase('name'); ?></div></th>
                            <th><div><?php echo get_phrase('email'); ?></div></th>
                            <th><div><?php echo get_phrase('level'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                        foreach ($admin_list as $key => $row):
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td align='center'><img style="margin:0" src="<?php echo $this->crud_model->get_image_url('admin', $row['admin_id']); ?>" class="img-circle" width="30" height="30" /></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo ($row['level'] == 1 ? 'Super' : 'Normal'); ?></td>                                
                                <td width='175'>
                                    <?php if ($row['level'] > 1): ?>
                                       
                                                <!-- ADMIN EDITING LINK -->
											 <?php if ($this->session->userdata('login_type') == 'admin' && $admin_info['level'] == 1): ?>	
										<a href="#" class="per_button" onclick="showPermissioinPanel('<?php echo $row["admin_id"] ?>')" ><button type="button" class="btn btn-blue btn-xs"><i class="entypo-lock"></i></button></a>
										<?php endif; ?>	
												

										<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_admin_edit/<?php echo $row['admin_id']; ?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
										
							<a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/admins/delete/<?php echo $row['admin_id']; ?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
			<?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>


<div id="permission_list" style="display: none; float: left; border: solid 1px #999; margin-left: 10px; background-color: #fff ">
    <form id="form1" action="<?php echo base_url() ?>/index.php?admin/setPermission" method="post">

        <div class="row per-button-group" style="margin-top: 10px; padding-left:20px">
            <a class="btn btn-primary btn-cancel"><?php echo get_phrase('cancel'); ?></a>
            <button class="btn btn-info submit"><?php echo get_phrase('save'); ?></button>
        </div>
        <div id="permission_panel" style=";overflow: auto; padding:10px">
            <input type="hidden" value="" id="admin_id" name="admin_id" />
            <?php
            for ($i = 0; $i < sizeof($actions); $i++):
                if ($actions[$i]['parent_name'] == '' || $actions[$i]['parent_name'] == null || $actions[$i]['display'] == 'subject'):
                    ?>
                    <div>
                        <input type="checkbox" name="action_id[]" class="action_id" value="<?php echo $actions[$i]['action_id'] ?>" />
                        <?php echo $actions[$i]['display'] ?>
                    </div>
                    <?php
                else:
                    if ($i > 0):
                        if ($actions[$i]['parent_name'] != $actions[$i - 1]['parent_name'] && $actions[$i]['parent_name'] != 'Subjects'):
                            ?>
                            <div>
                                <input type="checkbox" class="chk_parent" value="<?php echo $actions[$i]['parent_key'] ?>" />
                                <?php echo $actions[$i]['parent_name'] ?>
                            </div>
                            <?php
                        endif;
                    endif;
                    ?>
                    <?php if ($actions[$i]['display'] != 'subject'): ?>
                        <div style="padding-left: 20px;">
                            <input type="checkbox" name="action_id[]" class="action_id" data-parent="<?php echo $actions[$i]['parent_key'] ?>" value="<?php echo $actions[$i]['action_id'] ?>" />
                            <?php echo $actions[$i]['display'] ?>
                        </div>
                        <?php
                    endif;
                endif;
            endfor;
            ?>
        </div>

        <div class="row per-button-group" style="margin-top: 10px; padding-left:20px">
            <a class="btn btn-primary btn-cancel"><?php echo get_phrase('cancel'); ?></a>
            <button class="btn btn-info submit"><?php echo get_phrase('save'); ?></button>
        </div>
    </form>
</div>
<div class="clearfix "></div>


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

        $('#permission_panel').css('max-height', $('.admin-table').height() - 80);

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        $(document).delegate('.chk_parent', 'change', function () {
            $('[data-parent=' + $(this).val() + ']').prop('checked', $(this).prop('checked'));
        });

        $('.btn-cancel').click(function () {
            $('#permission_list').slideUp('fast', 'linear', function () {
                $('.admin-table').animate({"margin-left": 0}, 'fast');
            });

        });
    });

    function showPermissioinPanel(admin_id) {
        $('#form1 #admin_id').val(admin_id);

        $('#form1 input[type=checkbox]').prop('checked', false);

        $('#permission_list').slideUp('fast', 'linear', function () {
            $('.admin-table').animate({"margin-left": 0}, 'fast');
        });

        $.ajax({
            type: "post",
            url: '<?php echo base_url() ?>/index.php?admin/getPermission',
            dataType: "json",
            data: {
                'admin_id': admin_id
            },
            success: function (data) {
                $.each(data, function (index, values) {
                    $('.action_id[value=' + values.action_id + ']').prop('checked', true);
                    $('.chk_parent[value=' + values.parent_key + ']').prop('checked', true);
                });

                $(".admin-table").animate({"margin-left": -$('#permission_list').outerWidth() - 10}, 'fast', function () {
                    $('#permission_list').slideDown('fast', 'linear');
                });

            },
            error: function (req, text, error) {
                alert('Error!', 'Error AJAX: ' + text + ' | ' + error, 'error');
            }
        });
    }

</script>