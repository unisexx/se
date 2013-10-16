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

//print_r(get_link());
$links = get_link();
if($links)
{
    foreach ($links as $key => $link)
    {
        $html = file_get_html($link);
		$data['url'] = $link;
        $data['title'] = $html->find('h2',1)->plaintext;
		$data['detail'] = $html->find('div[class=fullcol]',1)->innertext;
		$data['video_script'] = "http:".$html->find('div[class=fullcol]',1)->find('iframe',0)->src;
        $data['slug'] = $html->find('div.single-title-again h2 a',0)->plaintext;
        $data['slug'] = clean_url($data['slug']);
        $data['created'] = time();
        $data['status'] = 'approve';
        $db->AutoExecute('mvs',$data,'INSERT');
        print "<br>".++$key." $link insert";
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
function get_link()
{
    global $db;
    $html = file_get_html('http://music.tlcthai.com/asian_music/');
    foreach($html->find('html body div.body div.div990 div.index-news div.news-content a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $slug = clean_url($data->title);
            $check = $db->GetOne('select slug from mvs where slug = ?',array($slug));
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
?>