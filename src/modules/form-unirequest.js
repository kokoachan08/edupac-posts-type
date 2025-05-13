import $ from "jquery";

class edu003_uniRequestForm{
    constructor(){
        this.event()
    }

    event(){
        $('.req-form').validate({
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
                university:{
                    validateEducationalInstitute: true,
                    minlength: 3
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
                },
                university:{
                    required: 'Mohon masukkan universitas yang Anda inginkan!',
                    minlength: 'Masukkan nama universitas minimal 3 karakter!'
                }
            },
            submitHandler: function(){
                var formData = {
                    'name': $('#reqname').val(),
                    'email': $('#reqemail').val(),
                    'phoneNumber': $('#reqphoneNumber').val(),
                    'lastestEducation': $('#reqlastestEducation').val(),
                    'educationalInstitutionName': $('#reqeducationalInstitutionName').val(),
                    'university': "Request: " + $('#requniversity').val(),
                    'collegeFinancing': $('#reqcollegeFinancing').val(),
                    'chosenProgram': $('#reqchosenProgram').val(),
                    'address': $('#reqaddress').val(),
                    'datetime': $('#reqdatetime').val()
                };

                $.ajax({
                    url: 'https://script.google.com/macros/s/AKfycbwo5OULvfTFMXiYNvRpXHCk3CIzF3dikZZSHcRte9XRKN9iyTTOY-QPyU0Jp59pET4l/exec',
                    data: formData,
                    type: 'POST',
                    beforeSend:function(){
                        $("#submitBtnReq").css("display", "none");
                        $("#loadingBtnReq").css("display", "block");
                    },
                    success: function(response){
                        var json = JSON.stringify(response.result);
                    
                        setTimeout( () => {
                            $("#submitBtnReq").css("display", "block");
                            $("#loadingBtnReq").css("display", "none");

                            if(json.slice(1, -1) == "success"){
                                $("#form_alerts_req").html("<div class='alert alert-success'>Terima kasih! Formulir Anda sudah diterima dan akan di follow up dalam waktu 24 jam.</div>");
                                $(".req-form")[0].reset();
                            }else{
                                $("#form_alerts_req").html("<div class='alert alert-danger'>Formulir gagal diterima!</div>")
                            }
                        }, 5000);
                    }
                });
            }
        });
    }

}
export default edu003_uniRequestForm;
