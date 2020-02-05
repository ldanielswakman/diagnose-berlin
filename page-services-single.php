<?php
/**
 *  * Template Name: Single Service Page
 */

get_header() ?>

<?php while ( have_posts() ) : the_post() ?>

<?php $cover_url = (get_field('page_cover_image')) ? get_field('page_cover_image')['url'] : '' ?>

<section id="<?= $post->post_name ?>" class="section--intro load-fadein" style="background-image: url('<?= $cover_url?>');">
    <div class="col-xs-12 col-sm-6 col-md-6 content">
        <h1 class="c-highlight">
            <?php if(get_field('service_icon')) : ?>
                <img src="<?php the_field('service_icon') ?>" />
            <?php endif ?>
            <?php the_title() ?>
        </h1>
        <?php the_field('page_headline') ?>
        <?php the_field('page_intro_blurb') ?>
        <div class="button--toggle-group">
            <?php foreach(get_field('package_groups') as $key => $item): ?>
                <button class="button button--outline<?= $key == 0 ? ' isActive':'' ?>" onclick="togglePackages($(this), '<?= sanitize_title($item['group_title']) ?>')"><?= $item['group_title'] ?></button>
            <? endforeach ?>
        </div>
    </div>
</section>
<section id="packages" class="section--packages content load-movein-btm load-delay-1s">
    <div class="row">
        <?php
        if( have_rows('group_1_packages') ): 
        while( have_rows('group_1_packages') ): the_row(); 

        // vars
        $letter = get_sub_field('package_letter');
        $title = get_sub_field('package_title');
        $description = get_sub_field('package_description');
        $price = get_sub_field('package_price');
        $cta_text = get_sub_field('package_cta_text');
        $cta_link = get_sub_field('package_cta_link');
        $classes = '';
        if(get_sub_field('package_group')) {
            $classes .= ' col--grouped col--' . sanitize_title(get_sub_field('package_group'));
            $classes .= (get_sub_field('package_group') == get_field('package_groups')[0]['group_title']) ? '' : ' isHidden';
        }
        ?>
            <div class="col-xs-12 col-sm-6 col-lg-4 col--package<?= $classes ?>">
                <div class="box box--package">
                    <div class="box__header">
                        <h4><?php echo $letter ?></h4>
                        <h2><?php echo $title ?></h2>
                    </div>
                    <p><?php echo $description ?></p>
                    <div class="box__footer">
                        <div class="price"><?php echo $price ?></div><a href="<?php echo $cta_link ?>"><button class="button button--primary button--large"><?php echo $cta_text ?></button></a>
                    </div>
                </div>
            </div>
        <?php endwhile; endif ?>

        <?php if( get_field('group_1_table') ): ?>
            <div class="col-xs-12 package-actions">
                <button onclick="toggleComparison($(this))" class="button button--medium button--outline button--arrowright"><?= pll__('Compare', 'diagberl') ?></button>
                <a href="#contact-form" class="button button--medium button--blue" style="margin-left: 0.5rem;"><?= pll__('Contact us for options', 'diagberl') ?></a>
            </div>

            <?php $table_no = 1; include(locate_template('partials/service-comparison-table.php')) ?>
        <?php endif ?>

    </div>
</section>


<?php

// check if the repeater field has rows of data
if( have_rows('other_services') ):

    // loop through the rows of data
    while ( have_rows('other_services') ) : the_row() ?>

    <!-- // display a sub field value -->
    <section class="section--service load-movein-btm load-delay-1s">
        <div class="row row--nopadding" style="align-items: center;">
            <div class="col-xs-12 col-sm-6 image">
				<figure>
					<img src="<?php the_sub_field('service_image') ?>">
				</figure>
			</div>
			<div class="col-xs-12 col-sm-6 text">
          		<div class="box">
					<blockquote class="blockquote--big">
						<p><?php the_sub_field('service_title') ?></p>
					</blockquote>
					<p><?php the_sub_field('service_description') ?></p>
                    <?php if(strlen(get_sub_field('service_button_text')) > 0): ?>
    					<a href="<?php the_sub_field('service_button_link') ?>" class="button button--primary button--large"><?php the_sub_field('service_button_text') ?></a>
                    <?php endif ?>

				</div>
			</div>
		</div>
	</section>
<?php endwhile;

else :

    // no rows found

endif;
?>


<?php endwhile; // end of the loop. ?>
<?php get_footer();
