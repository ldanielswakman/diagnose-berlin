<section id="categories" class="categories content load-fadein">
    <?php
    $cats = wp_list_categories([
        'title_li'   => '<div class="title">' . __('Categories') . '</div>',
        'orderby'    => 'name',
        'exclude'    => array( 239, 241 ),
        'show_option_all' => __('Allen'),
        'echo' => false
    ]);

    $blog_url = esc_url( home_url( '/knowledge/' ) );

    // Set proper href for 'All categories' link
    $cats = preg_replace('/cat-item-all\'><a href=\'([^"]*)\'>/','cat-item-all\'><a href=\'' . $blog_url . '\'>',$cats);

    // Set current category for 'all' item if no filter active
    if (!is_category()) {
        $cats = preg_replace('/cat-item-all/', 'cat-item-all current-cat', $cats, 1);
    }

    echo $cats;
    ?>
</section>
