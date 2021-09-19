<?php
session_start();
// include Function  file
include_once('function.php');
// Object creation
$userdata=new DB_con();
if(isset($_POST['register']))
{
// Posted Values
$uname = $_POST['username'];
$email = $_POST['email'];
$pasword = $_POST['password'];
$conpassword = $_POST['conpassword'];
if($password == $conpassword){  
  echo "<script type='text/javascript'>alert('Passwords Did not Match');</script>";
}else{
$sql=$userdata->usernameavailblty($email);
$num=mysqli_num_rows($sql);
if($num > 0)
{
echo "<script type='text/javascript'>alert('E-mail is Already Taken');</script>";
} else{
//Function Calling
$sql=$userdata->registration($uname,$email,$pasword);
if($sql)
{
// Message for successfull insertion
echo "<script>alert('Registration successfull.');</script>";
}
else
{
// Message for unsuccessfull insertion
echo "<script>alert('Something went wrong. Please try again');</script>";
} } }
}
if(isset($_POST['login']))
{
// Posted Values
$uname=$_POST['loginname'];
$pasword=$_POST['loginpassword'];
//Function Calling
$ret=$userdata->signin($uname,$pasword);
$num=mysqli_fetch_array($ret);
if($num>0)
{
  $_SESSION['token'] = $num['token'];
  $_SESSION['id']=$num['id'];
  $_SESSION['name']=$num['name'];
  $_SESSION['email']=$num['email'];
// For success
echo "<script>window.location.href='index.php'</script>";
}
else
{
// Message for unsuccessfull login
echo "<script>alert('Your Username Or Password is Wrong. Please try again');</script>";
echo "<script>window.location.href='login.php'</script>";
}
}
?>
<html>
    <head>
        <title> Login Page</title>
       <link rel="stylesheet" type="text/css" href="login.css">
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous"> 
    </head>

    <body>
        <div class="loginpage" id="logpage">
            <div class="loginform" id="inputform">
                <div class="buttonbox">
                    <div id="button"></div>
                    <button type="button" class="togglebutton" onclick="signin()">Sign-In</button>
                    <button type="button" class="togglebutton" onclick="signup()">Sign-Up</button>
                </div>
                <form id="form_id" action="login.php" method="POST">
                        <table id="login" class="logininputgroup"> 
                    <tbody>   
                     <th> <img src="images/login.jpg" class="picture"> </th>
                        <tr>
                            <td>
                                <input type="text" class="inputfield" name="loginname" id="loginname" placeholder="Your Name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" class="inputfield" name="loginpassword" id="loginpassword" placeholder="Password" required>
                            </td>
                        </tr>
                   
                        <tr>
                      <td colspan="2"><input type="submit" class="loginbtn" name="login" value="Log-In"></td>
                    </tr>
                </tbody>
                </table>
              </form>
              <form id="form_id" action="login.php" method="POST">
                <table id="register" class="logininputgroup">
                    <tbody>
                      <th> <img src="images/register.jpg" class="picture"> </th>
                    <tr>
                      <td><input type="text" class="inputfield" name="username" id="first" placeholder="Firstname" required ></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="inputfield" name="email" id="email" placeholder="E-mail" required ></td>
                    </tr>
                    <tr>
                      <td><input type="password" class="inputfield" name="password" id="password" placeholder="Password" required></td>
                    </tr>
                    <tr>
                      <td><input type="password" class="inputfield" name="conpassword" id="confirm" placeholder="Confirm Password" required ></td>
                    </tr>
                    <tr>
                      <td colspan="2"><input type="submit" class="loginbtn" name="register" id="create"  value="Register"></td>
                    </tr>
                  </tbody></table>
                </form>
            </div>
        </div>
        <script src="login.js"></script> 
        <script src="jquery.js"></script>
    </body>
</html>

