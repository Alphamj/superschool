<div class="col-md-5">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_book'); ?>
					</div>
					</div>
					   
			<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/book/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('book_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('author');?></label>
                                <div class="col-sm-9">
                                    <select name="author_id" class="form-control" style="width:100%;">
									<option>Select Author</option>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('publisher');?></label>
                                <div class="col-sm-9">
                                    <select name="publisher_id" class="form-control" style="width:100%;">
									<option>Select Publisher</option>
                                    	<?php 
										$publishers = $this->db->get('publisher')->result_array();
										foreach($publishers as $row):
										?>
                                    		<option value="<?php echo $row['publisher_id'];?>"><?php echo $row['publisher_name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('book_category');?></label>
                                <div class="col-sm-9">
                                    <select name="book_category_id" class="form-control" style="width:100%;">
									<option>Select Book Category</option>
                                    	<?php 
										$book_categorys = $this->db->get('book_category')->result_array();
										foreach($book_categorys as $row):
										?>
                                    		<option value="<?php echo $row['book_category_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('ISBN_number');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="isbn"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('book_edition');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="edition"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('book_subject');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subject"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('book_quantity');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="quantity"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_added'); ?></label>
                        <div class="col-sm-9">
                            <div class="date-and-time">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="price"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-9">
                                    <select name="class_id" class="form-control" style="width:100%;">
                                    	<?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control" style="width:100%;">
                                    	<option value="available"><?php echo get_phrase('available');?></option>
                                    	<option value="unavailable"><?php echo get_phrase('unavailable');?></option>
                                    </select>
                                </div>
                            </div>
							
							
							<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('book_image'); ?></label>

                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="http://placehold.it/200x200" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

							
							
                        		<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn=sm btn-icon icon-left"><i class="entypo-book"></i><?php echo get_phrase('add_book');?></button>
                              </div>
								</div>
								<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
					
					
<div class="col-md-7">
<div class="x_panel table-responsive">
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_books'); ?>
					</div>
					</div>

<table class="table" id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('book_name');?></div></th>
                    		<th><div><?php echo get_phrase('author');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('price');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($books as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('author',$row['author_id']);?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['price'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
							<td><span class="label label-<?php if($row['status']=='available')echo 'success';else echo 'warning';?>"><?php echo $row['status'];?></span></td>
							<td>
							
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_book/<?php echo $row['book_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/book/delete/<?php echo $row['book_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							
							
                           
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->


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