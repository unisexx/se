<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="th" lang="th" dir="ltr">
<head>
	<base href="<?php echo base_url(); ?>" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content='kpoplover' name='author'/>
	<meta content='kpoplover' name='copyright'/>
	<meta content='kpoplover' name='Organization-Name'/>
	<meta content='TH' name='Organization-Country-Code'/>
	<meta content='Thailand' name='Country'/>
	<meta property="fb:app_id" content="136698876474938">
	<meta property="fb:admins" content="100000675258786">
	<link rel="shortcut icon" href="<?=base_url()?>/favicon.ico">
	<link rel="canonical" href="http://www.kpoplover.com<?=@$_SERVER['PATH_INFO']?>" />
	<title><?php echo $template['title'] ?></title>
	<? include "_css.php";?>
	<?php echo $template['metadata'] ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
	<? include "_header.php";?>
    <div class="container">
            <div class="col-sm-8">
                <?php echo $template["body"] ?>
                <?php // echo modules::run('banners/inc_home_footer');?>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <?include "_sidebar.php";?>
            </div>
    </div>
    <? include "_footer.php";?>
    <? include "_script.php";?>
</body>
</html>