import $ from "jquery";

class edu003_universityForm{
    constructor(){
        this.events();
    }

    events(){
        $(document).ready(function(){
            
            $('.u-form').validate({
                rules:{
                    name:{
                        validateName: true,
                        minlength: 3
                    },
                    email:{
                        nowhitespace: true,
                        validateEmail: true
                    },
                    phoneNumber:{
                        validatePhoneNumber: true,
                        nowhitespace: true,
                        minlength: 10
                    },
                    educationalInstitutionName:{
                        validateEducationalInstitute: true,
                        minlength: 3
                    },
                    address:{
                        validateAddress: true,
                        minlength: 10
                    }
                },
                messages:{
                    name:{
                        required: 'Mohon masukkan nama Anda!',
                        minlength: 'Masukkan nama minimal 3 karakter!'
                    },
                    email:{
                        required: 'Mohon masukkan email Anda!'
                    },
                    phoneNumber:{
                        required: 'Mohon masukkan nomer telepon Anda!',
                        minlength: 'Masukkan nomer minimal 10 angka!'
                    },
                    lastestEducation:{
                        required: 'Mohon masukkan pendidikan terakhir Anda!'
                    },
                    educationalInstitutionName:{
                        required: 'Mohon masukkan nama sekolah atau universitas Anda!',
                        minlength: 'Masukkan nama sekolah atau universitas minimal 3 karakter!'
                    },
                    collegeFinancing: {
                        required: 'Mohon masukkan pembiayaan kuliah Anda!'
                    },
                    chosenProgram:{
                        required: 'Mohon masukkan program pendidikan yang ingin Anda ambil!'
                    },
                    address:{
                        required: 'Mohon masukkan alamat Anda!',
                        minlength: 'Mohon masukkan alamat minimal 10 karakter!'
                    }
                },
                submitHandler: function(){

                    var formDataUniversity = new FormData($('.u-form')[0]);

                    var majors = $('#majors').val();

                    if (Array.isArray(majors)) {
                        var joinedMajors = majors.join(', ');

                        formDataUniversity.set('majors', joinedMajors);
                    }

                    $.ajax({
                        url: 'https://script.google.com/macros/s/AKfycbwo5OULvfTFMXiYNvRpXHCk3CIzF3dikZZSHcRte9XRKN9iyTTOY-QPyU0Jp59pET4l/exec',
                        data: formDataUniversity,
                        type: 'POST',
                        processData: false, 
                        contentType: false,
                        beforeSend:function(){
                            $("#submitBtn").css("display", "none");
                            $("#loadingBtn").css("display", "block");
                        },
                        success: function(response){
                            var json = JSON.stringify(response.result);

                            console.log(formDataUniversity);

                            setTimeout( () => {
                                $("#submitBtn").css("display", "block");
                                $("#loadingBtn").css("display", "none");

                                if(json.slice(1, -1) == "success"){
                                    $("#form_alerts").html("<div class='alert alert-success'>Terima kasih! Formulir Anda sudah diterima dan akan di follow up dalam waktu 24 jam.</div>");
                                    $(".u-form")[0].reset();
                                    $('#majors').multiselect('deselectAll', false);
                                }else{
                                    $("#form_alerts").html("<div class='alert alert-danger'>Formulir gagal diterima!</div>")
                                }
                            }, 5000);
                        }
                    });
                }
            });


        });


    }



}

export default edu003_universityForm;