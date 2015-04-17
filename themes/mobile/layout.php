<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="th" lang="th" dir="ltr">
<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="media/font-awesome-4.3.0/css/font-awesome.min.css">
	<style>
		ul {
			list-style: none;
			padding: 0;
			margin: 0
		}
		#accordion {
			/*box-shadow: 0px 4px 10px rgba(50,50,50,0.3);
			-moz-box-shadow: 0px 4px 10px rgba(50,50,50,0.3);
			-webkit-box-shadow: 0px 4px 10px rgba(50,50,50,0.3);
			background-color: #fff;*/
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
		}
		#items {
			padding: 0
		}
		#items>li>a {
			text-indent: 10px;
			/*width: 100%;*/
			margin: 0 auto;
			cursor: pointer;
			line-height: 50px;
			display: block;
			text-decoration: none;
			font-size: 14px;
			font-family: 'Oswald', sans-serif!important;
			font-weight: 400;
			border-top-width: 1px;
			border-bottom-width: 1px;
			border-top-style: solid;
			border-bottom-style: solid;
			border-top-color: #CCC;
			border-bottom-color: #999;
			color: #000!important;
		
		}
		
		#items>li>a>i{
			vertical-align: middle!important;
			padding-right: 15px;
			text-align: center!important;
			width:36px;
		
		}
		
		#items>li>a::after {
			font-weight: 400;
			margin-top: 2px;
			content: "\f106";
			font-family: "FontAwesome";
			position: absolute;
			right: 30px;
			content: "\f105"
		}
		#items>li>a:hover, #items>li>a.activated {
			color: #fff!important;
			font-weight: 400;
			background-color: #555555;
			transition: background-color 0.4s ease-in-out;
			-moz-transition: background-color 0.4s ease-in-out;
			-webkit-transition: background-color 0.4s ease-in-out;
			-o-transition: background-color 0.4s ease-in-out
		}
		#items>li>a.activated::after {
			/*content: "\f106"*/
		}
		.sub-items {
			display: none
		}
		.sub-items>li:first-child>a {
			margin-top: 8px;
			height: 34px;
		}
		.sub-items>li:last-child>a {
			margin-bottom: 12px;
			height: 34px;
		}
		.sub-items>li>a {
			margin: 0 auto;
			/*width: 212px;*/
			line-height: 39px;
			text-indent: 54px;
			height: 34px;
			position: relative;
			display: block;
			/*border-left: 2px solid rgba(57,198,233,0.3);*/
			font-size: 14px;
			font-family: 'Oswald', sans-serif!important;
			font-weight: 400!important;
			text-decoration: none;
			color: #000!important;
		}
		.sub-items>li>a.current {
			color: #000;
			position: relative;
			font-weight: 400!important;
			text-decoration: none;
		}
		.sub-items>li>a.current::before {
			content: "\f00c";
			font-family: "FontAwesome";
			/*background-color: #fff;*/
			position: absolute;
			color: #000!important;
			font-size: 0.656em;
			left: -29px;
			
		}
		.sub-items>li:hover>a {
			color: #000!important;
			transition: color 0.4s ease-in-out;
			-moz-transition: color 0.4s ease-in-out;
			-webkit-transition: color 0.4s ease-in-out;
			-o-transition: color 0.4s ease-in-out
		}
	</style>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <?php echo $template['metadata'] ?>
</head>
<body>

<div data-role="page" id="pageone">
  <div data-role="panel" id="myPanel">
    <div id="accordion">
	    <ul id="items">
	    	<li><a href="/m/news">News</a></li>
	    	<li><a href="">Music</a></li>
	    	<li><a href="">MV</a></li>
	    	<li><a href="">Series</a></li>
	    </ul>
    </div>
  </div> 

  <div data-role="header">
  	<a href="#myPanel" class="ui-btn ui-icon-grid ui-btn-icon-notext">Menu</a>
    <h1>KPOPLOVER</h1>
  </div>

  <div data-role="main" class="ui-content">
    <?php echo $template["body"] ?>
  </div>

  <div data-role="footer">
    <h1>Page Footer</h1>
  </div> 
</div> 

</body>
</html>