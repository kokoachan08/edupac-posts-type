<?php 

class edu003_sidebarUniversity{

    static function renderSidebarUniversity() {
        global $post;

        if ($post->post_type === 'university'){

            ?>
                <aside id="sidebar-wrapper" class="border-end bg-white overflow-auto flex-shrink-0" style="display: none;">
                    <div id="toc" class="table-of-contents mx-3">
                        <h2 class="my-3">Daftar Isi</h2>
                        <ol class="p-0">
                            <?php
                            $current_title = get_the_title();

                            $toc_items = [
                                'section-1' => ['tab' => 'tentang-universitas', 'label' => "Tentang $current_title"],
                                'section-2' => ['tab' => 'biaya-kuliah', 'label' => "Biaya Kuliah di $current_title", 'acf_field' => 'university_price_tuition_fees'],
                                'section-3' => ['tab' => 'kenapa-kuliah', 'label' => "Kenapa Kuliah di $current_title?", 'acf_field' => 'why_choose_us'],
                                'section-4' => ['tab' => 'syarat-masuk', 'label' => 'Syarat Masuk', 'acf_field' => 'university_entry_requirements_2'],
                                'section-5' => ['tab' => 'jurusan-kuliah', 'label' => "Jurusan Kuliah di $current_title"],
                                'section-6' => ['tab' => 'event-n-scholarships', 'label' => 'Event & Scholarships']
                            ];

                            foreach ($toc_items as $id => $data) {
                                $section_id = esc_attr($id); // ID untuk elemen utama
                                echo "<li><a href='#{$section_id}' data-tab='{$data['tab']}'>{$data['label']}</a>";

                                // Counter untuk sub-item
                                $sub_item_counter = 1;

                                switch ($id) {
                                    case 'section-5':
                                        $the_terms = get_terms(array(
                                            'taxonomy' => 'major_categories',
                                            'hide_empty' => false,
                                            'parent' => 0
                                        ));

                                        if(!empty($the_terms)){
                                            echo '<ol class="p-0">';
                                            foreach($the_terms as $the_term){
                                                $my_posts = new WP_QUERY(array(
                                                    'post_type' => 'majors',
                                                    'post_per_page' => -1,
                                                    'post__in' => get_field('university_majors'),
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'major_categories',
                                                            'field' => 'slug',
                                                            'terms' => $the_term->slug
                                                        )
                                                    )
                                                ));
                                                if($my_posts->have_posts()){
                                                    $sub_id = "{$section_id}-" . $sub_item_counter++;
                                                    echo "<li><a href='#{$sub_id}' data-tab='{$data['tab']}'>" . esc_html($the_term->name) . "</a></li>";
                                                }
                                            }
                                            echo '</ol>';
                                        }
                                    break;
                                    
                                    case 'section-6':
                                        $event_posts = get_posts([
                                            'post_type' => 'events',
                                            'posts_per_page' => -1,
                                            'meta_key' => 'event_date_event_date_start',
                                            'orderby' => 'meta_value',
                                            'order' => 'ASC',
                                            'meta_query' => [
                                                [
                                                    'key' => 'attending_university',
                                                    'value' => '"' . get_the_ID() . '"',
                                                    'compare' => 'LIKE'
                                                ]
                                            ]
                                        ]);

                                        $scholarship_posts = get_posts([
                                            'post_type' => 'scholarships',
                                            'posts_per_page' => -1,
                                            'meta_key' => 'scholarship_date_scholarship_date_start',
                                            'orderby' => 'meta_value',
                                            'order' => 'ASC',
                                            'meta_query' => [
                                                [
                                                    'key' => 'participating_university',
                                                    'value' => '"' . get_the_ID() . '"',
                                                    'compare' => 'LIKE'
                                                ]
                                            ]
                                        ]);

                                        $merged_posts = array_merge($event_posts, $scholarship_posts);
                                        usort($merged_posts, function ($a, $b) {
                                            $date_a = get_field('event_date', $a->ID)['event_date_start'] ?? get_field('scholarship_date', $a->ID)['scholarship_date_start'];
                                            $date_b = get_field('event_date', $b->ID)['event_date_start'] ?? get_field('scholarship_date', $b->ID)['scholarship_date_start'];
                                            return strtotime($date_a) - strtotime($date_b);
                                        });

                                        $results = array_filter($merged_posts, function ($post) {
                                            $the_date = get_field('event_date', $post->ID) ?? get_field('scholarship_date', $post->ID);
                                            $end_date = $the_date['event_date_end'] ?? $the_date['scholarship_date_end'];
                                            return strtotime(current_time('mysql')) < strtotime($end_date);
                                        });

                                        if (!empty($results)) {
                                            echo '<ol class="p-0">';
                                            foreach ($results as $result) {
                                                $sub_id = "{$section_id}-" . $sub_item_counter++;
                                                echo "<li><a href='#{$sub_id}' data-tab='{$data['tab']}'>" . esc_html($result->post_title) . "</a></li>";
                                            }
                                            echo '</ol>';
                                        }
                                    break;

                                    default:
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
                                        break;
                                }

                                echo '</li>';
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