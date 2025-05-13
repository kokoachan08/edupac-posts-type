<?php 

class edu003_displayProgramsCPT{
    static function display_programs_shortcode(){    
        $parent_pages = get_pages( array(
            'post_type' => 'programs',
            'parent' => 0,
            'sort_column' => 'menu_order',
            'sort_order' => 'ASC'
        ) );
        
        ob_start();
        echo '<div class="container">';
        echo '<div id="lists" class="row">';
      
        
        foreach($parent_pages as $parent){
          
            echo '<div class="col-sm-4">';
            echo '<div class="card mb-3">';
            echo '<div class="card-header">';
            echo '<h2><a href="'.get_permalink($parent->ID).'">'.get_the_title($parent->ID).'</a></h2>';
            echo '</div>';
            echo '<div class="card-body">';
            $child_pages = wp_list_pages( array(
                'title_li'    => '',
                'post_type' => 'programs',
                'child_of' => $parent->ID,
            ));
            if ( $child_pages ) {
                foreach($child_pages as $child){
                    echo '<a href="'.get_permalink($child->ID).'">' . $child->post_title . '</a>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
       

        return ob_get_clean();
    }    

    static function displayAllProgram() {
        // Ambil semua terms untuk 'program_categories'
        $program_terms = get_terms('program_categories', array(
            'parent' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false
        ));
    
        ?>
        <div class="container p-0">
            <div class="row">
            <?php 
            $index = 1; // Inisialisasi penghitung
            foreach ($program_terms as $program_term): 
            ?>
                <h2>
                    <?php echo $index; ?>. <!-- Tampilkan nomor -->
                    <a href="<?php echo $program_term->slug ?>">
                        <?php echo $program_term->name; ?> 
                        <i class="fa fa-external-link" aria-hidden="true" style="font-size: initial;"></i>
                    </a>
                </h2>
                <?php 
                    // Ambil posts berdasarkan kategori program
                    $programs = get_posts(array(
                        'post_type' => 'programs',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'program_categories',
                                'field'    => 'slug',
                                'terms'    => $program_term->slug,
                            ),
                        ),
                    ));
                    
                    // Kumpulkan semua terms 'program_name' yang relevan
                    $program_name_ids = array();
                    foreach ($programs as $program) {
                        $program_name_terms = wp_get_post_terms($program->ID, 'program_name');
                        foreach ($program_name_terms as $program_name_term) {
                            $program_name_ids[] = $program_name_term->term_id;
                        }
                    }
                    // Ambil data unik dari program_name_ids
                    $program_name_ids = array_unique($program_name_ids);
    
                    // Ambil terms 'program_name' berdasarkan ID yang relevan
                    if (!empty($program_name_ids)) {
                        $program_name_terms = get_terms('program_name', array(
                            'include'    => $program_name_ids,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => false
                        ));
    
                        foreach ($program_name_terms as $program_name_term) {
                            $program_name = $program_name_term->name;
                            $program_slug = $program_term->slug . "/" . $program_name_term->slug;
                            ?>
                            <div class="col-sm-6 col-lg-3 py-4">
                                <div class="card h-100">
                                    <img src="<?php echo z_taxonomy_image_url($program_name_term->term_id) ?: 'path/to/default-image.jpg'; ?>" alt="<?php echo $program_name; ?>">
                                    <div class="card-body">
                                        <h3><a href="<?php echo $program_slug ?>"><?php echo $program_name; ?></a></h3>
                                        <?php
                                            // Filter posts berdasarkan program_name
                                            $program_posts = get_posts(array(
                                                'post_type' => 'programs',
                                                'post_status' => 'publish',
                                                'order' => 'ASC',
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    'relation' => 'AND',
                                                    array(
                                                        'taxonomy' => 'program_categories',
                                                        'field'    => 'slug',
                                                        'terms'    => $program_term->slug,
                                                    ),
                                                    array(
                                                        'taxonomy' => 'program_name',
                                                        'field'    => 'slug',
                                                        'terms'    => $program_name_term->slug,
                                                    ),
                                                ),
                                            ));
                                        ?>
    
                                        <ul>
                                            <?php 
                                            if (!empty($program_posts)) {
                                                foreach ($program_posts as $program_post): ?>
                                                    <li class="text-left">
                                                        <a href="<?php echo get_permalink($program_post->ID) ?>">
                                                            <?php echo $program_post->post_title; ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach;
                                            } else { ?>
                                                <li>Tidak ada kursus tersedia.</li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } 
                ?>
            <br />
            <?php 
            $index++; // Increment penghitung
            endforeach; 
            ?>
            </div>
        </div>
        <?php 
    
        wp_reset_postdata();
    }

}


?>