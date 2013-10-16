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
    foreach ($links as $key => $link){
        $url = "http://www.kodhit.com".$link;

            $html = file_get_html($url);
            $data['title'] = trim($html->find('h1',0)->plaintext);
            foreach ($html->find('iframe') as $elm){
                $data['vdo_script'] .= $elm->src." ";
            }
            $data['slug'] = clean_url($data['title']);
            $data['created'] = time();
            $data['url'] = 'http://www.kodhit.com'.$link;
            $db->AutoExecute('vdos',$data,'INSERT');
            print "<br>".++$key." $link insert";
            unset($html);
            unset($data);
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
    $html = file_get_html('http://www.kodhit.com/?splash=off');
    foreach($html->find('div.container section.row-fluid article.span6 div.view-content ul.nav li') as $key => $data)
    {
        if($key == 0 )$next = $data->find('a',0)->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $url = "http://www.kodhit.com".$data->find('a',0)->href;
            $check = $db->GetOne('select url from vdos where url = ?',array($url));
             if(!$check)
             {
                 $feed[] =  $data->find('a',0)->href;
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