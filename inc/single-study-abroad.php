<?php

class edu003_studyAboard{

    
    static function override_single_study_abroad( $single_template_study_abroad){

        global $post;
    
        if( $post->post_type === 'study-abroad'){

            $single_template_study_abroad  = dirname(__FILE__) .'/templates/single-study-abroad.php';
            
            get_header();
            
            ?>
            <div class="container-fluid p-0">
                <div class="row">
                    <?php if (has_post_thumbnail($post->ID)): 
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        $featured_image_caption = wp_get_attachment_caption(get_post_thumbnail_id($post->ID));
                        $alt_text = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                    ?>
                    <div style="position: relative;">
                        <div style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
                        <img class="img-fluid w-100" style="height: 250px; object-fit: cover; position: relative; z-index: 2; opacity: 0.6;" src="<?php echo $featured_image[0]; ?>" alt="<?php echo esc_attr($alt_text); ?>">
                        <h1 class="text-white carousel-caption display-6 text-uppercase font-weight-bold" style="text-shadow: 2px 2px #000;">
                            Kuliah di <?php the_title(); ?>
                        </h1>
                    </div>
                    <?php else: ?>
                        <div style="position: relative;">
                            <div style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
                            <div class="img-fluid w-100" style="height: 250px; object-fit: cover; position: relative; z-index: 2; opacity: 0.6;"></div>
                            <h1 class="text-white carousel-caption display-6 text-uppercase font-weight-bold" style="text-shadow: 2px 2px #000;">
                                Kuliah di <?php the_title(); ?>
                            </h1>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <ul class="nav nav-tabs bg-primary bg-gradient text-center col-12 p-0" role="tablist">
                    <?php
                        $tabs = [
                            'tentang-negara' => ['dashicons dashicons-flag', 'Tentang Negara'],
                            'biaya-kuliah' => ['dashicons-money-alt', 'Biaya Kuliah'],
                            'kenapa-kuliah' => ['dashicons-lightbulb', 'Alasan Kuliah'],
                            'syarat-kuliah' => ['dashicons-list-view', 'Syarat Kuliah'],
                            'daftar-universitas' => ['dashicons-welcome-learn-more', 'Daftar Universitas'],
                            'scholarships' => ['dashicons-feedback', 'Scholarships']
                        ];
                        $first = true;
                        foreach ($tabs as $id => $data) {
                            $active_class = $first ? 'active show' : '';
                            $first = false;
                            ?>
                            <li class="nav-item px-0 col-6 col-md-4">
                                <a class="nav-link text-white <?php echo $active_class; ?>" data-bs-toggle="tab" href="#<?php echo esc_attr($id); ?>" role="tab">
                                    <span class="dashicons <?php echo esc_attr($data[0]); ?>"></span>
                                    <span><?php echo esc_html($data[1]); ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>


            <div class="row">
                <div id="wrapper">
                    <div class="d-flex">
                    <?php echo edu003_sidebarStudyAbroad::renderSidebarStudyAbroad(); ?>
                        <div id="main-wrapper" class="d-flex flex-column p-0 flex-grow-1">
                            <nav id="navbar-wrapper" class="navbar navbar-expand-lg navbar-light bg-light">
                                <div class="container-fluid">
                                    <div class="col-2">
                                        <div class="navbar-header">
                                            <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                                        </div>
                                    </div>
                                    <div id="apply-button" class="col-10">
                                        <button type="button" class="btn btn-sm btn-block blinkbtn text-white popmake-9358">Study to <?php the_title();?> Now!</button>
                                    </div>
                                </div>
                            </nav>

                            <div id="content-wrapper" class="p-4">
                                <div class="tab-content">
                                    <div id="tentang-negara" class="tab-pane fade show active">
                                        <?php 
                                            $post_id = get_the_ID(); // Mendapatkan ID Post
                                            $author_id = get_post_field('post_author', $post_id); // Mendapatkan ID Penulis
                                            $author_name = get_the_author_meta('display_name', $author_id); // Mendapatkan Nama Penulis
                                        ?>

                                        <div class="row py-3 align-items-center">
                                            <!-- Nama Penulis dengan Dashicons -->
                                            <div class="col-12 col-md-6 order-1 order-md-1 text-start text-md-end d-flex align-items-center mb-2 mb-md-0">
                                                <span class="dashicons dashicons-admin-users me-2"></span>
                                                <span class="author-name">Author: <?php echo esc_html($author_name); ?></span>
                                            </div>

                                            <!-- Shortcode Post Views -->
                                            <div class="col-12 col-md-6 order-2 order-md-2 text-start text-md-start">
                                                <span class="post-views">
                                                    <?php echo do_shortcode('[post-views]'); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <h2>Tentang Kuliah di <?php the_title(); ?></h2>
                                        <?php the_content(); ?>
                                    </div>
                                    <div id="biaya-kuliah" class="tab-pane fade">
                                        <h2>Biaya Kuliah di <?php the_title(); ?></h2>
                                        <?php the_field('estimated_price'); ?>
                                    </div>
                                    <div id="kenapa-kuliah" class="tab-pane fade">
                                        <h2>Alasan Kuliah di <?php the_title(); ?></h2>
                                        <?php the_field('why_study_here'); ?>
                                    </div>
                                    <div id="syarat-kuliah" class="tab-pane fade">
                                        <h2>Syarat Kuliah di <?php the_title(); ?></h2>
                                        <?php the_field('study_abroad_requirements'); ?>
                                    </div>
                                    <div id="daftar-universitas" class="tab-pane fade">
                                        <div class="row">
                                            <h2>Daftar Universitas di <?php the_title(); ?></h2>

                                            <?php
                                            $university_lists = get_posts(array(
                                                'post_type' => 'university',
                                                'posts_per_page' => -1,
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'university_location',
                                                        'value' => '"' . get_the_ID() . '"',
                                                        'compare' => 'LIKE'
                                                    )
                                                )
                                            ));

                                            if ($university_lists) {

                                                foreach ($university_lists as $university_list) {
                                                    $permalink = get_permalink($university_list->ID);
                                                    $alt_text = get_post_meta(get_post_thumbnail_id($university_list->ID), '_wp_attachment_image_alt', true);
                                                    $get_university_logo = get_field('university_logo', $university_list->ID);
                                                    ?>  
                                                    <a href="<?php echo $permalink; ?>" class="text-decoration-none my-3">
                                                        <div class="card h-100">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-start">
                                                                    <!-- Gambar di kiri -->
                                                                    <div class="me-3">
                                                                        <?php echo wp_get_attachment_image($get_university_logo, "medium", "", array("class" => "img-responsive")); ?>
                                                                    </div>
                                                                    
                                                                    <!-- Nama Universitas dan Deskripsi di kanan -->
                                                                    <div class="text-justify">
                                                                        <h3 class="mb-2"><?php echo $university_list->post_title; ?></h3>  
                                                                        <p class="mb-0 text-muted">
                                                                            <?php echo wp_trim_words(($university_list->post_content), 20); ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div id="scholarships" class="tab-pane fade">
                                        <h2 style="text-align: center;">Beasiswa di <?php the_title(); ?></h2>
                                        <?php 
                                            $lists = get_posts(array(
                                                'post_type' => 'university',
                                                'posts_per_page' => -1,
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'university_location',
                                                        'value' => '"' . get_the_ID() . '"',
                                                        'compare' => 'LIKE'
                                                    )
                                                )
                                            ));

                                            $items = array();

                                            if(!empty($lists)){
                                                foreach($lists as $list){

                                                    $scholarships = get_posts(array(
                                                        'post_type' => 'scholarships',
                                                        'post_per_page' => -1,
                                                        'meta_key' => 'scholarship_date_scholarship_date_start',
                                                        'orderby' => 'meta_value',
                                                        'order'  => 'ASC',
                                                        'meta_query' => array(
                                                            array(
                                                            'key' => 'participating_university',
                                                            'value' => $list->ID,
                                                            'compare' => 'LIKE'
                                                            )
                                                        )
                                                    ));
                                                
                                                    foreach($scholarships as $scholarship){
                                                        $items[] = $scholarship->ID;
                                                    }
                                                    
                                                    $results = array_unique($items);
                                                }

                                                $index = array();

                                                foreach($results as $result){
                                                    $scholarship_date = get_field('scholarship_date', $result);

                                                    if(strtotime(current_time('mysql')) < strtotime($scholarship_date["scholarship_date_end"])){
                                                        $index[] = $result;
                                                        $beasiswa = array_slice($index, 0, 3, true);
                                                    }
                                                }

                                                if(!empty($beasiswa)){
                                                    foreach($beasiswa as $beasiswa_id){
                                                        $tanggal_beasiswa = get_field('scholarship_date', $beasiswa_id);
                                                    ?>
                                                        <ul class="list-group my-3">
                                                            <a href="<?php echo get_permalink($beasiswa_id); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                                                <div class="w-100 justify-content-between">
                                                                    <h3><?php echo get_the_title($beasiswa_id); ?></h3>
                                                                    <small>
                                                                        <?php
                                                                            $current_time = strtotime(current_time('mysql'));
                                                                            $scholarship_end = strtotime($tanggal_beasiswa["scholarship_date_end"]);
                                                                            $scholarship_start = strtotime($tanggal_beasiswa["scholarship_date_start"]);

                                                                            $how_log_ago = '';
                                                                            $seconds = $scholarship_end - $current_time; 
                                                                            $minutes = (int)($seconds / 60);
                                                                            $hours = (int)($minutes / 60);
                                                                            $days = (int)($hours / 24);
                                                                            if ($days >= 1) {
                                                                                $how_log_ago = $days . ' day' . ($days != 1 ? 's' : '') . ' left';
                                                                            } else if ($hours >= 1) {
                                                                                $how_log_ago = $hours . ' hour' . ($days != 1 ? 's' : '') . ' left';
                                                                            } else if ($minutes >= 1) {
                                                                                $how_log_ago = $minutes . ' minute' . ($days != 1 ? 's' : '') . ' left';
                                                                            } else if($seconds >= 1) {
                                                                                $how_log_ago = $seconds . ' second' . ($days != 1 ? 's' : '') . ' left';
                                                                            } else {
                                                                                $how_log_ago = 'ongoing';
                                                                            }

                                                                            if($scholarship_start > $current_time){
                                                                                echo 'Start Date: ' . date('j F Y', $scholarship_start);
                                                                            } else {
                                                                                echo 'End Date: ' . date('j F Y', $scholarship_end) . ' — ' . $how_log_ago;
                                                                            }
                                                                        ?>
                                                                    </small>
                                                                    <p class="mb-1"><?php echo wp_trim_words(do_shortcode(get_post_field('post_content', $beasiswa_id)), 15); ?></p>
                                                                </div>
                                                        
                                                            </a>

                                                        </ul>
                                                        <?php
                                                    }

                                                } else {
                                                    ?>
                                                    <div class="edu-container">
                                                        <p style="text-align: center;">Sorry! there is no ongoing scholarship available.</p>
                                                    </div>
                                                    <?php
                                                }
                                                
                                            } else{
                                                ?>
                                                <div class="edu-container">
                                                    <p style="text-align: center;">Sorry! there is no ongoing scholarship available.</p>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <?php

            get_footer();
    
            exit;
        
        }
     
        return $single_template_study_abroad;
    }
}




?>