<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function test(){
        $this->load->model('user_model');
        echo $this->user_model->countAll();
    }

	public function index()
	{
        $ad_data = array(
            'title'   => "Đăng nhập"
        );   
        if($this->session->userdata("level")=="0")
        redirect(base_url()."quan-tri");
        else if($this->session->userdata("level")=="1")
        $this->load->view('tem_user');
        else
            $this->load->view('tem_login',$ad_data);
    }
    
    public function login(){
        
        $this->load->library('form_validation');
        $config = array(
            array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors'=> array(
                        'required'=>'Bạn chưa nhập username'
                    )
            ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[5]|max_length[12]',
                    'errors' => array(
                            'required' => 'Bạn chưa nhập mật khẩu',
                            'min_length'=>'Mật khẩu ít nhất 5 kí tự',
                            'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 12 ký tự'
                    ),
                )
            );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == false){
            
            $this->load->view('tem_login');
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->load->model('user_model');
            $query= $this->user_model->checkLogin($username, $password);
            if($query){
                if($query['level']==0){       
                    $data=array(
                        "id" => $query['id'],
                        "username" => $query['username'], 
                        "level" =>    $query['level']                 
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url()."quan-tri");
                }else{
                    $data=array(
                        "id" => $query['id'],
                        "username" => $query['username'],
                        "level" =>    $query['level']                        
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url()."thanhvien");
                }
            }else{
                $data = array( 'errlogin'=> "<p class='alert alert-danger '>Đăng nhập không thành công</p>") ;
                $this->load->view('tem_login',$data); 
            }
        }
    
    }

    public function admin(){   
        $this->load->model('user_model');
        if($this->session->userdata("level")=="0"){
                $this->load->library('pagination');

                $config['base_url'] = base_url().'quan-tri';
                $config['total_rows'] = $this->user_model->countAll();
                $config['per_page'] = 5;   
                $config['full_tag_open'] = '<ul class="pagination">';

                $config['full_tag_close'] = '</ul><!--pagination-->';

                $config['first_link'] = '&laquo; First';
                $config['first_tag_open'] = '<li class="page-item ">';
                $config['first_tag_close'] = '</li>';

                $config['last_link'] = 'Last &raquo;';
                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tag_close'] = '</li>';

                $config['next_link'] = 'Next &rarr;';
                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tag_close'] = '</li>';

                $config['prev_link'] = '&larr; Previous';
                $config['prev_tag_open'] = '<li class="page-item">';
                $config['prev_tag_close'] = '</li>';

                $config['cur_tag_open'] = '<li class="page-item"><a href="">';
                $config['cur_tag_close'] = '</a></li>';

                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);
                $start = $this->uri->segment(2);
                $dl = $this->user_model->getAllUser1($config['per_page'], $start); 
                



                
                
                $data = array(
                    'ds'=>$dl,
                    'page'=>$this->pagination->create_links()

                );
              $this->load->view('tem_admin',$data); 
         }else if($this->session->userdata("level")=="1")
         redirect(base_url()."thanhvien");
         else
             redirect(base_url()."dangnhap");
    }

    public function userb(){  
        if($this->session->userdata("level")=="0")
             redirect(base_url()."dangnhap");
         else if($this->session->userdata("level")=="1"){
            $this->load->model('user_model');
                $dl = $this->user_model->getUserById($this->session->userdata("id"));
                $data = array(
                    'ds'=>$dl
                );
              $this->load->view('tem_admin',$data); }
        else
            redirect(base_url()."dangnhap");
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url()."dangnhap");
    }

    public function getEdit($id,$status=''){
        $this->session->set_userdata('security','0');
        $this->load->model('user_model');
        $dl = $this->user_model->getUserById($id);
            $user = array('user'=>$dl,'status'=>$status);
            //print_r($dl);
           // echo $this->session->userdata('security');
            //var_dump($this->session->userdata('security'));
            //var_dump($dl['0']['level']);
            if (@$dl['0']['level'] == $this->session->userdata('security') && @$dl['0']['id'] != $this->session->userdata('id')) {
                 echo "<h1>Truy cập trái phép</h1>";
            }else{
                if(@$dl['0']['level']!=$this->session->userdata('security') || @$dl['0']['id'] == $this->session->userdata('id') || $this->session->userdata('level') == "0"  )
                $this->load->view('edit',$user);
                
            else{
                 echo "<h1>Truy cập trái phép</h1>";
            }
            }
            
        
    }

    public function postEdit($id){
        //if($this->session->userdata('level')=="0"){


        $this->load->library('form_validation');
         $this->load->model('user_model');
         $this->session->set_userdata('security','0');
         $dl = $this->user_model->getUserById($id);
         if (@$dl['0']['level'] == $this->session->userdata('security') && @$dl['0']['id'] != $this->session->userdata('id')) {
                 echo "<h1>Truy cập trái phép</h1>";
            }else{
         if(@$dl['0']['level']!=$this->session->userdata('security') || @$dl['0']['id'] == $this->session->userdata('id') || $this->session->userdata('level') == "0"  ){
            $config = array(          
            array(
                    'field' => 'name',
                  
                    'rules' => 'required|min_length[5]|max_length[50]',
                    'errors'=> array(
                        'required'=>'Bạn chưa nhập tên'
                    )
            ),
            array(
                    'field' => 'address',
                   
                    'rules' => 'required|min_length[5]|max_length[50]',
                    'errors' => array(
                            'required' => 'Bạn chưa nhập địa chỉ',
                            'min_length'=>'Địa chỉ ít nhất 6 kí tự',
                            'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 50 ký tự'
                    ),

                ),
            array(
                    'field' => 'phone',
                   
                    'rules' => 'required|min_length[10]|max_length[11]',
                    'errors' => array(
                            'required' => 'Bạn chưa nhập số điện thoại',
                            'min_length'=>'Số điện thoại ít nhất 10 kí tự',
                            'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 11 ký tự'
                    )
                 ) 
            // array(
            //         'field' => 'email',               
            //         'rules' => 'trim|required|valid_email|is_unique[user.email]',
            //          'errors' => array(
            //                  'required' => 'Bạn chưa nhập email',
            //                  'valid_email' =>'Định dạng Email không hợp lệ',
            //                  'is_unique'=>'Email đã tồn tại'
            //          )
            //      )
            );
         $this->form_validation->set_rules($config);
         $data = array(
                'user'=>  $this->user_model->getUserById($id)
         ) ;
         if ($this->form_validation->run() == FALSE)
                {

                        $this->load->view('edit',$data);          

                }
                else
                {
                        if ($this->session->userdata('level') == '1') {
                            $level = @$dl['0']['level'];
                        }else{
                            $level = $this->input->post('level');
                        }
                        if ($this->input->post('password')=='') {
                            $data_update = array(
                            'id'=>@$dl['0']['id'],
                            'username'=>@$dl['0']['username'],
                            'address'=>$this->input->post('address'),
                            'name'=>$this->input->post('name'),
                            'email'=>$this->input->post('email'),
                            'phone'=>$this->input->post('phone'),
                            'password'=>@$dl['0']['password'],
                            'level'=>$level
                        );
                        }else{
                            $data_update = array(
                            'id'=>@$dl['0']['id'],
                            'username'=>@$dl['0']['username'],
                            'address'=>$this->input->post('address'),
                            'name'=>$this->input->post('name'),
                            'email'=>$this->input->post('email'),
                            'phone'=>$this->input->post('phone'),
                            'password'=>md5($this->input->post('password')),
                            'level'=>$level
                        );
                        }
                        
                        // $data['id'] = $this->input->post('id');
                        // $data['username'] = $this->input->post('username');
                        // $data['address'] = $this->input->post('address');
                        // $data['name'] = $this->input->post('name');
                        // $data['email'] = $this->input->post('email');
                        // $data['phone'] = $this->input->post('phone');
                        // $data['password'] = $this->input->post('password');
                        // $data['level'] = $this->input->post('level');
                        //print_r($data);
                        $this->load->model('user_model');
                        $this->user_model->updateUser($data_update,$id);

                        
                        $this->getEdit($id,"<p class='alert alert-success'>Thay đổi thông tin thành công<p>");


                        
                }
                
         }
            else{
                 echo "<h1>Truy cập trái phép</h1>";
            
        
      // }else{
                }}
       // redirect(base_url()."quan-tri");
    }
    

    public function delete($id){
        $this->load->model('user_model');
        $this->user_model->delete_user($id);
        redirect(base_url()."quan-tri");
    }

    public function getLogUp(){
        if($this->session->userdata('level')=="0")
            $this->load->view('logup');
        else
            redirect(base_url()."dangnhap");
    }

    public function postLogUp(){
        if($this->session->userdata('level')=="0"){
        $this->load->library('form_validation');
        $config = array(
            array(
                    'field' => 'username',          
                    'rules' => 'trim|required|min_length[6]|max_length[50]|is_unique[user.username]',
                    'errors' => array(
                            'required' => 'Bạn chưa nhập username',
                            'min_length'=>'Username ít nhất 6 kí tự',
                            'max_length'=>'Độ dài quá quy định, username chỉ chứa 50 ký tự',
                            'is_unique'=>'Tên đăng nhập đã tồn tại'
                    )
                ),
            // array(
            //         'field' => 'name',               
            //         'rules' => 'required|min_length[6]|max_length[50]',
            //         'errors'=> array(
            //             'required'=>'Bạn chưa nhập username'
            //         )
            // ),
            // array(
            //         'field' => 'address',                
            //         'rules' => 'required|min_length[6]|max_length[50]',
            //         'errors' => array(
            //                 'required' => 'Bạn chưa nhập địa chỉ',
            //                 'min_length'=>'Địa chỉ ít nhất 6 kí tự',
            //                 'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 50 ký tự'
            //         ),

            //     ),
            array(
                    'field' => 'password',          
                    'rules' => 'trim|required|min_length[6]|max_length[50]',
                    'errors' => array(
                            'required' => 'Bạn chưa nhập password',
                            'min_length'=>'Mật khẩu ít nhất 6 kí tự',
                            'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 50 ký tự'
                    )
                ),
            array(
                    'field' => 'repassword',          
                    'rules' => 'trim|required|min_length[6]|max_length[50]|matches[password]',
                    'errors' => array(
                            'required' => 'Bạn chưa nhập password',
                            'min_length'=>'Mật khẩu ít nhất 6 kí tự',
                            'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 50 ký tự',
                            'matches'=>'Nhập lại mật khẩu sai'
                    )
                ),
            // array(
            //         'field' => 'phone',          
            //         'rules' => 'trim|required|min_length[10]|max_length[11]',
            //         'errors' => array(
            //                 'required' => 'Bạn chưa nhập số điện thoại',
            //                 'min_length'=>'Số điện thoại ít nhất 10 kí tự',
            //                 'max_length'=>'Độ dài quá quy định, mật khẩu chỉ chứa 11 ký tự'
            //         )
            //     ),
            array(
                    'field' => 'level',          
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => array(
                            'required' => 'Chưa cấp quyền'
                            
                    )
                ),
            array(
                    'field' => 'email',               
                    'rules' => 'trim|required|valid_email|is_unique[user.email]',
                     'errors' => array(
                             'required' => 'Bạn chưa nhập email',
                             'valid_email' =>'Định dạng Email không hợp lệ',
                             'is_unique'=>'Email đã tồn tại'
                     )
                 )
             );
         $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('logup');
                }
                else
                {
                        $data['username'] = $this->input->post('username');
                        $data['email'] = $this->input->post('email');
                        $data['password'] = $this->input->post('password');
                        $passcof = $this->input->post('repassword');
                        $data['level'] = $this->input->post('level');
                        //print_r($data);
                        //if ($data['password']==$passcof) {
                            $this->load->model('user_model');
                            $kt = $this->user_model->insert($data);
                            //print_r($kt);
                            if($kt){
                                $dt['success'] ="Tạo tài khoản thành công" ;
                                $this->load->view('logup',$dt);}
                            else{
                                $dt['success'] ="Tạo tài khoản thất bại" ;
                                $this->load->view('logup',$dt);
                            }
                            
                        //}else{
                           // $dt['loipass']="Nhập lại mật khẩu sai";
                           // $this->load->view('logup',$dt);
                       // }
                        
                        
                        


                        
                }
       }else{
        redirect(base_url()."quan-tri");
    }
    }

    public function timkiem(){
        $key = addslashes($this->input->post('search'));
        $key = trim($key);
            
        
        if ($key==null) {
            redirect(base_url()."quan-tri");
        }else{
            $key = convert_vi_to_en($key);
            $this->load->model('user_model');
            //$sear = count($this->user_model->search($key));
            // $this->load->library('pagination');
            //     $config['base_url'] = base_url().'user/timkiem';
            //     $config['total_rows'] = $sear;
            //     $config['per_page'] = 1;   
            //     $config['full_tag_open'] = '<ul class="pagination">';

            //     $config['full_tag_close'] = '</ul><!--pagination-->';

            //     $config['first_link'] = '&laquo; First';
            //     $config['first_tag_open'] = '<li class="page-item ">';
            //     $config['first_tag_close'] = '</li>';

            //     $config['last_link'] = 'Last &raquo;';
            //     $config['last_tag_open'] = '<li class="page-item">';
            //     $config['last_tag_close'] = '</li>';

            //     $config['next_link'] = 'Next &rarr;';
            //     $config['next_tag_open'] = '<li class="page-item">';
            //     $config['next_tag_close'] = '</li>';

            //     $config['prev_link'] = '&larr; Previous';
            //     $config['prev_tag_open'] = '<li class="page-item">';
            //     $config['prev_tag_close'] = '</li>';

            //     $config['cur_tag_open'] = '<li class="page-item"><a href="">';
            //     $config['cur_tag_close'] = '</a></li>';

            //     $config['num_tag_open'] = '<li class="page-item">';
            //     $config['num_tag_close'] = '</li>';

            //     $this->pagination->initialize($config);
            //     $start = $this->uri->segment(2);
            //     $dl = $this->user_model->getAllUser1($config['per_page'], $start); 
            if($this->user_model->search($key)!=null){    
            $data= array(
                 'ds'=>$this->user_model->search($key)
                 //'link'=>$this->pagination->create_links()
            );
            $this->load->view('tem_admin',$data);
            }else{
                $data= array(
                 'str'=> "<p>Không tìm thấy dữ liệu cần tìm</p>",
                 'back'  => "base_url().'quan-tri'"
            );
                $this->load->view('tem_admin',$data);
            }
        }

    }


}
