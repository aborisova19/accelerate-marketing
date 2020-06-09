<?php
/**
 * Template Name: Search Results Page
 * 
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 2.0
 */

get_header(); 
$wp_query; ?>

	<div id="primary" class="site-content sidebar">
		<div class="main-content" role="main">

				<?php if ( have_posts() ) : ?>
					<div class="search-heading">
						<h1 class="search-title"> <?php echo $wp_query->found_posts; ?>
						<?php _e( 'search results found for', 'locale' ); ?>: "<?php the_search_query(); ?>" </h1>
						<?php get_search_form(); ?>
					</div>

					<?php while ( have_posts() ) : the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" class="post-entry">
							<div class="entry-wrap">
								<header class="entry-header">
									<div class="entry-meta">
										<time class="entry-time"><?php echo get_the_date(); ?></time>
									</div>
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</header>
								<div class="entry-summary">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure>
											<?php the_post_thumbnail('full'); ?>
										</figure>
									<?php endif; ?>
									<?php the_excerpt(); ?>
								</div>
								<footer class="entry-footer">
									<div class="entry-meta">
										<span class="entry-terms comments author">
											Written by <?php the_author_posts_link(); ?>
											/
											Posted in <?php the_category(', '); ?>
											/
											<a href="<?php comments_link(); ?>"><?php comments_number( '<span>No Comments</span>', '1 Comment', '% comments' ); ?></a>
										</span>
									</div>
								</footer>
							</div>
						</article>
						
					<?php endwhile; ?> 
					
					<?php else : // If no content ?> 
                	<h1 class="search-title"> Sorry nothing was found </h1>
					<?php get_search_form(); ?>

				<?php endif; ?>
				
				</ul>

			</div>

		</div><!-- .main-content -->


	</div><!-- #primary -->

<?php get_footer(); ?>