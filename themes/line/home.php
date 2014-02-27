<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="th" lang="th" dir="ltr">
<head>
    <base href="<?php echo base_url(); ?>" />
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content='line2me' name='author'/>
    <meta content='line2me' name='copyright'/>
    <meta content='line2me' name='Organization-Name'/>
    <meta content='TH' name='Organization-Country-Code'/>
    <meta content='Thailand' name='Country'/>
    <meta property="fb:app_id" content="478882442186992">
    <meta property="fb:admins" content="100000675258786">
    <link rel="shortcut icon" href="<?=base_url()?>/favicon.ico">
    <link rel="canonical" href="http://www.line2me.in.th<?=@$_SERVER['PATH_INFO']?>" />
    <title><?php echo $template['title'] ?></title>
    <? include "_css.php";?>
    <? include "_script.php";?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="media/bootstrap-3.0.0/assets/js/html5shiv.js"></script>
      <script src="media/bootstrap-3.0.0/assets/js/respond.min.js"></script>
    <![endif]-->
    <?php echo $template['metadata'] ?>
</head>
<body>
    <? include "_header.php";?>
    <div class="container">
        
        <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-12">
          <div class="jumbotron">
            <h1>ยินดีต้อนรับ...</h1>
            <p>หาเพื่อนคุย หาแฟน หากิ๊ก หาคู่ มาแลกไอดีกันจ้า</p>
            <?php if(is_login()):?>
            	<a class="btn btn-primary" href="users/profile">
	            <?php if(user_login()->image != ""):?>
	               <?=thumb('uploads/user/'.avatar(user_login()->id),20,20,1,"")?>
	            <?php endif;?>
	            <?php echo user_login()->email ?>
	            </a> 
	            <a class="btn btn-success" href="users/up_profile"><i class="fa fa-angle-double-up"></i></a>
            <?php else:?>
            	<a class="btn btn-primary" href="users/register">สมัครสมาชิก</a> <a class="btn btn-primary" href="users/login_frm">เข้าสู่ระบบ</a>
            <?php endif;?>
          </div>
          <div class="row">
            <div class="col-6 col-sm-8 col-lg-8">
                <?php echo modules::run('friends/inc_home'); ?>
            </div>
            <div class="col-6 col-sm-4 col-lg-4">
                <?php echo modules::run('stickers/inc_home'); ?><br>
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/LINE-Thailand-Fanclub/619024168129948?ref=hl" data-width="100%" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
            </div>
          </div><!--/row-->
        </div><!--/span-->

        
      </div><!--/row-->
    <br clear="all">
    <? include "_footer.php";?>
    </div> <!-- /container -->
</body>
</html>