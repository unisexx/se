<h2 class="headline">มิวสิกวิดีโอ kpop</h2>

<div class="row">
<?php foreach($mvs as $mv):?>
<div class="col-lg-6">
<div class="media">
  <a class="media-left" href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>" target="_blank">
    <img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($mv->url)?>/default.jpg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?=$mv->title?></h4>
  </div>
</div>
</div>
<?php endforeach;?>
</div><!--/row-->

<!-- <div class="row">
	<?php foreach($mvs as $mv):?>
		<div class="col-lg-6">
			<a href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>" target="_blank">
			  <img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($mv->url)?>/mqdefault.jpg">
		      <h3><?=$mv->title?></h3>
		    </a>
	    </div>
	<?php endforeach;?>
</div> -->

<!-- <div class="span9">
	<h2 class="header">มิวสิควีดีโอ</h2>
	<?php foreach($mvs as $mv):?>
	    <?php echo alternator('','<br clear="all">');?>
	    <div class="span4">
	    <div class="clearfix">
		<div class="video-thumb">
			<a href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>" target="_blank">
				<div class="thumbnail video">
					<span class="video-thumb-container">
						<span class="wrap">
							<span class="shim"></span>
							<?//=YoutubeIframeConverter($mv->video_script,"thumb",'alt="'.$mv->title.'"')?>
							<img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($mv->url)?>/mqdefault.jpg">
						</span>
						<span class="play">Play</span>
					</span>
				</div>
			</a>
		</div>
		<a href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>" target="_blank"><?=$mv->title?></a> <?=(datediff(datetime2date($mv->created)) >= -1)?'<span class="label label-mini label-warning">ใหม่</span>':'';?>
		<div class="author"></div>
		<div class="viewcount"></div>
		</div>
		</div>
	<?php endforeach;?>
	<a href="มิวสิควีดีโอเพลงเกาหลี"><div class="right btn btn-mini" type="button">ดู MV ทั้งหมด</div></a>
	<br clear="all">
</div> -->