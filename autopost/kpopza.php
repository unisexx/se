<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
#!/usr/local/bin/php
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


$links = get_link();
//print_r($links);
if($links)
{
    foreach ($links as $key => $link)
    {
        //$db->debug =true;
        $html = file_get_html($link);
        $data['title'] = $html->find('h1[class=post-title]',0)->plaintext;
        $data['detail'] = $html->find('div[class=post-body]',0)->find('span[class=date-header]',0)->outertext = '';
        $data['detail'] = $html->find('div[class=post-body]',0)->find('div[class=reaction-buttons]',0)->outertext = '';
        $data['detail'] = $html->find('div[class=post-body]',0)->find('div[id=social-wrapper]',0)->outertext = '';
        $data['detail'] = $html->find('div[class=post-body]',0)->find('i',0)->outertext = '';
        $data['img'] = $html->find('div[class=post-body]',0)->find('img',1)->outertext."<br><br>";
        $data['detail'] = $html->find('div[class=post-body]',0)->find('img',1)->outertext = '';
        $data['detail'] = $data['img'].$html->find('div[class=post-body]',0)->innertext;
        $data['slug'] = clean_url($data['title']);
        $data['created'] = time();
        $data['source'] = 'kpopza';
        $data['status'] = 'approve';
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
    $html = file_get_html('http://www.kpopza.com/');
    foreach($html->find('h2[class=post-title] a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $slug = clean_url($data->plaintext);
            $check = $db->GetOne('select slug from kpop_news where source = "kpopza" and slug = ?',array($slug));
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