import $ from "jquery";

class edu003_eduXpertForm{
    constructor(){
        this.events();
        $('#englishScore').hide();
        $('#englishSkills').on('change', function(){
            if ($(this).val() === 'Not Yet Taken') {
                $('#englishScore').hide();
            } else {
                $('#englishScore').show();
            }
        });
    }

    events(){
        $(document).ready(function(){

            $('.ec-form').validate({
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
                    },
                    englishScore: {
                        validateScore: true,
                        required: function(element) {
                            return $('#englishSkills').val() !== 'Not Yet Taken';
                        }
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
                    englishSkills:{
                        required: 'Mohon masukkan tes bahasa Inggris yang Anda ambil!'
                    },
                    englishScore:{
                        required: 'Mohon masukkan skor bahasa Inggris Anda!'
                    },
                    address:{
                        required: 'Mohon masukkan alamat Anda!',
                        minlength: 'Mohon masukkan alamat minimal 10 karakter!'
                    }
                },
                submitHandler: function(){
 
                    $.ajax({
                        url: 'https://script.google.com/macros/s/AKfycbzMHQUh8pAXPwbojt-1QtN6y0QvHHnbGk2ISozgXUgIf93cz-kL-PnsZ8nQhZ35jllF/exec',
                        data: $('.ec-form').serialize(),
                        type: 'POST',
                        beforeSend:function(){
                            $("#submitBtn").css("display", "none");
                            $("#loadingBtn").css("display", "block");
                        },
                        success: function(response){
                            var json = JSON.stringify(response.result);
                                   
                            setTimeout( () => {
                                $("#submitBtn").css("display", "block");
                                $("#loadingBtn").css("display", "none");

                                if(json.slice(1, -1) == "success"){
                                    $("#form_alerts").html("<div class='alert alert-success'>Terima kasih! Formulir Anda sudah diterima dan akan di follow up dalam waktu 24 jam.</div>");
                                    $(".ec-form")[0].reset();
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

export default edu003_eduXpertForm;