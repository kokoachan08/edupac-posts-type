import $ from "jquery";

class edu003_eventForm{
    constructor(){
        this.events();
    }

    events(){
        $(document).ready(function(){
            $('.e-form').validate({
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
                    educationalInstitutionName:{
                        required: 'Mohon masukkan nama sekolah atau universitas Anda!',
                        minlength: 'Masukkan nama sekolah atau universitas minimal 3 karakter!'
                    },
                    lastestEducation:{
                        required: 'Mohon masukkan pendidikan terakhir Anda!'
                    },
                    address:{
                        required: 'Mohon masukkan alamat Anda!',
                        minlength: 'Mohon masukkan alamat minimal 10 karakter!'
                    }
                },
                submitHandler: function(){

                    if(pluginData.event_type){
                        if(pluginData.event_type == 'postgraduate'){
                            var url = 'https://script.google.com/macros/s/AKfycbwrHAiYqye10bu7eOW4v0KsCcoYSAQqKdqH1DRGF8UQuVqDWFLqr5OOKSIfyxwjP38apw/exec';
                        }
                        else if(pluginData.event_type == 'undergraduate'){
                            var url = 'https://script.google.com/macros/s/AKfycbzEwr69LfuWdhieJlJxpLnjr8-GCowE5KIld9CEFAO02VzLsBSauz-BxLfYzwsZ8pN8/exec';
                        }
                    }

                    $.ajax({
                        url: url,
                        data: $('.e-form').serialize(),
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
                                    $("#form_alerts").html("<div class='alert alert-success'>Formulir Anda sudah diterima, terima kasih telah mendaftar.</div>");
                                    $(".e-form")[0].reset();
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

export default edu003_eventForm;