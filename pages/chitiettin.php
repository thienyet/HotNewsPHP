<?php  
    ob_start();
    // session_start();
?>

<?php  

    if(isset($_GET["idTin"])) {
        $idTin = $_GET["idTin"];
        settype($idTin, "int");
    } else {
        $idTin = 1;
    }
    CapNhatSoLanXemTin($idTin);
?>

<?php

  $tin = ChiTietTin($idTin);
  $row_tin = mysqli_fetch_array($tin);
?>

<?php  
    $comment = DanhSachBinhLuan($idTin);

    if(isset($_POST["btn_cmt"])) {
        $HoTen = $_SESSION["HoTen"];
        $Email = $_SESSION["user_email_address"];
        $NoiDung= $_POST["comment_text"];

        $conn = myConnect();
        echo $qr = "insert into comment values(null, '$HoTen', '$Email', '$NoiDung', '$idTin')  ";
        mysqli_query($conn, $qr);
        header("location:chitiettin.php");
    }
?>

<h3 class="title"><?php echo  $row_tin['TieuDe']?></h3>
<div class="des">
<?php echo  $row_tin['TomTat']?>
</div>
<div class="chitiet">
<!--noi dung-->
    <?php echo  $row_tin['Content']?>
<!--//noi dung-->
</div>
<div class="clear"></div>
<a class="btn_quantam" id="vne-like-anchor-1000000-3023795" href="#" total-like="21"></a>
<div class="number_count"><span id="like-total-1000000-3023795"><?php echo  $row_tin['SoLanXem']?></span></div>


<div class="clear"></div>
<div id="tincungloai">
<div class="clear"></div>
	<ul>
    	<?php  
            $tincungloai = TinCungLoaiTin($idTin, $row_tin['idLT']);
            while($row_tincungloai = mysqli_fetch_array($tincungloai)) {
        ?>
        <li>       
             <a href="index.php?p=chitiettin&idTin=<?php echo $row_tincungloai['idTin'] ?>"><img src="<?php echo $row_tincungloai['urlHinh'] ?>" alt="<?php echo $row_tincungloai['TieuDe'] ?>" style="height: 100px;"></a> <br />
 			 <a class="title" href="index.php?p=chitiettin&idTin=<?php echo $row_tincungloai['idTin'] ?>"><?php echo $row_tincungloai['TieuDe'] ?></a>
             <span class="no_wrap">   
        </li>
        <?php } ?>
    </ul>
</div>
<div class="clear"></div> 
<hr/>




<div style="float: left;">
<?php  
    if(isset($_SESSION["HoTen"])) {
?>
    <!-- comment form -->
    <form class="clearfix" action="index.php" method="POST" id="comment_form">
        <h4>Post a comment:</h4>
        <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
        <input type="submit" name="btn_cmt" value="Bình luận">
    </form>
<?php } else { ?>
        <h4>Đăng nhập để bình luận</h4>

<?php  }?>

    <!-- Display total number of comments on this post  -->
    <h4><span id="comments_count">0</span> Comment(s)</h4>
    <hr>
    <!-- comments wrapper -->
    <div id="comments-wrapper">
        <div class="comment clearfix">
            <?php while($row_comment = mysqli_fetch_array($comment)) { ?>
                <img src="../upload/user.png" alt="" class="profile_pic">
                <div class="comment-details">
                    <span class="comment-name"><?php echo $row_comment['hoten'] ?></span>
                    <span class="comment-date"><?php echo date("Y/m/d") ?></span>
                    <p><?php echo $row_comment['noidung'] ?></p>
                    <a class="reply-btn" href="#" >reply</a>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- // comments wrapper -->
</div>



