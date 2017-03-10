<?php

// Create custom post type with category and taxonomies

/**
 * Plugin Name: Deals
 * Plugin URI: http://phpverge.com
 * Description: This plugin add deals to your website.
 * Version: 1.0.0
 * Author: Sunny Khatri
 * Author URI: http://phpverge.com
 */

function register_cpt_deals() {
 
    $labels = array(
        'name' => _x( 'Deal', 'deals' ),
        'singular_name' => _x( 'Deal', 'deals' ),
        'add_new' => _x( 'Add New', 'deals' ),
        'add_new_item' => _x( 'Add New Deal', 'deals' ),
        'edit_item' => _x( 'Edit Deal', 'deals' ),
        'new_item' => _x( 'New Deal', 'deals' ),
        'view_item' => _x( 'View Deal', 'deals' ),
        'search_items' => _x( 'Search Deal', 'deals' ),
        'not_found' => _x( 'No deal found', 'deals' ),
        'not_found_in_trash' => _x( 'No deals found in Trash', 'deals' ),
        'parent_item_colon' => _x( 'Parent deal:', 'deals' ),
        'menu_name' => _x( 'Deals', 'deals' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Deals filterable by genre',
        'supports' => array( 'title','thumbnail',  'revisions'),
        'taxonomies' => array( 'genres','dealtag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-tickets-alt',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
    );
 
    register_post_type( 'deals', $args );
}
add_action( 'init', 'register_cpt_deals' );
 
function genres_taxonomy() {
    register_taxonomy(
        'deal_category',
        'deals',
        array(
            'hierarchical' => true,
            'label' => 'Deal Category',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'genres_taxonomy');

/*function create_deals_pages()
{
$post = array(
      'comment_status' => 'closed',
      'ping_status' =>  'closed' ,
      'post_date' => date('Y-m-d H:i:s'),
      'post_name' => 'deals',
      'post_status' => 'publish' ,
      'post_title' => 'Deals',
      'post_type' => 'page',
);
$newvalue = wp_insert_post( $post, false );
update_option( 'mrpage', $newvalue );
  }
register_activation_hook( __FILE__, 'create_deals_pages');*/

add_action( 'init', 'create_dltg_taxonomies', 0 );
// create two taxonomies, genres and writers for the post type "book"
function create_dltg_taxonomies() {
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'DealTags', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'DealTag', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Tag', 'textdomain' ),
        'popular_items'              => __( 'Popular Tags', 'textdomain' ),
        'all_items'                  => __( 'All Tags', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Tag', 'textdomain' ),
        'update_item'                => __( 'Update Tag', 'textdomain' ),
        'add_new_item'               => __( 'Add New Tag', 'textdomain' ),
        'new_item_name'              => __( 'New Tag Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate tag with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove tags', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used tags', 'textdomain' ),
        'not_found'                  => __( 'No tags found.', 'textdomain' ),
        'menu_name'                  => __( 'Tags', 'textdomain' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'dealtag' ),
    );

    register_taxonomy( 'dealtag', 'deals', $args );
}

?>
