<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li class="active">K-pop Chart</li>
</ol>

<h1>k-pop chart</h1>


<table class="table table-striped">
	<thead>
	<tr>
        <th>สัปดาห์ที่</th>
    </tr>
    </thead>
  	<tbody>
	<?php foreach($chart_categories as $chart_category):?>
	<tr>
        <td><a href="music_charts/week/<?=$chart_category->slug?>"><h4><?=$chart_category->title?></h4></a></td>
    </tr>
	<?php endforeach;?>
	</tbody>
</table>

<?php echo $chart_categories->pagination();?>

</div>