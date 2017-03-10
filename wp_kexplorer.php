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
    foreach ($links as $key => $link)
    {
    	$html = file_get_html($link);
		
		$data['title'] = trim($html->find('h1.title',0)->plaintext);
		$data['slug'] = clean_url555($data['title']);
		$detail = '';
        for($i=0;$i<count($html->find('.post-single-content',0)->find('p'));$i++){
        	$detail .= "<p>".$html->find('.post-single-content',0)->find('p',$i)->innertext."</p>";
        }
		$detail .= "<p>_______________<br>Source : <a href='".$link."' target='_blank'>kpopexplorer</a></p>";
        $data['detail'] = str_replace('[<a href="http://kpopexplorer.net" target="_blank">kpopexplorer.net</a>]',"",$detail);
        // $db->AutoExecute('kpop_news',$data,'INSERT');
        
        ### Wordpress Insert ###
        $post = array(
		    'post_title' => $data['title'],
		    'post_name' => $data['slug'],
		    'post_content' => $data['detail'],
		    'post_date' => date("Y-m-d H:i:s"),
		    'post_date_gmt' => date("Y-m-d H:i:s"),
		    'post_status' => 'publish',
		    'post_author' => 2,
		    'post_category' => array(390)
		);
		wp_insert_post( $post );


        print "<br>".++$key." $url/news/$link insert";
        unset($html);
        unset($data);
    }
    print "<br>".count($links)." records updated";
}
else
{
    print('<br>no data updated');
}



/*---------------------------------------function-----------------------------------------------*/

// function my_callback($element) {
        // if ($element->class=='like_box')
                // $element->outertext = '';
    // } 

function get_link123()
{
    global $db;
    $html = file_get_html('http://kpopexplorer.net');
    foreach($html->find('h2.title a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
			$slug = clean_url555($data->plaintext);
			// echo $slug."<br>";
            $check = $db->GetOne('select post_name from wp_posts where post_name = ?',array($slug));

             if(!$check)
             {
                 $feed[] =  $data->href;
             }
             else
             {
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
?>