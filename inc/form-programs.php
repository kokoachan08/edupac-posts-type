<?php 

class edu003_programForm{

    static function displayProgramForm(){
        ?>
        <form class="p-form" method="post">

            <div class="edu-form-container">
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
                    <textarea name="address" id="address" class="form-control text-center" placeholder="Alamat" required></textarea>
                </div>

                <div class="form-group">
                    <textarea name="question" id="question" class="form-control text-center" placeholder="Pertanyaan jika ada"></textarea>
                </div>

                <input type="hidden" name="program" id="program" value="<?php echo the_title(); ?>" readonly>
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
