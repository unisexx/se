<div class="row">
	
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="">หน้าแรก</a></li>
  <li><a href="music">เพลงเกาหลี</a></li>
  <li class="active"><?=$webboard_quizs->title?></li>
</ol>

<h1><?php echo $webboard_quizs->title?></h1>
<?=addThis()?>
    <div class="newcontent">
        <?php echo censor(link_filter($webboard_quizs->detail))?>
    </div>
    
    <?=facebook_comment();?>
</div>