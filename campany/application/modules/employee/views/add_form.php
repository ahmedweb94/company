<form role="form bor-rad" enctype="multipart/form-data" action="<?php echo base_url().'employee/add_edit'?>" method="post">
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group col-md-6">
          <label for=""><b>اسم الموظف<b/></label>
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="employee_name" value="<?php echo isset($userData->employee_name)?$userData->employee_name:'';?>" class="form-control" placeholder="اسم الموظف">
          </div>
        </div>
        <div class="col-md-12">	
          <div class="form-group col-md-6">
            <label for=""><b>المنصب</b></label>
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="employee_position" value="<?php echo isset($userData->employee_position)?$userData->employee_position:'';?>" class="form-control" placeholder="المنصب">
          </div>
        </div>
        <div class="col-md-12">	
          <div class="form-group col-md-6">
            <label for=""><b>الشركه</b></label>
            <?php 
            $this->db->select('campany_id, campany_name');
            $query = $this->db->get('campany');?>
          </div>
          <div class="form-group col-md-6">
            <select name="campany_id" class="form-group col-md-6" <?php /* if($view=="1"){echo "disabled"; }*/?> id="campany_id">
              <?php
              foreach ($query->result() as $row){?>
                <option value="<?php echo $row->campany_id;?>"><?php echo $row->campany_name;?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="col-md-12"> 
          <div class="form-group imsize">
            <label for="exampleInputFile"><b> صوره الموظف</b></label>
            <div class="pic_size" id="image-holder"> 
              <?php if(isset($userData->employee_image) && file_exists('assets/images/'.$userData->employee_image)){
                $employee_image = $userData->employee_image;
              }else{ 
                $employee_image = 'user.png';
              } ?> 
              <left> <img class="thumb-image setpropileam" src="<?php echo base_url();?>/assets/images/<?php echo isset($employee_image)?$employee_image:'user.png';?>" alt="employee picture"></left>
            </div> <input type="file" name="employee_image" id="exampleInputFile">
          </div>
        </div>
        <?php if(!empty($userData->employee_id)){?>
          <input type="hidden"  name="employee_id" value="<?php echo isset($userData->employee_id)?$userData->employee_id:'';?>">
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
        $(document).ready(function(){
          $("#employee_class").change(function() {  
            var val=$("#employee_class").val();
            var url = '<?php echo base_url();?>';
            $.ajax({
              url : url+"employee/getcampany",
              method: "post", 
              data : {
                clasval: val
              }
            }).done(function(data) {
              $('#campany_id').html(data); 
            })
          });
        });
      </script>
