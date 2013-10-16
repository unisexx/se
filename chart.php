#!/usr/local/bin/php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
set_time_limit(0); 
//ini_set("memory_limit","256M");
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
    $html = file_get_html('http://www.kpopchart.com/');
	$data['title'] = $html->find('h1',0)->plaintext;
	$data['slug'] = clean_url($data['title']);
	$data['status'] = 'approve';
	$data['created'] = time();
	$db->AutoExecute('music_chart_categories',$data,'INSERT');
    
    foreach ($links as $key => $link)
    {
        $data2['artist'] = $html->find("html body div#wrap div.item div.dscr div.info div.artist",$key)->find('a',0)->innertext;
        $data2['m_title'] = $html->find("html body div#wrap div.item div.dscr div.info div.title",$key)->find('a',0)->innertext;
        $data2['no'] = $html->find("html body div#wrap div.item div.dscr div.no",$key)->find('a',0)->innertext;
    	$data2['cover'] = "http://www.kpopchart.com".$html->find('div#wrap div.item div.pic',$key)->find('img',0)->src;
		
        $html2 = file_get_html('http://www.kpopchart.com'.$link);
		$data2['music_chart_category_id'] = $db->GetOne('select max(id) from music_chart_categories');
		$data2['url'] = $link;
        $data2['title'] = $html2->find('div#watch h1',0)->plaintext;
		$data2['vdo_script'] = $html2->find('embed',0);
		$data2['vdo_url'] = $html2->find('embed',0)->src;
        $data2['slug'] = clean_url($data2['title']);
        $data2['created'] = time();
        $db->AutoExecute('music_charts',$data2,'INSERT');
        print "<br>".++$key." $link insert";

		unset($html2);
        unset($data);
        unset($data2);
    }
	unset($html);
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
    $html = file_get_html('http://www.kpopchart.com/');
    foreach($html->find('html body div#wrap div.item div.pic') as $key => $data)
    {
        if($key == 0 )$next = $data->find('a',0)->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $url = $data->find('a',0)->href;
            $check = $db->GetOne('select slug from music_charts where url = ?',array($url));
             if(!$check)
             {
                        //$cover[] =  $data->find('img',0)->src;
						$feed[] = $data->find('a',0)->href;
             }
             else
             {
                 if(isset($feed))
                 {
                     natsort($feed);
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
        natsort($feed);
        return $feed;
    }
    else
    {
        return false;
    }
}
?>