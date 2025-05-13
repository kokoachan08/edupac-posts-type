<?php 

class edu003_metaTags{

    static function reading_time() {
        global $post; 

        if($post){
            $content = get_post_field( 'post_content', $post->ID );
            $word_count = str_word_count( strip_tags( $content ) );
            $readingtime = ceil($word_count / 200);
            if ($readingtime == 1) {
                $timer = " minute";
            } else {
                $timer = " minutes";
            }
            $totalreadingtime = $readingtime . $timer;

            return $totalreadingtime;
        }
        
    }
    
    static function get_post_author_name() {
        global $post;
        if(!empty($post->post_author)){
            $author_id = $post->post_author;
        
            $author = ''. get_the_author_meta('display_name', $author_id);
            return $author;
        }
    }

    static function filter_university_meta_title($title) {
        if(is_singular('university')){
            $title = 'Kuliah di ' . get_the_title() . ': EduXpert Indonesia';
        }
        return $title;
    }
    static function filter_majors_meta_title($title){
        $university_majors = get_posts(array(
            'post_type' => 'university',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'university_majors',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE'
                )
            )
        ));

        if(is_singular('majors')){
            $title = count($university_majors) . ' Universitas yang Ada Jurusan ' . get_the_title(get_the_ID());
        }
        return $title;
    }
    static function filter_programs_meta_title($title){
        if(is_singular('programs')){
            $title = get_field('program_title') . ' - '. get_bloginfo();
        }
        return $title;
    }

    static function filter_study_abroad_meta_title($title){
        if(is_singular('study-abroad')){
            $title = 'Kuliah di '. get_the_title() .': Alasan, Biaya, Syarat & Daftar Universitas ';
        }
        return $title;
    }

    static function filter_university_page_meta_title($title){

        if(is_page(4351)){
            $title = 'EduXpert Indonesia: Konsultan Pendidikan Luar Negeri';
        }
        return $title;
    }

    static function filter_mba_university_page_meta_title($title){

        if(is_page(10833)){
            $title = 'MBA Consulting by EduXpert Indonesia';
        }
        return $title;
    }

    static function filter_majors_page_meta_title($title){
        if(is_page(4352)){
            $title = totalRecords('majors') . ' Jurusan Kuliah Terbaik di Luar Negeri ' .':'. ' EduXpert Indonesia';
        }
        return $title;
    }

    static function custom_meta_tags(){
        global $post;
        $university_majors = get_posts(array(
            'post_type' => 'university',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'university_majors',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE'
                )
            )
        ));

        $output = '';
   
        $output .= '<!-- META TAGS CUSTOM -->';
        $output .= '<link rel="canonical" href="'.get_permalink().'">';
        $output .= '<meta name="googlebot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">';
        $output .= '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">';
        $output .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        if(!empty($post->post_author)){
            $output .= '<meta name="author" content="'.esc_html(edu003_metaTags::get_post_author_name()).'">';
        }
        $output .= '<meta http-equiv="Reply-to" content="hendrasutrisno@edupac-id.com">';
        $output .= '<meta name="rating" content="general">';
        if(is_singular('university')){
            $output .= '<meta name="description" content="'.esc_html('Ingin kuliah di ' . get_the_title() . '? Yuk, pelajari info lengkap tentang ' . get_the_title() . ', kenapa kuliah disini, jurusan, dan syarat masuk terbarunya!').'">';
            $output .= '<meta property="og:description" content="'.esc_html('Ingin kuliah di ' . get_the_title() . '? Yuk, pelajari info lengkap tentang ' . get_the_title() . ', kenapa kuliah disini, jurusan, dan syarat masuk terbarunya!').'">';
            $output .= '<meta property="og:title" content="'.esc_html( 'Kuliah di ' . get_the_title()  . ':' . ' EduXpert Indonesia' ).'">';
        } else if(is_singular('programs')){
            $output .= '<meta property="og:title" content="'.esc_html(get_field('program_title') . ' - '. get_bloginfo()).'">';
        } else if(is_singular('majors')){
            $output .= '<meta name="description" content="'.esc_html('Ingin kuliah jurusan ' . get_the_title() . '? Berikut adalah pengertian, prospek kerja & ' . count($university_majors) . ' universitas yang menyediakan jurusan ' . get_the_title()).'!">';
            $output .= '<meta property="og:description" content="'.esc_html('Ingin kuliah jurusan ' . get_the_title() . '? Berikut adalah pengertian, prospek kerja & ' . count($university_majors) . ' universitas yang menyediakan jurusan ' . get_the_title()).'!">';
            $output .= '<meta property="og:title" content="'.esc_html(count($university_majors) . ' Universitas yang Ada Jurusan '. get_the_title(get_the_ID())).'">';
        } else if(is_singular('study-abroad')){
            $output .= '<meta name="description" content="'.esc_html('Ingin kuliah di ' . get_the_title() . '? Berikut adalah panduan kuliah di ' . get_the_title() . ' Lengkap berserta Biaya Kuliah, Persyaratan, & Daftar Universitas!').'">';
            $output .= '<meta property="og:description" content="'.esc_html('Ingin kuliah di ' . get_the_title() . '? Berikut adalah panduan kuliah di ' . get_the_title() . ' Lengkap berserta Biaya Kuliah, Persyaratan, & Daftar Universitas!').'">';
            $output .= '<meta property="og:title" content="'.esc_html('Kuliah di '. get_the_title() .': '. 'Alasan, Biaya, Syarat & Daftar Universitas ').'">';
        } else if(is_page(4352)){
            $output .= '<meta name="description" content="'.esc_html('Ingin kuliah ke luar negeri tapi masih binggung mau ambil jurusan apa? Berikut adalah ' . totalRecords('majors') . ' jurusan kuliah di luar negeri favorit berserta info universitas yang menyediakannya!').'">';
            $output .= '<meta property="og:description" content="'.esc_html('Ingin kuliah ke luar negeri tapi masih binggung mau ambil jurusan apa? Berikut adalah ' . totalRecords('majors') . ' jurusan kuliah di luar negeri favorit berserta info universitas yang menyediakannya!').'">';
            $output .= '<meta property="og:title" content="'.esc_html( totalRecords('majors') . ' Jurusan Kuliah Terbaik di Luar Negeri' . ' : ' . 'EduXpert Indonesia').'">';
        } else if(is_page(10833)){
            $output .= '<meta property="og:title" content="'.esc_html( 'MBA Consulting by EduXpert Indonesia' ).'">';
        }
        else{
            $output .= '<meta property="og:title" content="'.esc_html( get_the_title() . ' - ' . get_bloginfo() ).'">';
        }
        $output .= '<meta property="og:url" content="'.esc_html(get_permalink()).'">';
        $output .= '<meta property="og:locale" content="id_ID">';
        $output .= '<meta property="og:type" content="article">';
        if(has_post_thumbnail()){
            $output .= '<meta property="og:image" content="'.esc_html(wp_get_attachment_url( get_post_thumbnail_id($post->ID))).'">';
        }
        $output .= '<meta property="og:site_name" content="'.esc_html(get_bloginfo( 'name' )).'">';
        $output .= '<meta property="article:published_time" content="'.esc_html(get_the_date('Y-m-d')).'">';
        $output .= '<meta property="article:modified_time" content="'.esc_html(get_the_modified_date('Y-m-d')).'">';
        $output .= '<meta name="twitter:card" content="summary_large_image">';
        $output .= '<meta name="twitter:label1" content="Written by">';
        $output .= '<meta name="twitter:data1" content="'.esc_html(edu003_metaTags::get_post_author_name()).'">';
        $output .= '<meta name="twitter:label2" content="Est. reading time">';
        $output .= '<meta name="twitter:data2" content="'.esc_html(edu003_metaTags::reading_time()).'">';
        $output .= '<!--/ META TAGS CUSTOM -->';
        
        echo $output;
    }



}


?>