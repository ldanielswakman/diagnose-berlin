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
	foreach ($rows as $row) :

		$html .= "<tr>";
		$cells = $row->childNodes;
		$title = null;

		foreach ($cells as $key => $cell) :
			if ($key == 0) {
				$title = $cell->nodeValue;
			} else if($key == 1) {

				$descr = $cell->nodeValue;

				// $html .= title cell
				$html .= '<td class="title">';
					// Title
					$html .= $title;
					// Button
					$html .= '<button onclick="toggleTooltip($(this))" class="button button--small button--circle button--grey">i</button>';
					// Info box
					$html .= '<div class="box box--info-tooltip" onclick="toggleTooltip($(this))">';
						$html .= '<h3>' . $title . '</h3>';
						$html .= '<p>' . $descr . '</p>';
					$html .= '</div>';

				$html .= '</td>';

			} else {
		  	$html .= "<td>" . $cell->nodeValue . "</td>";
			}
		endforeach;

		$html .= "</tr>";

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

// Prefill first form question based on page


add_filter( 'gform_field_value', 'populate_fields', 2 );
function populate_fields( $value, $field, $name ) {
 $pagename = get_query_var('pagename');  
    if ( !$pagename && $id > 0 ) {  
        // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object  
        $post = $wp_query->get_queried_object();  
        $pagename = $post->post_name;  
    }
    
    $values = array(
        'field_one'   => 'value one',
        'field_two'   => 'value two',
        'field_three' => 'value three',
    );
 
    return isset( $values[ $name ] ) ? $values[ $name ] : $value;
}
