<?php


class edu003_shortCourse{

    static function override_single_short_course($single_template_short_course){
        
        global $post;

        if( $post->post_type === 'short-course'){

            $single_template_short_course  = dirname(__FILE__) .'/templates/single-short-course.php';

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
                                <?php while ( have_posts() ) : the_post(); ?>
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
                                                <?php if(have_rows('short_course_location')) : ?>
                                                    <?php while(have_rows('short_course_location')): the_row();
                                                        $short_course_location_type = get_sub_field("short_course_location_selections");
                                                        echo '<p><strong>Lokasi Short Course:</strong>&nbsp;' . $short_course_location_type . '</p>';
                                                    ?> 
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                                <p><?php echo get_the_content(); ?></p>
                                                <h2>Detail Short Course</h2>
                                                <h3>Jam & Tanggal</h3>
                                                <p>Tertarik untuk mengikuti <?php the_title(); ?>? Yuk, segera catat tanggal dibawah ini:</p>
                                                <?php if(have_rows('short_course_date')) : ?>
                                                    <?php while(have_rows('short_course_date')): the_row();
                                                        $short_course_start = get_sub_field("short_course_date_start");
                                                        $short_course_end = get_sub_field("short_course_date_end");

                                                        echo '<p><strong>Short Course Dimulai &nbsp;&emsp; :</strong> ' . date("j F Y, g:i a", strtotime($short_course_start)) . '</p>';
                                                        echo '<p><strong>Short Course Berakhir &emsp; :</strong> ' . date("j F Y, g:i a", strtotime($short_course_end)) . '</p>';
                                                        
                                                    ?> 
                                                    <?php endwhile; ?>
                                                <?php endif; ?>

                                                <h3>Alamat Short Course</h3>
                                                <?php if(have_rows('short_course_location')) : ?>
                                                    <?php while(have_rows('short_course_location')): the_row();
                                                        $short_course_location_type = get_sub_field("short_course_location_selections");
                                                        if($short_course_location_type == "Offline"){
                                                            ?>
                                                            <p>Berikut adalah detail alamat dimana <?php the_title() ?> berlangsung:</p>
                                                            <p><strong>Alamat Lengkap: </strong><?php echo get_sub_field("short_course_location_offline"); ?></p>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <p style="text-align: justify;">Short course ini diadakan secara online, daftarkan diri Anda untuk mendapatkan link-nya. Link event akan diberikan 1 hari sebelum short course berlangsung ke email terdaftar.</p>
                                                            <?php
                                                        }
                                                    ?> 
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </div>
                                            <br /><br />
                                            <div class="col-sm-4">
                                                <?php echo do_shortcode('[displayShortCourseForm]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </main>					
                        </div>
                        <?php
                        if ( RDTheme::$layout == 'right-sidebar' ) {
                            get_sidebar();
                        }
                        ?>
                    </div>
                </div>

            <?php 
            
            get_footer();

            exit;

        }

        return $single_template_short_course;

    }

}


?>