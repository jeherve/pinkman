<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till the #site-navigation
 *
 * @package Pinkman
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="bg-container"></div>

<?php
	$twitter_link = get_theme_mod( 'jetpack-twitter' );
	$facebook_link = get_theme_mod( 'jetpack-facebook' );
	$google_plus_link = get_theme_mod( 'jetpack-google_plus' );
	$linkedin_link = get_theme_mod( 'jetpack-linkedin' );
	$github_link = get_theme_mod( 'jetpack-github' );
	$wporg_link = get_theme_mod( 'jetpack-wporg' );

	$social_links = ( '' != $twitter_link
		|| '' != $facebook_link
		|| '' != $linkedin_link
		|| '' != $google_plus_link
		|| '' != $github_link
		|| '' != $wporg_link
	);
	$services = get_theme_support( 'social-links' );
?>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="grav-link">
				<img src="<?php echo pinkman_get_gravatar(); ?>" class="no-grav" width="120" height="120" />
			</a>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

			<div id="social-links-wrapper">
				<ul class="social-links clear">

					<?php
						foreach ( $services[0] as $service ) :
						if ( get_theme_mod( "jetpack-$service", false ) ) :
					?>

					<li class="<?php echo $service; ?>-link">
						<a href="<?php echo esc_url( get_theme_mod( "jetpack-$service", '' ) ); ?>" class="genericon" title="<?php echo esc_attr( ucfirst( $service ) ); ?>" target="_blank" rel="me">
							<span class="screen-reader-text"><?php echo ucfirst( $service ); ?></span>
						</a>
					</li>
					<?php
						endif;
						endforeach;
					?>

					<?php if ( '' != $github_link ) : ?>
					<li class="github-link">
						<a href="<?php echo esc_url( $github_link ); ?>" class="genericon" title="<?php esc_attr_e( 'Github', 'pinkman' ); ?>" target="_blank" rel="me">
							<span class="screen-reader-text"><?php _e( 'Github', 'pinkman' ); ?></span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ( '' != $wporg_link ) : ?>
					<li class="wporg-link">
						<a href="<?php echo esc_url( $wporg_link ); ?>" class="genericon" title="<?php esc_attr_e( 'WordPress.org', 'pinkman' ); ?>" target="_blank" rel="me">
							<span class="screen-reader-text"><?php _e( 'WordPress.org', 'pinkman' ); ?></span>
						</a>
					</li>
					<?php endif; ?>

				</ul>
			</div><!-- /#social-links-wrapper -->

		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="main" class="site-main">
		<?php
			if ( is_home() )
				get_template_part( 'grid' );
		?>

		<nav id="site-navigation" class="navigation-main" role="navigation">
				<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'pinkman' ); ?>"><?php _e( 'Skip to content', 'pinkman' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
