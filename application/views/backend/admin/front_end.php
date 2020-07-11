
	<div class="col-md-12">       
           		<!----CREATION FORM STARTS---->
 <div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title">
                        <?php echo get_phrase('supply_front_end_information');?>
                    </div>
                </div>
				
   <?php echo form_open(base_url() . 'index.php?admin/front_end/do_update' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
											
			
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('short_about');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="about_us"/><?php echo $this->db->get_where('front_end' , array('type' =>'about_us'))->row()->description;?></textarea>
								</div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('full_about_us');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control ckeditor"  value = "" name="full_about"/><?php echo $this->db->get_where('front_end' , array('type' =>'full_about'))->row()->description;?></textarea>
								</div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('vision');?></label>
                                <div class="col-sm-11">

                <textarea  class="form-control" value = "" name="vission"/><?php echo $this->db->get_where('front_end' , array('type' =>'vission'))->row()->description;?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('mission');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="mission"/><?php echo $this->db->get_where('front_end' , array('type' =>'mission'))->row()->description;?></textarea>

                                </div>
                            </div>
							
				<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('goal');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="goal"/><?php echo $this->db->get_where('front_end' , array('type' =>'goal'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('services');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="services"/><?php echo $this->db->get_where('front_end' , array('type' =>'services'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('youtube');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="youtube"/><?php echo $this->db->get_where('front_end' , array('type' =>'youtube'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('news_intro');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="news"/><?php echo $this->db->get_where('front_end' , array('type' =>'news'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('teacher_intro');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="teacher"/><?php echo $this->db->get_where('front_end' , array('type' =>'teacher'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('event_intro');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="event"/><?php echo $this->db->get_where('front_end' , array('type' =>'event'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('testimonies_intro');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="testimonies"/><?php echo $this->db->get_where('front_end' , array('type' =>'testimonies'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('system_map');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="map"/><?php echo $this->db->get_where('front_end' , array('type' =>'map'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('facebook');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="facebook"/><?php echo $this->db->get_where('front_end' , array('type' =>'facebook'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('twitter');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="twitter"/><?php echo $this->db->get_where('front_end' , array('type' =>'twitter'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('linkedin');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="linkedin"/><?php echo $this->db->get_where('front_end' , array('type' =>'linkedin'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('pinterest');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="instagram"/><?php echo $this->db->get_where('front_end' , array('type' =>'instagram'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('footer_text');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="footer_text"/><?php echo $this->db->get_where('front_end' , array('type' =>'footer_text'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-1 control-label"><?php echo get_phrase('register_content');?></label>
                                <div class="col-sm-11">
                <textarea  class="form-control" value = "" name="reg"/><?php echo $this->db->get_where('front_end' , array('type' =>'reg'))->row()->description;?></textarea>
                                </div>
                            </div>

                        		<div class="form-group">
                              	<div class="col-sm-offset-1 col-sm-7">
                                  <button type="submit" class="btn  btn-blue"><i class="entypo-plus"></i><?php echo get_phrase('save');?></button>
                              	</div>
								</div>
					     <br>
			            <?php echo form_close();?>

			<!----CREATION FORM ENDS-->
			
			 </div>
							</div> 
