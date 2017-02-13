<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
?>

#!/usr/local/bin/php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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


$links = get_link123();
// echo "<pre>";
// print_r($links);
// echo "</pre>";


if($links)
{
		$newarray = implode(", ", $links);
	
		$mvs_from_db = $db->Execute('SELECT post_content from wp_posts where post_content in ('.$newarray.',"http://www.youtube.com/watch?v=aSOoT5pQiWk")');
		foreach($mvs_from_db as $row){
			$arrFromDB[] = $row[0];
		}
		
		$result = array_diff(str_replace('"', '', $links), $arrFromDB);
	
		if(!empty($result)){
			foreach ($result as $key => $url){
				$data['youtubeid'] = getYouTubeIdFromURL($url);
				$html = file_get_html($url);
	
				$data['title'] = trim($html->find('#eow-title',0)->plaintext);
				$data['url'] = "http://www.youtube.com/watch?v=".$data['youtubeid'];
		        $data['slug'] = clean_url555($data['title']);
		        // $data['video_script'] = $data['url'];
		        // $data['detail'] = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$data['youtubeid'].'" frameborder="0" allowfullscreen></iframe>';
		        // $data['created'] = time();
		        // $data['status'] = 'approve';
		        // $data['chanel'] = 'loen';
				
				### Wordpress Insert ###
		        $post = array(
				    'post_title' => $data['title'],
				    'post_name' => $data['slug'],
				    'post_content' => $data['url'],
				    'post_date' => date("Y-m-d H:i:s"),
				    'post_date_gmt' => date("Y-m-d H:i:s"),
				    'post_status' => 'publish',
				    'post_author' => 3,
				    'post_category' => array(385)
				);
				wp_insert_post( $post );
				print "<br>".++$key." $url insert";
		        unset($html);
		        unset($data);
			}
    }
	else
	{
	    print('<br>no data updated');
	}
}



/*---------------------------------------function-----------------------------------------------*/

// function my_callback($element) {
        // if ($element->class=='like_box')
                // $element->outertext = '';
    // } 

function get_link123()
{
    global $db;
    $html = file_get_html('https://www.youtube.com/user/LOENENT/videos');
    foreach($html->find('#channels-browse-content-grid > li:nth-child(1) > div > div.yt-lockup-dismissable > div.yt-lockup-content > h3') as $key => $data)
    {
        if($key == 0 )$next = $data->find('a',0)->href;
        if (!preg_match("/^\//", $data->href)) 
        {
			$feed[] =  '"http://www.youtube.com'.$data->find('a',0)->href.'"';
        } 
    }
	
    if(isset($feed))
    {
        sort($feed);
        return $feed;
    }
    else
    {
        return false;
    }
}

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

function getYouTubeIdFromURL($url) 
{
  $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
  preg_match($pattern, $url, $matches);

  return isset($matches[1]) ? $matches[1] : false;
}
?>