        <!------CONTROL TABS END------>
            <!----TABLE LISTING STARTS-->
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
                        <?php echo get_phrase('list_all_exams');?>
                    </div>
                </div>
                <div class="panel-body">
                <table class="table " id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('class_name'); ?></div></th>
                            <th><div><?php echo get_phrase('subject_name'); ?></div></th>
                            <th><div><?php echo get_phrase('session'); ?></div></th>
                            <th><div><?php echo get_phrase('duration'); ?></div></th>
                            <th><div><?php echo get_phrase('exam_date'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($question_data as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row->class_name ?></td>
                                <td><?php echo $row->subject_name ?></td>
                                <td><?php echo $row->session ?></td>
                                <td><?php echo $row->duration ?></td>
                                <td><?php echo $row->date ?></td>
                                <td>
								
								 <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/exam_list/<?php echo $row->class_id . '/' . $row->subject_id . '/' . $row->duration . '/' . $row->date . '/' . ($row->session == '' ? '%null' : $row->session) ?>/delete');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-cancel"></i></button></a>
								 
								  <a href="#" onclick="viewExam('<?php echo $row->class_id ?>', '<?php echo $row->subject_id ?>', '<?php echo $row->session ?>', '<?php echo $row->duration ?>', '<?php echo $row->date ?>')"><button type="button" class="btn btn-green btn-xs"><i class="entypo-right"></i></button></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->
        </div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

    function viewExam(class_id, subject_id, session, duration, date) {
        location.href = '<?php echo base_url(); ?>index.php?admin/exam_view/' + class_id + '/' + subject_id + '/' + duration + '/' + date + '/' + session;
    }

</script>