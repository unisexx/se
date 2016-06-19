<!-- Main hero unit for a primary marketing message or call to action -->
<link id="facebookThumb" rel="image_src" href="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/161898_379223069327_7884506_n.jpg">

  <div class="row">
    <div class="homepage">
        <?php //echo modules::run('chat/inc_home'); ?>
    	<?php //echo modules::run('hilights/inc_home'); ?>
        <?php // echo modules::run('tickers/inc_home'); ?>
        <section id="kpop_new"><?php echo modules::run('kpop_news/inc_home'); ?></section>
        <section id="music"><?php echo modules::run('webboards/inc_home'); ?></section>
        <section id="mv"><?php echo modules::run('music_videos/inc_home'); ?></section>
        <?php // echo modules::run('concerts/inc_home'); ?>
        <section id="series"><?php echo modules::run('vdos/inc_home2'); ?></section>
    </div>
  </div> 