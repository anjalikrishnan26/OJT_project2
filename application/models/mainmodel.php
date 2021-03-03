<?php
class mainmodel extends CI_model
{
	public function encpassword($pass)
	{
		return password_hash($pass,PASSWORD_BCRYPT);
	}
/****
*@function name=register
*@author=Anjali Krishnan
*@date=02/03/2021
****/


public function register($a,$b)
{
	
	$this->db->insert("login",$b);
	$id=$this->db->insert_id();
	$a['log_id']=$id;
	$this->db->insert("register",$a);
	
}	
 function is_email_available($email)  
       {  
            $this->db->where('email', $email);  
            $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
            {  
                 return true;  
           }  
           else  
            {  
                return false;  
            }  
       }  


function is_mobile_available($mobile)  
       {  
            $this->db->where('mobile', $mobile);  
            $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
            {  
                 return true;  
           }  
           else  
            {  
                return false;  
            }  
       }  



       function is_uname_available($uname)  
       {  
            $this->db->where('uname', $uname);  
            $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
            {  
                 return true;  
           }  
           else  
            {  
                return false;  
            }  
       }  




public function slctpass($em,$pass)
{
$this->db->select('password');

$this->db->where("uname=","$em");
$this->db->or_where("email=","$em");
$this->db->or_where("mobile=","$em");

$this->db->from('login');
$qry=$this->db->get()->row("password");
return $this->verifypas($pass,$qry);
}
public function verifypas($pass,$qry)
{
return password_verify($pass,$qry);
}
public function getusrid($em)
{
$this->db->select('id');
$this->db->from("login");
$this->db->where("uname=","$em");
$this->db->or_where("email=","$em");
$this->db->or_where("mobile=","$em");

return $this->db->get()->row('id');
}
public function getusr($id)
{
$this->db->select('*');
$this->db->from("login");
$this->db->where("id",$id);
return $this->db->get()->row();
}
// public function slctpass($em,$pass)
// {
// $this->db->select('password');
// $this->db->from("login");
// $this->db->where("email",$em);
// $qry=$this->db->get()->row('password');
// return $this->verfypass($pass,$qry);
// }
// public function verfypass($pass,$qry)
// {
// return password_verify($pass,$qry);
// }
// public function getusrid($em)
// {
// $this->db->select('id');
// $this->db->from("login");
// $this->db->where("email",$em);
// return $this->db->get()->row('id');
// }
// public function getusr($id)
// {
// $this->db->select('*');
// $this->db->from("login");
// $this->db->where("id",$id);
// return $this->db->get()->row();
// }


public function show()
{
	$this->db->select('*');
	$this->db->join('login','login.id=register.log_id','inner');
	$qry=$this->db->where('utype','1');
	$qry=$this->db->get("register");
	return $qry;

}
public function approve1($id)
{
	$this->db->set('status','1');
	$qry=$this->db->where("id",$id);
	$qry=$this->db->update("login");
    return $qry;
}
public function reject1($id)
{
	$this->db->set('status','2');
	$qry=$this->db->where("id",$id);
	$qry=$this->db->update("login");
    return $qry;
}


public function updateform($id)
	{
		$this->db->select('*');
		$qry=$this->db->join("login",'login.id=register.log_id','inner');
		$qry=$this->db->where("register.log_id",$id);
		$qry=$this->db->get("register");
		return $qry;
	}


	public function updates($a,$b,$id)
	{
        $this->db->select('*');
        $qry=$this->db->where("log_id",$id);
        $qry=$this->db->join('login','login.id=register.log_id','inner');
        $qry=$this->db->update("register",$a);
        $qry=$this->db->where("login.id",$id);
        $qry=$this->db->update("login",$b);
        return $qry;


	} 
public function delete($id)
	{
		$this->db->join('login','login.id=register.log_id','inner');
		$this->db->where("log_id",$id);
		$this->db->delete("register");
		$this->db->where("id",$id);
		$this->db->delete("login");

	}
}

?>