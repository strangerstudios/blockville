<div class="flex eventblock">
    <?php 
    $today = date('Ymd');
    $homePageEvents = new WP_Query(array(
      'posts_per_page' => 2,
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
        array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
        )
      )
    ));

    while($homePageEvents->have_posts()) {
        $homePageEvents->the_post(); 
        $photo = get_field('event_photo'); ?>

    <div class="card-container">
    <div class="card">
        <div class="grid">
            <div class="top" style="background-image: url('<?php echo $photo['url'] ?>')"></div>
            <div class="bottom">
                <div class="title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
                <div class="description">
                    <p>
                        <?php 
                        if(has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_excerpt(), 18);
                        }
                        ?>
                    </p>
                </div>
                <div class="date">
                   <div class="left">
                   <div class="time">
                        <span>
                            <?php $eventDate = new DateTime(get_field('event_date')); echo $eventDate->format('d') ?>
                        </span>
                        <span>
                            <?php echo $eventDate->format('M') ?>
                        </span>
                        <span>
                            <?php echo $eventDate->format('Y') ?>
                        </span>
                    </div>
                   </div>
                   <div class="right">
                    <a href="#">Read More...</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php }
    ?>
</div>

