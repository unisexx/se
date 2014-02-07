#!/usr/local/bin/php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <form action="" method="get">
	<input type="text" name="link">
	<input type="submit">
</form> -->
<?php
set_time_limit(0); 
include('application/helpers/MY_url_helper.php');
include('media/simpledom/simple_html_dom.php');
include('adodb/adodb.inc.php');
include('autopost/config.php');
$db = ADONewConnection($_config['dbdriver']);
$db->Connect($_config['server'],$_config['username'],$_config['password'],$_config['database']);
$db->Execute('SET character_set_results=utf8');
$db->Execute('SET collation_connection=utf8_unicode_ci');
$db->Execute('SET NAMES utf8');

// echo "<pre>";
// print_r(get_link());
// echo "</pre>";

// $links = get_link();

$html = file_get_html("http://www.youtube.com/user/CJENMMUSIC/videos");
foreach($html->find('#video-page-content .yt-lockup-title') as $key => $row)
{
    $url = "http://www.youtube.com".$row->find('a',0)->href;
    $check = $db->GetOne('select url from mvs where chanel = "cjenm" and url = ?',array($url));
    if(!$check)
    {
        $data['url'] = $url;
        $data['title'] = trim($row->find('a',0)->plaintext);
        $data['slug'] = clean_url($data['title']);
        $data['video_script'] = $url;
        $data['detail'] = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.getYouTubeIdFromURL($url).'" frameborder="0" allowfullscreen></iframe>';
        $data['created'] = time();
        $data['status'] = 'approve';
        $data['chanel'] = 'cjenm';
        $db->AutoExecute('mvs',$data,'INSERT');
        print "<br>".++$key." $url insert";
        unset($html);
        unset($data);
    }
}


/*------------------------function--------------------------*/
// function get_link()
// {
    // global $db;
    // $html = file_get_html('http://www.youtube.com/user/CJENMMUSIC/videos');
    // foreach($html->find('#video-page-content .yt-lockup-title') as $key => $data)
    // {
        // if($key == 0 )$next = $data->find('a',0)->href;
        // if (!preg_match("/^\//", $data->href)) 
        // {
            // // $url = $data->find('a',0)->href;
            // $url = "http://www.youtube.com".$data->find('a',0)->href;
            // $check = $db->GetOne('select url from mvs where chanel = "cjenm" and url = ?',array($url));
             // if(!$check)
             // {
                 // $feed[] =  $data->find('a',0)->href;
             // }
             // else
             // {
                 // if(isset($feed))
                 // {
                     // sort($feed);
                     // return $feed;
                 // }
                 // else
                 // {
                     // return false;
                 // }
             // }
//                 
        // } 
    // }
    // if(isset($feed))
    // {
        // sort($feed);
        // return $feed;
    // }
    // else
    // {
        // return false;
    // }
// }

function getYouTubeIdFromURL($url) 
{
  $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
  preg_match($pattern, $url, $matches);

  return isset($matches[1]) ? $matches[1] : false;
}


?>