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

$links = get_link();
//print_r($links);
if($links)
{
    foreach ($links as $key => $link)
    {
        //$db->debug =true;
        $html = file_get_html($link);
        $data['title'] = $html->find('div[class=single-title] h1',0)->plaintext;
			 $data['detail'] = $html->find('div[class=single-getcontent]',0)->find('div[class=socialshare]',0)->outertext = '';
			 $data['detail'] = $html->find('div[class=single-getcontent]',0)->find('div[class=right_ads]',0)->outertext = '';
             $data['detail'] = $html->find('div[class=single-getcontent]',0)->find('div[class=right_ads2]',0)->outertext = '';
			 $data['detail'] = $html->find('div[class=single-getcontent]',0)->find('div[class=left_ads]',0)->outertext = '';
             $data['detail'] = $html->find('div[class=single-getcontent]',0)->find('div[class=like_box]',0)->outertext = '';
             $data['detail'] = $html->find('div[class=single-getcontent]',0)->find('div[class=ads_content]',0)->outertext = '';
        $data['detail'] = $html->find('div[class=single-getcontent]',0)->innertext;
        $data['slug'] = clean_url($data['title']);
        $data['created'] = time();
        $data['source'] = 'tlc';
		$data['status'] = 'draft';
        $db->AutoExecute('kpop_news',$data,'INSERT');
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

function my_callback($element) {
        if ($element->class=='like_box')
                $element->outertext = '';
    } 

function get_link()
{
    global $db;
    $html = file_get_html('http://korea.tlcthai.com/category/koreaentertain/');
    foreach($html->find('div[class=category-content_post_title] h2 a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $slug = clean_url($data->plaintext);
            $check = $db->GetOne('select slug from kpop_news where source = "tlc" and slug = ?',array($slug));
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