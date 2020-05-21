<?php 

get_header(); ?>
    <header class="about-page">
            <?php while ( have_posts() ) : the_post(); ?>
                <p class="about-header-text"><?php the_content(); ?></p>
            <?php endwhile; ?>
	</header>
	
    <section id="primary" class="site-content about-page">
		<div class="main-content" role="main">

            <section class="about-page service-list">
                <div class="center-text">
                    <h3>Our services</h3>
                    <p>We take pride in our clients and the content we create for them.
                    </br> Here's a brief overview of our offered services.</p>
                </div>
            </section>

            <div class="services">
                <?php query_posts('posts_per_page=4&post_type=about_pages&orderby=date&order=asc'); ?> 
                <?php while ( have_posts() ) : the_post(); 
                    $image = get_field('image'); 
                    $size="medium";
                    $service = get_field('service');
                    ?>
                    
                    <div class="flex-wrapper clearfix">
                        <div class="individual-services"> 
                            <div class="service-img">   
                                <?php echo wp_get_attachment_image($image, $size); ?>
                            </div>
                            <div class="services-padding"></div>
                            <div class="service-text">
                                <h3><?php echo $service; ?></h3>                         
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                    </div>		
                <?php endwhile; ?> 
                <?php wp_reset_query(); ?>    
		    </div>
    
            <div class="work-with-us">
                <h2>Interested in working with us?</h2>
                <a class="button" href="<?php echo site_url('/contact-us/') ?>">Contact us</a>
            </div>
    
        </div>

    </section>
    
<?php get_footer(); ?>
