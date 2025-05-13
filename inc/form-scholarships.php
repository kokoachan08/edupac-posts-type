<?php 

class edu003_scholarshipForm{

    static function displayScholarshipForm(){
        $var = apply_filters('filter_scholarship_form', '

            <form class="s-form" method="post">
            
            <div class="edu-form-container">
                <h2 style="font-size: 20px; text-align: center;">Formulir Pendaftaran</h2>
                <p>Tertarik untuk mengambil beasiswa ini? Segera daftarkan diri Anda pada formulir dibawah ini:</p>
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
                    <input type="text" name="educationalInstitutionName" id="educationalInstitutionName" class="form-control text-center" placeholder="Nama Sekolah / Universitas" required>
                </div>

                <div class="form-group">
                    <select name="lastestEducation" id="lastestEducation" class="custom-select form-control text-center" required>
                        <option disabled selected>Pendidikan Terakhir</option>
                        <option value="SMA">SMA</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>

                <input type="hidden" name="scholarship" id="scholarship" value="'. get_the_title() .'" readonly>
                <input type="hidden" name="datetime" id="datetime" value="' . current_time('mysql') . '" readonly>

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
            
        ');

        return $var;

    }

}


?>
