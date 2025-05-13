import $ from 'jquery';

class edu003_programForm{
    constructor(){
        this.events();
    }

    events(){
        $(document).ready(function(){

            $('.p-form').validate({
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
                    address:{
                        validateAddress: true,
                        minlength: 10
                    },
                    question:{
                        validateQuestion: true
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
                    address:{
                        required: 'Mohon masukkan alamat Anda!',
                        minlength: 'Mohon masukkan alamat minimal 10 karakter!'
                    }
                },
                submitHandler:function(){
                    $.ajax({
                        url: 'https://script.google.com/macros/s/AKfycbyAGP3f3C5ehBK3W1CrEiX8C7ng7l3utfE5nRN1GbuRA2Rp_aT2b4NKG7TIRgC5BWEU/exec',
                        data: $('.p-form').serialize(),
                        type: 'POST',
                        beforeSend: function(){
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
                                    $(".p-form")[0].reset();
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
export default edu003_programForm;