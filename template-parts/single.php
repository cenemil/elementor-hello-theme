<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php while ( have_posts() ) : the_post(); ?>

<main id="main" class="site-main" role="main">

	<?php
	$enable_pheader = get_theme_mod( 'htc_gen_setting_phead_enable' );
	$enable_pheader_default = false;
	
	if( "yes" == $enable_pheader ){
	  $enable_pheader_default = true;
	}

	if( true == $enable_pheader_default ) : ?>
	<header class="page-header">
		<div class="page-header-inner">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>
	<?php endif; ?>

	<div class="page-content">
		<?php the_content(); ?>
	</div>

</main>

<?php endwhile;
