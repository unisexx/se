<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <base href="<?php echo base_url(); ?>" />
    <title>บริการรับฝากซื้อสติ๊กเกอร์ไลน์แบบส่ง Gift ราคาถูกโดย LINE Thailand Fanclub</title>
    <meta name="description" content="อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆ พร้อมกับโปรโมชั่นราคาพิเศษ เพื่อเอาใจคนเล่นไลน์โดยเฉพาะ ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% การันตีโดยกลุ่มลูกค้าในเฟสบุคกว่าพันคน">
    <meta name="keywords" content="LINE,Sticker,สติ๊กเกอร์,ไลน์,Gift,ขายสติ๊กเกอร์ไลน์,ฝากซื้อสติ๊กเกอร์ไลน์">
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <meta content='index,follow,archive,imageindex,imageclick' name='robots'/>
    <meta content='index,follow,archive' name='googlebot'/>
    <meta content='kpoplover' name='author'/>
    <meta content='kpoplover' name='copyright'/>
    <meta content='kpoplover' name='Organization-Name'/>
    <meta content='TH' name='Organization-Country-Code'/>
    <meta content='Thailand' name='Country'/>
    <meta property="fb:app_id" content="478882442186992">
    <meta property="fb:admins" content="100000675258786">
    <link rel="shortcut icon" href="<?=base_url()?>/favicon.ico">
    <link rel="canonical" href="http://www.kpoplover.com<?=@$_SERVER['PATH_INFO']?>" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="media/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="media/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/th_TH/all.js#xfbml=1&appId=478882442186992";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <?php echo @$template['metadata'] ?>
</head>
<body>
<style>
#letter-index{
    position:fixed;
    top:10px;
    right:5px;
    width: 320px;
}
.letter{font-size:60px; text-align:center; background:#2e8bcc; color: #fff; width:100px; height:65px; padding-top:65px; padding-bottom:30px; display: inline-block; margin-bottom:2px;}
table td{font-size:50px;padding: 25px 8px !important; line-height:50px !important;}
</style>
<div class="container">
    <div class="span12">
        <div id="letter-index">
        <?php foreach (range('a', 'z') as $char):?>
            <a class="letter" href="sticker/list#<?php echo substr(ucwords(strtolower($char)),0,1)?>"><?php echo $char?></a>
        <?php endforeach;?>
        </div>
    
        <table class="table">
            <?php foreach($stickers as $sticker):?>
                <tr>
                    <td><a id="<?php echo substr(ucfirst($sticker->title),0,1)?>" href="line://shop/detail/<?php echo $sticker->sticker_code?>" alt="<?php echo $sticker->title?>"><?php echo $sticker->title?></a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</div>
</body>
</html>