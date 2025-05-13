<?php 

class edu003_majorForms{

    static function displayMajorForm(){
        global $posts;

        $university_majors = get_posts(array(
            'post_type' => 'university',
            'posts_per_page' => -1,
            'orderby' => 'rand',
            'meta_query' => array(
                array(
                    'key' => 'university_majors',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE'
                )
            )
        ));
    
        ?>
        <form class="m-form" action="post">
            <div class="border p-5 text-center">
                <?php echo wp_get_attachment_image($attachment_id = 4412, "full", "", array("class" => "img-responsive mb-5")); ?>
                <div class="row justify-content-center">
                    <div style="col-12">
                        <div id="form_alerts"></div>
                        <p class="h2">Kuliah <?php the_title(); ?></p>
                        <p>Ingin kuliah <?php the_title(); ?>? Daftarkan diri Anda di formulir bawah ini:</p>
                        
                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="name" id="name" placeholder="Nama Lengkap" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="email" id="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="phoneNumber" id="phoneNumber" placeholder="Nomer Telepon" required>
                        </div>

                        <div class="form-group">
                            <select class="custom-select text-center form-control" name="lastestEducation" id="lastestEducation" style="padding-right: 0.75rem;" required>
                                <option disabled selected>Pendidikan Terakhir</option>
                                <option value="SMA">SMA</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="educationalInstitutionName" id="educationalInstitutionName" placeholder="Nama Sekolah / Universitas" required>
                        </div>

                        <div class="form-group">
                            <select class="custom-select text-center form-control" name="collegeFinancing" id="collegeFinancing" style="padding-right: 0.75rem;" required>
                                <option disabled selected>Pembiayaan Kuliah</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="orangtua">Orang Tua</option>
                                <option value="beasiswa">Beasiswa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="custom-select text-center form-control" name="chosenProgram" id="chosenProgram" style="padding-right: 0.75rem;" required>
                                <option disabled selected>Program Yang Diambil</option>
                                <option value="Bachelor / S1">Sarjana / S1</option>
                                <option value="Master / S2">Magister / S2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="multiple-checkboxes text-center btn-group-justified multiselect" name="university" id="university" multiple="multiple" data-placeholder="Pilih Universitas"  required>
                                <?php foreach($university_majors as $university_major): ?>
                                    <option value="<?php echo esc_attr($university_major->post_title); ?>"><?php echo esc_html($university_major->post_title); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control text-center" name="address" id="address" placeholder="Alamat" required></textarea>
                        </div>

                        <input type="hidden" name="majors" id="majors" value="<?php echo the_title(); ?>" readonly>
                        <input type="hidden" name="datetime" id="datetime" value="<?php echo current_time('mysql'); ?>" readonly>

                        <div class="form-group">
                            <input type="submit" name="submit" class="form-control btn btn-primary" id="submitBtn">
                            <div class="btnwrap">
                                <button type="button" id="loadingBtn" class="form-control btn btn-secondary">
                                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php 
    }
}

?>
