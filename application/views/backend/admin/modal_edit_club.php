<?php 
$edit_data		=	$this->db->get_where('club' , array('club_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_club');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/club/do_update/'.$row['club_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('club_name');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="club_name" value="<?php echo $row['club_name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="desc" value="<?php echo $row['desc'];?>"/>
                        </div>
                    </div>
                   
            		<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_club');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>


