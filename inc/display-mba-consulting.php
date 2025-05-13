<?php 

class edu003_displayMBAConsulting{

    static function searchMBAUniversity(){
        
        $studyAbroads = get_posts(array(
            'post_type' => 'study-abroad',
            'posts_per_page' => -1
        ));

        $mba_major = get_posts(array(
            'post_type' => 'majors',
            'title' => 'MBA'
        ));

        $universities = get_posts(
            array(
                'post_type' => 'university',
                'post_status' => 'publish',
                'orderby' => 'post_date',
                'order' => 'ASC',
                'posts_per_page' =>  -1,
                'meta_query' => array(
                    array(
                        'key' => 'university_majors', 
                        'value' => $mba_major[0]->ID,
                        'compare' => 'LIKE'
                    )
                )
            )
        );

        ?>

        <div class="bg-abstract-square">
            <div class="row">
                <div class="col-sm-7">
                    <div class="p-5 mt-5">
                        <span class="lead font-weight-bold text-uppercase text-white">Biarkan Kami Membantu Anda!</span>
                        <h2 class="display-5 text-white text-white">Diterima Kuliah MBA di Universitas Terbaik Luar Negeri</h2>
                        <p class="lead text-white">Raih Letter of Acceptance (LOA) di Universitas atau Business School Top di Luar Negeri, Selesaikan Gelar MBA, dan Wujudkan Karier yang Cemerlang!</p>
                        <button class="popmake-7795 pum-btn w-100">Konsultasi Gratis</button>
                    </div>
                </div>
                <div class="col-sm-4" style="margin-block-start: auto">
                    <img src="https://www.edupac-id.com/wp-content/uploads/2025/04/mba-consultant.png" alt="mba-consultant" class="img-responsive w-auto">
                </div>
            </div>

          
            <div class="row px-md-5" style="z-index: 2; position: relative;">
                <div class="card h-100" style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                    <div class="card-body" >
                        <h2 class="display-6">Search MBA University</h2>
                        <p class="lead">Cari universitas MBA di luar negeri favorit Anda dibawah ini:</p>
                        <div class="input-group mb-3 w-100 flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text dashicons dashicons-search" style="padding-right: 1.8rem!important;" id="inputGroup-sizing-default"></span>
                            </div>
                            <input class="form-control" type="text" id="searchUniversity" placeholder="Search Here...">
                        </div>
            
                        <ul class="list-group text-left m-0 mt-3" id="list" style="display: none;">
                            <?php foreach($universities as $university): ?>
                                <li class="list-group-item" style="border: 1px solid #ddd;">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="d-flex flex-wrap">
                                                <a href="<?php the_permalink($university->ID) ?>"><h3 style="font-size: 15px;" class="mb-0 mr-3"><?php echo $university->post_title ?></h3></a>
                                                <?php if(get_field('university_partnership', $university->ID) === true): ?>
                                                    <div id="partner-badge" style="cursor: pointer; font-size: small;">
                                                        <p class="badge badge-primary badge-pill">PARTNER</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                <?php $university_locations = get_field('university_location', $university->ID); ?>
                                                <?php foreach ($university_locations as $location): ?>
                                                    <?php foreach($studyAbroads as $studyAbroad): ?>
                                                        <?php if($location === $studyAbroad->ID): ?>
                                                            <div class="mr-2">
                                                                <p style="font-size: 12px;" class="text-left"><a href="<?php echo get_permalink($studyAbroad->ID); ?>"><?php echo get_field("country_flag", $studyAbroad->ID) . get_the_title($location); ?></a></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-left">
                                            <?php 
                                                $university_logo = get_field('university_logo', $university->ID);
                                                $size = 'thumbnail';
                                                if( ! empty ( $university_logo ) ) {
                                                    echo wp_get_attachment_image($university_logo, $size, "", array( "class" => "img-responsive" ));
                                                }
                                            ?>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    
                                </li>
                            <?php endforeach; ?>
                        </ul>
                
                    </div>
                </div>
            </div>
    
        </div>

        <?php

    }
    
}



?>