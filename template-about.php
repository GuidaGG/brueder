<?php
/**
 * The template for displaying the homepage.
 *
 *
 * Template name: About
 *
 * @package Die_Brueder_Shop
 */

get_header(); ?>
	<?php 	 do_action('die_brueder_header_special'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<h1 ><?php
								$content = get_the_content(); 
								echo  $content;
						?>
							</h1>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'die-brueder-shop' ),
								'after'  => '</div>',
							) );
						?>
						
						<?php 
						$id = get_the_ID();
							$values = get_fields();
							// some time later to get a value for a field
					
							?>
						<div class=" about-emails-wrapper">
							<div class="about about-emails">
								<h2>Questions</h2>
								<h2><a href="mailto:<?php echo $values['questions_about_the_shop']; ?>"><?php echo $values['questions_about_the_shop']; ?></a></h2>
							</div>
							<div class="about about-emails">
								<h2>Jobs and Internships </h2>
								<h2><a href="mailto:<?php echo $values['jobs_and_internshops']; ?>"><?php echo $values['jobs_and_internshops']; ?></a></h2>
							</div>
							<div class="about about-emails">
								<h2>Client Requests</h2>
								<h2><a href="mailto:<?php echo $values['client_requests']; ?>"><?php echo $values['client_requests']; ?></a></h2>
							</div>
						</div>
						<div class="about-adresses-wrapper">
							<p><?php echo $values['die_brueder_name']; ?></p>
							<p><?php echo $values['die_brueder_adress_1']; ?></p>
							<p><?php echo $values['die_brueder_adress_2']; ?></p>
						</div>	
						<div class="about-thumbnail-wrapper">
							<?php
							the_post_thumbnail();
							?>
						</div>
						<div class="about-people-wrapper">
							<?php
							$people = $values[ 'die_brueder_people'];
							$array_people =	explode(", ",$people);
							$emails = $values[ 'die_brueder_emails'];
							$array_emails =	explode(", ",$emails);
						
							foreach (array_combine($array_people, $array_emails) as $apeople => $aemails){
								echo '
								<div class="about-people-span">
								<p>'.$apeople
								.'</p>
								<p><a href="mailto:'.$aemails
								.'">'.$aemails
								.'</a></p>
								</div>';
							}
							
	
							?>
						</div>
						<ul id="isotope" class="about-projects">
						
							<?php
							
								// the query
								$the_query = new WP_Query(array( 'post_type' => 'project')); ?>
								
								<?php if ( $the_query->have_posts() ) : ?>
								
									<!-- pagination here -->
								
									<!-- the loop -->
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<li class="about-projects-li">
										<p><?php the_title(); ?>:</p>
										<?php $p_values = get_fields(get_the_ID());
										
										$platform = $p_values[  'project_platforms'];
										$array_platform =	explode(", ",$platform );
										$links = $p_values[ 'project_links'];
										$array_links=	explode(", ",$links);
										?>
										<ul>
											<?php
										foreach (array_combine($array_platform, $array_links) as $aplatform => $alink){
											echo '
											<span><a href="'.$alink
											.'">'.$aplatform
											.'</a></span>';
										}
							
										?>
										</ul>
										</li>
										<?php
									 endwhile; ?>
									<!-- end of the loop -->
								
									<!-- pagination here -->
								
									<?php wp_reset_postdata(); ?>
								
								<?php else : ?>
									<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								<?php endif; ?>
						</div>
					</div><!-- .entry-content -->
					
					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
								edit_post_link(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Edit <span class="screen-reader-text">%s</span>', 'die-brueder-shop' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										get_the_title()
									),
									'<span class="edit-link">',
									'</span>'
								);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();