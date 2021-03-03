<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */



	/******
	*@function name:index
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
	public function index()
	{
		$this->load->view('index');
	}
	/******
	*@function name:registration
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
	public function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","fname",'required');
		$this->form_validation->set_rules("lname","lname",'required');
		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("mobile","mobile",'required');
		$this->form_validation->set_rules("dob","dob",'required');
		$this->form_validation->set_rules("address","address",'required');
		$this->form_validation->set_rules("district","district",'required');
		$this->form_validation->set_rules("pincode","pincode",'required');
		$this->form_validation->set_rules("uname","uname",'required');
		$this->form_validation->set_rules("password","password",'required');
		
		
		if($this->form_validation->run())
		{
			$this->load->model('mainmodel');
			$pass=$this->input->post("password");
			$encpass=$this->mainmodel->encpassword($pass);
		$a=array("fname"=>$this->input->post("fname"),
			"lname"=>$this->input->post("lname"),
			"dob"=>$this->input->post("dob"),
			"address"=>$this->input->post("address"),
			"district"=>$this->input->post("district"),
			"pincode"=>$this->input->post("pincode"));
		$b=array("email"=>$this->input->post("email"),
			"mobile"=>$this->input->post("mobile"),
			"uname"=>$this->input->post("uname"),
			"password"=>$encpass,'utype'=>'1');
		
		$this->mainmodel->register($a,$b);
		redirect(base_url().'main/index');

	    }
}


/******
	*@function name:check_email_avalibility
	*@Author:Anjali Krishnan
	*@date:02/03/2021
Email,username,phone validation****/
 
       public function check_email_avalibility()  
      {  
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
            {  
                 $this->load->model("mainmodel");  
                if($this->mainmodel->is_email_available($_POST["email"]))  
                 {  
                      echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
              }  
                 else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';  
                 }  
      }  
 }

/******
	*@function name:check_email_avalibility
	*@Author:Anjali Krishnan
	*@date:02/03/2021
Email,username,phone validation****/

 public function check_mobile_avalibility()  
      {  

                 $this->load->model("mainmodel");  
                if($this->mainmodel->is_mobile_available($_POST["mobile"]))  
                 {  
                      echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> mobile Already register</label>';  
              }  
                 else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> mobile Available</label>';  
                 }  
      }  
 






public function check_uname_avalibility()  
      {  

                 $this->load->model("mainmodel");  
                if($this->mainmodel->is_uname_available($_POST["uname"]))  
                 {  
                      echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> uname Already register</label>';  
              }  
                 else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> uname Available</label>';  
                 }  
      }  
 

	/******
	*@function name:login
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/

public function login()
{
$this->load->view('login');
}
public function admin()
{
$this->load->view('admin');
}
public function userhome()
{
$this->load->view('uhome');
}
public function new_login()
{
$this->load->library('form_validation');
$this->form_validation->set_rules("email","email",'required');
$this->form_validation->set_rules("password","password",'required');
if($this->form_validation->run())
{
$this->load->model('mainmodel');
$em=$this->input->post("email");
$pass=$this->input->post("password");
$rslt=$this->mainmodel->slctpass($em,$pass);

if ($rslt)
{
$id=$this->mainmodel->getusrid($em);
$user=$this->mainmodel->getusr($id);
$this->load->library(array('session'));
$this->session->set_userdata(array('id'=>(int)$user->id,'utype'=>$user->utype,'status'=>$user->status,'logged_in'=>(bool)true));
if($_SESSION['utype']=='0' && $_SESSION['logged_in']==true && $_SESSION['status']=='1')
{
redirect(base_url().'main/admin');
}

elseif ($_SESSION['utype']=='1' && $_SESSION['logged_in']==true && $_SESSION['status']=='1')
{
redirect(base_url().'main/userhome');
}

    }
    else
    {
    echo "invalid user";
    }
}
else
{
redirect('main/login','refresh');
}
}
	/******
	*@function name:show
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
	public function show()
{
	 if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
	 {
	$this->load->model('mainmodel');
	$data['n']=$this->mainmodel->show();
	$this->load->view('view',$data);
}
	 else
	 {
	 	redirect('main/login','refresh');
	 }

}
	/******
	*@function name:approve1
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
public function approve1()
	{
	 	if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
	 {

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->approve1($id);
		redirect('main/show','refresh');
	}

 else
{
 	redirect('main/login','refresh');
 }
 }

		/******
	*@function name:reject1
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
	public function reject1()
	{
	 	if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
	 {
		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->reject1($id);
		redirect('main/show','refresh');

	}
	 else
	 {
	 	redirect('main/login','refresh');
	 }
	}
	/******
	*@function name:update
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
	public function update()
{
		
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
	 {
		$this->load->model('mainmodel');
		$id=$this->session->id;
		$data['user_data']=$this->mainmodel->updateform($id);
		$this->load->view('update',$data);

	}
	else
	{
		redirect('main/login','refresh');

	}
}
/******
	*@function name:updatedetails
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/

public function updatedetails()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
	 {
		$a=array("fname"=>$this->input->post("fname"),
			"lname"=>$this->input->post("lname"),
			"dob"=>$this->input->post("dob"),
			"address"=>$this->input->post("address"),
			"district"=>$this->input->post("district"),
			"pincode"=>$this->input->post("pincode"),
			);
		$b=array("email"=>$this->input->post("email"),
			"email"=>$this->input->post("email"),
			"mobile"=>$this->input->post("mobile"),
		"uname"=>$this->input->post("uname"));
		$this->load->model('mainmodel');
		
		if($this->input->post("update"))
		{
			$id=$this->session->id;
			$this->mainmodel->updates($a,$b,$id);
			redirect('main/update','refresh');
		}
		else
		{
			redirect('main/login','refresh');
		}

	}
}
/******
	*@function name:delete
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/
	public function delete()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
	 {
		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->delete($id);
		redirect('main/show','refresh');
	}
	else
	{
		redirect('main/login','refresh');
	}
	}

/******
	*@function name:logout
	*@Author:Anjali Krishnan
	*@date:02/03/2021
	******/

/****logout***********/
public function logout()
    {
        $data=new stdClass();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true)
        {
            foreach ($_SESSION as $key => $value)
            {
               unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification','logged_out');
            redirect('main/login','refresh');
        }
        else{
            redirect('main/login','refresh');
        }
    }
    /**********logout end**************/
    /***************forget password*************************************/
public function forget()
{
$this->load->view('forgetpswd');
}

public function send()
{
    $to =  $this->input->post('from');  // User email pass here
    $subject = 'Welcome To Elevenstech';

    $from = 'team3orisys@gmail.com';              // Pass here your mail id

    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
    $emailContent .='<tr><td style="height:20px"></td></tr>';


    $emailContent .= $this->input->post('message');  //   Post message available here


    $emailContent .='<tr><td style="height:20px"></td></tr>';
    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";
                


    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '60';

    $config['smtp_user']    = 'team3orisys@gmail.com';    //Important
    $config['smtp_pass']    = 'karr@orisys';  //Important

    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not 

     

    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($emailContent);
    $this->email->send();

    $this->session->set_flashdata('msg',"Mail has been sent successfully");
    $this->session->set_flashdata('msg_class','alert-success');
    return redirect('main/forget');
}









    /****************forget password******************************************/

}
