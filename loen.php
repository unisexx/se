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

// print_r(get_link());
$links = get_link();
if($links)
{
    foreach ($links as $key => $link)
    {
        $url = "http://www.youtube.com".$link;
        $html = file_get_html($url);
        $data['url'] = $url;
        $data['title'] = $html->find('span.title',$key)->plaintext;
        $data['slug'] = clean_url($data['title']);
        $data['vdo_script'] = $url;
        $data['detail'] = $url;
        $data['created'] = time();
        $data['status'] = 'approve';
        $data['chanel'] = 'loen';
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


/*------------------------function--------------------------*/
function get_link()
{
    global $db;
    $html = file_get_html('https://www.youtube.com/user/LOENENT/videos');
    foreach($html->find('#video-page-content .yt-lockup-title') as $key => $data)
    {
        if($key == 0 )$next = $data->find('a',0)->href;
        if (!preg_match("/^\//", $data->href)) 
        {
            $url = $data->find('a',0)->href;
            $check = $db->GetOne('select url from mvs where url = ?',array($url));
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