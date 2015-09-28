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
// $db->debug = true;

// echo "<pre>";
// print_r(get_link());
// echo "</pre>";

$links = get_link();

if($links)
{
	$newarray = implode(", ", $links);
	
	$mvs_from_db = $db->Execute('SELECT url from mvs where url in ('.$newarray.',"http://www.youtube.com/watch?v=lEJVJ64EsFM")');
	foreach($mvs_from_db as $row){
		$arrFromDB[] = $row[0];
	}
	
	$result = array_diff(str_replace('"', '', $links), $arrFromDB);
	
	if(!empty($result)){
		foreach ($result as $key => $url){
			$data['youtubeid'] = getYouTubeIdFromURL($url);
			$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$data['youtubeid']);
			parse_str($content, $youtube_title);
			
			//This gives you the video title
			$data['title'] = $youtube_title['title'];

			$data['url'] = "http://www.youtube.com/watch?v=".$data['youtubeid'];
	        $data['slug'] = clean_url($data['title']);
	        $data['video_script'] = $data['url'];
	        $data['detail'] = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$data['youtubeid'].'" frameborder="0" allowfullscreen></iframe>';
	        $data['created'] = time();
	        $data['status'] = 'approve';
	        $data['chanel'] = 'loen';
	        $db->AutoExecute('mvs',$data,'INSERT');
	        // print "<br>".++$key." $url insert";
	        unset($html);
	        unset($data);
		}
	}
	else
	{
	    print('<br>no data updated');
	}
}


/*------------------------function--------------------------*/
function get_link()
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

function getYouTubeIdFromURL($url) 
{
  $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
  preg_match($pattern, $url, $matches);

  return isset($matches[1]) ? $matches[1] : false;
}
?>