<?php
session_start();
include("function.php");
$userdata=new DB_con();
        $connect = mysqli_connect("localhost", "root", "E45pg876123", "characters");
		if(isset($_POST["StartGame"]))
		{
			$query = "SELECT name,race,id FROM tbl_characters WHERE name = '".$_POST["CharacterName"]."' AND race = '".$_POST["RaceName"]."' AND user_id = ".$_SESSION['id']." ";
			$results = mysqli_query($connect, $query);
			if(mysqli_num_rows($results) == 0){
				$query = "INSERT INTO tbl_characters ( user_id,name, race, qualification, experience) VALUES(".$_SESSION['id'].", '".$_POST['CharacterName']."', '".$_POST['RaceName']."', '".$_POST['hidden_qualification']."',0)";
                $results = mysqli_query($connect, $query);
                $query2= "UPDATE tbl_users SET token= token - 30 WHERE id = ".$_SESSION['id']."";
                mysqli_query($connect, $query2);
                $userdata->SearchTable($_SESSION['id']);
                $_SESSION['CharacterName'] = $_POST['CharacterName'];
                $_SESSION['Qualification'] = $_POST['hidden_qualification'];
                $_SESSION['RaceName'] = $_POST['RaceName'];
                header('location:game.php');
            }
            else{
                echo "<script type='text/javascript'>alert('This Character Already Exist');</script>";
            }
        }
        if(isset($_POST["Random"])){
			$randomValue = rand(1, 7);
			$query = "SELECT * FROM tbl_characters WHERE id = $randomValue ";
            $results = mysqli_query($connect, $query);
            if(mysqli_num_rows($results) > 0)
			{
				while($row = mysqli_fetch_array($results))
				{
                    $_SESSION['CharacterName'] = $row['name'];
                    $_SESSION['Qualification'] = $row['qualification'];
                    $_SESSION['RaceName'] = $row['race'];
                    header('location:game.php');
                }
            }	
        }
        if(isset($_POST["GoCharacter"])){
            $query = "SELECT name,race,id FROM tbl_characters WHERE name = '".$_POST["CharacterName"]."' AND race = '".$_POST["RaceName"]."' AND qualification ='".$_POST["QualificationName"]."' AND user_id = ".$_SESSION['id']."";
            $results = mysqli_query($connect, $query);
            if(mysqli_num_rows($results) > 0)
			{
				while($row = mysqli_fetch_array($results))
				{
                    $_SESSION['CharacterName'] = $_POST['CharacterName'];
                    $_SESSION['Qualification'] = $_POST['QualificationName'];
                    $_SESSION['RaceName'] = $_POST['RaceName'];
                    header('location:game2.php');
                }
            }else{
                echo "<script type='text/javascript'>alert('This Character is Not Exist');</script>";
            }
        }
                ?>		
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Index Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/inputgroup.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header-top">
            <div class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end header inner -->

            <!-- end header -->
            <section class="slider_section">
                <div class="banner_main">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2 padding_left0">
                                <div class="menu-area">
                                <div class="limit-box">
                                    <nav class="main-menu">
                                        <ul class="menu-area-main">
                                            <li class="active"> <a href="#game">Game</a> </li>
                                            <li> <a href="#testimonial">Rock-Paper-Scissors</a> </li>
                                            <li> <a href="#contact">Contact</a> </li>
                                            <li>
                                            <div class="btn-group dropright">
                                            <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:70%">
                                            <?php echo $_SESSION['name']?>
                                            </button>
                                            <div class="dropdown-menu">
                                                    <button class="dropdown-item" type="button" onclick="window.location.href='logout.php'" >Logout</button>
                                                    <button class="dropdown-item" type="button" onclick="window.location.href='userinformation.php'">User Informations</button>
                                            </div>
                                            </div>
                                            </li>
                                           
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 " style="margin-left: 45%;">
                                <div class="text-bg">
                                    <h1>amazing<br> 3d game</h1>
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br> tempor incididunt ut</span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
        
           </section>
        </div>
    </header>

    <!-- our -->
    
    <div id="games" class="our">
        <div class="container">
            <div class="row">
            <div class="login-box">
                <h2>Your Character</h2>
                <form method="post" action="index.php">
                <div class="user-box">
                    <input type="text" name="CharacterName" required="">
                    <label>Character Name</label>
                    </div>
                    <div class="user-box">
                    <input type="text" name="QualificationName" required="">
                    <label>Character Qualification</label>
                    </div>
                    <div class="user-box">
                    <input type="text" name="RaceName" required="">
                    <label>Character Race</label>
                    </div>
                <button type="submit" name="GoCharacter" class="btn btn-primary"> Go To Game
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </form>
            </div>
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Games</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
            $query = "SELECT * FROM tbl_characternames";
							$result = mysqli_query($connect,$query);
							$count = mysqli_num_rows($result);
							if($count > 0){
								while($row = mysqli_fetch_array($result))
								{
							?>
                <div class="col-md-12 margin_bottom">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="two-box">
                                <figure><img src="images/<?php echo $row['image'] ?>" alt="#" style="width: 103%;"/></figure>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="Games">
								<form method="post" action="index.php">
								<h3><?php echo $row['name'] ?></h3>
								<input type="hidden" name="hidden_qualification" value="<?php echo $row['name'] ?>" />
                                <p> <?php echo $row['definition'] ?> </p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                                    </div>
                                    <input type="text" name="CharacterName" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-default">Race</span>
                                    </div>
                                    <input type="text" name="RaceName" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                  </div>
									<input type="submit" name="StartGame"  class="btn btn-dark" value="Start !!"></input>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                }
                }
                ?>
                    <div class="col-md-12 margin_bottom">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="two-box">
                                <figure><img src="images/randomimage.jpg" alt="#" style="width: 103%;"/></figure>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="Games">
								<h3>Create Random Character</h3>
                                <p> Lorem İpsum Sit Amet </p>
                                <form method="POST" action="index.php">
                                <button type="submit" name="Random" class="btn btn-primary">Create Random Character</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
   
    <!-- end our -->
   

    <!-- testimonial -->
    <div id="testimonial" class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Rock-Paper-Scissors</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12>
                    <div class="row box">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                            <div class="testimonial_box">
                                <figure><img src="images/rpsgame.jpg" alt="#" /></figure>
                            </div>
                        </div>
                    </div>
                    <div class="clients_box">
                    <h3>Gain Tokens</h3>
                        <p>Win Against Computer
                            <br>Gain Tokens!!
                            <br>Be Carefull Do not Lose Your Tokens</p>  
                            <form method="POST" action="RPSGame.php">
                            <button class="submit">Play</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- end testimonial -->
    <!--  footer -->
    <footr>
        <div class="footer ">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 ">
                                <div class="address">
                                    <ul class="social_link">
                                        <li><a href="#"><img src="icon/fb.png"></a></li>
                                        <li><a href="#"><img src="icon/tw.png"></a></li>
                                        <li><a href="#"><img src="icon/lin(2).png"></a></li>
                                         <li><a href="#"><img src="icon/instagram.png"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="address">
                                    <h3>Quick links</h3>
                                    <ul class="Menu_footer">
                                        <li class="active"> <img src="images/3.png" alt="#"> <a href="#">MainPage</a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#">About</a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#testimonial"> Rock-Paper-Scissors Game</a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#contact">Contact</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="address">
                                    <h3>downloded</h3>
                                    <ul class="Links_footer">
                                        <li class="active"><img src="images/3.png" alt="#"> <a href="#">Lorem Ipsum </a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#">Simply random</a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#">Roots in a</a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#"> Piece</a> </li>
                                        <li><img src="images/3.png" alt="#"> <a href="#">Classical</a> </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 ">
                                <div class="address">
                                    <h3>Contact us </h3>
                                    <ul class="loca">
                                        <li>
                                            <a href="#"><img src="icon/loc.png" alt="#" /></a>Istanbul
                                            <br>Kagithane </li>
                                        <li>
                                            <a href="#"><img src="icon/email.png" alt="#" /></a>olcayik20@hotmail.com </li>
                                        <li>
                                            <a href="#"><img src="icon/call.png" alt="#" /></a>05532821614 </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="copyright">
                <div class="container">
                    <p>© 2020 All Rights Reserved.Olcay IŞIK</p>
                </div>
            </div>
        </div>
    </footr>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>

</html>