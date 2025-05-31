<?php get_header(); ?>
        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php
                    $hero_title = get_theme_mod('set_hero_title','Please type some title');
                    $hero_subtitle = get_theme_mod('set__hero_subtitle', 'Please type some subtitle');
                    $hero_button_link = get_theme_mod('set_hero_button_link', '#');
                    $hero_button_text = get_theme_mod('set_hero_button_text', 'Learn More');
                    ?>
                    <section class="hero">
                        <div class="overlay" style="min-height: 600px">
                           <div class="container">
                               <div class="hero-items">
                                   <h1><?php echo $hero_title; ?></h1>
                                   <p><?php echo $hero_subtitle; ?></p>
                                   <a href="<?php echo $hero_button_text;?>">Learn More</a>
                               </div>
                           </div>
                        </div>
                    </section>
                    <section class="services">
                        <h1><?php esc_html_e('Our Work', 'wp-devs') ?></h1>
                        <div class="container">
                            <div class="services-item">
                                <?php
                                    if( is_active_sidebar( 'services-1' )){
                                        dynamic_sidebar( 'services-1' );
                                    }
                                ?>
                            </div>
                            <div class="services-item">
                                <?php
                                    if( is_active_sidebar( 'services-2' )){
                                        dynamic_sidebar( 'services-2' );
                                    }
                                ?>
                            </div>
                            <div class="services-item">
                                <?php
                                    if( is_active_sidebar( 'services-3' )){
                                        dynamic_sidebar( 'services-3' );
                                    }
                                ?>
                            </div>
                        </div>
                    </section>


                    <section class="services">
                        <h1><?php esc_html_e('Our Costumers', 'wp-devs') ?></h1>
                        <div class="container">
                            <div class="services-item">
                                <?php
                                    if( is_active_sidebar( 'feedback-1' )){
                                        dynamic_sidebar( 'feedback-1' );
                                    }
                                ?>
                            </div>
                            <div class="services-item">
                                <?php
                                    if( is_active_sidebar( 'feedback-2' )){
                                        dynamic_sidebar( 'feedback-2' );
                                    }
                                ?>
                            </div>
                            <div class="services-item">
                                <?php
                                    if( is_active_sidebar( 'feedback-3' )){
                                        dynamic_sidebar( 'feedback-3' );
                                    }
                                ?>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
<?php get_footer(); ?>