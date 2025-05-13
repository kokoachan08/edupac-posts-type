<?php 


function edu003_plugin_assets(){
    wp_enqueue_script("edu003_enqueue_plugin_scripts", EDUPAC_POSTS_TYPE_URL . 'build/index.js', array('jquery'), '1.0', true);
    wp_enqueue_style("edu003_enqueue_plugin_style", EDUPAC_POSTS_TYPE_URL . 'build/style-index.css');
    wp_enqueue_style('dashicons');

    if( !wp_script_is('jquery')){
        wp_enqueue_script('jquery');
    }

    wp_enqueue_script('jquery-ui');
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_style('jquery-ui-dialog-style', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css');
    
    wp_enqueue_script('jquery-validation', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js');
    wp_enqueue_script('jquery-validation-additional', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js');

    wp_enqueue_script('momentjs-v2.2.1', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js');

    //initialize bootstrap
    wp_enqueue_script('bootstrap-multiselect-script-v1.1.2', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js');
    wp_enqueue_style('bootstrap-multiselect-style-v1.1.2', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css');
    wp_enqueue_script('bootstrap-script-v5.2.0', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js');
    wp_enqueue_style('bootstrap-style-v5.2.0', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-bundle-v5.2.0', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js');
    
    //initialize mdb ui kit
    wp_enqueue_style('mdb-ui-kit-style-v5.0.0', 'https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css');

    //initialize fontawesome
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    //initialize owl carousel
    wp_enqueue_script('owl-carousel-script', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
    wp_enqueue_style('owl-carousel-style', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css');
    

    wp_localize_script('edu003_enqueue_plugin_scripts', 'pluginData', array(
        'ajax_url' =>  admin_url( "admin-ajax.php" ),
        'page_title' => get_the_title(),
        'event_type' => get_field('event_type'),
        'is_single' => is_single()
    ));

}

add_action('wp_enqueue_scripts', 'edu003_plugin_assets');


function totalRecords($post_type){
    global $wpdb;
                
    $table_name = $wpdb->prefix . 'posts';

    $total_records = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE post_type = '" . $post_type . "' AND post_status = 'publish'", array() ));

    return $total_records;
}

function schedule_shortcode( $test_name ) {
    extract( shortcode_atts( array(
        'test_name' => '',
    ), $test_name ) );

    return '
    <table class="p-table">
        <thead>
            <tr>
                <th><h3>Tanggal</h3></th>
                <th><h3>Jam</h3></th>
            </tr>
        </thead>
        <tbody class="schedule" data-test-name="'.$test_name.'"></tbody>                   
    </table>
    <div id="backdrop">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center" role="document">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <div id="now"></div>
    ';
}
add_shortcode( 'schedule', 'schedule_shortcode' );


function short_course_shortcode(){
    $short_courses = get_posts(array(
        'post_type' => 'short-course',
        'post_per_page' => -1,
        'meta_key' => 'short_course_date_short_course_date_start',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'short_course_category',
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE'
            )
        )
    ));
    ?>
    <div class="container-fluid p-0">
        <div class="short-course-carousel owl-carousel owl-theme">
            <?php 
            if(!empty($short_courses)){
                $index = array();

                foreach($short_courses as $short_course){
                    $short_course_date = get_field("short_course_date", $short_course->ID);
                  
                    if(strtotime(current_time('mysql')) < strtotime($short_course_date["short_course_date_end"])){
                        $index[] = $short_course;
                    }
                }

                if(!empty($index)){
                    foreach($index as $sc_id){
                        $tanggal_program = get_field("short_course_date", $sc_id);
                        ?>
                        <div class="card float-left w-100">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php if(has_post_thumbnail($sc_id)):
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($sc_id), 'full');
                                        $alt_text = get_post_meta( get_post_thumbnail_id($sc_id), '_wp_attachment_image_alt', true );   
                                    ?>
                                        <img class="d-block w-100" src="<?php echo $featured_image[0]; ?>" alt="<?php echo $alt_text; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-7 px-6">
                                    <div class="card-block px-6">
                                        <h2><?php echo get_the_title($sc_id); ?></h2>
                                        <div class="mb-2">
                                            <span class="dashicons dashicons-calendar-alt"></span>
                                            <strong><?php echo date("j F Y, g:i a", strtotime($tanggal_program["short_course_date_start"])); ?></strong>
                                        </div>
                                        
                                        <p class="text-justify"><?php echo wp_trim_words(get_post_field('post_content', $sc_id), 50); ?></p>
                                        <?php if(get_field('brochure_download', $sc_id) != NULL): ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="<?php echo get_field('brochure_download', $sc_id); ?>" class="btn btn-primary btn-block">Download Brochure</a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <a href="<?php echo get_the_permalink($sc_id); ?>" class="btn btn-primary btn-block">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php
                        
                    }

                } else{
                    ?>
                    <div class="edu-container">
                        <p style="text-align: center;">Sorry! this program will be available soon.</p>
                    </div>
                    <?php
                }

            } else{
                ?>
                <div class="edu-container">
                    <p style="text-align: center;">Sorry! this program will be available soon.</p>
                </div>
                <?php
            }
            
            
            ?>
         
        </div>
    </div>
    <?php
}
add_shortcode('short_course', 'short_course_shortcode');


//ini buat favicon hilang...
function dialog(){
    ?>
    <div id="dialog" style="display: none;">
        <p>Keuntungan memilih universitas yang merupakan partner, adalah sebagai berikut:</p>
        <ul class="checklist-ul">
            <li>Dibantu proses admisi sampai pengurusan visa pelajar.</li>
            <li>Dibantu pengecekan esai dan resume.</li>
            <li>Free biaya proses aplikasi ke universitas.</li>
        </ul>
    </div>

    <?php if(!is_singular( 'university' )): ?>

    <div class="container" id="requestunidialog" style="display: none;">
        <div class="row">
            <form class="req-form" method="post">
                <h2 class="text-center">Request University</h2>
                <p class="text-center">Tidak menemukan universitas yang Anda inginkan? Jangan khawatir, Anda dapat mengajukan permohonan dengan mengisi formulir dibawah ini:</p>
                <div class="overflow-auto p-3" style="height: 400px;">
                    <div id="form_alerts_req"></div>
                    <div class="form-group">
                        <input type="text" name="name" id="reqname" class="form-control text-center" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" id="reqemail" class="form-control text-center" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="phoneNumber" id="reqphoneNumber" class="form-control text-center" placeholder="Nomer Telepon" required>
                    </div>

                    <div class="form-group">
                        <select name="lastestEducation" id="reqlastestEducation" class="form-control text-center" required>
                            <option disabled selected>Pendidikan Terakhir</option>
                            <option value="SMA">SMA</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                        
                    <div class="form-group">
                        <input type="text" name="educationalInstitutionName" id="reqeducationalInstitutionName" class="form-control text-center" placeholder="Nama Sekolah / Universitas" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="university" id="requniversity" class="form-control text-center" placeholder="Nama Universitas yang diinginkan" required>
                    </div>

                    <div class="form-group">
                        <select name="collegeFinancing" id="reqcollegeFinancing" class="custom-select form-control text-center" required>
                            <option disabled selected>Pembiayaan Kuliah</option>
                            <option value="pribadi">Pribadi</option>
                            <option value="orangtua">Orang Tua</option>
                            <option value="beasiswa">Beasiswa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="chosenProgram" id="reqchosenProgram" class="custom-select form-control text-center" required>
                            <option disabled selected>Program Yang Diambil</option>
                            <option value="Bachelor / S1">Sarjana / S1</option>
                            <option value="Master / S2">Magister / S2</option>
                            <option value="Doktor / S3">Doktor / S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="address" id="reqaddress" class="form-control text-center" placeholder="Alamat" required></textarea>
                    </div>
                    <input type="hidden" name="datetime" id="reqdatetime" value="<?php echo current_time('mysql'); ?>" readonly>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-control btn btn-primary" id="submitBtnReq" style="color: white">
                        <div class="btnwrap">
                            <button type="button" id="loadingBtnReq" class="form-control btn btn-secondary">
                                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php endif; ?>


    <?php 
}
add_action('wp_body_open', 'dialog');

function auto_id_headings( $content ) {

	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}
add_filter( 'the_content', 'auto_id_headings' );


?>