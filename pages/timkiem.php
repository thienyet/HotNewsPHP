<?php
    $tukhoa = $_GET['q'];

    $tin = TimKiem($tukhoa);
?>
<h5 style="margin: 0;"><?php echo $tongsotin = mysqli_num_rows($tin); ?> kết quả tìm được</h5>
<?php
    
    while($row_tin = mysqli_fetch_array($tin)) {

?>

<div class="box-cat">
    <div class="cat1">
        
        <div class="clear"></div>
        <div class="cat-content">

            <div class="col0 col1">
                <div class="news">
                    <h4 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_tin['idTin'] ?>"><?php echo $row_tin['TieuDe'] ?></a></h4>
                    <img class="images_news" src="<?php echo $row_tin['urlHinh'] ?>" align="left" />
                    <div class="des"><?php echo $row_tin['TomTat'] ?></div>
                    <div class="clear"></div>
                   
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php  
    }
?>
