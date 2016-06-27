<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li class="active">คอนเสิร์ตเกาหลี</li>
</ol>

<h1>คอนเสิร์ตเกาหลี</h1>


<table class="table table-striped">
	<thead>
	<tr>
        <th>สัปดาห์ที่</th>
        <th></th>
    </tr>
    </thead>
  	<tbody>
	<?php foreach($categories as $category):?>
	<tr>
        <td><a href="concerts/week/<?=$category->id?>"><h4>MBC Music Core <?=end(explode(" ",$category->concert_vid->title))?> - <?=$category->title?></h4></a></td>
        <td><?=thumb("http:".$category->thumb_1,70,50,1)?><?=thumb("http:".$category->thumb_2,70,50,1)?><?=thumb("http:".$category->thumb_3,70,50,1)?><?=thumb("http:".$category->thumb_4,70,50,1)?><?=thumb("http:".$category->thumb_5,70,50,1)?></td>
    </tr>
	<?php endforeach;?>
	</tbody>
</table>

<?php echo $categories->pagination();?>

</div>