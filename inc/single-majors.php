<?php 

class edu003_singleMajors{

    static function override_single_template_majors( $single_template_majors){

        global $post;
    
        if( $post->post_type === 'majors'){

            $single_template_majors  = dirname(__FILE__) .'/templates/single-majors.php';
            
            if ( RDTheme::$layout == 'full-width' ) {
                $rdtheme_layout_class = 'col-sm-12 col-12';
            }
            else{
                $rdtheme_layout_class = 'col-sm-12 col-md-8 col-lg-9 col-12';
            }
    
            get_header();
            
            ?>
    
            <div id="primary" class="content-area pt-0">
                <div class="container-fluid p-0">
                    <?php

                    $university_majors = get_posts(array(
                        'post_type' => 'university',
                        'posts_per_page' => -1,
                        'orderby' => 'rand',
                        'meta_query' => array(
                            array(
                                'key' => 'university_majors',
                                'value' => '"' . get_the_ID() . '"',
                                'compare' => 'LIKE'
                            )
                        )
                    ));

                    $studyAbroads = get_posts(array(
                        'post_type' => 'study-abroad',
                        'posts_per_page' => -1
                    ));
                                        
                    
                    if(has_post_thumbnail($post->ID)){
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        $featured_image_caption = wp_get_attachment_caption(get_post_thumbnail_id($post->ID));
                        $alt_text = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true ); 
                        ?>
                        <div style="position: relative;">
                            <div style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
                            <img class="img-fluid w-100" style="height: 250px; object-fit: cover; position: relative; z-index: 2; opacity: 0.6;" src="<?php echo $featured_image[0]; ?>" alt="<?php echo $alt_text; ?>">
                            <h1 class="text-white carousel-caption display-6 text-uppercase font-weight-bold" style="text-shadow: 2px 2px #000;"><?php echo count($university_majors) ?> Universitas yang Ada Jurusan <?php the_title(); ?></h1>
                        </div>
                        <?php
                    } else{
                        ?>
                        <div style="position: relative;">
                            <div style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
                            <div class="img-fluid w-100" style="height: 250px; object-fit: cover; position: relative; z-index: 2; opacity: 0.6;"></div>
                            <h1 class="text-white carousel-caption display-6 text-uppercase font-weight-bold" style="text-shadow: 2px 2px #000;"><?php echo count($university_majors) ?> Universitas yang Ada Jurusan <?php the_title(); ?></h1>
                        </div>
                        <?php
                    }
                    
                    ?>
                    <div class="row">
                        <ul class="nav nav-tabs bg-primary bg-gradient text-center col-12 p-0 ml-auto" role="tablist">
                            <li class="nav-item px-0 col-6">
                                <a class="nav-link active show text-white" data-bs-toggle="tab" href="#tentang-jurusan" role="tab">
                                    <span class="dashicons dashicons-welcome-learn-more"></span>
                                    <span>Tentang Jurusan</span>
                                </a>
                            </li>
                            <li class="nav-item px-0 col-6">
                                <a class="nav-link text-white" data-bs-toggle="tab" href="#daftar-kuliah" role="tab">
                                    <span class="dashicons dashicons-index-card"></span>
                                    <span>Daftar Kuliah</span>
                                </a>
                            </li>
                        </ul>
                    </div>


                    <div class="tab-content p-3 bg-white">
                        <div class="tab-pane fade show active" id="tentang-jurusan" role="tabpanel">
                            <div class="text-dark">
                                <div class="row mb-3" style="margin-inline-start: auto;">
                                    <div class="col-sm-6">
                                        <?php echo do_shortcode('[post-views]'); ?>
                                    </div>
                                </div>
                                <?php echo get_the_content(); ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="daftar-kuliah" role="tabpanel">
                            <div class="bg-white">
                                <?php echo do_shortcode('[displayMajorForm]'); ?>
                            </div>
                        </div>
                    </div>
                            
                    <div class="row">
                        <?php
                        if ( RDTheme::$layout == 'left-sidebar' ) {
                            get_sidebar();
                        }
                        ?>
                        <div class="<?php echo esc_attr( $rdtheme_layout_class );?>">
                            <main id="main" class="site-main">
                                <div class="container">
                                    <?php 
                                    if($university_majors){
                                        ?>
                                            <p class="text-center mb-5">Berikut adalah <?php echo count($university_majors) ?> rekomendasi universitas dengan jurusan <?php the_title(); ?> terbaik:</p>
                                        <?php
                                        
                                        foreach($university_majors as $university_major){
                                            $permalink = get_permalink( $university_major->ID );
                                            $university_locations = get_field('university_location', $university_major->ID);
                                            ?>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <?php 
                                                            $university_logo = get_field('university_logo', $university_major->ID);
                                                            $size = 'medium';
                                                            if( ! empty ( $university_logo ) ) {
                                                                echo wp_get_attachment_image($university_logo, $size, "", array( "class" => "img-responsive" ));
                                                            }
                                        
                                                        ?>
                                                  
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h2><?php echo $university_major->post_title; ?></h2>
                                                        <div class="d-flex flex-wrap">
                                                        <?php foreach($university_locations as $location): ?>
                                                            <?php foreach($studyAbroads as $studyAbroad): ?>
                                                                <?php if($location === $studyAbroad->ID): ?>
                                                                    <div class="mr-3">
                                                                        <p style="font-size: 12px;" class="text-left"><a href="<?php echo get_permalink($studyAbroad->ID); ?>"><?php echo get_field("country_flag", $studyAbroad->ID) . get_the_title($location); ?></a></p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endforeach; ?>
                                                        </div>
                                                        <p><?php echo wp_trim_words($university_major->post_content, 30); ?><a href="<?php echo esc_url($permalink); ?>"> Baca Selengkapnya &raquo;</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="border-top: 1px solid #000000; ">
                                      
                                            <?php
                                        }
                                    }

                                    ?>
                                </div>
                            </main>					
                        </div>
                        <?php
                        if ( RDTheme::$layout == 'right-sidebar' ) {
                            get_sidebar();
                        }
                        ?>
                    </div>
                </div>
            </div>
    
            <?php

            get_footer();
    
            exit;
        
        }
     
        return $single_template_majors;
    }

}

?>