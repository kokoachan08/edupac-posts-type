<?php 

class edu003_shortCourseForms{

    static function displayShortCourseForm(){
        global $posts;

        ?>
          <form class="sc-form" method="post">
            <div class="edu-form-container">
                <h2 style="font-size: 20px; text-align: center;">Daftar Short Course <br> <?php the_title(); ?></h2>
                <p style="text-align: justify;">Tertarik untuk mengikuti program ini? Yuk daftarkan diri Anda di form berikut:</p>
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
                        <option value="SMA 1">SMA 1</option>
                        <option value="SMA 2">SMA 2</option>
                        <option value="SMA 3">SMA 3</option>
                    </select>
                </div>
                    
                <div class="form-group">
                    <input type="text" name="educationalInstitutionName" id="educationalInstitutionName" class="form-control text-center" placeholder="Nama Sekolah" required>
                </div>

                <div class="form-group">
                    <textarea name="address" id="address" class="form-control text-center" placeholder="Alamat" required></textarea>
                </div>

                <input type="hidden" name="shortcourse" id="shortcourse" value="<?php echo the_title(); ?>" readonly>
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
