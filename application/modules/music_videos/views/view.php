<div class="row">
	
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="">หน้าแรก</a></li>
  <li><a href="มิวสิควีดีโอเพลงเกาหลี">มิวสิควีดีโอเพลงเกาหลี</a></li>
  <li class="active"><?=$mv->title?></li>
</ol>

<h1><?=$mv->title?></h1>
<?=addThis()?>
    <div class="newcontent">
        <?=get_facebook_thumbnail_from_youtube_iframe($mv->video_script)?>
        <?=preg_replace('#</?a(\s[^>]*)?>#i', '', $mv->detail)?>
    </div>
<?=fanpage_button();?>
<?=facebook_comment();?>

</div>