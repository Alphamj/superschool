<?php $class_info = $this->db->get('class')->result_array(); ?>
    <div class="col-md-12">


            <div class="x_title">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_media'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/media/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-10">
                            <div class="date-and-time">
                                <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-10">
                            <textarea name="description" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-10">
                            <select name="class_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php foreach ($class_info as $row) { ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('Preview Image'); ?></label>
                        <div class="col-sm-10">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('media_link'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="mlink" class="form-control" id="field-1" >
							
							<div data-toggle="tooltip" title="Based on the information from http://www.youtube.com/youtubeonyoursite:
					Use the youtube site to find the video you want.
					Click the 'Share' button below the video.
					Click the 'Embed' button next to the link they show you.
					Copy the iframe code given and paste it into the html of your web page.">
					<div style="color: #FF0000">Point here to see tips on how to embed youtube videos</div></div>
							
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('file_type'); ?></label>

                        <div class="col-sm-10">
                            <select name="file_type" class="form-control">
                                <option value=""><?php echo get_phrase('select_file_type'); ?></option>
                                <option value="image"><?php echo get_phrase('image'); ?></option>
                                <option value="Video"><?php echo get_phrase('Video'); ?></option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('add_media');?></button>
						</div>
					</div>
                </form>

    </div>
</div>