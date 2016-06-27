<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li><a href="music_charts">K-pop Chart</a></li>
  <li class="active"><?=$chart_category->title?></li>
</ol>

<h1><?=$chart_category->title?></h1>
<?=addThis()?>
<link rel="image_src" href="<?php echo $music_charts->cover?>">
<table class="table table-striped music-chart-week">
    <tr>
        <th>Ranking</th>
        <th>Songs / Star</th>
        <th>Music videos</th>
    </tr>
    <?php foreach($music_charts as $key=>$music_chart):?>
        <tr>
            <td><span class="blueranking left20"><?=$music_chart->no?></span></td>
            <td>
                <a href="music_charts/watch/<?=$chart_category->slug?>/no<?=$music_chart->no?>/<?=$music_chart->slug?>/<?=$music_chart->id?>" target="_blank">
                	<?//php/echo thumb($music_chart->cover,50,50,1,'style="float: left; margin-right: 10px;"')?>
                	<img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($music_chart->vdo_url)?>/default.jpg" style='float: left; margin-right: 10px; height:50px;'>
                </a>
                <a href="music_charts/watch/<?=$chart_category->slug?>/no<?=$music_chart->no?>/<?=$music_chart->slug?>/<?=$music_chart->id?>" target="_blank"><b><?=$music_chart->artist?></b><br><?=$music_chart->m_title?></a>
                <br clear="all">
            </td>
            <td><a href="music_charts/watch/<?=$chart_category->slug?>/no<?=$music_chart->no?>/<?=$music_chart->slug?>/<?=$music_chart->id?>" target="_blank"><i class="icon-facetime-video"></i> M/V</a></td>
        </tr>
    <?php endforeach;?>
</table>
<?=fanpage_button();?>
<?=facebook_comment();?>

</div>