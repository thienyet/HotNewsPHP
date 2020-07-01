<?php

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://coronavirus-19-api.herokuapp.com/countries');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $res = curl_exec($ch);
    curl_close($ch);
    $data = ($res !== null || $res !== '') ? json_decode($res, true) : [];
    // print_r($data);
?>


<div>
    <div>
        <h4> Thế giới</h4>
        <p>Số ca nhiễm: <?php echo $data[0]['cases'] ?></p>
        <p>Số ca tử vong: <?php echo $data[0]['deaths'] ?></p>
        <p>Số ca hồi phục: <?php echo $data[0]['recovered'] ?></p>
    </div>
    <div>
        <h4> <?php echo $data[1]['country'] ?></h4>
        <p>Số ca nhiễm: <?php echo $data[1]['cases'] ?></p>
        <p>Số ca tử vong: <?php echo $data[1]['deaths'] ?></p>
        <p>Số ca hồi phục: <?php echo $data[1]['recovered'] ?></p>
    </div>
    <div>
        <h4> <?php echo $data[155]['country'] ?></h4>
        <p>Số ca nhiễm: <?php echo $data[155]['cases'] ?></p>
        <p>Số ca tử vong: <?php echo $data[155]['deaths'] ?></p>
        <p>Số ca hồi phục: <?php echo $data[155]['recovered'] ?></p>
    </div>
</div>