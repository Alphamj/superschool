<?php 
$edit_data		=	$this->db->get_where('news' , array('news_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_news');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/news/do_update/'.$row['news_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('news_title');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="news_title" value="<?php echo $row['news_title'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
				
				 <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('uploader');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="uploader" value="<?php echo $row['uploader'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('date');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="datepicker form-control" name="date" value="<?php echo $row['date'];?>"/>
                    </div>
                </div>
				 <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('short_content');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="short_content" value="<?php echo $row['short_content'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('news_content');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="news_content" value="<?php echo $row['news_content'];?>"/>
                    </div>
                </div>
               <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_news');?></button>
						</div>
					</div>
            </form>
    </div>
</div>

<?php
endforeach;
?>





