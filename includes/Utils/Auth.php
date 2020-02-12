<?php


class Auth
{
    /**
     * @var DB
     */
    private $db;

    private $user;

    public function __construct(&$db)
    {
// هنا تعليقة الموقع 
        $this->db = &$db;

         if ($this->is_auth())
		{

           $this->user = $this->getUser();
		
		} 
	 }

    public function login($user, $pass)
    { 


        $username = strtolower( $user );
 
	   $password = md5($pass);
	    
        $query = "SELECT * FROM users WHERE (user_name='$username' OR email = '$username') AND password='$password'";
         
		if ($user = $this->db->getRow($query)) { //success
 
            $_SESSION['username'] = $user->user_name;
            $_SESSION['id'] = $user->id;
            $_SESSION['account_type'] = $user->account_type;
 
            return true;
        }

        return false;
    }

function checkUserExist()
{
      
    $query = "select * from users where id =" .  $_SESSION['id']  ;
    
   $result =  $this->db->getRow($query) ;
	  
    if ($result->num_rows > 0) {
        return  true;
    } else {
        return   false ;
    }
}

    public function is_auth()
    {
 
  
        if (isset($_SESSION["id"]) && !$this->checkUserExist()) {
			   					

             $this->logout();
        }
		
        return  true; 
    }

	 public function logout()
    {

	}
	
    public function getUser()
    {
        if ($this->is_auth()) {
            return $this->db->getRow("SELECT * FROM users WHERE id=" . $_SESSION['id']);
        }
        return false;
    }

    public function getCurrentUsername()
    {
        if ($this->is_auth()) {
            return $this->user->user_name;
        }
        return false;
    }

    public function getAccountType()
    {
        if ($this->is_auth()) {
            return intval($this->user->account_type);
        }
        return false;

    }

    public function getId()
    {
        if ($this->is_auth()) {
            return $this->user->id;
        }
        return false;

    }

    public function getAccountNumber()
    {

        if ($this->is_auth()) {
            return $this->user->account_number;
        }
    }



}



global $auth;
 
$auth = new Auth($db);
 