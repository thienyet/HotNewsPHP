<div style="float: right;">
<div class="txt_timer left" id="clockPC""><?php

    $date = getdate();
    $timestamp = time();

    echo $date['weekday'].", ";
    echo $date['mday']."/";
    echo $date['mon']."/";
    echo $date['year']." | ";
    echo (date("h:i", $timestamp));

?></div>  
<a href="#" class="txt_24h left">KPT</a>
<a href="#" class="img_rss left"><img src="http://st.f3.vnecdn.net/responsive/c/v52/images/graphics/img_rss_2.gif" alt=""></a>
<div class="block_search_web left">
    <form action="" method="get" target="_blank" id="search">
        <input name="q" value="" maxlength="80" class="txt_input" type="text">
        <input value="" class="icon_search_web" type="submit">
        <input name="p" type="hidden" value="timkiem"/>
    </form>
</div>
</div>

  
          