<div class="col-md-3">
 	<div class="x_panel" >
          <div class="x_title">
               <div class="panel-title">
				<?php echo 'subjects'; ?>
			</div>
		</div>
 		<!----CREATION FORM STARTS (FOR NURSERY 2)---->

          <?php echo form_open(base_url() . 'index.php?admin/nursery_subject1_2/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                  <div class="form-group">
                      <label class="col-sm-3 control-label"><?php echo get_phrase('language');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="language"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label"><?php echo get_phrase('social');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="social"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label"><?php echo get_phrase('knowledge'); ?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="knowledge"/>
                      </div>
                  </div>
                 
              <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_subject');?></button>
                    </div>
				   </div>
          </form>                
     </div>                
</div>
			<!----CREATION FORM ENDS-->

<div class="col-md-9">
 	<div class="x_panel table-responsive">
          <div class="x_title">
               <div class="panel-title">
				 <?php echo get_phrase('list_subjects'); ?>
			</div>
		</div>
		
		<table class="table" id="table_export">
               <thead>
               	<tr>
					<th><div><?php echo get_phrase('s/n');?></div></th>
               		<th><div><?php echo get_phrase('language');?></div></th>
               		<th><div><?php echo get_phrase('social');?></div></th>
					<th><div><?php echo get_phrase('knowledge');?></div></th>
					<th><div><?php echo get_phrase('update');?></div></th>
					</tr>
			</thead>
               <tbody>
				<?php
				$query = $this->db->get('nnursery_subject1_2')->result_array();
				foreach($query as $row):?>
                    	<tr>
						<td><?php echo $row['nursub_id'];?></td>
						<td><?php echo $row['language'];?></td>
						<td><?php echo $row['social'];?></td>
						<td><?php echo $row['knowledge'];?></td>
						<td>
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_nursery_subject1_2/<?php echo $row['nursub_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/nursery_subject1_2/delete/<?php echo $row['nursub_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
						</td>
                    	</tr>
                    <?php endforeach;?>
               </tbody>
		</table>
	</div>
</div>
            <!----TABLE LISTING ENDS--->
 
			          
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>
