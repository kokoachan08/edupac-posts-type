<?php 

class edu003_universityForms{

    static function displayUniversityForm(){
        global $posts;

        $university_majors = get_field('university_majors');
        $majors_posts = get_posts(array(
            'post_type' => 'majors',
            'posts_per_page' => -1,
            'post__in' => $university_majors
        ));

        ?>
        <form class="u-form" method="post">
            <div class="container overflow-auto" style="height: 65vh;">
                <br />
                <div class="container text-center">
                    <?php echo wp_get_attachment_image( $attachment_id = 4412, 'full', "", array( "class" => "img-responsive" ) ); ?>
                </div>
                <br />
                <h2 class="h4 text-center">Kami Bantu Anda Kuliah di <?php the_title(); ?>!</h2>
                <p class="text-justify">Apakah Anda tertarik untuk kuliah di <?php the_title(); ?>? Yuk, kami bantu proses nya dengan isi formulir di bawah ini:</p>
                <div id="form_alerts"></div>
                <div class="row">
                    <div class="col">
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
                            <select class="custom-select text-center form-control" name="lastestEducation" id="lastestEducation" required>
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
                            <select class="custom-select text-center form-control" name="collegeFinancing" id="collegeFinancing" required>
                                <option disabled selected>Pembiayaan Kuliah</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="orangtua">Orang Tua</option>
                                <option value="beasiswa">Beasiswa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="custom-select text-center form-control" name="chosenProgram" id="chosenProgram" required>
                                <option disabled selected>Program Yang Diambil</option>
                                <option value="Bachelor / S1">Sarjana / S1</option>
                                <option value="Master / S2">Magister / S2</option>
                                <?php if($posts[0]->post_title == "University of Glasgow"): ?>
                                <option value="Doktor / S3">Doktor / S3</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="multiple-checkboxes text-center btn-group-justified multiselect form-control" name="majors" id="majors" multiple="multiple" data-placeholder="Pilih Jurusan" required>
                                <?php foreach ($majors_posts as $post): ?>
                                    <option value="<?php echo esc_attr($post->post_title) ?>"><?php echo esc_html($post->post_title) ?></option>
                                <?php endforeach; ?>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control text-center" name="address" id="address" placeholder="Alamat" required></textarea>
                        </div>

                        <input type="hidden" name="university" id="university" value="<?php echo the_title(); ?>" readonly>
                        <input type="hidden" name="datetime" id="datetime" value="<?php echo current_time('mysql'); ?>" readonly>

                        <div class="form-group">
                            <input type="submit" name="submit" class="form-control btn btn-primary" id="submitBtn" style="color: white">
                        
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
