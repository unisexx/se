<?php $nation_color = array('global'=>'black','taiwan'=>'green','japan'=>'red','korea'=>'brown','spain'=>'magenta','india'=>'yellow','???'=>'???');?>

<section id="สติ๊กเกอร์มาใหม่" class="clearfix">
<h2>LINE Stickers อัพเดทใหม่ล่าสุด</h2>
    <div id="sticker" class="row">
    <?php foreach($stickers_update as $sticker):?>
      <div class="col-sm-12 col-md-6 col-xs-4" style="margin-top:10px;">
        <a href="sticker/<?php echo $sticker->slug?>" target="_blank" alt="<?php echo $sticker->title?>">
        <div class="thumbnail">
          <img src="<?php echo $sticker->cover?>" alt="<?php echo $sticker->title?>">
          <div class="caption">
            <h3><?php echo $sticker->title?></h3>
            <div class="awesome small <?php echo $nation_color[$sticker->category]?>"><?php echo ucfirst($sticker->category)?></div> <div class="awesome small blue"><?php echo ($sticker->sticker_code == 1671)?'30':'60';?>.-</div>
            <br clear="all">
          </div>
        </div>
        </a>
      </div>
    <?php endforeach;?>
    <br clear="all"><br>
    <center>
    	<a class="btn btn-primary btn-xs" href="http://line.naver.jp/ti/p/Q2iNZSp3aA">แอดไอดีร้านค้า</a>
	    <a class="btn btn-primary btn-xs" href="sticker">ดูสติ๊กเกอร์ไลน์ทั้งหมด</a>
    </center>
    </div>
</section>