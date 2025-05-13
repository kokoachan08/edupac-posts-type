<?php

class edu003_displayStudyAbroadCPT{
    static function topUniversityEduXpert(){
        global $wpdb;

        ?>

        <div class="container">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="popular-university-tab" data-toggle="tab" href="#popular-university" role="tab" aria-controls="popular-university" aria-selected="true">Popular University</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="favorite-university-tab" data-toggle="tab" href="#favorite-university" role="tab" aria-controls="favorite-university" aria-selected="false">Favorite University</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="popular-university" role="tabpanel" aria-labelledby="popular-university-tab">
                    <div class="row mt-5">
                        <h2 class="display-5">Universitas Mitra Terpopuler</h2>
                        <p class="lead">Kami mengurutkan universitas mitra terpopuler berdasarkan jumlah post view terbanyak.</p>
                        <div class="short-course-carousel owl-carousel owl-theme">
                            <?php
                            $order_by_post_views_university = array(
                                'order'            => 'desc',
                                'post_type'        => 'university',
                                'numberposts'      => 10,
                                'suppress_filters' => false,
                                'orderby'          => 'post_views',
                                'meta_query'       => array(
                                    array(
                                        'key'     => 'university_partnership',
                                        'value'   => true,
                                        'compare' => '=',
                                        'type'    => 'BOOLEAN'
                                    )
                                )
                            );

                            $university_views = get_posts($order_by_post_views_university); ?>

                            <?php
                            $top3_popular = 0;
                            foreach($university_views as $university_view):
                                $top3_popular++;
                                ?>
                                <div class="card float-left w-100">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?php if ($top3_popular <= 3): ?>
                                                <span class="badge badge-danger position-absolute" style="top: 10px; left: 0; z-index: 2; border-radius: unset;"><p class="h5 m-0">Top #<?php echo $top3_popular; ?> Popular University</p></span>
                                            <?php endif; ?>
                                            <?php if(has_post_thumbnail($university_view->ID)):
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($university_view->ID), 'full');
                                                $alt_text = get_post_meta(get_post_thumbnail_id($university_view->ID), '_wp_attachment_image_alt', true);
                                                ?>
                                                <div style="position: relative;">
                                                    <img class="d-block card-img" style="object-fit: cover; position: relative; height: 20em;" src="<?php echo $featured_image[0] ?>" alt="<?php echo $alt_text; ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-7 px-6">
                                            <div class="card-block px-6">
                                                <h2 style="font-size: calc(1.125rem + 0.5vw); font-weight: 600; line-height: 1.2;"><?php echo $university_view->post_title; ?></h2>
                                                <span>Views: <?php echo pvc_get_post_views($university_view->ID) ?></span>
                                                <p class="text-justify">
                                                    <?php echo wp_trim_words(get_post_field('post_content', $university_view->ID), 50); ?>
                                                </p>
                                            </div>
                                            <a href="<?php echo get_the_permalink($university_view->ID) ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="favorite-university" role="tabpanel" aria-labelledby="favorite-university-tab">
                    <div class="row mt-5">
                        <!-- Second row content (Universitas Terfavorit) -->
                        <h2 class="display-5">Universitas Mitra Terfavorit</h2>
                        <p class="lead">Kami mengurutkan universitas mitra terfavorit berdasarkan jumlah pendaftar terbanyak.</p>
                        <div class="short-course-carousel owl-carousel owl-theme">
                        <?php
                            $url = "https://script.google.com/macros/s/AKfycbwo5OULvfTFMXiYNvRpXHCk3CIzF3dikZZSHcRte9XRKN9iyTTOY-QPyU0Jp59pET4l/exec";
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects response
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $response = json_decode($result);

                            $args = get_posts(array(
                                'order'            => 'desc',
                                'post_type'        => 'university',
                                'numberposts'      => -1,
                                'meta_query'       => array(
                                    array(
                                        'key'     => 'university_partnership',
                                        'value'   => true,
                                        'compare' => '=',
                                        'type'    => 'BOOLEAN'
                                    )
                                )
                            ));

                            // Membuat array yang berisi nama-nama universitas mitra dan ID-nya
                            $mitra_universities = array();
                            foreach ($args as $arg) {
                                $mitra_universities[$arg->ID] = $arg->post_title;
                            }

