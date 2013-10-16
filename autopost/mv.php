<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
set_time_limit(0); 
ini_set("memory_limit","256M");
include('../application/helpers/MY_url_helper.php');
include('../media/simpledom/simple_html_dom.php');
include('../adodb/adodb.inc.php');
include('config.php');
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
		$data['video_script'] = $html->find('div[class=fullcol]',1)->find('embed',0);
        $data['slug'] = clean_url($data['title']);
        $data['created'] = time();
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
	// http://music.tlcthai.com/asian_music/category/%E0%B9%80%E0%B8%9E%E0%B8%A5%E0%B8%87%E0%B9%80%E0%B8%81%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%B5-korea-music/page/2/
    $html = file_get_html('http://music.tlcthai.com/asian_music/category/koreamusic/');
    foreach($html->find('div[id=content] div[class=list_cat] div h4 b a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $slug = clean_url($data->plaintext);
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