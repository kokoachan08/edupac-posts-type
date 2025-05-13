<?php

class edu003_singleUniversity {

    static function override_single_template_university($single_template_university) {
        global $post;

        if ($post->post_type === 'university') {

            $single_template_university = dirname(__FILE__) . '/templates/single-university.php';
            
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
                <div class="row">
                    <ul class="nav nav-tabs bg-primary bg-gradient text-center col-12 p-0" role="tablist" style="scrollbar-width: none; -ms-overflow-style: none;">
                        <?php
                        $tabs = [
                            'tentang-universitas' => ['dashicons-welcome-learn-more', 'Tentang Universitas'],
                            'biaya-kuliah' => ['dashicons-money-alt', 'Biaya Kuliah'],
                            'kenapa-kuliah' => ['dashicons-lightbulb', 'Alasan Kuliah'],
                            'syarat-masuk' => ['dashicons-list-view', 'Syarat Masuk'],
                            'jurusan-kuliah' => ['dashicons-book-alt', 'Jurusan Kuliah'],
                            'event-n-scholarships' => ['dashicons-feedback', 'Event & Scholarships']
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
                            <?php echo edu003_sidebarUniversity::renderSidebarUniversity(); ?>

                            <div id="main-wrapper" class="d-flex flex-column p-0 flex-grow-1">
                                <!-- Navbar -->
                                <nav id="navbar-wrapper" class="navbar navbar-expand-lg navbar-light bg-light">
                                    <div class="container-fluid">
                                        <div class="col-2">
                                            <div class="navbar-header">
                                                <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                                            </div>
                                        </div>
                                        <div id="apply-button" class="col-10">
                                            <button type="button" class="btn btn-sm btn-block blinkbtn text-white popmake-9356">Apply to <?php the_title();?> Now!</button>
                                        </div>
                                    </div>
                                </nav>

                                <!-- Content -->
                                <div id="content-wrapper" class="p-4">
                                    <div class="tab-content">
                                        <div id="tentang-universitas" class="tab-pane fade show active">
                                            <?php 
                                                $post_id = get_the_ID(); // Mendapatkan ID Post
                                                $author_id = get_post_field('post_author', $post_id); // Mendapatkan ID Penulis
                                                $author_name = get_the_author_meta('display_name', $author_id); // Mendapatkan Nama Penulis
                                            ?>

                                            <ul class="row py-3 align-items-center list-unstyled">
                                                <!-- Nama Penulis dengan Dashicons -->
                                                <li class="col-12 col-md-6 text-start text-md-end d-flex align-items-center mb-2 mb-md-0">
                                                    <span class="dashicons dashicons-admin-users me-2"></span>
                                                    <span class="author-name">Author: <?php echo esc_html($author_name); ?></span>
                                                </li>

                                                <!-- Shortcode Post Views -->
                                                <li class="col-12 col-md-6 text-start text-md-start">
                                                    <span class="post-views">
                                                        <?php echo do_shortcode('[post-views]'); ?>
                                                    </span>
                                                </li>
                                            </ul>



                                            <h2>Tentang <?php the_title(); ?></h2>
                                            <?php the_content(); ?>
                                            <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" style="text-align: center;">
                                                            <?php 
                                                                $university_logo = get_field('university_logo');
                                                                $size = 'medium';
                                                                if( ! empty ( $university_logo ) ) {
                                                                    echo wp_get_attachment_image($university_logo, $size, "", array( "class" => "img-responsive img-responsive center-block" ));
                                                                }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Lokasi</td>
                                                        <td class="d-flex border-top-0 border-left-0 border-bottom-0">
                                                            <?php

                                                            $university_locations = get_field('university_location');

                                                            foreach($university_locations as $university_location){
                                                                ?>
                                                                    <ul style="text-align: justify; list-style-type: none; padding: unset;">
                                                                        <li><p class="m-0"><?php echo get_field("country_flag", $university_location); ?><a href="<?php echo get_permalink($university_location); ?>"><?php echo get_the_title($university_location); ?></a></p></li>
                                                                    </ul>
                                                                <?php
                                                            }
                                                            
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Syarat Masuk</td>
                                                        <td>
                                                        <?php
                                                            $field_content = get_field('university_entry_requirements_2');
                                                            preg_match_all('/<\s*h3[^>]*>(.*?)<\/h3>/i', $field_content, $matches);
                                                            if (!empty($matches[1])) {
                                                                echo implode(", ", $matches[1]);
                                                            }
                                                        ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Acceptance Rate</td>
                                                        <td>
                                                            <p class="m-0"><?php the_field('university_acceptance_rate'); ?>%</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Biaya Kuliah</td>
                                                        <td>
                                                            <ul>
                                                                <li><strong>Undergradute:</strong> <?php echo get_field('university_price')['undergraduate']; ?></li>
                                                                <li><strong>Postgraduate:</strong> <?php echo get_field('university_price')['postgraduate']; ?></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>

                                        <div id="biaya-kuliah" class="tab-pane fade">
                                            <h2>Biaya Kuliah di <?php the_title(); ?></h2>
                                            <?php echo get_field('university_price')['tuition_fees']; ?>
                                        </div>
                                        <div id="kenapa-kuliah" class="tab-pane fade">
                                            <h2 id="section-3">Kenapa Kuliah di <?php the_title(); ?>?</h2>
                                            <p>Berikut adalah beberapa alasan kenapa Anda harus kuliah di <?php the_title(); ?>:</p>

                                            <?php echo get_field('why_choose_us'); ?>
                                        </div>
                                        <div id="syarat-masuk" class="tab-pane fade">
                                            <h2>Syarat Masuk</h2>
                                            <p style="text-align: justify;">Ingin kuliah di <?php the_title(); ?>? Berikut adalah beberapa persyaratan yang harus Anda penuhi:</p>
                                            <?php echo get_field('university_entry_requirements_2'); ?>
                                        </div>
                                        <div id="jurusan-kuliah" class="tab-pane fade">
                                            <h2>Jurusan Kuliah di <?php the_title(); ?></h2>
                                            <p>Ada jurusan apa saja di <?php the_title(); ?>? Berikut adalah daftar jurusan yang tersedia:</p>
                                            <?php
                                                $university_majors = get_field('university_majors');
                                                $post_type = 'majors';
                                                $the_terms = get_terms(array(
                                                    'taxonomy' => 'major_categories',
                                                    'hide_empty' => false,
                                                    'parent' => 0
                                                ));

                                                foreach($the_terms as $the_term){
                                                    $my_posts = new WP_QUERY(array(
                                                        'post_type' => $post_type,
                                                        'post_per_page' => -1,
                                                        'post__in' => $university_majors,
                                                        'tax_query' => array(
                                                            array(
                                                                'taxonomy' => 'major_categories',
                                                                'field' => 'slug',
                                                                'terms' => $the_term->slug
                                                            )
                                                        )
                                                    ));

                                                    if($my_posts->have_posts()){
                                                        ?>
                                                            <h3><a href="<?php echo site_url('/majors'); ?>"><?php echo $the_term->name; ?></a></h3>
                                                            <p><?php echo wp_trim_words($the_term->description, 15); ?> <a href="<?php echo site_url('/majors') ?>">Baca Selengkapnya &raquo;</a></p>
                                                            <details>
                                                                <summary>
                                                                    <p><strong>Klik Untuk Lihat Jurusan &raquo;</strong></p>
                                                                </summary>
                                                                <ul>
                                                                    <?php while($my_posts->have_posts()) : $my_posts->the_post(); ?>
                                                                    <li>
                                                                        <details>
                                                                            <summary><h4><?php echo the_title(); ?></h4></summary>
                                                                            <p><?php echo wp_trim_words(get_the_content(), 15); ?><a href="<?php the_permalink(); ?>"> Baca Selengkapnya &raquo;</a></p>
                                                                        </details>
                                                                    </li>
                                                                    <?php endwhile; ?>
                                                                </ul>
                                                            </details>
                                                            <hr style="border-top: 1px solid #000000; ">
                                                            <br />
                                                        <?php 
                                                        wp_reset_postdata();
                                                    }
                                                }     
                                            ?>
                                        </div>
                                        <div id="event-n-scholarships" class="tab-pane fade">
                                            <h2 style="text-align: center;">Event di <?php the_title(); ?></h2>
                                            <?php

                                                $university_events = get_posts(array(
                                                'post_type' => 'events',
                                                'posts_per_page' => -1,
                                                'meta_key' => 'event_date_event_date_start',
                                                'orderby' => 'meta_value',
                                                'order'  => 'ASC',
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'attending_university',
                                                        'value' => '"' . get_the_ID() . '"',
                                                        'compare' => 'LIKE'
                                                        )
                                                    )
                                                ));
                                            
                                                $results = array();
                                                foreach($university_events as $university_event){
                                                    $the_date = get_field('event_date', $university_event->ID);
                                                    if(strtotime(current_time('mysql')) < strtotime($the_date["event_date_end"])){
                                                        $results[] = $university_event;
                                                    }
                                                }

                                                if(!empty($results)){
                                                    foreach($results as $result){
                                                        ?>
                                                            <ul class="list-group my-3">
                                                                <a href="<?php echo get_permalink($result->ID); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                                                    <div class="w-100 justify-content-between">
                                                                        <h3 class="mb-1"><?php echo $result->post_title; ?></h3>
                                                                        <small>
                                                                            <?php
                                                                                $the_date = get_field('event_date', $result->ID);
                                                                                $current_time = strtotime(current_time('mysql'));
                                                                                $event_start = strtotime($the_date["event_date_start"]);

                                                                                $how_log_ago = '';
                                                                                $seconds = $event_start - $current_time; 
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
                                                                                echo date('j F Y', strtotime($the_date["event_date_start"])) . ' — ' . $how_log_ago;
                                                                            ?>
                                                                        </small>
                                                                    </div>
                                                                    <p class="mb-1"><?php echo wp_trim_words($result->post_content, 8); ?></p>
                                                                </a>
                                                            </ul>
                                                        <?php
                                                    }
                                                } else{
                                                    ?>
                                                        <p style="text-align: center;">Sorry! there is no ongoing event in <?php the_title() ?>.</p>
                                                    <?php
                                                }
                                            
                                            ?>
                                            <h2 style="text-align: center;">Beasiswa di <?php the_title(); ?></h2>
                                            <?php

                                                $university_scholarships = get_posts(array(
                                                'post_type' => 'scholarships',
                                                'posts_per_page' => -1,
                                                'meta_key' => 'scholarship_date_scholarship_date_start',
                                                'orderby' => 'meta_value',
                                                'order'  => 'ASC',
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'participating_university',
                                                        'value' => '"' . get_the_ID() . '"',
                                                        'compare' => 'LIKE'
                                                        )
                                                    )
                                                ));

                                                $results = array();

                                                foreach($university_scholarships as $university_scholarship){
                                                    $the_date = get_field('scholarship_date', $university_scholarship->ID);
                                                    if(strtotime(current_time('mysql')) < strtotime($the_date["scholarship_date_end"])){
                                                        $results[] = $university_scholarship;
                                                    }
                                                }

                                                if(!empty($results)){
                                                    foreach($results as $result){
                                                        ?>
                                                            <ul class="list-group my-3">
                                                                <a href="<?php echo get_permalink($result->ID); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                                                    <div class="w-100 justify-content-between">
                                                                        <h3 class="mb-1"><?php echo $result->post_title; ?></h3>
                                                                        <small>
                                                                            <?php
                                                                                $the_date = get_field('scholarship_date', $result->ID);
                                                                                $current_time = strtotime(current_time('mysql'));
                                                                                $scholarship_end = strtotime($the_date["scholarship_date_end"]);
                                                                                $scholarship_start = strtotime($the_date["scholarship_date_start"]);

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
                                                                    </div>
                                                                    <p class="mb-1"><?php echo wp_trim_words(do_shortcode($result->post_content), 15); ?></p>
                                                                </a>
                                                            </ul>
                                                        <?php 

                                                    }
                                                    
                                                } else{
                                                    ?>
                                                        <p style="text-align: center;">Sorry! there is no ongoing scholarship in <?php the_title() ?>.</p>
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
            </div>

            <?php

            get_footer();
            exit;
        }

        return $single_template_university;
    }
}

?>