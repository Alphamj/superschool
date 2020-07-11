<?php 
$edit_data		=	$this->db->get_where('book' , array('book_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row2):?>
        <?php echo form_open(base_url() . 'index.php?librarian/book/do_update/'.$row['book_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row2['name'];?>"/>
                    </div>
                </div>
				
				
				<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('author');?></label>
                                <div class="col-sm-5">
                                    <select name="author_id" class="form-control" style="width:100%;">
									<option value="<?php echo $this->crud_model->get_type_name_by_id('author',$row2['author_id']);?>"><?php echo $this->crud_model->get_type_name_by_id('author',$row2['author_id']);?></option>
                                    	<?php 
										$authors = $this->db->get('author')->result_array();
										foreach($authors as $row):
										?>
                                    		<option value="<?php echo $row['author_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							
               
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row2['description'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="price" value="<?php echo $row2['price'];?>"/>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-5">
                        <select name="class_id" class="form-control">
                            <?php 
                            $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['class_id'];?>"
                                    <?php if($row['class_id']==$row2['class_id'])echo 'selected';?>><?php echo $row2['name'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                    <div class="col-sm-5">
                        <select name="status" class="form-control">
                            <option value="available" <?php if($row2['status']=='available')echo 'selected';?>><?php echo get_phrase('available');?></option>
                            <option value="unavailable" <?php if($row2['status']=='unavailable')echo 'selected';?>><?php echo get_phrase('unavailable');?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-sm btn-blue"><i class="entypo-book"></i><?php echo get_phrase('edit_book');?></button>
                  </div>
                </div>
        </form>
        <?php endforeach;?>
    </div>
</div>