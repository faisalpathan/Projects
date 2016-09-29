<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'kyma';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'kyma' ),
				'background-image'      => esc_attr__( 'Background Image', 'kyma' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'kyma' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'kyma' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'kyma' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'kyma' ),
				'inherit'               => esc_attr__( 'Inherit', 'kyma' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'kyma' ),
				'cover'                 => esc_attr__( 'Cover', 'kyma' ),
				'contain'               => esc_attr__( 'Contain', 'kyma' ),
				'background-size'       => esc_attr__( 'Background Size', 'kyma' ),
				'fixed'                 => esc_attr__( 'Fixed', 'kyma' ),
				'scroll'                => esc_attr__( 'Scroll', 'kyma' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'kyma' ),
				'left-top'              => esc_attr__( 'Left Top', 'kyma' ),
				'left-center'           => esc_attr__( 'Left Center', 'kyma' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'kyma' ),
				'right-top'             => esc_attr__( 'Right Top', 'kyma' ),
				'right-center'          => esc_attr__( 'Right Center', 'kyma' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'kyma' ),
				'center-top'            => esc_attr__( 'Center Top', 'kyma' ),
				'center-center'         => esc_attr__( 'Center Center', 'kyma' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'kyma' ),
				'background-position'   => esc_attr__( 'Background Position', 'kyma' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'kyma' ),
				'on'                    => esc_attr__( 'ON', 'kyma' ),
				'off'                   => esc_attr__( 'OFF', 'kyma' ),
				'all'                   => esc_attr__( 'All', 'kyma' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'kyma' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'kyma' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'kyma' ),
				'greek'                 => esc_attr__( 'Greek', 'kyma' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'kyma' ),
				'khmer'                 => esc_attr__( 'Khmer', 'kyma' ),
				'latin'                 => esc_attr__( 'Latin', 'kyma' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'kyma' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'kyma' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'kyma' ),
				'arabic'                => esc_attr__( 'Arabic', 'kyma' ),
				'bengali'               => esc_attr__( 'Bengali', 'kyma' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'kyma' ),
				'tamil'                 => esc_attr__( 'Tamil', 'kyma' ),
				'telugu'                => esc_attr__( 'Telugu', 'kyma' ),
				'thai'                  => esc_attr__( 'Thai', 'kyma' ),
				'serif'                 => _x( 'Serif', 'font style', 'kyma' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'kyma' ),
				'monospace'             => _x( 'Monospace', 'font style', 'kyma' ),
				'font-family'           => esc_attr__( 'Font Family', 'kyma' ),
				'font-size'             => esc_attr__( 'Font Size', 'kyma' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'kyma' ),
				'line-height'           => esc_attr__( 'Line Height', 'kyma' ),
				'font-style'            => esc_attr__( 'Font Style', 'kyma' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'kyma' ),
				'top'                   => esc_attr__( 'Top', 'kyma' ),
				'bottom'                => esc_attr__( 'Bottom', 'kyma' ),
				'left'                  => esc_attr__( 'Left', 'kyma' ),
				'right'                 => esc_attr__( 'Right', 'kyma' ),
				'center'                => esc_attr__( 'Center', 'kyma' ),
				'justify'               => esc_attr__( 'Justify', 'kyma' ),
				'color'                 => esc_attr__( 'Color', 'kyma' ),
				'add-image'             => esc_attr__( 'Add Image', 'kyma' ),
				'change-image'          => esc_attr__( 'Change Image', 'kyma' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'kyma' ),
				'add-file'              => esc_attr__( 'Add File', 'kyma' ),
				'change-file'           => esc_attr__( 'Change File', 'kyma' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'kyma' ),
				'remove'                => esc_attr__( 'Remove', 'kyma' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'kyma' ),
				'variant'               => esc_attr__( 'Variant', 'kyma' ),
				'subsets'               => esc_attr__( 'Subset', 'kyma' ),
				'size'                  => esc_attr__( 'Size', 'kyma' ),
				'height'                => esc_attr__( 'Height', 'kyma' ),
				'spacing'               => esc_attr__( 'Spacing', 'kyma' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'kyma' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'kyma' ),
				'light'                 => esc_attr__( 'Light 200', 'kyma' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'kyma' ),
				'book'                  => esc_attr__( 'Book 300', 'kyma' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'kyma' ),
				'regular'               => esc_attr__( 'Normal 400', 'kyma' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'kyma' ),
				'medium'                => esc_attr__( 'Medium 500', 'kyma' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'kyma' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'kyma' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'kyma' ),
				'bold'                  => esc_attr__( 'Bold 700', 'kyma' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'kyma' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'kyma' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'kyma' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'kyma' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'kyma' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'kyma' ),
				'add-new'           	=> esc_attr__( 'Add new', 'kyma' ),
				'row'           		=> esc_attr__( 'row', 'kyma' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'kyma' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'kyma' ),
				'back'                  => esc_attr__( 'Back', 'kyma' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'kyma' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'kyma' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'kyma' ),
				'none'                  => esc_attr__( 'None', 'kyma' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'kyma' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'kyma' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'kyma' ),
				'initial'               => esc_attr__( 'Initial', 'kyma' ),
				'select-page'           => esc_attr__( 'Select a Page', 'kyma' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'kyma' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'kyma' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'kyma' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'kyma' ),
			);

			$config = apply_filters( 'kirki/config', array() );

			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
