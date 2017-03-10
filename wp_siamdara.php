<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
?>

#!/usr/local/bin/php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<form method="get" action="">
<input type="text" name="url" value="<?=@$_GET['url']?>" id="url" style="width: 300px;"/>	
<input type="submit" />
</form>

<?php
// adodb
include('media/simpledom/simple_html_dom.php');
include('adodb/adodb.inc.php');
include('autopost/config.php');
$db = ADONewConnection($_config['dbdriver']);
$db->Connect($_config['server'],$_config['username'],$_config['password'],$_config['database']);
$db->Execute('SET character_set_results=utf8');
$db->Execute('SET collation_connection=utf8_unicode_ci');
$db->Execute('SET NAMES utf8');
// $db->debug =true;

// wordpress function
defined('WP_USE_THEMES') || define('WP_USE_THEMES', false);
require_once('wp-load.php');
global $wpdb;

//--------------------------------  End include -------------------------------- 

if(@$_GET){

	$link = @$_GET['url'];
	$html = file_get_html($link);
	
	$data['title'] = trim($html->find('h1',0)->plaintext);
	$data['slug'] = clean_url555($data['title']);
	
	$check = $db->GetOne('select post_name from wp_posts where post_name = ?',$data['slug']);
	if(!$check)
	{
	    $detail = '';
		$detail .= '<p>'.$html->find('.news-content figure img',0).'<p>';
		// Find all <p>
		foreach($html->find('.news-content > p') as $element){
		       $detail .= $element ;
		}
		$detail .= "<p>_______________<br>Source : <a href='".$_GET['url']."' target='_blank'>siamdara</a></p>";
		$data['detail'] = $detail;
		
		$post = array(
		    'post_title' => $data['title'],
		    'post_name' => $data['slug'],
		    'post_content' => $data['detail'],
		    'post_date' => date("Y-m-d H:i:s"),
		    'post_date_gmt' => date("Y-m-d H:i:s"),
		    'post_status' => 'publish',
		    'post_author' => 5,
		    'post_category' => array(2)
		);
		wp_insert_post( $post );
		
		print "<br> $link insert";
		unset($html);
		unset($data);
	}else{
		print "มีข่าวนี้แล้ว";
	}
	
}


/*---------------------------------------function-----------------------------------------------*/

function clean_url555($text)
{	
	setlocale(LC_ALL,"Thai");
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	$text = @ereg_replace('(--)+', '', $text);
	$text = @ereg_replace('(-)$', '', $text);
	return $text;
} 
?>