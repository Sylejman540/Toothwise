<?php

// Enqueue theme styles and fonts
function toothwise_enqueue_styles() {
    wp_enqueue_style('toothwise-style', get_stylesheet_uri());
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'toothwise_enqueue_styles');

// Enqueue theme scripts
function wpdevs_load_scripts() {
    wp_enqueue_script('dropdown', get_template_directory_uri() . '/js/dropdown.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'wpdevs_load_scripts');

// Register menus
function toothwise_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'toothwise'),
        'wp_devs_main_menu' => 'Main Menu',
        'wp_devs_footer_menu' => 'Footer Menu',
    ]);
}
add_action('init', 'toothwise_register_menus');

// Theme support options
function wpdevs_config() {
    add_theme_support('custom-header', ['height' => 225, 'width' => 1920]);
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'width' => 200,
        'height' => 110,
        'flex-height' => true,
        'flex-width' => true
    ]);
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('title-tag');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');
    add_theme_support('wp-block-styles');
}
add_action('after_setup_theme', 'wpdevs_config');

// Register widget areas
function wpdevs_sidebars() {
    $areas = [
        ['Blog Sidebar', 'sidebar-blog'],
        ['Service 1', 'services-1'],
        ['Service 2', 'services-2'],
        ['Service 3', 'services-3'],
        ['Feedback 1', 'feedback-1'],
        ['Feedback 2', 'feedback-2'],
        ['Feedback 3', 'feedback-3'],
    ];

    foreach ($areas as [$name, $id]) {
        register_sidebar([
            'name' => $name,
            'id' => $id,
            'description' => $name,
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        ]);
    }
}
add_action('widgets_init', 'wpdevs_sidebars');

// Customizer setting for hero image
function toothwise_customize_register($wp_customize) {
    $wp_customize->add_setting('set_hero_background', [
        'default' => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'set_hero_background', [
        'label' => __('Hero Background Image', 'toothwise'),
        'section' => 'set_hero_background',
        'mime_type' => 'image',
    ]));
}
add_action('customize_register', 'toothwise_customize_register');

// Fix pagination when using shortcodes in pages
function fix_pagination_for_shortcode_on_pages() {
    if (is_page() && get_query_var('page')) {
        set_query_var('paged', get_query_var('page'));
    }
}
add_action('pre_get_posts', 'fix_pagination_for_shortcode_on_pages');

// Shortcode: Show recent posts with pagination
function about_recent_posts_shortcode() {
    ob_start();
    $paged = max(1, get_query_var('paged'));

    $query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => $paged,
    ]);

    if ($query->have_posts()) {
        echo '<div class="about-post-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="about-post-box">';
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(null, 'medium', ['style' => 'width:100%; height:auto; margin-bottom:10px;']);
            }
            echo '<h3>' . get_the_title() . '</h3>';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '<a href="' . get_permalink() . '">Read more</a>';
            echo '</div>';
        }
        echo '</div>';

        echo '<div class="about-pagination">';
        echo paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
            'format' => get_permalink() . '%_%',
            'base' => get_permalink() . '?paged=%#%',
        ]);
        echo '</div>';
    } else {
        echo '<p>No posts found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('about_posts', 'about_recent_posts_shortcode');

// Shortcode: Contact form
function custom_contact_form_shortcode() {
    ob_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cf_submit'])) {
        echo '<div style="background: #d4edda; padding: 10px; margin-bottom: 20px; color: #155724;">Thank you for your message!</div>';
    }

    ?>
    <form method="post" style="display: flex; flex-direction: column; gap: 15px; max-width: 600px; margin: 0 auto;">
        <input type="text" name="cf_name" placeholder="Your Name" required style="padding: 10px; border: 1px solid #ccc;">
        <input type="email" name="cf_email" placeholder="Your Email" required style="padding: 10px; border: 1px solid #ccc;">
        <textarea name="cf_message" rows="5" placeholder="Your Message" required style="padding: 10px; border: 1px solid #ccc;"></textarea>
        <button type="submit" name="cf_submit" style="padding: 10px; background: #0073aa; color: white; border: none;">Send</button>
    </form>
    <?php

    return ob_get_clean();
}
add_shortcode('custom_contact_form', 'custom_contact_form_shortcode');