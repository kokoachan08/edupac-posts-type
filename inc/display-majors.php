<?php 

class edu003_displayMajorsCPT{

    static function displayAllMajor(){
        global $wpdb;

        $terms = get_terms('major_categories', array(
            'parent' => 0,
            'orderby' => 'name',
            'order' => 'ASC'
        ));
        
        $table_name = $wpdb->prefix . 'posts';
        $total_records = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_type = 'majors' AND post_status = 'publish'", array() ));
        
        ?>
        <div class="container-fluid p-0">
            <h1><?php echo $total_records; ?> Jurusan Kuliah Terbaik di Luar Negeri</h1>
            <br />
            <?php ob_start(); ?>
                <?php 
                    foreach($terms as $term){

                        $majors = new WP_QUERY(array(
                            'post_type' => 'majors',
                            'post_status' => 'publish',
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'major_categories' => $term->name
                        ));
                        ?>
                            <h2><?php echo $term->name; ?></h2>
                            <p><?php echo $term->description; ?></p>
                            <details>
                                <summary>
                                    <p><strong>Klik Untuk Lihat Jurusan &raquo;</strong></p>
                                </summary>
                                <ul>
                                    <?php while($majors->have_posts()) : $majors->the_post(); ?>
                                    <li>
                                        <details>
                                            <summary><h3><?php echo the_title(); ?></h3></summary>
                                            <p><?php echo wp_trim_words(get_the_content(), 15); ?><a href="<?php the_permalink(); ?>"> Baca Selengkapnya &raquo;</a></p>
                                        </details>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                            </details>
                            <hr style="border-top: 1px solid #000000; ">

                        <?php
                    } 
                    
                ?>
            <?php return ob_get_clean(); ?>
        </div>
        <?php

        wp_reset_postdata();
       
    }

    

}







?>