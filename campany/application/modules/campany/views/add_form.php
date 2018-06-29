<form role="form bor-rad" enctype="multipart/form-data" action="<?php echo base_url().'campany/add_edit'?>" method="post">
	<div class="box-body">
		
		<!-- show company employee  -->
		<?php if($view=="1"){?>
			<div class="col-xs-8">
				<div class="box">
					<h3 class="box-title">موظفين الشركه</h3>
					<?php
					$this->db->select('employee_name');
					$query=$this->db->get_where('employee',array('campany_id'=>$userData->campany_id));?>
					<ul>
						<?php foreach ($query->result() as $employee) {?>
							<li><?php echo $employee;?></li>
						</ul>
					<?php }}?>
				</div>
			</div>
			<!-- end show -->
			
			<div class="col-md-12">
				<div class="form-group col-md-6">
					<input type="text" name="campany_name" value="<?php echo isset($userData->campany_name)?$userData->campany_name:'';?>" class="form-control" placeholder="اسم الشركه">
				</div>
				<div class="form-group col-md-6">
					<label for=""><b>اسم الشركه<b/></label>
					</div>
				</div>
				<div class="col-md-12">	
					<div class="form-group col-md-6">
						<label for=""><b>رئيس الشركه</b></label>
					</div>
					<div class="form-group col-md-6">
						<input type="text" name="campany_header" value="<?php echo isset($userData->campany_header)?$userData->campany_header:'';?>" class="form-control" placeholder="رئيس الشركه">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group col-md-3">
						<label for=""><b>وصف الشركه<b/></label>
						</div>
						<div class="form-group col-md-9">
							<textarea class="form-control ckeditor" id="html" name="campany_description" placeholder="description"> <?php echo isset($userData->campany_description)?$userData->campany_description:'';?></textarea>
						</div>
					</div>
					<div class="col-md-12">	
						<div class="form-group col-md-6">
							<label for=""><b>الموقع الالكتروني الشركه</b></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="campany_website" value="<?php echo isset($userData->campany_website)?$userData->campany_website:'';?>" class="form-control" placeholder="الموقع الالكتروني للشركه">
						</div>
					</div>                        
					<div class="col-md-12">	
						<div class="form-group col-md-6">
							<label for=""><b>هاتف الشركه</b></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="campany_phone" value="<?php echo isset($userData->campany_phone)?$userData->campany_phone:'';?>" class="form-control" placeholder="هاتف الشركه">
						</div>
					</div>  
					<div class="col-md-12">	
						<div class="form-group col-md-6">
							<label for=""><b>campany facebook</b></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="campany_fb" value="<?php echo isset($userData->campany_fb)?$userData->campany_fb:'';?>" class="form-control" placeholder="facebook">
						</div>
					</div>
					<div class="col-md-12">	
						<div class="form-group col-md-6">
							<label for=""><b>بريد الشركه</b></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="campany_email" value="<?php echo isset($userData->campany_email)?$userData->campany_email:'';?>" class="form-control" placeholder="البريد الالكتروني للشركه">
						</div>
					</div>          
					<div class="col-md-12"> 
						<div class="form-group imsize">
							<label for="exampleInputFile"><b> صوره الشركه</b></label>
							<div class="pic_size" id="image-holder"> 
								<?php if(isset($userData->campany_image) && file_exists('assets/images/'.$userData->campany_image)){
									$campany_image = $userData->campany_image;
								}else{ 
									$campany_image = 'user.png';
								} ?> 
								<left> <img class="thumb-image setpropileam" src="<?php echo base_url();?>/assets/images/<?php echo isset($campany_image)?$campany_image:'user.png';?>" alt="campany picture"></left>
							</div> <input type="file" name="campany_image" id="exampleInputFile">
						</div>
						
					</div>
					<?php if(!empty($userData->campany_id)){?>
						<input type="hidden"  name="campany_id" value="<?php echo isset($userData->campany_id)?$userData->campany_id:'';?>">
						<input type="hidden" name="fileOld" value="<?php echo isset($userData->campany_image)?$userData->campany_image:'';?>">
						<div class="box-footer sub-btn-wdt">
							<button type="submit" name="edit" value="edit" class="btn btn-success wdt-bg">تعديل</button>
						</div>
						<!-- /.box-body -->
					<?php }else{?>
						<div class="box-footer sub-btn-wdt">
							<button type="submit" name="submit" value="add" class="btn btn-success wdt-bg">اضافه</button>
						</div>
					<?php }?>
				</form>
				<script>
					var tt = $('textarea.ckeditor').ckeditor();
					CKEDITOR.config.allowedContent = true;
					
					
				</script>
