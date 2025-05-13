<?php 

class edu003_sidebarStudyAbroad{
    static function renderSidebarStudyAbroad(){
        global $post;

        if ($post->post_type === 'study-abroad'){
            ?>
                <aside id="sidebar-wrapper" class="border-end bg-white overflow-auto flex-shrink-0" style="display: none;">
                    <div id="toc" class="table-of-contents mx-3">
                        <h2 class="my-3">Daftar Isi</h2>
                        <ol class="p-0">
                        <?php
                            $current_title = get_the_title();

                            $toc_items = [
                                'section-1' => ['tab' => 'tentang-negara', 'label' => "Tentang Kuliah di $current_title"],
                                'section-2' => ['tab' => 'biaya-kuliah', 'label' => "Biaya Kuliah di $current_title", 'acf_field' => 'estimated_price'],
                                'section-3' => ['tab' => 'kenapa-kuliah', 'label' => "Alasan Kuliah di $current_title?", 'acf_field' => 'why_study_here'],
                                'section-4' => ['tab' => 'syarat-kuliah', 'label' => "Syarat Kuliah di $current_title", 'acf_field' => 'study_abroad_requirements'],
                                'section-5' => ['tab' => 'daftar-universitas', 'label' => "Daftar Universitas di $current_title"],
                                'section-6' => ['tab' => 'scholarships', 'label' => 'Scholarships']
                            ];

                            foreach($toc_items as $id => $data){
                                $section_id = esc_attr($id); // ID untuk elemen utama
                                echo "<li><a href='#{$section_id}' data-tab='{$data['tab']}'>{$data['label']}</a>";
                                // Counter untuk sub-item
                                $sub_item_counter = 1;
                                switch($id){
                                    case 'section-5':
                                        $university_lists = get_posts(array(
                                            'post_type' => 'university',
                                            'posts_per_page' => -1,
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'university_location',
                                                    'value' => '"' . get_the_ID() . '"',
                                                    'compare' => 'LIKE'
                                                )
                                            )
                                        ));
                                        if ($university_lists) {
                                            echo '<ol class="p-0">';
                                            foreach ($university_lists as $university_list) {
                                                $sub_id = "{$section_id}-" . $sub_item_counter++;
                                                echo "<li><a href='#{$sub_id}' data-tab='{$data['tab']}'>" . esc_html($university_list->post_title) . "</a></li>";
                                            }
                                            echo '</ol>';
                                        }
                                    
                                    break;
                                    case 'section-6':
                                        $lists = get_posts(array(
                                            'post_type' => 'university',
                                            'posts_per_page' => -1,
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'university_location',
                                                    'value' => '"' . get_the_ID() . '"',
                                                    'compare' => 'LIKE'
                                                )
                                            )
                                        ));

                                        $items = array();
                                        if(!empty($lists)){
                                            foreach($lists as $list){
                                                $scholarships = get_posts(array(
                                                    'post_type' => 'scholarships',
                                                    'post_per_page' => -1,
                                                    'meta_key' => 'scholarship_date_scholarship_date_start',
                                                    'orderby' => 'meta_value',
                                                    'order'  => 'ASC',
                                                    'meta_query' => array(
                                                        array(
                                                        'key' => 'participating_university',
                                                        'value' => $list->ID,
                                                        'compare' => 'LIKE'
                                                        )
                                                    )
                                                ));
                                                foreach($scholarships as $scholarship){
                                                    $items[] = $scholarship->ID;
                                                }
                                                
                                                $results = array_unique($items);

                                            }

                                            $index = array();

                                            foreach($results as $result){
                                                $scholarship_date = get_field('scholarship_date', $result);

                                                if(strtotime(current_time('mysql')) < strtotime($scholarship_date["scholarship_date_end"])){
                                                    $index[] = $result;
                                                    $beasiswa = array_slice($index, 0, 3, true);
                                                }
                                            }

                                            if(!empty($beasiswa)){
                                                echo '<ol class="p-0">';
                                                foreach($beasiswa as $beasiswa_id){
                                                    $sub_id = "{$section_id}-" . $sub_item_counter++;
                                                    echo "<li><a href='#{$sub_id}' data-tab='{$data['tab']}'>" . esc_html(get_the_title($beasiswa_id)) . "</a></li>";
                                                }
                                                echo '</ol>';
                                            }
                                        }
                                }
                                if (!empty($data['acf_field'])) {
                                    $field_content = get_field($data['acf_field']);
                                    if (is_array($field_content)) {
                                        echo '<ol class="p-0">';
                                        foreach ($field_content as $index => $item) {
                                            $sub_id = "{$section_id}-" . ($index + 1);
                                            echo "<li><a href='#{$sub_id}' data-tab='{$data['tab']}'>" . esc_html(get_the_title($item)) . "</a></li>";
                                        }
                                        echo '</ol>';
                                    } else {
                                        preg_match_all('/<\s*h3[^>]*>(.*?)<\/h3>/i', $field_content, $matches);
                                        if (!empty($matches[1])) {
                                            echo '<ol class="p-0">';
                                            foreach ($matches[1] as $index => $heading) {
                                                $sub_id = "{$section_id}-" . ($index + 1);
                                                echo "<li><a href='#{$sub_id}' data-tab='{$data['tab']}'>" . esc_html($heading) . "</a></li>";
                                            }
                                            echo '</ol>';
                                        }
                                    }
                                }
                            }
                            
                        ?>
                        </ol>
                    </div>
                </aside>
            <?php
        }

    }
}


?>