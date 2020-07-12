<div class="wrap">
	<h1>Look Back Through Your Posts!</h1>
	<p>
    Looking back at posts published within <?php echo Lookback_Plugin::DAY_RANGE ?> days
    of <?php echo current_time('F j') ?> over the years.
  </p>


<?php

  // Get the range of days we will be looking at
  $days_str = Lookback_Plugin::DAY_RANGE . ' days';
  $after_day = date_format( date_create ('-'.$days_str), 'j' );
  $after_mon = date_format( date_create ('-'.$days_str), 'n' );
  $after_year_diff = date_format( date_create ('-'.$days_str), 'Y' )
                      - current_time('Y'); // In case this is around the New Year
  $before_day = date_format( date_create ('+'.$days_str), 'j' );
  $before_mon = date_format( date_create ('+'.$days_str), 'n' );
  $before_year_diff = date_format( date_create ('-'.$days_str), 'Y' )
                      - current_time('Y'); // In case this is around the New Year

  // Get the range of years
  $start = current_time('Y') - 1;
  $end   = (function () {
    $loop = get_posts( 'numberposts=1&order=ASC' );
    return get_the_date('Y', $loop[0]->ID);
  })();

?>

<?php foreach ( range($start, $end, -1) as $year): ?>

<h2>
  <?php echo $year ?>
</h2>

<?php
  $args = array(
    'date_query' => array(
        array(
            'after'     => array(
              'year'  => $year + $after_year_diff,
              'month' => $after_mon,
              'day'   => $after_day,
            ),
            'before'    => array(
              'year'  => $year + $before_year_diff,
              'month' => $before_mon,
              'day'   => $before_day,
            ),
            'inclusive' => true,
        ),
    ),
    'posts_per_page' => -1,
  );

  $query = new WP_Query( $args );
?>

<!-- Start the Loop. -->
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

<h4>
  <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
    <?php the_title(); ?>
  </a>
  - <?php the_time('M jS, Y'); ?>, by <?php the_author_posts_link(); ?>
</h4>

<?php endwhile; else : ?>

<p><?php esc_html_e( 'No posts to look back on in '.$year ); ?></p>

<?php endif; ?>

<?php endforeach; ?>

</div>