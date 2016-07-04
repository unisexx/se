<div class="row">
	
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="home">หน้าแรก</a></li>
  <li><a href="music_charts">K-pop Chart</a></li>
  <li><a href="music_charts/week/<?=$music_chart->music_chart_category->slug?>"><?=$music_chart->music_chart_category->title?></a></li>
  <li class="active"><?=$music_chart->artist?> - <?=$music_chart->m_title?></li>
</ol>

<h1><?=$music_chart->artist?> - <?=$music_chart->m_title?></h1>
<?=addThis()?>
    <div class="newcontent">
        <link rel="image_src" href="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($music_chart->vdo_url)?>/0.jpg">
        <?php echo get_vdo($music_chart->vdo_url)?>
    </div>
<?//=fanpage_button();?>
<?=facebook_comment();?>

</div>