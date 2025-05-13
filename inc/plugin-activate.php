<?php 

class edu003_pluginActivate{
    static function activate(){
        // edu003_pluginActivate::create_pages_on_activate();
        flush_rewrite_rules();
    }

    // static function create_pages_on_activate(){

    //     if(!post_exists('University')){
    //         $university = array(
    //             'post_title' => wp_strip_all_tags('Partner University'),
    //             'post_name' => 'university',
    //             'post_content' => "[displayAllUniversity]",
    //             'post_status' => 'publish',
    //             'post_author' => get_the_author_meta( 'ID' ),
    //             'post_type' => 'page'
    //         );
    //         wp_insert_post($university);
    //     }

    //     if(!post_exists('Majors')){
    //         $majors = array(
    //             'post_title' => wp_strip_all_tags('Jurusan Kuliah di Luar Negeri'),
    //             'post_name' => 'majors',
    //             'post_content' => "[displayAllMajor]",
    //             'post_status' => 'publish',
    //             'post_author' => get_the_author_meta( 'ID' ),
    //             'post_type' => 'page'
    //         );
    //         wp_insert_post($majors);
    //     }
        
    //     if(!post_exists('Programs')){
    //         $majors = array(
    //             'post_title' => wp_strip_all_tags('Our Programs'),
    //             'post_name' => 'programs',
    //             'post_content' => "[displayAllProgram]",
    //             'post_status' => 'publish',
    //             'post_author' => get_the_author_meta( 'ID' ),
    //             'post_type' => 'page'
    //         );
    //         wp_insert_post($majors);

    //     }

    // }

}






?>