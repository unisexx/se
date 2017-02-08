<?php

// defined('WP_USE_THEMES') || define('WP_USE_THEMES', false);
// require_once('wp-load.php');
// global $wpdb;
// 
// $post = array(
    // 'post_title' => 'post_title',
    // 'post_content' => 'post_content',
    // 'post_date' => date("Y-m-d H:i:s"),
    // 'post_date_gmt' => date("Y-m-d H:i:s"),
    // 'post_status' => 'publish',
    // 'post_author' => 1,
    // 'post_category' => array(1)
// );
// wp_insert_post( $post );
// 	

?>

<?php
require('wp-blog-header.php');
?>

<?php
$posts = get_posts('numberposts=10&order=ASC&orderby=post_title');
foreach ($posts as $post) : setup_postdata( $post ); ?>
<?php the_date(); echo "<br />"; ?>
<?php the_title(); ?>    
<?php the_excerpt(); ?> 
<?php
endforeach;
?>