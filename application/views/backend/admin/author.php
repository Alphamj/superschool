<div class="col-md-5">
<div class="x_panel" >
<div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('add_author'); ?>
        </div>
    </div>
   <!----CREATION FORM STARTS---->
          
                    <?php echo form_open(base_url() . 'index.php?admin/author/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('author_name'); ?></label>
                            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" placeholder="Author Name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>
                            <div class="col-sm-9">
						    <textarea type="text" class="form-control" name="description"></textarea>
							</div>
							</div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i>&nbsp;<?php echo get_phrase('add_author'); ?></button>
                            </div>
                        </div>
                        </form> 
						<br>               
                    </div>                
                </div>
                <!----CREATION FORM ENDS-->
				
				
<div class="col-md-7">
<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('list_author'); ?>
        </div>
    </div>
   
<table class=" table  datatable" id="table-2">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('author_name'); ?></div></th>
                            <th><div><?php echo get_phrase('descriptions'); ?></div></th>
                            <th><div><?php echo get_phrase('Action'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($authors as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>
								
								 <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/author/delete/<?php echo $row['author_id']; ?>');">
                                                   <button type="button" class="btn btn-red btn-xs"> <i class="entypo-trash"></i></button></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
			</div>
            <!----TABLE LISTING ENDS--->


         

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-2 col-left'i><'col-xs-10 col-right'p>>"
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