<?php

class edu003_studyAbroadForms{

    static function displayStudyAbroadForm(){
        global $posts;

        ?>
        <form class="sa-form" method="post">
            <div class="container overflow-auto" style="height: 65vh;">
                <br />
                <div class="container text-center">
                    <?php echo wp_get_attachment_image( $attachment_id = 4412, 'full', "", array( "class" => "img-responsive" ) ); ?>
                </div>
                <br />
                <?php if($posts[0]->post_title === "Study Abroad"): ?>
                <h2 style="font-size: 20px; text-align: center;">Kami Bantu Anda Kuliah di Luar Negeri!</h2>
                <p style="text-align: justify;">Apakah Anda tertarik untuk kuliah di Luar Negeri? Yuk, kami bantu! Isi formulir dibawah ini ya:</p>
                <?php else: ?>
                <h2 style="font-size: 20px; text-align: center;">Kami Bantu Anda Kuliah di <?php the_title(); ?>!</h2>
                <p style="text-align: justify;">Apakah Anda tertarik untuk kuliah di <?php the_title(); ?>? Yuk, kami bantu! Isi formulir dibawah ini ya:</p>
                <?php endif; ?>
                <div id="form_alerts"></div>
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control text-center" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <input type="text" name="email" id="email" class="form-control text-center" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control text-center" placeholder="Nomer Telepon" required>
                </div>

                <div class="form-group">
                    <select name="lastestEducation" id="lastestEducation" class="custom-select form-control text-center" required>
                        <option disabled selected>Pendidikan Terakhir</option>
                        <option value="SMA">SMA</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>
                    
                <div class="form-group">
                    <input type="text" name="educationalInstitutionName" id="educationalInstitutionName" class="form-control text-center" placeholder="Nama Sekolah / Universitas" required>
                </div>

                <div class="form-group">
                    <select name="collegeFinancing" id="collegeFinancing" class="custom-select form-control text-center" required>
                        <option disabled selected>Pembiayaan Kuliah</option>
                        <option value="pribadi">Pribadi</option>
                        <option value="orangtua">Orang Tua</option>
                        <option value="beasiswa">Beasiswa</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="chosenProgram" id="chosenProgram" class="custom-select form-control text-center" required>
                        <option disabled selected>Program Yang Diambil</option>
                        <option value="Bachelor / S1">Sarjana / S1</option>
                        <option value="Master / S2">Magister / S2</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="englishSkills" id="englishSkills" class="custom-select form-control text-center" required>
                        <option disabled selected>Tes Bahasa Inggris Yang Diambil</option>
                        <option value="TOEFL iBT">TOEFL iBT</option>
                        <option value="IELTS">IELTS</option>
                        <option value="Not Yet Taken">Belum Pernah Ambil</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="englishScore" id="englishScore" class="form-control text-center" placeholder="Skor Bahasa Inggris" required>
                </div>

                <div class="form-group">
                    <textarea name="address" id="address" class="form-control text-center" placeholder="Alamat" required></textarea>
                </div>

                <input type="hidden" name="studyabroad" id="studyabroad" value="<?php echo the_title(); ?>" readonly>
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
        </form>

        <?php

    }

}

?>
