<?php 

class edu003_eventForm{

    static function displayEventForm(){
        if(get_field('event_type') == 'undergraduate'){
                
            $var = apply_filters('filter_event_form', '

                <form class="e-form" method="post">
                
                <div class="edu-form-container">
                    <h2 style="font-size: 20px; text-align: center;">Daftar Event '. get_the_title() . '</h2>
                    <p>Yuk, daftarkan diri Anda untuk mengikuti event '. get_the_title() .' pada formulir dibawah ini:</p>
                    <div id="form_alerts"></div>

                    <div class="edu-form-content">
                        <input type="text" name="name" id="name" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="edu-form-content">
                        <input type="text" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="edu-form-content">
                        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Nomer Telepon" required>
                    </div>
                    <div class="edu-form-content">
                        <input type="text" name="educationalInstitutionName" id="educationalInstitutionName" placeholder="Nama Sekolah" required>
                    </div>

                    <div class="edu-form-content">
                        <select name="lastestEducation" id="lastestEducation" required>
                            <option disabled selected>Pendidikan Terakhir</option>
                            <option value="SMP 1">SMP 1</option>
                            <option value="SMP 2">SMP 2</option>
                            <option value="SMP 3">SMP 3</option>
                            <option value="SMA 1">SMA 1</option>
                            <option value="SMA 2">SMA 2</option>
                            <option value="SMA 3">SMA 3</option>
                        </select>
                    </div>

                    <div class="edu-form-content">
                        <textarea name="address" id="address" placeholder="Alamat" required></textarea>
                    </div>

                    <input type="hidden" name="event" id="event" value="'. get_the_title() .'" readonly>
                    <input type="hidden" name="datetime" id="datetime" value="' . current_time('mysql') . '" readonly>

                    <div class="edu-form-submit">
                        <input type="submit" name="submit" class="edu-submit-btn" id="submitBtn" style="color: white">
                        
                        <div class="btnwrap">
                            <button type="button" id="loadingBtn" class="edu-btn">
                                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                            </button>
                        </div>
                    </div>

                </div>

                </form>
                
            ');

            return $var;

        }else{

            $var = apply_filters('filter_event_form', '
                <form class="e-form" method="post">
                
                <div class="edu-form-container">
                    <h2 style="font-size: 20px; text-align: center;">Daftar Event '. get_the_title() . '</h2>
                    <p>Yuk, daftarkan diri Anda untuk mengikuti event '. get_the_title() .' pada formulir dibawah ini:</p>
                    <div id="form_alerts"></div>

                    <div class="edu-form-content">
                        <input type="text" name="name" id="name" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="edu-form-content">
                        <input type="text" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="edu-form-content">
                        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Nomer Telepon" required>
                    </div>
                    <div class="edu-form-content">
                        <input type="text" name="educationalInstitutionName" id="educationalInstitutionName" placeholder="Nama Universitas" required>
                    </div>

                    <div class="edu-form-content">
                        <input type="text" name="companyName" id="companyName" placeholder="Nama Perusahaan" required>
                    </div>

                    <div class="edu-form-content">
                        <input type="text" name="profession" id="profession" placeholder="Pekerjaan Anda" required>
                    </div>

                    <div class="edu-form-content">
                        <textarea name="address" id="address" placeholder="Alamat" required></textarea>
                    </div>

                    <input type="hidden" name="event" id="event" value="'. get_the_title() .'" readonly>
                    <input type="hidden" name="datetime" id="datetime" value="' . current_time('mysql') . '" readonly>

                    <div class="edu-form-submit">
                        <input type="submit" name="submit" class="edu-submit-btn" id="submitBtn" style="color: white">
                        
                        <div class="btnwrap">
                            <button type="button" id="loadingBtn" class="edu-btn">
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

}



?>