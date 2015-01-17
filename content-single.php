<?php
/**
 * @package simpla
 */
?>

<?php
	$post_images = "";
	if (has_post_thumbnail( $post->ID ) ):
		$post_images = simpla_get_post_images($post->ID);
	endif;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
<?php if ($post_images != null) : ?>
		<header class="entry-header entry-header-img data-img" style="background-image: url(1x1.gif);" data-sml="<?php echo $post_images['small']; ?>"
 data-med="<?php echo $post_images['medium']; ?>"
 data-lrg="<?php echo $post_images['full']; ?>" >
<?php else: ?>
	
	<header class="entry-header"> 
<?php endif; ?>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'simpla' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-author">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 200 );?>
			<p class="entry-author-name"><?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></p>
			<p class="entry-author-bio"><?php the_author_meta( 'description' ); ?></p>
		</div>	
		<div class="entry-meta">
			<?php simpla_posted_on(); ?>
			<?php simpla_entry_footer(); ?>
		</div><!-- .entry-meta -->
		
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
