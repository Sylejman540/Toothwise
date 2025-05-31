<?php get_header(); ?>

<main class="container" style="padding: 40px 20px;">

  <?php if (is_page('about')) : ?>

    <div style="text-align: center; margin-bottom: 40px;">
      <h1>Welcome to Toothwise</h1>
      <p>We’re dedicated to crafting brighter smiles and sharing valuable knowledge.</p>
    </div>

    <h2 style="text-align: center;">Insights From Our Team</h2>
    <?php echo do_shortcode('[about_posts]'); ?>

  <?php elseif (is_page('contact-us')) : ?>

    <div style="text-align: center; margin-bottom: 30px;">
      <h1>Contact Us</h1>
      <p>We’d love to hear from you. Fill in the form below and we’ll be in touch shortly.</p>
    </div>

    <div style="display: flex; justify-content: center;">
      <div style="width: 100%; max-width: 600px;">
        <?php echo do_shortcode('[custom_contact_form]'); ?>
        <p style="margin-top: 30px; text-align: center;">
          Email: contact@toothwise.com<br>
          Phone: +383 49 123 456
        </p>
      </div>
    </div>

  <?php else : ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    <?php endwhile; else : ?>
      <p>No content found.</p>
    <?php endif; ?>

  <?php endif; ?>

</main>

<?php get_footer(); ?>
