<?php get_header(); ?>

<main class="container">
  <h1>Search Results for: <?php echo get_search_query(); ?></h1>

  <?php if ( have_posts() ) : ?>
    <ul>
      <?php while ( have_posts() ) : the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <p><?php the_excerpt(); ?></p>
        </li>
      <?php endwhile; ?>
    </ul>

    <?php
    // Pagination
    the_posts_pagination();
    ?>

  <?php else : ?>
    <p>No results found. Try again with different keywords.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
