<?php

class edu003_displayUniversityCPT{

    static function searchUniversity(){
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
        <div class="container" style="z-index: 1; position: relative !important;">
            <?php layerslider(5) ?>
        </div>
        
        <div class="container search-screen" style="z-index: 2; position: relative;">
            <div style="background: black; margin: 1%; border-radius: 10px; opacity: .5;">
                <h1 class="text-center search-screen text-white py-3 px-3">EduXpert Indonesia: Konsultan Pendidikan Luar Negeri</h1>
            </div>
            
            <div class="card h-100">
                <div class="card-body" >
                    <h2>Search University</h2>
                    <p>Cari universitas luar negeri favorit Anda dibawah ini:</p>
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
            </div>
        </div>
        
        <?php 
    }
    
    static function displayUniversity($atts){

        $atts = shortcode_atts(array(
            'university_location' => ''
        ), $atts);
      
        ?>
        <div class="container-fluid p-0">
            <div class="university-carousel owl-carousel owl-theme">
                <?php

                    $study_abroad = get_page_by_title($atts['university_location'], OBJECT, 'study-abroad');

                    $universities = get_posts(array(
                        'post_type' => 'university',
                        'post_status' => 'publish',
                        'orderby' => 'post_date',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'university_location',
                                'value' => '"' . $study_abroad->ID . '"',
                                'compare' => 'LIKE'
                            )
                        )
                    ));

                    if ( $universities ) {
                        foreach ( $universities as $university ) {
                            $university_events = get_posts(array(
                                'post_type' => 'events',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key' => 'attending_university',
                                        'value' => '"' . $university->ID . '"',
                                        'compare' => 'LIKE'
                                    )
                                )
                            ));

                            $university_scholarships = get_posts(array(
                                'post_type' => 'scholarships',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                array(
                                    'key' => 'participating_university',
                                    'value' => '"' . $university->ID . '"',
                                    'compare' => 'LIKE'
                                    )
                                )
                            ));

                            ?>
                            <div class="card h-100">
                                <div class="card-body">
                                    <?php 
                                        $university_logo = get_field('university_logo', $university->ID);
                                        $size = 'medium';
                                        if( ! empty ( $university_logo ) ) {
                                            echo wp_get_attachment_image($university_logo, $size, "", array( "class" => "img-responsive" ));
                                        }

                                        if(get_field('university_partnership', $university->ID) === true){
                                            ?>
                                                <div id="partner-badge" style="cursor: pointer;">
                                                    <p class="badge badge-pill badge-primary" style="position: absolute; top: 10px; right: 10px; font-size: 18px;">PARTNER</p>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    <h4 class="card-title" style="font-size: 20px; line-height: inherit;"><?php echo $university->post_title ?></h4>
                                    <?php
                                    $event = array(); $scholarship = array();
                                    foreach($university_events as $university_event){
                                        $the_date = get_field('event_date', $university_event->ID);
                                        if(strtotime(current_time('mysql')) < strtotime($the_date["event_date_end"])){
                                            $event[] = $university_event->ID;
                                        }
                                    }

                                    foreach($university_scholarships as $university_scholarship){
                                        $scholarship_date = get_field('scholarship_date', $university_scholarship->ID);
                                        if(strtotime(current_time('mysql')) < strtotime($scholarship_date["scholarship_date_end"])){
                                            $scholarship[] = $university_scholarship->ID;
                                        }
                                    }

                                    ?>
                                    
                                    <ul style="padding-left: 10%; text-align: justify; list-style-type: none;">
                                        <li><span style="margin: 1.5% 5% 0% 0%;" class="dashicons dashicons-welcome-learn-more"></span><p style="display: contents;"><?php echo count(get_field('university_majors', $university->ID)); ?> Jurusan Tersedia</p></li>
                                        <li><span style="margin: 0% 5% 0% 0%;" class="dashicons dashicons-calendar-alt"></span><p style="display: contents;"><?php echo count($event); ?> Event Tersedia</p></li>
                                        <li><span style="margin: 0% 5% 0% 0%;" class="dashicons dashicons-awards"></span><p style="display: contents;"><?php echo count($scholarship); ?> Beasiswa Tersedia</p></li>
                                    </ul>
                                    <a class="btn btn-primary form-control" href="<?php the_permalink($university->ID); ?>"> Baca Selengkapnya</a>
                                </div>
                            </div>
                          
                            <?php

                        }
                    }
                ?>
            </div>
        </div>

        <?php
        
        wp_reset_postdata();
       
    }

}