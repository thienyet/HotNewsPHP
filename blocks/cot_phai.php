<!-- box cat -->
<?php 
    $idLT = 1;
?>

<div class="box-cat">
    <div class="cat">
        <div class="main-cat">
            <a href="#"><?php echo TenLoaiTin($idLT) ?></a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
            <?php  
                $mottin = TinMoiNhat_TheoLoaiTin_MotTin($idLT);
                $row_mottin = mysqli_fetch_array($mottin);
            ?>
            <div class="col1">
                <div class="news">
                <h4 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo  $row_mottin['idTin'] ?>"> <?php echo $row_mottin['TieuDe'] ?> </a></h4>
                  <img class="images_news" src="<?php echo $row_mottin['urlHinh'] ?>" align="left" />
                    <div class="des"><?php  echo $row_mottin['TomTat']?> </div>
                  
                  
                    <!-- <div class="clear"></div> -->
                   
                </div>
            </div>
            <div class="col2" style="margin-top: 10px;">
                <?php  
                    $tinmoi_bontin = TinMoiNhat_TheoLoaiTin_BonTin($idLT);
                    while($row_tinmoi_bontin = mysqli_fetch_array($tinmoi_bontin)) {
                ?>
                <p class="tlq"><a href="index.php?p=chitiettin&idTin=<?php echo  $row_tinmoi_bontin['idTin'] ?>"><?php echo $row_tinmoi_bontin['TieuDe'] ?></a>
                </p>

                <?php 
                    }
                 ?>
            </div> 
           
        </div>
    
    </div>

</div>
<div class="clear"></div>
<!-- //box cat -->


<div class="box-cat" style="height: 400px;">
    <div class="cat">
        <div class="main-cat">
            <a href="#">Covid</a>
            <?php require "get_covid.php" ?>
        </div>
    </div>
</div>

<div class="box-cat" style="min-height: 280px">
    <div class="cat">
        <div class="main-cat">
            <a href="#">Thời tiết</a>
            <?php require "get_thoitiet.php" ?>
        </div>
    </div>
</div>



