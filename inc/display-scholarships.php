<?php 

class edu003_displayScholarshipsCPT{

    static function displayAllScholarship(){
        global $wpdb;

        $scholarships = get_posts(
            array(
                'post_type' => 'scholarships',
                'post_status' => 'publish',
                'meta_key' => 'scholarship_date_scholarship_date_start',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'posts_per_page' => -1
            )
        );

        ?>
        <div class="container-fluid p-0">
            <div class="row">
                <main id="main" class="site-main">
                    <div class="column">
                        <div class="row">
                            <h1 class="entry-title"><?php echo the_title(); ?></h1>
                            <?php

                            if(!empty($scholarships)){

                                $index = array();

                                foreach($scholarships as $scholarship){
                                    $scholarship_date = get_field("scholarship_date", $scholarship->ID);
                                    if(strtotime(current_time('mysql')) < strtotime($scholarship_date["scholarship_date_end"])){
                                        $index[] = $scholarship;
                                    } 
                                }

                                if(!empty($index)){
                                    foreach($index as $beasiswa_id){
                                        $tanggal_beasiswa = get_field("scholarship_date", $beasiswa_id);
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img style="padding-bottom: 3%;" src="<?php echo get_the_post_thumbnail_url($beasiswa_id); ?>" class="rounded">
                                                    <h2 class="card-title"><?php echo get_the_title($beasiswa_id) ?></h2>
                                                    <span class="dashicons dashicons-calendar-alt"></span>
                                                    <strong><?php echo date("j F Y, g:i a", strtotime($tanggal_beasiswa["scholarship_date_start"])); ?></strong>
                                                    <?php
                                                        $content = get_post_field('post_content', $beasiswa_id);
                                                        $trimmed_content = wp_trim_words(do_shortcode($content), 15);
                                                    ?>
                                                    <p class="card-text"><?php echo $trimmed_content; ?></p>

                                                    <a href="<?php echo get_permalink($beasiswa_id); ?>" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                                                </div>
                                            </div>
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
                </main>
            </div>
        </div>

        <?php

        wp_reset_postdata();
    }

}


?>