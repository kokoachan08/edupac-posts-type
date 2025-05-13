<?php 

class edu003_registerCPT{

    static function register_menu_page(){
        if(is_plugin_active('edupac-posts-type/edupac-posts-type.php')){
            register_post_type('events', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail'),
                'rewrite' => array('slug' => 'events'),
                'public' => true,
                'labels' => array(
                    'name' => 'Events',
                    'add_new_item' => 'Add New Event',
                    'edit_item' => 'Edit Event',
                    'all_item' => 'All Events',
                    'singular_name' => 'Event'
                ),
                'menu_icon' => 'dashicons-schedule'
            ));

            register_post_type('scholarships', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail'),
                'rewrite' => array('slug' => 'scholarships'),
                'public' => true,
                'labels' => array(
                    'name' => 'Scholarships',
                    'add_new_item' => 'Add New Scholarship',
                    'all_item' => 'All Scholarships',
                    'singular_name' => 'Scholarship'
                ),
                'menu_icon' => 'dashicons-awards'
            ));


            register_post_type('university', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail'),
                'rewrite' => array('slug' => 'university'),
                'public' => true,
                'labels' => array(
                    'name' => 'University',
                    'add_new_item' => 'Add New University',
                    'edit_item' => 'Edit University',
                    'all_item' => 'All University',
                    'singular_name' => 'University'
                ),
                'menu_icon' => 'dashicons-building',
                'taxonomies' => array( 'university_categories' )
            ));

            register_post_type('majors', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
                'rewrite' => array('slug' => 'majors'),
                'public' => true,
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'Majors',
                    'add_new_item' => 'Add New Major',
                    'edit_item' => 'Edit Major',
                    'all_item' => 'All Majors',
                    'singular_name' => 'Major'
                ),
                'menu_icon' => 'dashicons-welcome-learn-more',
                'taxonomies' => array( 'major_categories' )
            ));
            
            register_post_type('programs', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
                'rewrite' => array('slug' => 'programs'),
                'public' => true,
                'hierarchical' => true,
                'show_in_vc_editor' => true,
                'labels' => array(
                    'name' => 'Programs',
                    'add_new_item' => 'Add New Program',
                    'edit_item' => 'Edit Program',
                    'all_item' => 'All Programs',
                    'singular_name' => 'Program'
                ),
                'menu_icon' => 'dashicons-products'
            ));
            
            register_post_type('study-abroad', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
                'rewrite' => array('slug' => 'study-abroad'),
                'public' => true,
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'Study Abroad',
                    'add_new_item' => 'Add New Country',
                    'edit_item' => 'Edit Country',
                    'all_item' => 'All Country',
                    'singular_name' => 'Country'
                ),
                'menu_icon' => 'dashicons-flag'
            ));

            register_post_type('short-course', array(
                'show_in_rest' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
                'rewrite' => array('slug' => 'short-course'),
                'public' => true,
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'Short Course',
                    'add_new_item' => 'Add New Short Course',
                    'edit_item' => 'Edit Short Course',
                    'all_item' => 'All Short Course',
                    'singular_name' => 'Short Course'
                ),
                'menu_icon' => 'dashicons-groups'
            ));


            register_taxonomy('program_categories', array('programs'), array(
                'hierarchical' => true,
                'rewrite' => array('slug' => 'program-categories'),
                'show_admin_column' => true,
		        'show_in_rest' => true,
                'labels' => array(
                    'name' => 'Program Categories',
                    'all_items' => 'All Program Categories',
                    'add_new_item' => 'Add New Category',
                    'edit_item' => 'Edit Program Category',
                    'singular_name' => 'Program Category'
                )
            ));

            register_taxonomy('program_name', array('programs'), array(
                'hierarchical' => true,
                'rewrite' => false,
                'show_admin_column' => true,
		        'show_in_rest' => true,
                'labels' => array(
                    'name' => 'Program Name',
                    'all_items' => 'All Program Name',
                    'add_new_item' => 'Add New Program Name',
                    'edit_item' => 'Edit Program Name',
                    'singular_name' => 'Program Name'
                )
            ));


            register_taxonomy('major_categories', array('majors'), array(
                'hierarchical' => true,
                'rewrite' => array('slug' => 'major-categories'),
                'show_admin_column' => true,
		        'show_in_rest' => true,
                'labels' => array(
                    'name' => 'Major Categories',
                    'all_items' => 'All Major Categories',
                    'add_new_item' => 'Add New Category',
                    'edit_item' => 'Edit Major Category',
                    'singular_name' => 'Major Category'
                )
            ));

            register_taxonomy_for_object_type('major_categories', 'majors');


        }

    }

}




?>