<div class="col-md-5">
<div class="x_panel" >
<div class="x_title">
        <div class="panel-title">
            <?php echo get_phrase('add_transport_route'); ?>
        </div>
    </div>
   <!----CREATION FORM STARTS---->
          
                    <?php echo form_open(base_url() . 'index.php?admin/backup_restore/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
					
					
                         <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i>&nbsp;<?php echo get_phrase('backup_now'); ?></button>
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
            <?php echo get_phrase('list_transport_route'); ?>
        </div>
    	</div>
   





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