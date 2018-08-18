<?php
/**
 * Widget API: Childtheme_Auto_Menu_Widget class
 *
 * @package WP Boilerplate
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Class used to implement the Auto Menu widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */

// @TODO: It would be helpful to use this functionality in layers
class Childtheme_Auto_Menu_Widget extends WP_Widget {

	/**
	 * Sets up a new Auto Menu widget instance.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'description' => __( 'Add a context sensitive menu to your sidebar.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'auto_menu', __( 'Auto Menu' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Auto Menu widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Auto Menu widget instance.
	 */
	public function widget( $args, $instance ) {
		$post = get_queried_object();

		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu
		);
		
		$auto_menu = array();

		// check for a valid menu
		if( ! empty( $nav_menu ) ) {
			$menu_args = array();
			$menu_items = wp_get_nav_menu_items( $nav_menu, $menu_args );

			// variable defaults
			$nav_menu_item = null;
			$child_menu_items = array();
			$sibling_menu_items = array();

			// if we have some menu items, loop through them to find the item corresponding to $post
			if( ! empty( $menu_items ) ) {
				foreach( $menu_items as $menu_item ) {
					// find the menu item for the current page
					if( $menu_item->object_id == $post->ID ) {
						$nav_menu_item = $menu_item;
						break;
					}
				}
			}

			// if we found a match, loop through again to find child and sibling menu items
			if( $nav_menu_item ) {
				foreach( $menu_items as $menu_item ) {
					// child relationship check
					if( $menu_item->menu_item_parent == $nav_menu_item->ID ) {
						$child_menu_items[] = $menu_item;
					}
					// sibling relationship check
					else if( $menu_item->menu_item_parent == $nav_menu_item->menu_item_parent ) {
						$sibling_menu_items[] = $menu_item;
					}
				}
			}

			// fill the auto menu based on child relationships first, sibling relationships next
			$auto_menu = ( ! empty( $child_menu_items ) ) ? $child_menu_items : $sibling_menu_items;
		}

		if( ! empty( $auto_menu ) ) {

			echo $args['before_widget'];

			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			?>
			
			<ul class="nav flex-column sub-menu">

				<?php foreach( $auto_menu as $menu_item ): ?>

					<li class="nav-item"><a href="<?php echo $menu_item->url; ?>" title="<?php echo $menu_item->title; ?>" class="nav-link"><?php echo $menu_item->title; ?></a></li>

				<?php endforeach; ?>

			</ul>

			<?php
			echo $args['after_widget'];
		}

		/**
		 * Filters the arguments for the Auto Menu widget.
		 *
		 * @since 1.0.0
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve an auto menu.
		 *
		 *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param WP_Term  $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 * @param array    $instance      Array of settings for the current widget.
		 */
		//wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

		//echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Auto Menu widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

	/**
	 * Outputs the settings form for the Auto Menu widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		global $wp_customize;
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ) ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}
