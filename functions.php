<?php

function child_theme_setup() {
	// override parent theme's 'more' text for excerpts
	remove_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' ); 
}
add_action( 'after_setup_theme', 'child_theme_setup' );

add_post_type_support( 'page', 'excerpt' );

register_nav_menus( array(
	'footer_menu' => 'Footer Menu',
) );

// Custom function: parse Tablepress table
function parseTablePressTable($table) {

	$html = '';

	$doc = new DOMDocument();
	$doc->loadHTML($table);

	$tableNode = $doc->getElementsByTagName('table')->item(0);
	$html .= "<table class='table--comparison'>";
	
	$rows = $tableNode->getElementsByTagName('tr');
	foreach ($rows as $rowkey => $row) :

    if($rowkey == 0) { $html .= '<thead>'; }

		$html .= '<tr key="' . $rowkey . '">';
		$cells = $row->childNodes;
		$title = null;

		foreach ($cells as $key => $cell) :
			if ($key == 0) {
				$title = $cell->nodeValue;
			} else if($key == 1) {

        // Title cell

        if($rowkey == 0) {
          $html .= '<td class="title"></td>';
        } else {
  				$descr = $cell->nodeValue;

  				// $html .= title cell
  				$html .= '<td class="title">';
  					// Title
  					$html .= htmlspecialchars($title);
  					// Button
  					$html .= '<button onclick="toggleTooltip($(this))" class="button button--small button--circle button--grey">i</button>';
  					// Info box
  					$html .= '<div class="box box--info-tooltip" onclick="toggleTooltip($(this))">';
  						$html .= '<h3>' . $title . '</h3>';
  						$html .= '<p>' . $descr . '</p>';
  					$html .= '</div>';

  				$html .= '</td>';
        }

			} else if($key < $cells->length - 1) {

        // Other cells

        if($rowkey == 0) {
		  	  $html .= "<td><h3>" . $cell->nodeValue . "</h3></td>";
        } else {
          $html .= '<td key="' . $key . ' of ' . $cells->length . '">' . $cell->nodeValue . '</td>';
        }

			}
		endforeach;

		$html .= "</tr>";

    if($rowkey == 0) { $html .= '</thead>'; }

	endforeach;
	$html .= "</table>";

	return $html;

}




// Register translatable strings for polylang
add_action('init', function() {
  pll_register_string('Compare', 'Compare', 'Service Detail');
  pll_register_string('Contact us', 'Contact us for options', 'Service Detail');
  pll_register_string('Visit site', 'Visit site', 'Team');
  pll_register_string('Mehr info', 'Mehr info', 'Team');
  pll_register_string('Weniger info', 'Weniger info', 'Team');
});





add_filter( 'gform_pre_render_1', 'my_populate_checkbox' );

function my_populate_checkbox( $form ) {

    $pagename = get_query_var('pagename');  
    if ( !$pagename && $id > 0 ) {  
        // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object  
        $post = $wp_query->get_queried_object();  
        $pagename = $post->post_name;  
    }
   /**
   * Loop through form fields
   *
   * Note we are using the `$field` array as a direct reference using `&`. 
   * This means that changing its value will within the loop will 
   * change the corresponding `$form` array item
   */
  foreach( $form['fields'] as &$field ) {
    
    # Make sure to change `1` to the ID of the checkbox field that you want to pre-populate
    if( 2 === $field->id ) {
      
      /**
       * Loop through the choices for this checkbox
       *
       * Note again that we are passing `$choice` by reference in order to change the 
       * corresponding array item within the `$field` array
       */
      foreach( $field->choices as &$choice ) {
        
        /**
         * If this choice has a value of 'red' or 'blue', then make sure the checkbox is pre-checked
         * by setting the `isSelected` parameter to `true`
         */
        
        if( $pagename === $choice['value'] ) {
          $choice['isSelected'] = true;
        }
      } # end foreach: $field->choices
    } # end if: $field->id equals 2
  } # end foreach: $form['fields']
  
  # return the altered `$form` array to Gravity Forms
  return $form;
} # end: my_populate_checkbox

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


// remove width & height attributes from images
//
function remove_img_attr ($html)
{
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}
 
