<?php 

class edu003_singlePrograms{
    static function override_single_template_programs($single_template_programs){
        
        global $post;
    
        if( $post->post_type === 'programs'){

            $single_template_programs  = dirname(__FILE__) .'/templates/single-programs.php';
            
            if ( RDTheme::$layout == 'full-width' ) {
                $rdtheme_layout_class = 'col-sm-12 col-12';
            }
            else{
                $rdtheme_layout_class = 'col-sm-12 col-md-8 col-lg-9 col-12';
            }
    
            get_header();

            ?>

            <div id="primary">
                <div class="container-fluid p-0">
                    <?php

                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $featured_image_caption = wp_get_attachment_caption(get_post_thumbnail_id($post->ID));
                    $alt_text = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
                    ?>
                    <div class="<?php echo get_field('class_background_banner'); ?>">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="p-5 mt-5"> 
                                    <h1 class="display-5 text-white"><strong><?php echo get_the_title(); ?></strong></h1>
                                    <?php echo get_field('lead_banner'); ?>
                                    <?php if(get_field('show_register_button') === true): ?>
                                        <?php if( $post->ID == 5427): ?>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <a href="https://api.whatsapp.com/send?phone=628179338722">
                                                        <img class="alignnone size-medium wp-image-3005" src="https://www.edupac-id.com/blog/wp-content/uploads/2022/11/whatsapp-kaplan-edupac-jakarta-300x80.png" alt="whatsapp-kaplan-edupac-jakarta" width="300" height="80" />
                                                    </a>
                                                </div>
                                                <div class="col-sm-5">
                                                    <a href="https://api.whatsapp.com/send?phone=6282177788556">
                                                        <img class="alignnone size-medium wp-image-3006" src="https://www.edupac-id.com/blog/wp-content/uploads/2022/11/whatsapp-kaplan-edupac-surabaya-300x80.png" alt="whatsapp-kaplan-edupac-surabaya" width="300" height="80" />
                                                    </a>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <a class="btn btn-primary btn-lg w-100" href="#form-pendaftaran">Daftar Sekarang</a>
                                        <?php endif; ?>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-sm-4" style="margin-block-start: auto">
                                <?php if(has_post_thumbnail($post->ID)) : ?>
                                    <img src="<?php echo $featured_image[0]; ?>" alt="<?php echo $alt_text; ?>" class="img-responsive">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
              
                    <div class="container-fluid p-5">
                        <div class="row">
                            <main id="main" class="site-main">
                                <?php echo the_content(); ?>
                            </main>
                        </div>
                    </div>
                   
                    <div class="container-fluid p-3" style="background-image: linear-gradient(to bottom, powderblue, white);">
                        <div class="row mb-5">
                            <div class="col-sm-8 mx-auto position-sticky">
                            <h2 class="p-5 text-center">Frequent Ask Questions (FAQ)</h2>
                                <div class="p-3 bg-white border border-dark" style="border-radius: 1.25rem">
                                    <?php if(have_rows('frequent_ask_question')) : ?>
                                        <?php while(have_rows('frequent_ask_question')): the_row();
                                            $questions = get_sub_field("pertanyaan");
                                            $answers = get_sub_field("jawaban");
                                        ?>
                                            <?php foreach($questions as $index => $question): ?>
                            
                                                <details class="detail-style p-3 mb-3">
                                                    <summary class="summary-style"><h3><?php echo $question;  ?></h3></summary>
                                                    <span><p class="mt-3"><?php echo $answers[$index]; ?></p><span>
                                                </details>
                                        
                                            <?php endforeach; ?>
                                        <?php endwhile; ?>

                                    <?php endif; ?>

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
     
        return $single_template_programs;


    }


}






?>