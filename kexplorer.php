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

// echo "<pre>";
// print_r(get_link());
// echo "</pre>";

$links = get_link();
if($links)
{
	foreach ($links as $key => $link){
            $url = $link;
			$html = file_get_html($link);
			$data['title'] = trim($html->find('h1.entry-title',0)->plaintext);
			$data['slug'] = clean_url($data['title']);
            $data['webboard_category_id'] = 12;
            $data['type'] = 'normal';
            $detail = '';
            for($i=0;$i<count($html->find('.post-entry',0)->find('p'));$i++){
            $detail .= "<p>".$html->find('.post-entry',0)->find('p',$i)->innertext."</p>";
            }
            $data['detail'] = $detail;
			$data['created'] = time();
            $data['user_id'] = 1610;
            $data['status'] = 'approve';
		    $data['url'] = $link;
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
            $data['stick'] = 0;
            $data['group_id'] = 0;
            $data['author'] = "Memories";
            $data['url'] = $link;
			$db->AutoExecute('webboard_quizs',$data,'INSERT');
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
    $html = file_get_html('http://kpopexplorer.net');
    foreach($html->find('h2.entry-title a') as $key => $data)
    {
        if($key == 0 )$next = $data->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            // $slug = clean_url($data->plaintext);
            $url = $data->href;
            $check = $db->GetOne('select url from webboard_quizs where url = ?',array($url));
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