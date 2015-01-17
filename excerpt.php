<?php
/**
 * @package simpla
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php simpla_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php simpla_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->