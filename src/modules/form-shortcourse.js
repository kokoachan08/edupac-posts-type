import $ from "jquery";

class edu003_shortCourseForm{
    constructor(){
        this.events();
    }

    events(){
        $(document).ready(function(){
            $('.sc-form').validate({
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
                    address:{
                        required: 'Mohon masukkan alamat Anda!',
                        minlength: 'Mohon masukkan alamat minimal 10 karakter!'
                    }
                },
                submitHandler: function(){
 
                    $.ajax({
                        url: 'https://script.google.com/macros/s/AKfycbzvJhff95GWjEUxxqo2QUkHmwr7YPwTExszL_zz92KZU1QGG4G6q0OpJ7peBebarIKxJw/exec',
                        data: $('.sc-form').serialize(),
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
                                    $(".sc-form")[0].reset();
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

export default edu003_shortCourseForm;