                            if (is_object($response) && property_exists($response, 'data')) {
                                // Mengabaikan baris pertama karena itu adalah header
                                $data_universitas = array_slice($response->data, 1);

                                // Array asosiatif untuk menyimpan ID universitas unik dan jumlahnya
                                $universitas_count = array();

                                foreach ($data_universitas as $universitas) {
                                    // Mengambil nama universitas dari kolom ke-7 (indeks 6)
                                    $nama_universitas = $universitas[7];
                                    
                                    // Memeriksa apakah universitas tersebut merupakan mitra dan mendapatkan ID-nya
                                    $universitas_id = array_search($nama_universitas, $mitra_universities);

                                    // Jika ID universitas ditemukan, tambahkan jumlah universitas ke dalam array asosiatif
                                    if ($universitas_id !== false) {
                                        if(isset($universitas_count[$universitas_id])){
                                            $universitas_count[$universitas_id]++;
                                        } else {
                                            $universitas_count[$universitas_id] = 1;
                                        }
                                    }
                                }

                                // Mengurutkan array berdasarkan jumlah pendaftar
                                arsort($universitas_count);

                                // Mengambil 5 universitas dengan jumlah pendaftar terbanyak
                                $top5_universitas = array_slice($universitas_count, 0, 10, true);

                                $top3_favorite = 0;
                                foreach ($top5_universitas as $universitas_id => $jumlah) {
                                    $top3_favorite++;
                                    ?>
                                    <div class="card float-left w-100">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php if ($top3_favorite <= 3): ?>
                                                    <span class="badge badge-danger position-absolute" style="top: 10px; left: 0; z-index: 2; border-radius: unset;"><p class="h5 m-0">Top #<?php echo $top3_favorite; ?> Favorite University</p></span>
                                                <?php endif; ?>
                                                <?php if(has_post_thumbnail($universitas_id)):

                                                $fav_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($universitas_id), 'full');
                                                $fav_alt_text = get_post_meta(get_post_thumbnail_id($universitas_id), '_wp_attachment_image_alt', true);
                                                ?>
                                                <div style="position: relative;">
                                                    <img class="d-block card-img" style="object-fit: cover; position: relative; height: 20em;" src="<?php echo $fav_featured_image[0] ?>" alt="<?php echo $fav_alt_text; ?>">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-7 px-6">
                                                <div class="card-block px-6">
                                                    <h2 style="font-size: calc(1.125rem + 0.5vw); font-weight: 600; line-height: 1.2;"><?php echo get_the_title($universitas_id); ?></h2>
                                                    <p class="text-justify">
                                                        <?php echo wp_trim_words(get_post_field('post_content', $universitas_id), 50); ?>
                                                    </p>
                                                </div>
                                                <a href="<?php echo get_the_permalink($universitas_id) ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            } else {
                                echo "Gagal mengambil data universitas.";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php

    }

