<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#">Tin xem nhiều</a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        	
            <?php  
                $tinxemnhieunhat = TinXemNhieuNhat();
                while ($row_tinxemnhieunhat = mysqli_fetch_array($tinxemnhieunhat)) {  
            ?>

            <div class="col1">
            	<div class="news">
                  <img class="images_news" src="<?php echo $row_tinxemnhieunhat['urlHinh'] ?>"  />
                    <h3 style="font-size: 12px;" class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo  $row_tinxemnhieunhat['idTin'] ?>"><?php  echo $row_tinxemnhieunhat['TieuDe']?></a></h3>
                    <span class="hit"><?php  echo $row_tinxemnhieunhat['SoLanXem']?></span>
                    <div class="clear"></div>
				</div>
            </div>

            <?php  
                }
            ?>
                    
        </div>
    </div>
</div>
<div class="clear"></div>