add_filter( 'post_thumbnail_html', 'remove_img_attr' );

//featured or recent posts

function get_featured_or_recent_posts( $taxonomy_1, $taxonomy_2, $total_posts ) {

    // Sanitize and vaidate our incoming data
   
        $taxonomy_1 = filter_var( $taxonomy_1, FILTER_SANITIZE_STRING );


        $taxonomy_2 = filter_var( $taxonomy_2, FILTER_SANITIZE_STRING );

  
        $total_posts = filter_var( $total_posts, FILTER_VALIDATE_INT );
 

    // Set a variable to hold the results from query 1
    $q_1   = [];
    // Set a variable to hold the exclusion
     $args_1 = [
            'posts_per_page' => 3,
            'fields'         => 'ids',
            'tax_query'      => [
                'relation' => 'AND',
                [
                    'taxonomy'         => 'category',
                    'field' => 'term_id',
                    'terms'            => $taxonomy_1,
                    'include_children' => false
                ],
                [
                    'taxonomy'         => 'category',
                    'field' => 'slug',
                    'terms'            => $taxonomy_2,
                    'include_children' => false
                ],
            ]
        ];

    $q_1 = get_posts( $args_1 );
    $count = count( $q_1 );
    $diff = $total_posts - $count;   
    $exclude  = [];
    $exclude = array_merge( $exclude, $q_1 );

    if($count < $total_posts) {
     $args_2 = [
            'posts_per_page' => $diff,
            'post__not_in'   => $exclude,
            'fields'         => 'ids',
            'category_name' => $taxonomy_2,
        ];
        $q_2 = get_posts( $args_2 ); 
        $q_1 = array_merge( $q_1, $q_2 );
    }



    // Make sure we have an array of ID's
   /* if ( !$q_1 )
        return false;*/
   

    // Run our last query, and output the results
    $final_args = [
        'ignore_sticky_posts' => 1,
        'post_type'           => 'any',
        'posts_per_page'      => 3,
        'post__in'            => $q_1,
        'order'               => 'ASC',
        'orderby'             => 'post__in',
        'suppress_filters'    => true,
        'no_found_rows'       => true
    ];


    $final_query = new WP_Query( $final_args );

    return $final_query;
}

//index page featured posts

function get_featured_posts($tax_1, $total_posts) {

        $tax_1 = filter_var( $tax_1, FILTER_SANITIZE_STRING );
  
        $total_posts = filter_var( $total_posts, FILTER_VALIDATE_INT );
    
    $q_1   = [];

     $args_1 = [
            'posts_per_page' => 3,
            'fields'         => 'ids',
            'tax_query'      => [
                'relation' => 'AND',
                [
                    'taxonomy'         => 'category',
                    'field' => 'slug',
                    'terms'            => 'featured',
                    'include_children' => false
                ],
                [
                    'taxonomy'         => 'category',
                    'field' => 'slug',
                    'terms'            => 'vorgestellt',
                    'include_children' => false
                ]
            ]
        ];

    $q_1 = get_posts( $args_1 );
    $count = count( $q_1 );
    $diff = $total_posts - $count;   
    $exclude  = [];
    $exclude = array_merge( $exclude, $q_1 );

    if($count < $total_posts) {
     $args_2 = [
            'posts_per_page' => $diff,
            'post__not_in'   => $exclude,
            'fields'  => 'ids'
        ];
        $q_2 = get_posts( $args_2 ); 
        $q_1 = array_merge( $q_1, $q_2 );
    }

        $final_args = [
        'ignore_sticky_posts' => 1,
        'post_type'           => 'any',
        'posts_per_page'      => 3,
        'post__in'            => $q_1,
        'order'               => 'ASC',
        'orderby'             => 'post__in',
        'suppress_filters'    => true,
        'no_found_rows'       => true
    ];


    $final_query = new WP_Query( $final_args );

    return $final_query;
}


// Woocommerce dynamic cart update
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;

  ob_start();

  ?>
  <a class="cart-customlocation" href="<?= esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?= sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?= $woocommerce->cart->get_cart_total(); ?></a>
  <?php
  $fragments['a.cart-customlocation'] = ob_get_clean();
  return $fragments;
}