    static function searchUniversityStudyAbroad(){
        $universities = get_posts(
            array(
                'post_type' => 'university',
                'post_status' => 'publish',
                'orderby' => 'post_date',
                'order' => 'ASC',
                'posts_per_page' =>  -1
            )
        );

        $studyAbroads = get_posts(array(
            'post_type' => 'study-abroad',
            'posts_per_page' => -1
        ));

        ?>
        <div class="container-fluid py-5">
            <h2 class="display-5 text-center text-white">Search University</h2>
            <p class="lead text-white text-center">Anda bisa cari universitas impian di searchbar bawah ini:</p>
            <div class="input-group mb-3 w-100 flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text dashicons dashicons-search" style="padding-right: 1.8rem!important;" id="inputGroup-sizing-default"></span>
                </div>
                <input class="form-control" type="text" id="searchUniversity" placeholder="Search Here...">
            </div>

            <ul class="list-group text-left m-0 mt-3" id="list" style="display: none;">
                <?php foreach($universities as $university): ?>
                    <li class="list-group-item" style="border: 1px solid #ddd;">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="d-flex flex-wrap">
                                    <a href="<?php the_permalink($university->ID) ?>"><h3 style="font-size: 15px;" class="mb-0 mr-3"><?php echo $university->post_title ?></h3></a>
                                    <?php if(get_field('university_partnership', $university->ID) === true): ?>
                                        <div id="partner-badge" style="cursor: pointer; font-size: small;">
                                            <p class="badge badge-primary badge-pill">PARTNER</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <?php $university_locations = get_field('university_location', $university->ID); ?>
                                    <?php foreach ($university_locations as $location): ?>
                                        <?php foreach($studyAbroads as $studyAbroad): ?>
                                            <?php if($location === $studyAbroad->ID): ?>
                                                <div class="mr-2">
                                                    <p style="font-size: 12px;" class="text-left"><a href="<?php echo get_permalink($studyAbroad->ID); ?>"><?php echo get_field("country_flag", $studyAbroad->ID) . get_the_title($location); ?></a></p>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-left">
                                <?php 
                                    $university_logo = get_field('university_logo', $university->ID);
                                    $size = 'thumbnail';
                                    if( ! empty ( $university_logo ) ) {
                                        echo wp_get_attachment_image($university_logo, $size, "", array( "class" => "img-responsive" ));
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <?php 
    }


    static function topDestinationEduXpert(){
        ?>
        <div class="container mt-5">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="popular-destination-tab" data-toggle="tab" href="#popular-destination" role="tab" aria-controls="popular-destination" aria-selected="true">Popular Destination</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="favorite-destination-tab" data-toggle="tab" href="#favorite-destination" role="tab" aria-controls="favorite-destination" aria-selected="false">Favorite Destination</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="popular-destination" role="tabpanel" aria-labelledby="popular-destination-tab">
                    <div class="row mt-5">
                        <h2 class="display-5">Destinasi Studi Terpopuler</h2>
                        <p class="lead">Kami mengurutkan destinasi studi terpopuler berdasarkan jumlah post view terbanyak.</p>
                        <div class="short-course-carousel owl-carousel owl-theme">
                        <?php

                            $order_by_post_views_study_abroad = array(
                                'order'            => 'desc',
                                'post_type'        => 'study-abroad',
                                'numberposts'      => 10,
                                'suppress_filters' => false,
                                'orderby'          => 'post_views'
                            );

                            $study_abroad_views = get_posts($order_by_post_views_study_abroad);

                            $top3_popular_destination = 0;

                            foreach($study_abroad_views as $study_abroad_view){
                                $top3_popular_destination++;

                                $post_views = pvc_get_post_views($study_abroad_view->ID);
                                ?>

                                <div class="card float-left w-100">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?php if ($top3_popular_destination <= 3): ?>
                                                <span class="badge badge-danger position-absolute" style="top: 10px; left: 0; z-index: 2; border-radius: unset;"><p class="h5 m-0">Top #<?php echo $top3_popular_destination; ?> Popular Study Destination</p></span>
                                            <?php endif; ?>
                                            <?php if(has_post_thumbnail($study_abroad_view->ID)): ?>
                                                <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($study_abroad_view->ID), 'full'); ?>
                                                <img class="d-block card-img" style="object-fit: cover; position: relative; height: 20em;" src="<?php echo $thumbnail[0]; ?>" alt="<?php echo $study_abroad_view->post_title; ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-7 px-6">
                                            <div class="card-block px-6">
                                                <h2 style="font-size: calc(1.125rem + 0.5vw); font-weight: 600; line-height: 1.2;"><?php echo $study_abroad_view->post_title; ?></h2>
                                                <span>Views: <?php echo $post_views; ?></span>
                                                <p class="text-justify">
                                                    <?php echo wp_trim_words(get_post_field('post_content', $study_abroad_view->ID), 50); ?>
                                                </p>
                                            </div>
                                            <a href="<?php echo get_the_permalink($study_abroad_view->ID); ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }

                        ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="favorite-destination" role="tabpanel" aria-labelledby="favorite-destination-tab">
                    <div class="row mt-5">
                        <h2 class="display-5">Destinasi Studi Terfavorit</h2>
                        <p class="lead">Kami mengurutkan destinasi studi terfavorit berdasarkan jumlah pendaftar terbanyak.</p>
                        <div class="short-course-carousel owl-carousel owl-theme">
                        <?php
                            $urlDestination = "https://script.google.com/macros/s/AKfycbwXCb95fceZsG2ozsm1_rwxboFVOBqj6z6tx67hBOkk_hVEYh-PC9qteBBq2bQipKE_hA/exec";
                            $chDestination = curl_init($urlDestination);
                            curl_setopt($chDestination, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($chDestination, CURLOPT_RETURNTRANSFER, true);
                            $resultDestination = curl_exec($chDestination);
                            curl_close($chDestination);
                            $responseDestination = json_decode($resultDestination);

                            $argsDestinations = get_posts(array(
                                'order'       => 'desc',
                                'post_type'   => 'study-abroad',
                                'numberposts' => -1
                            ));

                            $studyDestinations = array();
                            foreach ($argsDestinations as $argsDestination) {
                                $studyDestinations[$argsDestination->ID] = $argsDestination->post_title;
                            }

                            if (is_object($responseDestination) && property_exists($responseDestination, 'data')) {
                                $dataDestinations = array_slice($responseDestination->data, 1);

                                $destinationCount = array();

                                foreach ($dataDestinations as $dataDestination) {
                                    $destination_row = $dataDestination[7];

                                    $studyabroad_id = array_search($destination_row, $studyDestinations);

                                    if ($studyabroad_id !== false) {
                                        if (isset($destinationCount[$studyabroad_id])) {
                                            $destinationCount[$studyabroad_id]++;
                                        } else {
                                            $destinationCount[$studyabroad_id] = 1;
                                        }
                                    }
                                }

                                // Mengurutkan array berdasarkan jumlah pendaftar
                                arsort($destinationCount);

                                // Mengambil 5 pendaftar terbanyak
                                $top5_destinations = array_slice($destinationCount, 0, 10, true);

                                $top3_favorite_destination = 0;
                                foreach ($top5_destinations as $studyabroad_id => $jumlah) {
                                    $top3_favorite_destination++;
                                    ?>
                                    <div class="card float-left w-100">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php if ($top3_favorite_destination <= 3): ?>
                                                    <span class="badge badge-danger position-absolute" style="top: 10px; left: 0; z-index: 2; border-radius: unset;"><p class="h5 m-0">Top #<?php echo $top3_favorite_destination; ?> Favorite Study Destination</p></span>
                                                <?php endif; ?>
                                                <?php if(has_post_thumbnail($studyabroad_id)):

                                                $fav_featured_image_destination = wp_get_attachment_image_src(get_post_thumbnail_id($studyabroad_id), 'full');
                                                $fav_alt_text_destination = get_post_meta(get_post_thumbnail_id($studyabroad_id), '_wp_attachment_image_alt', true);
                                                ?>
                                                <div style="position: relative;">
                                                    <img class="d-block card-img" style="object-fit: cover; position: relative; height: 20em;" src="<?php echo $fav_featured_image_destination[0] ?>" alt="<?php echo $fav_alt_text_destination; ?>">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-7 px-6">
                                                <div class="card-block px-6">
                                                    <h2 style="font-size: calc(1.125rem + 0.5vw); font-weight: 600; line-height: 1.2;"><?php echo get_the_title($studyabroad_id); ?></h2>
                                                    <p class="text-justify">
                                                        <?php echo wp_trim_words(get_post_field('post_content', $studyabroad_id), 50); ?>
                                                    </p>
                                                </div>
                                                <a href="<?php echo get_the_permalink($studyabroad_id) ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "Gagal mengambil data destinasi studi.";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

    static function topMajorEduXpert(){
        ?>

        <div class="container mt-5">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="popular-major-tab" data-toggle="tab" href="#popular-major" role="tab" aria-controls="popular-major" aria-selected="true">Popular Majors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="favorite-major-tab" data-toggle="tab" href="#favorite-major" role="tab" aria-controls="favorite-major" aria-selected="false">Favorite Majors</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="popular-major" role="tabpanel" aria-labelledby="popular-major-tab">
                    <div class="row mt-5">
                    <h2 class="display-5">Jurusan Kuliah Terpopuler</h2>
                        <p class="lead">Kami mengurutkan jurusan kuliah terpopuler berdasarkan jumlah post view terbanyak.</p>
                        <div class="short-course-carousel owl-carousel owl-theme">
                        <?php

                            $order_by_post_views_majors = array(
                                'order'            => 'desc',
                                'post_type'        => 'majors',
                                'numberposts'      => 10,
                                'suppress_filters' => false,
                                'orderby'          => 'post_views'
                            );

                            $major_views = get_posts($order_by_post_views_majors);

                            $top3_popular_majors = 0;

                            foreach($major_views as $major_view){
                                $top3_popular_majors++;
                                $post_views = pvc_get_post_views($major_view->ID);
                                ?>

                                <div class="card float-left w-100">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?php if ($top3_popular_majors <= 3): ?>
                                                <span class="badge badge-danger position-absolute" style="top: 10px; left: 0; z-index: 2; border-radius: unset;"><p class="h5 m-0">Top #<?php echo $top3_popular_majors; ?> Popular Major</p></span>
                                            <?php endif; ?>
                                            <?php if(has_post_thumbnail($major_view->ID)): ?>
                                                <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($major_view->ID), 'full'); ?>
                                                <img class="d-block card-img" style="object-fit: cover; position: relative; height: 20em;" src="<?php echo $thumbnail[0]; ?>" alt="<?php echo $major_view->post_title; ?>">
                                            <?php else: ?>
                                                <div class="no-thumbnail d-flex justify-content-center align-items-center card-img" style="background-color: #f0f0f0; height: 20em;">
                                                    <p class="text-center m-0">No Image Available</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-7 px-6">
                                            <div class="card-block px-6">
                                                <h2 style="font-size: calc(1.125rem + 0.5vw); font-weight: 600; line-height: 1.2;"><?php echo $major_view->post_title; ?></h2>
                                                <span>Views: <?php echo $post_views; ?></span>
                                                <p class="text-justify">
                                                    <?php echo wp_trim_words(get_post_field('post_content', $major_view->ID), 50); ?>
                                                </p>
                                            </div>
                                            <a href="<?php echo get_the_permalink($major_view->ID); ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="favorite-major" role="tabpanel" aria-labelledby="favorite-major-tab">
                    <div class="row mt-5">
                        <h2 class="display-5">Jurusan Kuliah Terfavorit</h2>
                        <p class="lead">Kami mengurutkan jurusan kuliah terfavorit berdasarkan jumlah pendaftar terbanyak.</p>
                        <div class="short-course-carousel owl-carousel owl-theme">
                            <?php 
                                $url_2 = "https://script.google.com/macros/s/AKfycbwo5OULvfTFMXiYNvRpXHCk3CIzF3dikZZSHcRte9XRKN9iyTTOY-QPyU0Jp59pET4l/exec";
                                $ch_2 = curl_init($url_2);
                                curl_setopt($ch_2, CURLOPT_FOLLOWLOCATION, true);
                                curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
                                $result_2 = curl_exec($ch_2);
                                curl_close($ch_2);
                                $response_2 = json_decode($result_2);

                                $args = get_posts(array(
                                    'order'            => 'desc',
                                    'post_type'        => 'majors',
                                    'numberposts'      => -1
                                ));

                                $listjurusan = array();
                                foreach ($args as $arg) {
                                    $listjurusan[$arg->ID] = $arg->post_title;
                                }

                                if (is_object($response_2) && property_exists($response_2, 'data')) {
                                    $data_jurusan_studi = array_slice($response_2->data, 1);
                                    $jurusan_studi_count = array();

                                    foreach ($data_jurusan_studi as $row) {
                                        $jurusan_studi = $row[8];
                                        $jurusan_list = array_map('trim', explode(',', $jurusan_studi));

                                        foreach ($jurusan_list as $jurusan_name) {
                                            $jurusan_id = array_search($jurusan_name, $listjurusan);

                                            if ($jurusan_id !== false) {
                                                if (isset($jurusan_studi_count[$jurusan_id])) {
                                                    $jurusan_studi_count[$jurusan_id]++;
                                                } else {
                                                    $jurusan_studi_count[$jurusan_id] = 1;
                                                }
                                            }
                                        }
                                    }

                                    // Mengambil 10 jurusan dengan jumlah pendaftar terbanyak
                                    arsort($jurusan_studi_count);
                                    $top10_jurusan = array_slice($jurusan_studi_count, 0, 10, true);

                                    $top3_favorite = 0;
                                    foreach ($top10_jurusan as $jurusan_id => $jumlah) {
                                        $top3_favorite++;
                                        ?>
                                        <div class="card float-left w-100 mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-5">
                                                    <?php if ($top3_favorite <= 3): ?>
                                                        <span class="badge badge-danger position-absolute" style="top: 10px; left: 0; z-index: 2; border-radius: unset;">
                                                            <p class="h5 m-0">Top #<?php echo $top3_favorite; ?> Favorite Major</p>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php 
                                                    if (has_post_thumbnail($jurusan_id)): 
                                                        $fav_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($jurusan_id), 'full');
                                                        $fav_alt_text = get_post_meta(get_post_thumbnail_id($jurusan_id), '_wp_attachment_image_alt', true);
                                                    ?>
                                                    <div style="position: relative;">
                                                        <img class="d-block card-img" style="object-fit: cover; position: relative; height: 20em;" src="<?php echo $fav_featured_image[0]; ?>" alt="<?php echo $fav_alt_text; ?>">
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="no-thumbnail d-flex justify-content-center align-items-center card-img" style="background-color: #f0f0f0; height: 20em;">
                                                        <p class="text-center m-0">No Image Available</p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-7 px-3">
                                                    <div class="card-block px-3">
                                                        <h2 style="font-size: calc(1.125rem + 0.5vw); font-weight: 600; line-height: 1.2;">
                                                            <?php echo get_the_title($jurusan_id); ?>
                                                        </h2>
                                                        <p class="text-justify">
                                                            <?php echo wp_trim_words(get_post_field('post_content', $jurusan_id), 50); ?>
                                                        </p>
                                                    </div>
                                                    <a href="<?php echo get_the_permalink($jurusan_id); ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "Gagal mengambil data bidang studi.";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}


?>