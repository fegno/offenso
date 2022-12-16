<?php
function course_home() {
global $post;
ob_start();
$args = array(
    'post_type' => 'courses',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);
$loop = new WP_Query( $args );
?>
<div class="course-title">
    <label>COURSES</label>
</div>
<div class="course-outer col-centered">
    <?php
        while($loop->have_posts()):
            $loop->the_post();
            ?>
        <div class="course-carousel">
            <div class="item">
                <div class="course-image">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
                    <a href='<?php the_permalink(); ?>'><img src='<?= $image[0] ?>'/></a>
                </div>
                <div class="link">
                    <h4 class="title">
                        <a href='<?php the_permalink();?>'><?php print the_title();?></a>
                    </h4>
                </div>
                <div class="course-detail">
                    <p><?php the_excerpt();?></p>
                </div>
            </div>
        </div>
        
    <?php
    endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
<?php 
   $c = ob_get_clean();
   return $c;
}
add_shortcode('course-home', 'course_home'); ?>
