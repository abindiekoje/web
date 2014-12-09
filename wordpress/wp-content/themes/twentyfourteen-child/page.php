<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>

			<?php 
				if (is_front_page()) {
					echo "<div class=\"entry-header\"><div class=\"entry-title\">Aktuelles</div></div>";
					echo "<div class=\"entry-content\">";
						query_posts('posts_per_page=-1&post_type=post');
						while ( have_posts() ) : the_post();
							echo "<a class=\"teaser\" href=\"";
							the_permalink();
							echo "\">";
								echo "<span class=\"thumbnail\">";
								if (has_post_thumbnail()) {
									the_post_thumbnail();	
								}
								else {
									echo "<span class=\"logo\">";
									the_title();
									echo "</span>";
								}
								echo "</span>";								
								echo "<span class=\"title\">";
								the_title();
								echo "</span>";
								echo "<span class=\"excerpt\">";
								the_excerpt();
								echo "</span>";
							echo "</a>";

							//get_template_part( 'content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						endwhile;					
					echo "</div>";						
				}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
