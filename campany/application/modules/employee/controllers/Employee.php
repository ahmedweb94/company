<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Employee extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model('Employee_model');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

    /**
     * This function is used for show users list
     * @return Void
     */
    public function index(){
        is_login();
        if(CheckPermission("employee", "own_read")){
            $this->load->view('include/header');
            $this->load->view('employee_table');                
            $this->load->view('include/footer');            
        } else {
            $this->session->set_flashdata('messagePr', 'can not access');
            redirect( base_url().'user/profile', 'refresh');
        }
    }

    /**
     * This function is used to delete users
     * @return Void
     */
    public function delete($id){
        is_login(); 
        $ids = explode('-', $id);
        foreach ($ids as $id) {
            $this->Employee_model->delete($id); 
        }
        redirect(base_url().'employee/', 'refresh');
    }


    /**
     * This function is used to create datatable in users list page
     * @return Void
     */
    public function dataTable (){
        is_login();
        $table = 'employee';
        $primaryKey = 'employee_id';
        $columns = array(
         array( 'db' => 'employee_id', 'dt' => 0 ),array( 'db' => 'employee_name', 'dt' => 1 )
         ,array( 'db' => 'employee_position', 'dt' => 2 ),array( 'db' => 'employee_image', 'dt' => 3 ),array( 'db' => 'campany_id', 'dt' => 4 ),array( 'db' => 'employee_id', 'dt' => 5 )
     );

        $sql_details = array(
         'user' => $this->db->username,
         'pass' => $this->db->password,
         'db'   => $this->db->database,
         'host' => $this->db->hostname
     );

        $output_arr = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns);
        foreach ($output_arr['data'] as $key => $value) {
         $id = $output_arr['data'][$key][count($output_arr['data'][$key])  - 1];
         $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] = '';



         $campany=getDataByid('campany',$output_arr['data'][$key][4],'campany_id'); 
         $output_arr['data'][$key][4] = $campany->campany_name;


         if(CheckPermission($table, "all_update")){
             $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonemployee mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
         }else if(CheckPermission($table, "own_update") && (CheckPermission($table, "all_update")!=true)){
            $user_id =getRowByTableColomId($table,$id,'users_id','user_id');
            if($user_id==$this->user_id){
             $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonemployee mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
         }
     }

     if(CheckPermission($table, "all_delete")){
         $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'employee\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';}
         else if(CheckPermission($table, "own_delete") && (CheckPermission($table, "all_delete")!=true)){
            $user_id =getRowByTableColomId($table,$id,'users_id','user_id');
            if($user_id==$this->user_id){
             $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'employee\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
         }
     }
     $output_arr['data'][$key][0] = '<input type="checkbox" name="selData" value="'.$output_arr['data'][$key][0].'">';
 }
 echo json_encode($output_arr);
}


    /**
     * This function is used to add and update users
     * @return Void
     */
    public function add_edit($employee_id='') {   
        $data = $this->input->post();
        $employee_name = $this->input->post('employee_name');
        $employee_position = $this->input->post('employee_position');
        $employee_image = 'user.png';
        $campany_id = $this->input->post('campany_id');

        if($this->input->post('employee_id')) {
            $employee_id = $this->input->post('employee_id');
        }
        if(isset($this->session->userdata ('user_details')[0]->users_id)) {
            $redirect = 'employee';
        } else {
          redirect(base_url().'user/login', 'refresh');
      }
      if($this->input->post('fileOld')) {  
        $newname = $this->input->post('fileOld');
        $employee_image =$newname;
    } else {

        $employee_image ='user.png';
    }
    foreach($_FILES as $name => $fileInfo)
    { 
       if(!empty($_FILES[$name]['name'])){
        $newname=$this->upload(); 

        $employee_image =$newname;
    } else {  
        if($this->input->post('fileOld')) {  
            $newname = $this->input->post('fileOld');

            $employee_image =$newname;
        } else {

            $employee_image ='user.png';
        } 
    } 
}

if($employee_id != '') {
    $employee_id = $this->input->post('employee_id');        
    $dataedit['employee_name'] = $this->input->post('employee_name');
    $dataedit['employee_position'] = $this->input->post('employee_position');
    $dataedit['employee_image'] = $employee_image;
    $dataedit['campany_id'] = $this->input->post('campany_id');


    if(isset($data['edit'])){
        unset($data['edit']);
    }
    $this->Employee_model->updateRow('employee', 'employee_id', $employee_id, $dataedit);
    $this->session->set_flashdata('messagePr', 'done edit');
    redirect( base_url().'employee', 'refresh');
} else { 
    if($this->input->post('user_type') != 'admin') {
        $data = $this->input->post();
        $data['employee_name'] = $employee_name;
        $data['employee_position'] = $employee_position;
        $data['employee_image'] = $employee_image;
        $data['campany_id'] = $campany_id;

        unset($data['submit']);
        $this->Employee_model->insertRow('employee', $data);
        redirect( base_url().'employee/'.$redirect, 'refresh');
    } else {
        $this->session->set_flashdata('messagePr', 'you can not you not admin ' );
        redirect( base_url().'user/login', 'refresh');
    }
}

}

public function get_modal() {
    is_login();
    if($this->input->post('id')){
        $data['userData'] = getDataByid('employee',$this->input->post('id'),'employee_id'); 
        echo $this->load->view('add_form', $data, true);
    } else {
        echo $this->load->view('add_form', '', true);
    }
    exit;
}
    /**
     * This function is used to upload file
     * @return Void
     */
    function upload() {
        foreach($_FILES as $name => $fileInfo)
        {
            $filename=$_FILES[$name]['name'];
            $tmpname=$_FILES[$name]['tmp_name'];
            $exp=explode('.', $filename);
            $ext=end($exp);
            $newname=  $exp[0].'_'.time().".".$ext; 
            $config['upload_path'] = 'assets/images/';
            $config['upload_url'] =  base_url().'assets/images/';
            $config['allowed_types'] = "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp";
            $config['max_size'] = '2000000'; 
            $config['file_name'] = $newname;
            $this->load->library('upload', $config);
            move_uploaded_file($tmpname,"assets/images/".$newname);
            return $newname;
        }
    }


}
?>
