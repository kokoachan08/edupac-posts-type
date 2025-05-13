<?php 
/*
Plugin Name: Edupac Posts Type
Description: This Plugin is collection of every Edupac Indonesia Posts Type 
Version: 1.3.0
Author: Hendra Sutrisno
Author URI: https://www.edupac-id.com/
*/


if(! defined('ABSPATH')){
    exit();
}

if(! defined('EDUPAC_POSTS_TYPE_PATH')){
    define('EDUPAC_POSTS_TYPE_PATH', plugin_dir_path(__FILE__));
}

if(! defined('EDUPAC_POSTS_TYPE_URL')){
    define('EDUPAC_POSTS_TYPE_URL', plugin_dir_url(__FILE__));
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once ABSPATH . 'wp-admin/includes/upgrade.php';


require_once EDUPAC_POSTS_TYPE_PATH . 'functions.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/plugin-activate.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/register-cpt.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-university.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-majors.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-programs.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-events.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-scholarships.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-study-abroad.php';

require_once EDUPAC_POSTS_TYPE_PATH . 'inc/single-short-course.php';

require_once EDUPAC_POSTS_TYPE_PATH . 'inc/meta-tags.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-university.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-programs.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-events.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-scholarships.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-study-abroad.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-eduxpert.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-short-course.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/form-majors.php';


require_once EDUPAC_POSTS_TYPE_PATH . 'inc/get-user-ip.php';

require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-university.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-majors.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-scholarships.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-programs.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-events.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-study-abroad.php';

require_once EDUPAC_POSTS_TYPE_PATH . 'inc/display-mba-consulting.php';


require_once EDUPAC_POSTS_TYPE_PATH . 'inc/sidebar-university.php';
require_once EDUPAC_POSTS_TYPE_PATH . 'inc/sidebar-study-abroad.php';


class edu003_postsType{

    function __construct(){
        add_action( 'init', array('edu003_registerCPT', 'register_menu_page'));
        
        add_shortcode('displayUniversity', array('edu003_displayUniversityCPT', 'displayUniversity'));
        add_shortcode('searchUniversity', array('edu003_displayUniversityCPT', 'searchUniversity'));

        add_shortcode('searchMBAUniversity', array('edu003_displayMBAConsulting', 'searchMBAUniversity'));

        add_shortcode('displayAllMajor', array('edu003_displayMajorsCPT', 'displayAllMajor'));
        add_shortcode('displayAllProgram', array('edu003_displayProgramsCPT', 'displayAllProgram'));
        add_shortcode('displayAllEvent', array('edu003_displayEventsCPT', 'displayAllEvent'));
        add_shortcode('displayAllScholarship', array('edu003_displayScholarshipsCPT', 'displayAllScholarship'));
        

        add_shortcode('topUniversityEduXpert', array('edu003_displayStudyAbroadCPT', 'topUniversityEduXpert'));
        add_shortcode('searchUniversityStudyAbroad', array('edu003_displayStudyAbroadCPT', 'searchUniversityStudyAbroad'));
        add_shortcode('topMajorEduXpert', array('edu003_displayStudyAbroadCPT', 'topMajorEduXpert'));
        add_shortcode('topDestinationEduXpert', array('edu003_displayStudyAbroadCPT', 'topDestinationEduXpert'));

        add_shortcode('displayMajorForm', array('edu003_majorForms', 'displayMajorForm'));
        add_shortcode('displayUniversityForm', array('edu003_universityForms', 'displayUniversityForm'));
        add_shortcode('displayProgramForm', array('edu003_programForm', 'displayProgramForm'));
        add_shortcode('displayEventForm', array('edu003_eventForm', 'displayEventForm'));
        add_shortcode('displayScholarshipForm', array('edu003_scholarshipForm', 'displayScholarshipForm'));
        add_shortcode('displayStudyAbroadForm', array('edu003_studyAbroadForms', 'displayStudyAbroadForm'));
        add_shortcode('displayEduXpertConsultationForm', array('edu003_eduXpertForms', 'displayEduXpertConsultationForm'));
        add_shortcode('displayShortCourseForm', array('edu003_shortCourseForms','displayShortCourseForm'));
        add_shortcode( 'display_programs', array('edu003_displayProgramsCPT', 'display_programs_shortcode'));

        
        add_shortcode('get_client_ip', array('edu003_getUserIP','get_client_ip'));

        add_filter( 'single_template', array('edu003_singleUniversity', 'override_single_template_university'));
        add_filter( 'single_template', array('edu003_singleMajors', 'override_single_template_majors'));
        add_filter( 'single_template', array('edu003_singlePrograms', 'override_single_template_programs'));
        add_filter( 'single_template', array('edu003_singleScholarships', 'override_single_template_scholarships'));
        add_filter( 'single_template', array('edu003_singleEvents', 'override_single_template_events'));
        add_filter( 'single_template', array('edu003_studyAboard', 'override_single_study_abroad'));
        add_filter( 'single_template', array('edu003_shortCourse', 'override_single_short_course'));

        add_filter('pre_get_document_title', array('edu003_metaTags','filter_university_meta_title'));
        add_filter('pre_get_document_title', array('edu003_metaTags','filter_majors_meta_title'));
        add_filter('pre_get_document_title', array('edu003_metaTags','filter_programs_meta_title'));
        add_filter('pre_get_document_title', array('edu003_metaTags','filter_study_abroad_meta_title'));
        add_filter('pre_get_document_title', array('edu003_metaTags','filter_university_page_meta_title'));
        add_filter('pre_get_document_title', array('edu003_metaTags','filter_majors_page_meta_title'));
        add_filter('pre_get_document_title', array('edu003_metaTags','filter_mba_university_page_meta_title'));

        add_action('wp_head', array('edu003_metaTags', 'custom_meta_tags'), 1);

    }
  

}

$eduPostsType = new edu003_postsType;

register_activation_hook(__FILE__, array('edu003_pluginActivate', 'activate'));


?>