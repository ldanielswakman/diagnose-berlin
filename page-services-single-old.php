<?php
/**
 *  * Template Name: Single Service Page
 */

get_header(); ?>

<?php //while ( have_posts() ) : the_post(); ?>

<section id="intro" class="load-fadein">
    <div class="col-xs-12 col-sm-6 col-md-6 content">
        <h1 class="c-highlight">
            <img src="<?php the_field('service_icon'); ?>" />
            <?php the_title(); ?>
        </h1>
        <?php the_field('page_headline'); ?>
        <?php the_field('page_intro_blurb'); ?>
        <?php 
            if (get_field('package_groups') === 'one') {
                //do nothing
            } elseif ('two' == get_field('package_groups')) { ?>
            <div class="button--toggle-group">
                <button class="button button--blue button--large isActive" onclick="togglePackages($(this), 'packages1')">
                    Für&nbsp;<strong><?php the_field('group_1_name'); ?></strong>
                </button>
                <button class="button button--outline button--large" onclick="togglePackages($(this), 'packages2')">
                    Für&nbsp;<strong><?php the_field('group_2_name'); ?></strong>
                </button>
            </div>
        <?php }	?>
    </div>
</section>
<section id="packages1" class="section--packages content load-movein-btm load-delay-1s">
    <div class="row">
        <?php if( have_rows('group_1_packages') ): 
        while( have_rows('group_1_packages') ): the_row(); 

        // vars
        $letter = get_sub_field('package_letter');
        $title = get_sub_field('package_title');
        $description = get_sub_field('package_description');
        $price = get_sub_field('package_price');
        $cta_text = get_sub_field('package_cta_text');
        $cta_link = get_sub_field('package_cta_link');
        ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="box box--package">
                <div class="box__header">
                    <h4><?php echo $letter; ?></h4>
                    <h2><?php echo $title; ?></h2>
                </div>
                <p><?php echo $description; ?></p>
                <div class="box__footer">
                    <div class="price"><?php echo $price; ?></div>
                    <a href="<?php echo $cta_link; ?>"><button class="button button--primary button--large"><?php echo $cta_text; ?></button></a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <?php endif; ?>

        <div class="col-xs-12" style="text-align: center; margin: 1rem 0;">
            <button onclick="toggleComparison($(this))" class="button button--outline button--arrowright">Vergleichen</button>
        </div>

    </div>

    <?php $table_no = 1; include(locate_template('partials/service-comparison-table.php')); ?>

</section>
<section id="packages2" class="section--packages content load-movein-btm load-delay-1s isHidden">
    <div class="row">
        <?php if( have_rows('group_2_packages') ): 
        while( have_rows('group_2_packages') ): the_row(); 

        // vars
        $letter = get_sub_field('g2_package_letter');
        $title = get_sub_field('g2_package_title');
        $description = get_sub_field('g2_package_description');
        $price = get_sub_field('g2_package_price');
        $cta_text = get_sub_field('g2_package_cta_text');
        $cta_link = get_sub_field('g2_package_cta_link');
        ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="box box--package">
                <div class="box__header">
                    <h4><?php echo $letter; ?></h4>
                    <h2><?php echo $title; ?></h2>
                </div>
                <p><?php echo $description; ?></p>
                <div class="box__footer">
                    <div class="price"><?php echo $price; ?></div>
                    <a href="<?php echo $cta_link; ?>"><button class="button button--primary button--large"><?php echo $cta_text; ?></button></a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <?php endif; ?>

        <div class="col-xs-12" style="text-align: center; margin: 1rem 0;">
            <button onclick="toggleComparison($(this))" class="button button--outline button--arrowright">Vergleichen</button>
        </div>

    </div>

    <?php
    if(get_field('package_groups') == 'two'):
        $table_no = 2;
        include(locate_template('partials/service-comparison-table.php'));
    endif;
    ?>

    </div>
</section>
<?php

// check if the repeater field has rows of data
if( have_rows('other_services') ):

    // loop through the rows of data
    while ( have_rows('other_services') ) : the_row(); ?>

    <!-- // display a sub field value -->
    <section id="" class="content load-movein-btm load-delay-1s">
        <div class="row row--nopadding">
            <div class="col-xs-12 col-sm-6 last-sm">
				<figure>
					<img src="<?php the_sub_field('service_image'); ?>">
				</figure>
			</div>
			<div class="col-xs-12 col-sm-6" style="margin-right: -5rem;">
          		<div class="box">
					<blockquote class="blockquote--big">
						<p><?php the_sub_field('service_title'); ?></p>
					</blockquote>
					<p><?php the_sub_field('service_description'); ?></p>
					<a href="<?php the_sub_field('service_button_link'); ?>" class="button button--primary button--large"><?php the_sub_field('service_button_text'); ?></a>
				</div>
			</div>
		</div>
	</section>
<?php endwhile;

else :

    // no rows found

endif;
?>


<?php //endwhile; // end of the loop. ?>
<?php get_footer();
