#!/usr/local/bin/php
<?php
include('../application/helpers/MY_url_helper.php');
include('../media/simpledom/simple_html_dom.php');
include('../adodb/adodb.inc.php');
include('config.php');
$db = ADONewConnection($_config['dbdriver']);
$db->Connect($_config['server'],$_config['username'],$_config['password'],$_config['database']);
$db->Execute('SET character_set_results=utf8');
$db->Execute('SET collation_connection=utf8_unicode_ci');
$db->Execute('SET NAMES utf8');

$links = get_link();
if($links)
{
    $url = 'http://www.pingbook.com';
    foreach ($links as $key => $link)
    {
        $html = file_get_html($url."/news/".$link);
        $data['title'] = iconv( 'TIS-620', 'UTF-8//IGNORE', $html->find('table[id=AutoNumber8]',0)->find('tr td u span', 0)->plaintext);
        $detail = '';
        for($i=0;$i<count($html->find('table[id=AutoNumber8]',0)->find('tr td span[lang=th] p'))-2;$i++)
        {
            $detail .= "<p>".$html->find('table[id=AutoNumber8]',0)->find('tr td span[lang=th] p',$i)->innertext."</p>";
        }
        $data['detail'] = iconv( 'TIS-620', 'UTF-8//IGNORE',$detail);
        $data['slug'] = clean_url($data['title']);
        $data['created'] = time();
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
function get_link()
{
    global $db;
    $html = file_get_html('http://www.pingbook.com/news/search.php');
    foreach($html->find('table[id=AutoNumber8] table tr td a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $slug = clean_url(iconv( 'TIS-620', 'UTF-8//IGNORE',$data->plaintext));
            $check = $db->GetOne('select slug from kpop_news where slug = ?',array($slug));
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