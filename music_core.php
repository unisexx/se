#!/usr/local/bin/php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('application/helpers/MY_url_helper.php');
include('media/simpledom/simple_html_dom.php');
include('adodb/adodb.inc.php');
include('autopost/config.php');
$db = ADONewConnection($_config['dbdriver']);
$db->Connect($_config['server'],$_config['username'],$_config['password'],$_config['database']);
$db->Execute('SET character_set_results=utf8');
$db->Execute('SET collation_connection=utf8_unicode_ci');
$db->Execute('SET NAMES utf8');

// print_r(get_link());
$links = get_link();
if($links)
{
    foreach ($links as $key => $link){
        $url = "http://www.youtube.com".$link;

            $html = file_get_html($url);
            $data['title'] = trim($html->find('h2.epic-nav-item-heading',0)->plaintext);
            foreach ($html->find('div.video-info div.video-overview h3.video-title-container a.yt-uix-sessionlink') as $key=>$elm){
                $vid_title = $html->find('span.title',$key)->plaintext;
                $data['vdo_script'] .= $vid_title."<br> http://www.youtube.com".$elm->href." ";
            }
            $data['slug'] = clean_url($data['title']);
            $data['created'] = time();
            $data['url'] = $link;
            $data['type'] = 'music core';
			$data['status'] = 'approve';
            $data['thumb_1'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",1)->src;
            $data['thumb_2'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",2)->src;
            $data['thumb_3'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",3)->src;
            $data['thumb_4'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",4)->src;
			$data['thumb_5'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",5)->src;
			$data['thumb_6'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",6)->src;
			$data['thumb_7'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",7)->src;
			$data['thumb_8'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",8)->src;
			$data['thumb_9'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",9)->src;
			$data['thumb_10'] = $html->find(".playlist-video-item span.yt-thumb-clip-inner img",10)->src;
			
			$orlist = explode(" ", $data['title']);
			$data['orderlist'] = $orlist[1];
			
            $db->AutoExecute('concert_categories',$data,'INSERT');
            
            foreach ($html->find('div.video-info div.video-overview h3.video-title-container a.yt-uix-sessionlink') as $key=>$elm){
                $data2['concert_category_id'] = $db->GetOne('select max(id) from concert_categories');
                $data2['title'] = $html->find('span.title',$key)->plaintext;
                $data2['slug'] = clean_url($data2['title']);
                $data2['vdo_script'] = "http://www.youtube.com".$elm->href;
                $data2['url'] = $data2['vdo_script'];
                $data2['created'] = time();
                $db->AutoExecute('concert_vids',$data2,'INSERT');
            }
            
            print "<br>".++$key." $link insert";

            unset($html);
            unset($data);
            unset($data2);
    }
}
else
{
    print('<br>no data updated');
}
/*------------------------function--------------------------*/
function get_link()
{
    global $db;
    $html = file_get_html('http://www.youtube.com/show/showmusiccore/videos?sort=dd&flow=grid&view=7');
    foreach($html->find('.channels-content-item') as $key => $data)
    {
    	$link = $data->find('a',0)->href;
		
        if($key == 0 )$next = get_playlist($link);
        if (!preg_match("/^\//", $data->href)) 
        {
            $url = get_playlist($link);
            $check = $db->GetOne('select url from concert_categories where url = ?',array($url));
             if(!$check)
             {
                 $feed[] =  get_playlist($link);
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

function get_playlist($url){
	$playlist = explode('&',$url);
	
	return "/playlist?".substr($playlist[1],4);
}
?>