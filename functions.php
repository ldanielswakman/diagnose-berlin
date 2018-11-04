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

// Lightbox for Gravity Forms

function inline_popup_enabler(){
     ?>

<script>
(function($){
    $(window).load(function() {
      $('.test-popup-link').magnificPopup({
        type:'inline',
        midClick: true 
      });
    });
})(jQuery);
</script>
<?php
}
add_action('wp_footer', 'inline_popup_enabler');


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
