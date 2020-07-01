<?php
    function getDataFromAPI($nameCity){
        $urlApi = "http://api.openweathermap.org/data/2.5/forecast?q={$nameCity}&appid=073f342f34bacc8898356a523fa5b4f8&units=metric&lang=vi";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = ($res !== null || $res !== '') ? json_decode($res, true) : [];
        return $data;
    }

    $nameCity = $_POST['txtCity'] ?? '';
    $nameCity = strip_tags($nameCity);
    $data = getDataFromAPI($nameCity);
    $listWeather = isset($data['list']) ? $data['list'] : [];
?>

<div>
    
    <form action="" method="post" style="margin-top: 5px; padding: 0; font-size: 12px;">
        <input type="text" name="txtCity" id="txtCity" class="form-control" placeholder="Nhập tên thành phố" style="width: 150px; margin-bottom: 5px;">
        <input type="submit" value="Tìm kiếm" name="submit" align="center" style="margin-left: 42px;" />
    </form>


    <?php if(isset($_POST['submit'])) {?>
    <?php if($listWeather): ?>
    <h4><?php echo $nameCity; ?></h4>
    <div class="weatherData" style="border-bottom: 1px solid #ccc; margin: 8px 0px; width: 100%;">
        <p>Thời gian: <?php echo substr($listWeather[2]['dt_txt'], 0, 10); ?></p>
        <p>Nhiệt độ: <?php echo $listWeather[2]['main']['temp']; ?>°C</p>
        <p>Độ ẩm: <?php echo $listWeather[2]['main']['humidity']; ?>%</p>
        <p>Mực nước biển: <?php echo $listWeather[2]['main']['sea_level']; ?> m</p>
        <p>Trạng thái: <?php echo $listWeather[2]['weather'][0]['description']; ?></p>
        <p><img src="http://openweathermap.org/img/w/<?php echo $listWeather[2]['weather'][0]['icon']; ?>.png" alt=""></p>
        <p>Sức gió: <?php echo $listWeather[2]['wind']['speed']; ?> m/h</p>
    </div>
    <div class="weatherData" style="border-bottom: 1px solid #ccc; margin: 8px 0px; width: 100%;">
        <p>Thời gian: <?php echo substr($listWeather[7]['dt_txt'], 0, 10); ?></p>
        <p>Nhiệt độ: <?php echo $listWeather[7]['main']['temp']; ?>°C</p>
        <p>Độ ẩm: <?php echo $listWeather[7]['main']['humidity']; ?>%</p>
        <p>Mực nước biển: <?php echo $listWeather[7]['main']['sea_level']; ?> m</p>
        <p>Trạng thái: <?php echo $listWeather[7]['weather'][0]['description']; ?></p>
        <p><img src="http://openweathermap.org/img/w/<?php echo $listWeather[7]['weather'][0]['icon']; ?>.png" alt=""></p>
        <p>Sức gió: <?php echo $listWeather[7]['wind']['speed']; ?> m/h</p>
    </div>
    <?php else: ?>
    <h4 style="text-align: center;">Không có kết quả</h4>
<?php endif; ?>
<?php } ?>
    
</div>


