<?php
function generatepress_child_enqueue_styles() {

    $parent_style = 'generatepress-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'generatepress-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_styles' );

//legger til webfont
function wpb_add_google_fonts() {

wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Permanent+Marker', false ); 
}

add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );


//Fjerner [taxonomy]: fra tittel på archive sider.
add_filter('get_the_archive_title', function ($title) {
  $title = explode(': ', $title);
  $title = "<span>" . $title[0] . " </span>" . $title[1];
    return $title;
});

//Sorterer post alfabetisk
function custom_get_posts( $query ) {

  if( is_archive() ) {
    $query->query_vars['orderby'] = 'name';
    $query->query_vars['order'] = 'ASC';
  }

  return $query;
}
add_filter( 'pre_get_posts', 'custom_get_posts' );
