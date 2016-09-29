<?php
/**
 * Custom Customizer Controls.
 *
 * @package Onefold
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Customize Control for Heading.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Onefold_Heading_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'heading';

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

	?>
	<?php if ( ! empty( $this->label ) ) : ?>
		<h3><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></h3>
	<?php endif; ?>
	<?php if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
	<?php endif; ?>
    <?php
	}
}

/**
 * Customize Control for Message.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Onefold_Message_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'message';

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

	?>
	<?php if ( ! empty( $this->label ) ) : ?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	<?php endif; ?>
	<?php if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo $this->description; ?></span>
	<?php endif; ?>
    <?php
	}
}

/**
 * Customize Control for Radio Image.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Onefold_Radio_Image_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio-image';

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;

	?>
	<label>
		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>
		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>

		<?php foreach ( $this->choices as $value => $label ) : ?>
			<label>
				<input type="radio" value="<?php echo esc_attr( $value ); ?>" <?php $this->link();
				checked( $this->value(), $value ); ?> class="stylish-radio-image" name="<?php echo esc_attr( $name ); ?>"/>
				<span><img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" /></span>
			</label>
		<?php endforeach; ?>
	</label>
    <?php
	}
}

/**
 * Customize Control for Taxonomy Select.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Onefold_Dropdown_Taxonomies_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-taxonomies';

	/**
	 * Taxonomy.
	 *
	 * @access public
	 * @var string
	 */
	public $taxonomy = '';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$our_taxonomy = 'category';
		if ( isset( $args['taxonomy'] ) ) {
			$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
			if ( true === $taxonomy_exist ) {
				$our_taxonomy = esc_attr( $args['taxonomy'] );
			}
		}
		$args['taxonomy'] = $our_taxonomy;
		$this->taxonomy = esc_attr( $our_taxonomy );

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		$tax_args = array(
			'hierarchical' => 0,
			'taxonomy'     => $this->taxonomy,
		);
		$all_taxonomies = get_categories( $tax_args );

	?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?>>
			<?php
			printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), ' ' );
			?>
			<?php if ( ! empty( $all_taxonomies ) ) :  ?>
				<?php foreach ( $all_taxonomies as $key => $tax ) :  ?>
					<?php
					printf( '<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected( $this->value(), $tax->term_id, false ), esc_html( $tax->name ) );
					?>
				<?php endforeach ?>
			<?php endif ?>
		</select>
	</label>
    <?php
	}
}

class Onefold_Dropdown_Sidebars_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-sidebars';

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		global $wp_registered_sidebars;

		$all_sidebars = $wp_registered_sidebars;
	?>
	<label>
		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>
		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
		<select <?php $this->link(); ?>>
			<?php
			printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), ' ' );
			?>
			<?php if ( ! empty( $all_sidebars ) ) :  ?>
				<?php foreach ( $all_sidebars as $key => $sidebar ) : ?>
					<?php
					printf( '<option value="%s" %s>%s</option>', esc_attr( $key ), selected( $this->value(), $key, false ), esc_html( $sidebar['name'] ) );
					?>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</label>
    <?php
	}
}

/**
 * Customize Control for managing section.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Onefold_Section_Manager_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'section-manager';

	/**
	 * Arguments.
	 *
	 * @access public
	 * @var array
	 */
	public $args = array();

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'onefold-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'jquery', 'customize-controls' ) );
		wp_enqueue_style( 'onefold-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css' );

	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	private function get_sections_list() {

		$value = $this->value();
		$items = explode( ',', $value );

		$output = array();
		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				if ( isset( $this->args['sections'][ $item ] ) ) {
					$output[ $item ]['label']  = $this->args['sections'][ $item ]['label'];
					$output[ $item ]['status'] = 1;
				}
			}
		}
		foreach ( $this->args['sections'] as $k => $v ) {
			if ( ! isset( $output[ $k ] ) ) {
				$output[ $k ]['label']  = $v['label'];
				$output[ $k ]['status'] = 0;
			}
		}
		return $output;

	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		if ( ! isset( $this->args['sections'] ) || empty( $this->args['sections'] ) ) {
			return;
		}

		$sections = $this->get_sections_list();
        ?>

        <?php if ( ! empty( $this->label ) ) : ?>
			<h3><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></h3>
        <?php endif; ?>
        <?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>
        <ul class="section-list">
	        <?php foreach ( $sections as $key => $section ) : ?>
	        	<li>
	        		<input type="checkbox" class="section-item-checkbox" value="<?php echo esc_attr( $key ); ?>" <?php checked( $section['status'], 1 ); ?> />
	        		<span><?php echo esc_html( $section['label'] ); ?></span>
	        	</li>
	        <?php endforeach; ?>
        </ul>
    	<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
        <?php
	}

}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Onefold_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
