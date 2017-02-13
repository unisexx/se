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


// $links = get_link123();
// echo "<pre>";
// print_r($links);
// echo "</pre>";


// $html = file_get_html('http://koreaseries.fanthai.com/?p=34489');
// echo $html;
// Dumps the internal DOM tree back into string 
// $str = $html->save();

// Dumps the internal DOM tree back into a file 
// $html->save('result.htm');

$html = file_get_html('http://koreaseries.fanthai.com/?p=29245');
echo $data['title'] = trim($html->find('h1.blog-title',0)->plaintext);
		
		
// if($links)
// {
    // foreach ($links as $key => $link)
    // {
    	// if($key == 1){ exit(); }
// 		
    	// // $html = file_get_html('http://koreaseries.fanthai.com/?p=34489');
		// // echo $html;
		// // echo $html->plaintext;
// 
		// // echo $data['title'] = trim($html->find('h1.blog-title',0)->plaintext);
		// // $detail = '';
		// // $detail .= "<p><img src='".$data['image']."'></p>";
		// // $detail .= $html->find('#mvp-content-main',0)->find('.seed-social',0)->outertext = '';
        // // $detail .= trim($html->find('#mvp-content-main',0)->innertext);
		// // $detail .= "<br> Source : <a href='".$link."' target='_blank'>pingbook entertainment</a>";
		// // $data['detail'] = $detail;
        // // $data['slug'] = clean_url555($data['title']);
// // 
        // // $post = array(
		    // // 'post_title' => $data['title'],
		    // // 'post_name' => $data['slug'],
		    // // 'post_content' => $data['detail'],
		    // // 'post_date' => date("Y-m-d H:i:s"),
		    // // 'post_date_gmt' => date("Y-m-d H:i:s"),
		    // // 'post_status' => 'publish',
		    // // 'post_author' => 1,
		    // // 'post_category' => array(2)
		// // );
		// // wp_insert_post( $post );
// 
// 
        // print "<br>".++$key." $link insert";
        // unset($html);
        // unset($data);
    // }
    // print "<br>".count($links)." records updated";
// }
// else
// {
    // print('<br>no data updated');
// }



/*---------------------------------------function-----------------------------------------------*/

function my_callback($element) {
        if ($element->class=='like_box')
                $element->outertext = '';
    } 

function get_link123()
{
    global $db;
    $html = file_get_html('http://koreaseries.fanthai.com/?cat=4691');
    foreach($html->find('h2.entry-title > a[rel=bookmark]') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $slug = clean_url555($data->plaintext);
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