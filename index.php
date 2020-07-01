<?php 

    session_start();

    require "lib/dbConn.php";
    require "lib/trangchu.php";
    include('config.php');

    if(isset($_GET["p"]))
        $p = $_GET["p"];
    else 
        $p = "";
 ?>

<?php  
    //account login
    if(isset($_POST["btn_submit"])) {
        $un = $_POST["username"];
        $pw = $_POST["password"];
        $pw = md5($pw);
        $conn = myConnect();
        $qr = "Select * from Users
                where Username = '$un'
                and Password = '$pw'";

        $user = mysqli_query($conn, $qr);
        if(mysqli_num_rows($user) == 1) {
            //dang nhap dung
            $row = mysqli_fetch_array($user);
            $_SESSION["idUser"] = $row['idUser'];
            $_SESSION["Username"] = $row['Username'];
            $_SESSION["HoTen"] = $row['HoTen'];
            $_SESSION["idGroup"] = $row['idGroup'];
            $_SESSION["user_email_address"] = $row['Email'];
        }
    }

    //google login

    $login_button = '';


    if(isset($_GET["code"])) {

        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        if(!isset($token['error'])) {

            $google_client->setAccessToken($token['access_token']);
            $_SESSION['access_token'] = $token['access_token'];
            $google_service = new Google_Service_Oauth2($google_client);

            $data = $google_service->userinfo->get();

            if(!empty($data['given_name'])) {
                $_SESSION['user_first_name'] = $data['given_name'];
            }

            if(!empty($data['family_name'])) {
                $_SESSION['user_last_name'] = $data['family_name'];
            }

            if(!empty($data['email'])) {
                $_SESSION['user_email_address'] = $data['email'];
            }

            if(!empty($data['gender'])) {
                $_SESSION['user_gender'] = $data['gender'];
            }

            if(!empty($data['picture'])) {
                $_SESSION['user_image'] = $data['picture'];
            }

            $_SESSION['HoTen'] = $_SESSION['user_first_name'].' '.$_SESSION['user_last_name'];

            $conn = myConnect();

            $sql = "SELECT * FROM users WHERE email='".$_SESSION['user_email_address']."'";
            $result = mysqli_query($conn, $sql);


            if(empty($result->fetch_assoc())){
                $sql2 = "INSERT INTO users (HoTen, Email, idGroup, Active) VALUES ('".$_SESSION['HoTen']."', '".$_SESSION['user_email_address']."', '0', '1')"; 
            } else {
                $sql2 = "INSERT INTO users (HoTen, Email, idGroup, Active) VALUES ('".$_SESSION['HoTen']."', '".$_SESSION['user_email_address']."', '0', '1')";
            }
            mysqli_query($conn, $sql2);
            
        }
    }

    if(!isset($_SESSION['access_token'])){
     //Create a URL to obtain user authorization
     $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="images/google.png" style="width:200px; height:auto;"/></a>';
    }


?>

<?php  
//thoát
    if(isset($_POST["btn_thoat"])) {
        if(isset($_SESSION["HoTen"])) {
            unset($_SESSION["idUser"]);
            unset($_SESSION["Username"]);
            unset($_SESSION["HoTen"]);
            unset($_SESSION["idGroup"]);
        } else if(isset($_SESSION['user_first_name'])) {
            $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="images/google.png" style="width:200px; height:auto;"/></a>';
            unset($_SESSION['access_token']);
            unset($_SESSION['user_first_name']);
            unset($_SESSION['user_last_name']);
            unset($_SESSION['user_email_address']);
            unset($_SESSION['user_gender']);
            unset($_SESSION['user_image']);
            $google_client->revokeToken();
            session_destroy();
        }
        
    }
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hot News</title>
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      table {
         margin-left: 30%;
      }
      table tr td{
        padding: 10px;
      }
  </style>
</head>

<body>
<div id="wrap-vp">
    <div id="header-vp">
        <div id="logo"><img src="images/logo.gif" /></div>

        <div style="float: right;">
            <?php  
                if(isset($_SESSION['idUser']) || isset($_SESSION['user_first_name']))  
                {  
                    require "blocks/formHello.php";}
                else  
                {  
                ?>  
                <div align="center">  
                     <button type="button" name="login" id="login" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button>  
                </div>  
                <?php  
                }  
                ?> 
        </div>
    </div>
    
    <div>
        <!--block/menu.php-->
        <?php require "blocks/menu.php" ?>
    </div>
      <div id="midheader-vp">
        <div id="left">
            <ul class="list_arrow_breakumb">
                <li class="start">
                <a href="javascript:;">Trang nhất</a>
                <span class="arrow_breakumb">&nbsp;</span></li>
           </ul>
        </div>
        <div id="right">
            <!--blocks/thongtinchung.php-->
            <?php require "blocks/thongtinchung.php" ?>
        </div>
    </div>
    <div class="clear"></div>

    <div id="slide-vp">
        <!--blocks/top_trang_chu.php-->
        <?php require "blocks/top_trang_chu.php" ?>

        <div id="slide-right">
        <!--blocks/quangcao_top_phai.php-->
        <?php require "blocks/quangcao_top_phai.php" ?>
        </div>
    </div>

    <div id="content-vp">
        <div id="content-left">
        <!--blocks/cot_trai.php-->
        <?php require "blocks/cot_trai.php" ?>
        </div>
        <div id="content-main">
            
            <!--PAGES-->
            <?php 
                switch ($p) {
                    case 'tintrongloai':
                        require 'pages/tintrongloai.php';
                        break;

                    case 'chitiettin':
                        require 'pages/chitiettin.php';
                        break;

                    case 'timkiem':
                        require 'pages/timkiem.php';
                        break;
                    
                    default:
                        require 'pages/trangchu.php';
                        break;
                }
             ?>
            
        </div>
        <div id="content-right">
        <!--blocks/cot_phai.php-->

        <?php require "blocks/cot_phai.php" ?>
        </div>

    <div class="clear"></div>
        
    </div>
    
     <div id="thongtin">
        <!--blocks/thongtindoanhnghiep.php-->
        <?php require "blocks/thongtindoanhnghiep.php" ?>
    </div>
    <div class="clear"></div>
    <div id="footer">
        <!--blocks/footer.php-->
        <?php require "blocks/footer.php" ?>

        <div id="footer_bottom">
            © Copyright VnExpress.net,  All rights reserved<br />
            ® VnExpress giữ bản quyền nội dung trên website này.
        </div>
    
    </div>
    
</div>

</body>
</html>
<div id="loginModal" class="modal fade" role="dialog"> 
      <div class="modal-dialog">  
   <!-- Modal content-->  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title" align="center">Đăng nhập để trải nghiệm nhiều hơn</h4>  
                </div>  
                <form method="POST" action="">
                    <h4 class="login100-form-title p-b-53" align="center">
                        Đăng nhập với
                    </h4>
                    <?php
                    if($login_button != ''){
                        echo '<div align="center">'.$login_button . '</div>';
                    }
                    ?>
                    
                </a>
                <br />
                    <fieldset>
                        <table>
                            <tr>
                                <td>Username</td>
                                <td><input type="text" name="username" maxlength="80"></td>
                            </tr>
                            <hr />
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="password" maxlength="80"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"> <input type="submit" name="btn_submit" value="Đăng nhập"></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
           </div>  
      </div>  
 </div>  

