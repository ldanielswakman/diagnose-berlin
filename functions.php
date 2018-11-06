<?php

function child_theme_setup() {
	// override parent theme's 'more' text for excerpts
	remove_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' ); 
}
add_action( 'after_setup_theme', 'child_theme_setup' );

function mychildtheme_enqueue_styles() {
    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/css/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'mychildtheme_enqueue_styles' );

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

		$html .= "<tr>";
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

			} else {

        // Other cells

        if($rowkey == 0) {
		  	  $html .= "<td><h3>" . $cell->nodeValue . "</h3></td>";
        } else {
          $html .= "<td>" . $cell->nodeValue . "</td>";
        }

			}
		endforeach;

		$html .= "</tr>";

    if($rowkey == 0) { $html .= '</thead>'; }

	endforeach;
	$html .= "</table>";

	return $html;

}


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

//featured post or most recent article function

function get_featured_or_recent_posts( $taxonomy_1 = 'post_tag', $taxonomy_2 = 'category', $recent_posts = array(), $total_posts = 3 ) {
    // First, make sure we are on an archive page, if not, bail
    if ( !is_category() )
        return false;

    // Sanitize and vaidate our incoming data
    if ( 'post_tag' !== $taxonomy_1 ) {
        $taxonomy_1 = filter_var( $taxonomy_1, FILTER_SANITIZE_STRING );
        if ( !taxonomy_exists( $taxonomy_1 ) )
            return false;
    }

    if ( 'category' !== $taxonomy_2 ) {
        $taxonomy_2 = filter_var( $taxonomy_2, FILTER_SANITIZE_STRING );
        if ( !taxonomy_exists( $taxonomy_2 ) )
            return false;
    }

    if ( 3 !== $total_posts ) {
        $total_posts = filter_var( $total_posts, FILTER_VALIDATE_INT );
            if ( !$total_posts )
                return false;
    }

    // Everything checks out and is sanitized, lets get the current post
    $current_post = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );

    // Lets get the first taxonomy's terms belonging to the post
    $terms_1 = get_the_terms( $current_post, $taxonomy_1 );

    // Set a varaible to hold the post count from first query
    $count = 0;
    // Set a variable to hold the results from query 1
    $q_1   = [];
    // Set a variable to hold the exclusions
    $sticky = get_option( 'sticky_posts' );
    $exclude = array_merge( [$current_post->ID], $sticky );
    $exclude = array_merge( $exclude, $recent_posts );

    // Make sure we have terms
    if ( $terms_1 ) {
        // Lets get the term ID's
        $term_1_ids = wp_list_pluck( $terms_1, 'term_id' );

        // Lets build the query to get related posts
        $args_1 = [
            'post_type'      => $current_post->post_type,
            'post__not_in'   => $exclude,
            'posts_per_page' => $total_posts,
            'fields'         => 'ids',
            'tax_query'      => [
                [
                    'taxonomy'         => $taxonomy_1,
                    'terms'            => $term_1_ids,
                    'include_children' => false
                ]
            ],
        ];
        $q_1 = get_posts( $args_1 );

        // Update our counter
        $count = count( $q_1 );
        // Update our counter
        $exclude = array_merge( $exclude, $q_1 );
    }

    // We will now run the second query if $count is less than $total_posts
    if ( $count < $total_posts ) {
        $terms_2 = get_the_terms( $current_post, $taxonomy_2 );
        // Make sure we have terms
        if ( $terms_2 ) {
            // Lets get the term ID's
            $term_2_ids = wp_list_pluck( $terms_2, 'term_id' );

            // Calculate the amount of post to get
            $diff = $total_posts - $count;                        

            $args_2 = [
                'post_type'      => $current_post->post_type,
                'post__not_in'   => $exclude,
                'posts_per_page' => $diff,
                'fields'         => 'ids',
                'category__in' => array( 239, 241 ),
                'tax_query'      => [
                    [
                        'taxonomy'         => $taxonomy_2,
                        'terms'            => $term_2_ids,
                        'include_children' => false,
                    ]
                ],
            ];
            $q_2 = get_posts( $args_2 );

            if ( $q_2 ) {
                // Merge the two results into one array of ID's
                $q_1 = array_merge( $q_1, $q_2 );

                // Update our post counter
                $count = count( $q_1 );

                // Update our counter
                $exclude = array_merge( $exclude, $q_2 );
            }
        }
    }

    // We will now run the third query if $count is less than $total_posts
    if ( $count < $total_posts ) {
        // Calculate the amount of post to get
        $diff = $total_posts - $count;

        $args_3 = [
            'post_type'      => $current_post->post_type,
            'post__not_in'   => $exclude,
            'posts_per_page' => $diff,
            'fields'         => 'ids',
        ];
        $q_3 = get_posts( $args_3 );

        if ( $q_3 ) {
            // Merge the two results into one array of ID's
            $q_1 = array_merge( $q_1, $q_3 );
        } else {

            $args_4 = [
                'post_type'      => 'any',
                'post__not_in'   => $exclude,
                'posts_per_page' => $diff,
                'fields'         => 'ids',
            ];
            $q_4 = get_posts( $args_4 );

            if ( $q_4 ) {
                // Merge the two results into one array of ID's
                $q_1 = array_merge( $q_1, $q_4 );
            }
        }
    }

    // Make sure we have an array of ID's
    if ( !$q_1 )
        return false;

    // Run our last query, and output the results
    $final_args = [
        'ignore_sticky_posts' => 1,
        'post_type'           => 'any',
        'posts_per_page'      => count( $q_1 ),
        'post__in'            => $q_1,
        'order'               => 'ASC',
        'orderby'             => 'post__in',
        'suppress_filters'    => true,
        'no_found_rows'       => true
    ];
    $final_query = new WP_Query( $final_args );

    return $final_query;
}