<?php

function toothwise_enqueue_styles(){
    wp_enqueue_style( 'toothwise-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'toothwise_enqueue_styles' );

function toothwise_register_menus() {
  register_nav_menus([
    'primary' => __('Primary Menu', 'toothwise')
  ]);
}
add_action('init', 'toothwise_register_menus');

register_nav_menus([
  'primary' => __('Primary Menu', 'toothwise')
]);

function wpdevs_load_scripts(){
    wp_enqueue_style( 'wpdevs-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ), 'all' );
    wp_enqueue_style( 'google-fonts', '
https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap
', array(), null );
    wp_enqueue_script( 'dropdown', get_template_directory_uri() . '/js/dropdown.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdevs_load_scripts' );

function wpdevs_config(){
    register_nav_menus(
        array(
            'wp_devs_main_menu' => 'Main Menu',
            'wp_devs_footer_menu' => 'Footer Menu'
        )
    );

    $args = array(
        'height'    => 225,
        'width'     => 1920
    );
    add_theme_support( 'custom-header', $args );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'width' => 200,
        'height'    => 110,
        'flex-height'   => true,
        'flex-width'    => true
    ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));
    add_theme_support( 'title-tag' );
    //add_theme_support ('align-wide');
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles ' );
    add_editor_style( 'style-editor.css' );
    add_theme_support( 'wp-block-styles' );
}
add_action( 'after_setup_theme', 'wpdevs_config', 0 );

add_action( 'widgets_init', 'wpdevs_sidebars' );
function wpdevs_sidebars(){
    register_sidebar(
        array(
            'name'  => 'Blog Sidebar',
            'id'    => 'sidebar-blog',
            'description'   => 'This is the Blog Sidebar. You can add your widgets here.',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name'  => 'Service 1',
            'id'    => 'services-1',
            'description'   => 'First Service Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name'  => 'Service 2',
            'id'    => 'services-2',
            'description'   => 'Second Service Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name'  => 'Service 3',
            'id'    => 'services-3',
            'description'   => 'Third Service Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
    
    register_sidebar(
        array(
            'name'  => 'Feedback 1',
            'id'    => 'feedback-1',
            'description'   => 'First Feedback Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name'  => 'Feedback 2',
            'id'    => 'feedback-2',
            'description'   => 'Second Feedback Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name'  => 'Feedback 3',
            'id'    => 'feedback-3',
            'description'   => 'Third Feedback Area',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
}

function toothwise_customize_register($wp_customize) {

    // Hero Background Image Setting
    $wp_customize->add_setting('set_hero_background', [
        'default' => '',
        'sanitize_callback' => 'absint',
    ]);

    // Hero Background Image Control
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'set_hero_background', [
        'label' => __('Hero Background Image', 'toothwise'),
        'section' => 'set_hero_background', // Make sure this section exists
        'mime_type' => 'image',
    ]));

}
add_action('customize_register', 'toothwise_customize_register');

function about_recent_posts_shortcode() {
    ob_start();

    // Fix pagination when shortcode is on a page
    $paged = get_query_var('paged') ?: (get_query_var('page') ?: 1);

    $query = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'paged'          => $paged,
    ]);

    if ($query->have_posts()) {
        echo '<div class="about-post-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="about-post-box">';
            if (has_post_thumbnail()) {
                echo '<div class="thumb">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
            }
            echo '<h3>' . get_the_title() . '</h3>';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '<a href="' . get_permalink() . '">Read more</a>';
            echo '</div>';
        }
        echo '</div>';

        // Pagination
        echo '<div class="about-pagination">';
        echo paginate_links([
            'total'   => $query->max_num_pages,
            'current' => $paged,
            'format'  => '?page=%#%',
        ]);
        echo '</div>';
    } else {
        echo '<p>No posts found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('about_posts', 'about_recent_posts_shortcode');
