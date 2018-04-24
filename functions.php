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
function superhero_get_posts( $query ) {

  if( is_archive() ) {
    $query->query_vars['orderby'] = 'name';
    $query->query_vars['order'] = 'ASC';
  }

  return $query;
}
add_filter( 'pre_get_posts', 'superhero_get_posts' );



//legger til taxonomy i søkefunksjon
//Hentet fra: https://wordpress.stackexchange.com/questions/2623/include-custom-taxonomy-term-in-search
function atom_search_where($where){
  global $wpdb;
  if (is_search())
    $where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
  return $where;
}

function atom_search_join($join){
  global $wpdb;
  if (is_search())
    $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
  return $join;
}

function atom_search_groupby($groupby){
  global $wpdb;

  // we need to group on post ID
  $groupby_id = "{$wpdb->posts}.ID";
  if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

  // groupby was empty, use ours
  if(!strlen(trim($groupby))) return $groupby_id;

  // wasn't empty, append ours
  return $groupby.", ".$groupby_id;
}

add_filter('posts_where','atom_search_where');
add_filter('posts_join', 'atom_search_join');
add_filter('posts_groupby', 'atom_search_groupby');
