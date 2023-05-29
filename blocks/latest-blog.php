<div class="flex blogblock">
    <?php 
    $latestBlog = new WP_Query(array(
        'posts_per_page' => 3
    ));

    while($latestBlog->have_posts()) {
        $latestBlog->the_post(); ?>
    <div class="blog-container">
    <div class="blog-post">
        <main class="post-content">
          <div class="date">
                <span><?php the_time('d'); ?></span>
                <span><?php the_time('M'); ?></span>
                <span><?php the_time('Y'); ?></span>
        </div>
          <div class="post-title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
          <div class="post-content">
            <p>
            <?php 
                if(has_excerpt()) {
                    echo get_the_excerpt();
                } else {
                    echo wp_trim_words(get_the_excerpt(), 25);
                }
            ?>
            </p>
          </div>
        </main>
        <hr />
        <div class="author">
          <div class="left">
            <img src="/mrbeast.jpg" alt="" />
          </div>
          <div class="right"><small>by <?php the_author(); ?></small></div>
        </div>
    </div>
</div>
   <?php }
    ?>
</div>