<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Campany extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model('Campany_model');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

    /**
     * This function is used for show users list
     * @return Void
     */
    public function index(){
        is_login();
        if(CheckPermission("campany", "own_read")){
            $this->load->view('include/header');
            $this->load->view('campany_table');                
            $this->load->view('include/footer');            
        } else {
            $this->session->set_flashdata('messagePr', 'لا تملك تصاريح هذه العملية');
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
            $this->Campany_model->delete($id); 
        }
        redirect(base_url().'campany/', 'refresh');
    }


    /**
     * This function is used to create datatable in users list page
     * @return Void
     */
    public function dataTable (){
        is_login();
        $table = 'campany';
        $primaryKey = 'campany_id';
        $columns = array(
         array( 'db' => 'campany_id', 'dt' => 0 ),array( 'db' => 'campany_name', 'dt' => 1 ),array( 'db' => 'campany_header', 'dt' => 2 ),array( 'db' => 'campany_description', 'dt' => 3 ),array( 'db' => 'campany_image', 'dt' => 4 ),array( 'db' => 'campany_website', 'dt' => 5 ),array('db'=>'campany_email','dt'=>6 ),array( 'db' => 'campany_id', 'dt' => 7 )
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
         
         
         $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtoncompany mClass"  href="javascript:;" type="button" data-src="'.$id.'"  data-view="1"  title="Show"><i class="fa fa-eye" data-id=""></i></a>';


         if(CheckPermission($table, "all_update")){
             $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtoncompany mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
         }else if(CheckPermission($table, "own_update") && (CheckPermission($table, "all_update")!=true)){
            $user_id =getRowByTableColomId($table,$id,'users_id','user_id');
            if($user_id==$this->user_id){
             $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtoncompany mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
         }
     }
     
     if(CheckPermission($table, "all_delete")){
         $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'campany\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';}
         else if(CheckPermission($table, "own_delete") && (CheckPermission($table, "all_delete")!=true)){
            $user_id =getRowByTableColomId($table,$id,'users_id','user_id');
            if($user_id==$this->user_id){
             $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'campany\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
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
    public function add_edit($id='') {   
        $data = $this->input->post();
        $campany_image = 'user.png';
        $campany_name = $this->input->post('campany_name');
        $campany_header = $this->input->post('campany_header');
        $campany_description = $this->input->post('campany_description');
        $campany_website = $this->input->post('campany_website');
        $campany_phone = $this->input->post('campany_phone');
        $campany_fb = $this->input->post('campany_fb'); 
        $campany_email = $this->input->post('campany_email');        
        
        if($this->input->post('campany_id')) {
            $id = $this->input->post('campany_id');
        }
        if(isset($this->session->userdata ('user_details')[0]->users_id)) {
            $redirect = 'campany';
        } else {
          redirect(base_url().'user/login', 'refresh');
      }
      if($this->input->post('fileOld')) {  
        $newname = $this->input->post('fileOld');
        $campany_image =$newname;
    } else {
        
        $campany_image ='user.png';
    }
    foreach($_FILES as $name => $fileInfo)
    { 
       if(!empty($_FILES[$name]['name'])){
        $newname=$this->upload(); 
        
        $campany_image =$newname;
    } else {  
        if($this->input->post('fileOld')) {  
            $newname = $this->input->post('fileOld');
            
            $campany_image =$newname;
        } else {
            
            $campany_image ='user.png';
        } 
    } 
}
if($id != '') {
    $campany_id = $this->input->post('campany_id');        
    $dataedit['campany_image']=$campany_image;
    $dataedit['campany_name'] = $this->input->post('campany_name');
    $dataedit['campany_header'] = $this->input->post('campany_header');
    $dataedit['campany_description'] = $this->input->post('campany_description');
    $dataedit['campany_website'] = $this->input->post('campany_website');
    $dataedit['campany_phone'] = $this->input->post('campany_phone');            
    $dataedit['campany_fb'] = $this->input->post('campany_fb');
    $dataedit['campany_email'] = $this->input->post('campany_email');
    
    if(isset($data['edit'])){
        unset($data['edit']);
    }
    $this->Campany_model->updateRow('campany', 'campany_id', $campany_id, $dataedit);
    $this->session->set_flashdata('messagePr', 'تم تعديل البيانات بنجاح');
    redirect( base_url().'campany', 'refresh');
} else { 
    if($this->input->post('user_type') != 'admin') {
        $data = $this->input->post();
                //$data['token'] = $this->generate_token();
                //$data['campany_id'] = $this->id;
        $data['campany_name'] = $campany_name;
        $data['campany_header'] = $campany_header;
        $data['campany_description'] = $campany_description;
        $data['campany_website'] = $campany_website;
        $data['campany_image'] = $campany_image;
        $data['campany_phone'] = $campany_phone;
        $data['campany_fb'] = $campany_fb;
        $data['campany_email'] = $campany_email;
        
        unset($data['submit']);
        $this->Campany_model->insertRow('campany', $data);

        redirect( base_url().'campany', 'refresh');
    } else {
        $this->session->set_flashdata('messagePr', 'انت لا تملك عضوية' );
        redirect( base_url().'user/login', 'refresh');
    }
}

}

public function get_modal() {
    is_login();
    if($this->input->post('id')){
        $data['userData'] = getDataByid('campany',$this->input->post('id'),'campany_id'); 
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
