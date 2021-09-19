<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'E45pg876123');
define('DB_NAME', 'characters');
class DB_con
{
function __construct()
{
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$this->dbh=$con;
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
}

// for username availblty
public function usernameavailblty($email) {
	 $result =mysqli_query($this->dbh,"SELECT email FROM tbl_users WHERE email='".$email."'");
return $result;
}

// Function for registration
	public function registration($uname,$uemail,$pasword)
	{
    $ret=mysqli_query($this->dbh,"insert into tbl_users(name,email,password,token) values('".$uname."','".$uemail."','".$pasword."',100)");
	return $ret;
	}

// Function for signin
public function signin($uname,$pasword)
	{
	$result=mysqli_query($this->dbh,"select * from tbl_users where name='".$uname."' and password='".$pasword."'");
	return $result;
	}

	public function updateToken($BetToken,$userid)
	{
	$result=mysqli_query($this->dbh,"UPDATE tbl_users SET token= token - ".$BetToken." WHERE id = ".$userid."");
	return $result;
	}

	public function SearchTable($userid)
	{
	$result=mysqli_query($this->dbh,"Select * From tbl_users Where id =".$userid."");
	$num=mysqli_fetch_array($result);
	if($num>0)
	{
		$_SESSION['token']=$num['token'];
	}
	return $result;
	}

	public function updatePassword($oldpassword,$newpassword,$conpassword){
							$message="<script type='text/javascript'>alert('Something Gone Wrong');</script>";
							 $query ='SELECT * FROM tbl_users WHERE id = '.$_SESSION['id'].'';
                             $results = mysqli_query($this->dbh, $query);
                             $count = mysqli_num_rows($results);
                             if($count > 0){
                               while($row = mysqli_fetch_array($results))
                               {
											$pass=$row['password'];
                               }
                                }
									if($oldpassword==$pass)
									{
										if($newpassword==$conpassword)
										{
										    $query ='UPDATE tbl_users SET password = '.$newpassword.' WHERE id =  '.$_SESSION['id'].'';
											echo $_SESSION['id'];
                                            mysqli_query($this->dbh, $query);
											$message="<script type='text/javascript'>alert('User Informations Are Updated');</script>";
										}
										else
										$message= "<script type='text/javascript'>alert('Passwords Did not Match');</script>";
									}else{
                                        $message= "<script type='text/javascript'>alert('Old Password is Wrong');</script>";
                                    }
									return $message;							
	}

}
?>