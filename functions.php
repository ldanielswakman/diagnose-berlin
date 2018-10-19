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
