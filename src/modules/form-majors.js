import $ from "jquery";

class edu003_majorsForm {
    constructor() {
        this.events();
    }

    events() {
        $(document).ready(function () {
            $('.multiple-checkboxes').multiselect({
                includeSelectAllOption: true,
                nSelectedText: 'Dipilih',
                allSelectedText: 'Semua Dipilih',
                maxHeight: 300,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true, 
                filterPlaceholder: 'Cari...',  
                includeFilterClearBtn: true,
                buttonWidth: '100%'
            });

            $('.m-form').validate({
                rules:{
                    name:{
                        validateName: true,
                        minlength: 3
                    },
                    university:{
                        required: true
                    }
                },
                messages:{
                    name:{
                        required: 'Mohon masukkan nama Anda!',
                        minlength: 'Masukkan nama minimal 3 karakter!'
                    },
                    university: {
                        required: "Mohon pilih setidaknya satu universitas!"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('multiselect')) {
                        error.insertAfter(element.next('.btn-group'))
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(){

                    var formData = new FormData($('.m-form')[0]);

                    var universities = $('#university').val();

                    if (Array.isArray(universities)) {
                        var joinedUniversities = universities.join(', ');

                        formData.set('university', joinedUniversities);
                    }

                    $.ajax({
                        url: 'https://script.google.com/macros/s/AKfycbwo5OULvfTFMXiYNvRpXHCk3CIzF3dikZZSHcRte9XRKN9iyTTOY-QPyU0Jp59pET4l/exec',
                        data: formData,
                        type: 'POST',
                        processData: false, 
                        contentType: false, 
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
                                    $(".m-form")[0].reset();
                                    $('#university').multiselect('deselectAll', false);
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

export default edu003_majorsForm;
