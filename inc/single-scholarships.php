<?php 

class edu003_singleScholarships{
    static function override_single_template_scholarships($single_template_scholarships){
        
        global $post;
    
        if( $post->post_type === 'scholarships'){

            $single_template_scholarships  = dirname(__FILE__) .'/templates/single-scholarships.php';
            
            if ( RDTheme::$layout == 'full-width' ) {
                $rdtheme_layout_class = 'col-sm-12 col-12';
            }
            else{
                $rdtheme_layout_class = 'col-sm-12 col-md-8 col-lg-9 col-12';
            }
    
            get_header();
            
            ?>
                <div id="primary" class="content-area">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <?php
                            if ( RDTheme::$layout == 'left-sidebar' ) {
                                get_sidebar();
                            }
                            ?>
                            <div class="<?php echo esc_attr( $rdtheme_layout_class );?>">
                                <main id="main" class="site-main">
                                <div class="container">
                                    <div class="row">
                                        <?php if(has_post_thumbnail($post->ID)) : 
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                        $featured_image_caption = wp_get_attachment_caption(get_post_thumbnail_id($post->ID));
                                        $alt_text = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true ); ?>
                                        <img src="<?php echo $featured_image[0]; ?>" alt="<?php echo $alt_text; ?>">
                                        <p style="text-align: center; font-size: medium; margin-top: 15px;"><strong><?php echo $featured_image_caption; ?></strong></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <br />
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-8 position-sticky">
                                            <?php echo the_content(); ?>
                                            <h2>Detail Beasiswa</h2>
                                            <h3>Jam & Tanggal</h3>
                                            <p>Berikut adalah tanggal mulai dan berakhir-nya beasiswa:</p>
                                            <?php if(have_rows('scholarship_date')) : ?>
                                                <?php while(have_rows('scholarship_date')): the_row();
                                                    $scholarship_start = get_sub_field("scholarship_date_start");
                                                    $scholarship_end = get_sub_field("scholarship_date_end");

                                                    echo '<p><strong>Beasiswa Dimulai &nbsp;&emsp; :</strong> ' . date("j F Y, g:i a", strtotime($scholarship_start)) . '</p>';
                                                    echo '<p><strong>Beasiswa Berakhir &emsp; :</strong> ' . date("j F Y, g:i a", strtotime($scholarship_end)) . '</p>';
                                                ?> 
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php echo do_shortcode('[displayScholarshipForm]'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <?php if(get_field('participating_university')): ?>
                                    <div class="row">
                                        <h2>Participating University</h2>
                                        <p>Berikut adalah universitas yang berpartisipasi dalam <?php the_title(); ?>:</p>
                                        <?php
                                            $participations = get_field('participating_university');
                                
                                            if($participations){
                                                foreach($participations as $participation){
                                                    ?>
                                                        <div class="col-sm-6 col-lg-3 py-2">
                                                            <div class="card h-100">
                                                                <div class="card-body">
                                                                    <?php
                                                                    $permalink = get_permalink( $participation );
                                                                    $alt_text = get_post_meta( get_post_thumbnail_id($participation), '_wp_attachment_image_alt', true );
                                                                    $get_university_logo = get_field('university_logo', $participation);                                                                
                                                                    ?>
                                                                    <a href="<?php echo $permalink; ?>"><?php echo wp_get_attachment_image($get_university_logo, "medium", "", array("class" => "img-responsive"));  ?>
                                                                    <h3 class="card-title"><?php echo get_the_title($participation); ?></h3></a>
                                                                </div>
                                                                    
                                                            </div>
                                                            
                                                        </div>
                                                    <?php
                                                    
                                                }
                                            }
                                        ?>
                                    </div>

                                    <?php endif; ?>
                                   
                                </div>
                                </main>
                            </div>
                        </div>
                    </div>

                </div>
            <?php

            get_footer();
    
            exit;
        
        }
     
        return $single_template_scholarships;


    }


}


?>