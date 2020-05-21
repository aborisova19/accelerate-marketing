<?php
/**
 * The template for displaying about pages
 *
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 2.0
 */


get_header(); ?>

<div id="primary" class="site-content sidebar">
	<div class="main-content" role="main">
		<?php while ( have_posts() ) : the_post(); 
			$size = "full";
            $image = get_field('image'); 
            $service = get_field('service'); 
            ?>

            <div class="individual-service">
                <div class="service-image">
                    <?php echo wp_get_attachment_image($image, $size); ?>
                </div>    
                <div class="service-text">
                    <h3><?php echo $service; ?></h3>
                    <p><?php the_content(); ?></p>
                </div>
            </div>

        <?php endwhile; ?>        

		
	</div><!-- .main-content -->
</div><!-- #primary -->


<div>
    <nav id="navigation" class="container">
        <div class="left"><a href="<?php echo site_url('/about-accelerate/') ?>">&larr; <span>Back to services</span></a></div>
    </nav>
</div>

<?php get_footer(); ?>