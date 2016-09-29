<?php
/**
 * Theme widgets.
 *
 * @package Onefold
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'onefold_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function onefold_load_widgets() {

		// Social widget.
		register_widget( 'Onefold_Social_Widget' );

		// Featured Page widget.
		register_widget( 'Onefold_Featured_Page_Widget' );

		// Recent Posts widget.
		register_widget( 'Onefold_Recent_Posts_Widget' );

	}

endif;

add_action( 'widgets_init', 'onefold_load_widgets' );

if ( ! class_exists( 'Onefold_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Onefold_Social_Widget extends Onefold_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'onefold_widget_social',
				'description'                 => __( 'Displays social icons.', 'onefold' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'onefold' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'onefold' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'onefold' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'onefold-social', __( 'Onefold: Social', 'onefold' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$nav_menu_locations = get_nav_menu_locations();
			$menu_id = 0;
			if ( isset( $nav_menu_locations['social'] ) && absint( $nav_menu_locations['social'] ) > 0 ) {
				$menu_id = absint( $nav_menu_locations['social'] );
			}
			if ( $menu_id > 0 ) {
				$menu_items = wp_get_nav_menu_items( $menu_id );
				if ( ! empty( $menu_items ) ) {
					echo '<ul class="size-medium">';
					foreach ( $menu_items as $m_key => $m ) {
						echo '<li>';
						echo '<a href="' . esc_url( $m->url ) . '" target="_blank">';
						echo '<span class="title screen-reader-text">' . esc_attr( $m->title ) . '</span>';
						echo '</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
			}
			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Onefold_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 1.0.0
	 */
	class Onefold_Featured_Page_Widget extends Onefold_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'onefold_widget_featured_page',
				'description'                 => __( 'Displays single featured Page or Post.', 'onefold' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'onefold' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'onefold' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'use_page_title' => array(
					'label'   => __( 'Use Page/Post Title as Widget Title', 'onefold' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'featured_page' => array(
					'label'            => __( 'Select Page:', 'onefold' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'onefold' ),
					),
				'id_message' => array(
					'label'            => '<strong>' . _x( 'OR', 'Featured Page Widget', 'onefold' ) . '</strong>',
					'type'             => 'message',
					),
				'featured_post' => array(
					'label'             => __( 'Post ID:', 'onefold' ),
					'placeholder'       => __( 'Eg: 1234', 'onefold' ),
					'type'              => 'text',
					'sanitize_callback' => 'onefold_widget_sanitize_post_id',
					),
				'content_type' => array(
					'label'   => __( 'Show Content:', 'onefold' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => __( 'Excerpt', 'onefold' ),
						'full'    => __( 'Full', 'onefold' ),
						),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'onefold' ),
					'description' => __( 'Applies when Excerpt is selected in Content option.', 'onefold' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 40,
					'min'         => 1,
					'max'         => 400,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'onefold' ),
					'type'    => 'select',
					'options' => onefold_get_image_sizes_options(),
					),
				'featured_image_alignment' => array(
					'label'   => __( 'Image Alignment:', 'onefold' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => onefold_get_image_alignment_options(),
					),
				);

			parent::__construct( 'onefold-featured-page', __( 'Onefold: Featured Page', 'onefold' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// ID validation.
			$our_post_object = null;
			$our_id = '';
			if ( absint( $params['featured_post'] ) > 0 ) {
				$our_id = absint( $params['featured_post'] );
			}
			if ( absint( $params['featured_page'] ) > 0 ) {
				$our_id = absint( $params['featured_page'] );
			}
			if ( absint( $our_id ) > 0 ) {
				$raw_object = get_post( $our_id );
				if ( ! in_array( $raw_object->post_type, array( 'attachment', 'nav_menu_item', 'revision' ) ) ) {
					$our_post_object = $raw_object;
				}
			}
			if ( ! $our_post_object ) {
				// No valid object; bail now!
				return;
			}

			echo $args['before_widget'];

			global $post;
			// Setup global post.
			$post = $our_post_object;
			setup_postdata( $post );

			// Override title if checkbox is selected.
			if ( true === $params['use_page_title'] ) {
				$params['title'] = get_the_title( $post );
			}

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			?>
			<div class="featured-page-widget entry-content">
				<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( esc_attr( $params['featured_image'] ), array( 'class' => 'align' . esc_attr( $params['featured_image_alignment'] ) ) ); ?>
				<?php endif; ?>
				<?php if ( 'excerpt' === $params['content_type'] ) : ?>
					<?php
						$excerpt = onefold_the_excerpt( absint( $params['excerpt_length'] ) );
						echo wpautop( $excerpt );
						?>
				<?php else : ?>
					<?php the_content(); ?>
				<?php endif; ?>

			</div><!-- .featured-page-widget -->
			<?php
			// Reset.
			wp_reset_postdata();

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Onefold_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 1.0.0
	 */
	class Onefold_Recent_Posts_Widget extends Onefold_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'onefold_widget_recent_posts',
				'description'                 => __( 'Displays recent posts.', 'onefold' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'onefold' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => __( 'Subtitle:', 'onefold' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'onefold' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'onefold' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'onefold' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'onefold' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => onefold_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
					),
				'image_width' => array(
					'label'       => __( 'Image Width:', 'onefold' ),
					'type'        => 'number',
					'description' => __( 'px', 'onefold' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 90,
					'min'         => 1,
					'max'         => 150,
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'onefold' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'onefold-recent-posts', __( 'Onefold: Recent Posts', 'onefold' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0  ) {
				$qargs['category'] = $params['post_category'];
			}
			$all_posts = get_posts( $qargs );

			?>
			<?php if ( ! empty( $all_posts ) ) :  ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php foreach ( $all_posts as $key => $post ) : ?>
						<?php setup_postdata( $post ); ?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) :  ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ). 'px;',
											);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) : ?>
									<div class="recent-posts-meta">

										<?php if ( false === $params['disable_date'] ) :  ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endforeach; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); // Reset. ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;
