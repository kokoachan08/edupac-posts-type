<?php 

class edu003_displayEventsCPT{

    static function displayAllEvent(){
        global $wpdb;

        $events = get_posts(
            array(
                'post_type' => 'events',
                'post_status' => 'publish',
                'meta_key' => 'event_date_event_date_start',
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

                            if(!empty($events)){
                                $index = array();
                                foreach($events as $event){
                                    $event_date = get_field("event_date", $event->ID);
                                    if(strtotime(current_time('mysql')) < strtotime($event_date["event_date_end"])){
                                        $index[] = $event;
                                    }
                                }

                                if(!empty($index)){
                                    foreach($index as $acara_id){
                                        $tanggal_acara = get_field("event_date", $acara_id);
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img style="padding-bottom: 3%;" src="<?php echo get_the_post_thumbnail_url($acara_id); ?>" class="rounded">
                                                    <h2 class="card-title"><?php echo get_the_title($acara_id) ?></h2>
                                                    <span class="dashicons dashicons-calendar-alt"></span>
                                                    <strong><?php echo date("j F Y, g:i a", strtotime($tanggal_acara["event_date_start"])); ?></strong>
                                                    <p class="card-text"><?php echo wp_trim_words(get_post_field('post_content', $acara_id), 15); ?></p>
                                                    <a href="<?php echo get_permalink($acara_id); ?>" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else{
                                    ?>
                                    <div class="edu-container">
                                        <p style="text-align: center;">Sorry! there is no ongoing event available.</p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="edu-container">
                                    <p style="text-align: center;">Sorry! there is no ongoing event available.</p>
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