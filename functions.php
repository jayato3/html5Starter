<?php
/*
 * Author: O3 World
 * URL: o3world.com
 * HTML5 theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. 
 *
 */
  
/**
 * Set up external modules/files
 */

// Load any external files you have here

/**
 * Theme Support
 */

// Set up the content width value based on the theme's design.
if (!isset($content_width))
{
    $content_width = 900;
}

// Extend base theme functionality
if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('sample-image-size', 433, 307, true); // sample image size;

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

	// Add jetpack infinite scroll
	add_theme_support( 'infinite-scroll', array(
	    'type'           => 'scroll',
	    'footer'         => 'wrapper',
	    'footer_widgets' => false,
	    'container'      => 'content',
	    'wrapper'        => true,
	    'render'         => false,
	    'posts_per_page' => 5
	) );

}

/**
 * Custom Functions
 */

// Header navigation
function o3_main_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Footer navigation
function o3_footer_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'footer-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

/**
 * Load Javascript
 */
 
function o3_scripts()
{
    if (!is_admin()) {
            
        wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
        
        wp_register_script('o3-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '1.0.0', true); // Custom scripts
        wp_enqueue_script('o3-plugins'); // Enqueue it!
        
        wp_register_script('o3-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0', true); // Custom scripts
        //wp_register_script('o3-scripts', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '1.0.0', true); // Custom scripts
        wp_enqueue_script('o3-scripts'); // Enqueue it!
        
    }
}

/**
 * Load CSS
 */
 
function o3_styles()
{  

	global $wp_styles;
	  
    //wp_register_style('o3_styles', get_template_directory_uri() . '/css/styles.min.css', array(), '1.0', 'all');
    wp_register_style('o3_styles', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all');
    wp_enqueue_style('o3_styles'); // Enqueue it!
    
    wp_register_style('ie-styles', get_template_directory_uri() . '/css/styles-ie.css', array(), '1.0', 'all');
    $wp_styles->add_data('ie-styles', 'conditional', 'lt IE 9');
    wp_enqueue_style('ie-styles'); // Enqueue it!
    
}

/**
 * Register navigation menus
 */
 
function register_o3_menu()
{
	
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'o3'), // Main Navigation
        'footer-menu' => __('Footer Menu', 'o3'), // Footer Navigation
        //'extra-menu' => __('Extra Menu', 'o3') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

/**
 * Remove the <div> surrounding the dynamic navigation to cleanup markup
 */
 
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

/**
 * Remove Injected classes, ID's and Page ID's from Navigation <li> items
 */
 
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

/**
 * Remove invalid rel attribute values in the categorylist
 */
 
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}


/**
 * Add page slug to body class - Credit: Starkers Wordpress Theme
 */
 
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


/**
 * Add dynamic sidebar
 */

if (function_exists('register_sidebar'))
{
    // Define standard widget area
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'o3'),
        'description' => __('Holder for sidebar widgets', 'o3'),
        'id' => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}

/**
 * Remove wp_head() injected Recent Comment styles
 */
 
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}


/**
 * Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links
 */

function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

/**
 * Custom Excerpts
 */
 
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

/**
 * Remove admin bar
 */
 
function remove_admin_bar()
{
    return false;
}

/**
 * Remove 'text/css' from our enqueued stylesheet
 */

function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

/**
 * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
 */
 
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

/**
 * Threaded comments
 */
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

/**
 * Custom comments callback
 */
 
function custom_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/**
 * Custom post types
 */

function create_post_type()
{
    // Example Custom Post type
    register_post_type('custom-type', 
        array(
        'labels' => array(
            'name' => __('Custom Post Type', 'custom-type'), // Rename these to suit
            'singular_name' => __('Custom Post', 'custom-type'),
            'add_new' => __('Add New', 'custom-type'),
            'add_new_item' => __('Add New Post', 'custom-type'),
            'edit' => __('Edit', 'custom-type'),
            'edit_item' => __('Edit Post', 'custom-type'),
            'new_item' => __('New Post', 'custom-type'),
            'view' => __('View Posts', 'custom-type'),
            'view_item' => __('View Posts', 'custom-type'),
            'search_items' => __('Search Posts', 'custom-type'),
            'not_found' => __('No Posts found', 'custom-type'),
            'not_found_in_trash' => __('No Posts found in Trash', 'custom-type')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'page-attributes'
        ),
        'rewrite' => array(
        	'slug' => 'project',
        	'with_front' => true
        ),
        'can_export' => true, // Allows export in Tools > Export 
    ));
    
}

/**
 * Custom taxonomies
 */

function create_taxonomies() 
{

	// Example taxonomy
    register_taxonomy(
    	'terms',
    	'custom-type',
        array(
            'labels' => array(
                'name' => 'Term',
                'add_new_item' => 'Add New Term',
                'new_item_name' => "New Term"
            ),
            'hierarchical' => true,
            'taxonomies' => array('post_tag')
        )
    ); 

}


/**
 * Short codes
 */

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null) {
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

/**
 * Misc functions
 */

function new_excerpt_more( $more ) {
	return '&hellip;';
}

// Clean up the dashboard
function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
}

// Move Yoast SEO to bottom
function yoasttobottom() {
	return 'low';
}


/**
 * Add + Filters + Shortcodes
 */

// Add Actions
add_action('init', 'o3_scripts'); // Add Custom Scripts to wp_head
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'o3_styles'); // Add Theme Stylesheet
add_action('init', 'register_o3_menu'); // Add O3 Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' ); // Clean up the dashboard
add_action('init', 'create_post_type'); // Add Custom Post Types
add_action( 'init', 'create_taxonomies', 0 ); // Add Custom Taxonomies

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('excerpt_more', 'new_excerpt_more'); // Format the_excerpt read more notation
add_filter( 'wpseo_metabox_prio', 'yoasttobottom'); // Move Yoast below custom fields

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo');

?>
