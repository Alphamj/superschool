<div class="col-md-5">
<div class="x_panel" table-responsive >

                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_exams'); ?>
					</div>
					</div>
	<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/exam/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="date"/ required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                            </div>
                        		<div class="form-group">
                              	<div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-book"></i><?php echo get_phrase('add_exam');?></button>
                              	</div>
								</div>
								<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->

<div class="col-md-7">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_exams'); ?>
					</div>
					</div>

                <table  class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('exam_name');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('comment');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($exams as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['date'];?></td>
							<td><?php echo $row['comment'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam/delete/<?php echo $row['exam_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>

        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->      
<!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  <div class="x_panel" >                
<script type="text/javascript">
	 $( function() {
		
			$( ".datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true
				
				
			});
		} );
	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>
