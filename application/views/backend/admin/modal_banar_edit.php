<?php 
$edit_data		=	$this->db->get_where('banar' , array('banar_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_bannar');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/banar/do_update/'.$row['banar_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                
					 <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('image'); ?></label>
                        <div class="col-sm-10">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary btn-sm" data-label="<i class='glyphicon glyphicon-file'></i> Browse Image" />
					    <br><br>
						<div  style="color:#FF0000">920 X 783</div>
					   </div>
					   
                    <br><br>
                            
                         <div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('banner_text_1');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="b_text_one" value="<?php echo $row ['b_text_one'] ;?>" >
						</div>
					</div>
				
				
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('banner_text_2');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="b_text_two" value="<?php echo $row ['b_text_two'] ;?>" >
						</div> 
					</div>
                            
                            
                      <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-orange btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_bannar');?></button>
						</div>
					</div>
                <?php echo form_close();?>
    </div>
</div>

<?php
endforeach;
?>