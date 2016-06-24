<?php
add_action( 'init', 'create_post_type' );
function create_post_type()
{
    register_post_type('society',
        array(
            'labels' => array(
                'name' => __('Общество'),
                'singular_name' => __('общественное событие'),
                'add_new' => __('Добавить общественное событие'),
                'add_new_item' => __('Добавить новое общественное событие'),
                'edit_item' => __('Редактировать общественное событие'),
                'new_item' => __('Новое общественное событие'),
                'view_item' => __('Просмотр общественного события'),
                'search_items' => __('Искать общественное событие'),
                'not_found' => __('Общественное событиене найдено'),
                'not_found_in_trash' => __('Общественное событие в корзине не найдено'),
                'parent_item_colon' => '',
                'menu_name' => 'Общество'
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_nav_menus' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 6,
            'supports' => array('title', 'revisions','comments','editor'),
        )
    );

    register_post_type('events',
        array(
            'labels' => array(
                'name' => __('События'),
                'singular_name' => __('Событие'),
                'add_new' => __('Добавить событие'),
                'add_new_item' => __('Добавить новое событие'),
                'edit_item' => __('Редактировать событие'),
                'new_item' => __('Новое событие'),
                'view_item' => __('Просмотр события'),
                'search_items' => __('Искать событие'),
                'not_found' => __('Событие не найдено'),
                'not_found_in_trash' => __('Событие в корзине не найдено'),
                'parent_item_colon' => '',
                'menu_name' => 'События'
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_nav_menus' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 6,
            'supports' => array('title', 'revisions','comments','editor'),
        )
    );

    register_post_type('map-pins',
        array(
            'labels' => array(
                'name' => __('Места на карте'),
                'singular_name' => __('Место'),
                'add_new' => __('Добавить место'),
                'add_new_item' => __('Добавить новое место'),
                'edit_item' => __('Редактировать место'),
                'new_item' => __('Новое место'),
                'view_item' => __('Просмотр места'),
                'search_items' => __('Искать место'),
                'not_found' => __('Место не найдено'),
                'not_found_in_trash' => __('Мест в корзине не найдено'),
                'parent_item_colon' => '',
                'menu_name' => 'Места на карте'
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_nav_menus' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 6,
            'supports' => array('title'),
        )
    );

    register_taxonomy_for_object_type('society-events','society');
}

add_action( 'init', 'create_book_taxonomies', 0 );

function create_book_taxonomies() {
    $labels = array(
        'name'              => _x( 'Категории', 'taxonomy general name' ),
        'singular_name'     => _x( 'Категория', 'taxonomy singular name' ),
        'search_items'      => __( 'Искать категории' ),
        'all_items'         => __( 'Все категории' ),
        'parent_item'       => __( 'Родительская категория' ),
        'parent_item_colon' => __( 'Родительская категория:' ),
        'edit_item'         => __( 'Редактировать категорию' ),
        'update_item'       => __( 'Обновить категорию' ),
        'add_new_item'      => __( 'Добавить новую категорию' ),
        'new_item_name'     => __( 'Имя новой категории' ),
        'menu_name'         => __( 'Категория' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'society/cat' ),
    );

    register_taxonomy( 'society-events', array( 'society' ), $args );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'category' ),
    );

//    register_taxonomy( 'events-category', 'events', $args );
}
//unregister_taxonomy_for_object_type( 'category', 'society' );