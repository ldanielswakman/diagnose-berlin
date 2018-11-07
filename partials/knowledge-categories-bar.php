<section id="categories" class="categories content load-fadein">
    <?php
    $cats = wp_list_categories([
        'title_li'   => '<div class="title">' . __('Categories') . '</div>',
        'orderby'    => 'name',
        'exclude'    => array( 246, 248 ),
        'show_option_all' => __('All'),
        'echo' => false
    ]);

    // Set current category for 'all' item if no filter active
    if (!is_category()) {
        $cats = preg_replace('/cat-item-all/', 'cat-item-all current-cat', $cats, 1);
    }

    echo $cats;

    ?>
</section>
