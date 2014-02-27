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
        
      <?php echo $template["body"] ?>
      
    <br clear="all">
    <? include "_footer.php";?>
    </div> <!-- /container -->
</body>
</html>