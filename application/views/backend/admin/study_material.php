 <!-- added on 26 may 2018-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list-materials'); ?>
					</div>
					</div>
           &nbsp;&nbsp;&nbsp;&nbsp;
		   <button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_study_material_add');" 
    class="btn btn-xs btn-orange">
        <i class="entypo-plus"></i>
        <?php echo get_phrase('add_material'); ?>
</button>
<br>
<table class="table " id="table-2">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('staff_name');?></th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('class');?></th>
            <th><?php echo get_phrase('download');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        foreach ($study_material_info as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo date("d M, Y", $row['timestamp']); ?></td>
				<td>
				 <?php $name = $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id'] ))->row()->name;
                     echo $name;?>
				</td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row['description']?></td>
                <td>
                    <?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
				
<a href="<?php echo base_url().'uploads/document/'.$row['file_name']; ?>"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-download"></i></button></a>

                </td>
                <td>
				
				   <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_study_material_edit/<?php echo $row['document_id']?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					<a href="<?php echo base_url();?>index.php?admin/study_material/delete/<?php echo $row['document_id']?>"><button type="button" class="btn btn-red btn-xs" onclick="return confirm('Are you sure to delete?');"><i class="entypo-trash"></i></button></a>

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>



<script type="text/javascript">
	
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
