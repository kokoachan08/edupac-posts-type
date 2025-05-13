import $ from 'jquery';

class edu003_testSchedule{
    constructor(){
        this.events();
    }
    events(){
        $(document).ready(function(){

            var test_name = $('.schedule').attr('data-test-name');

            if(test_name){
                if(test_name == "TOEFL iBT"){
                    var url = 'https://script.google.com/macros/s/AKfycbwMEfNZCTmzwBk2crMasQ4_Ue5by0eVN2Tg7L-hJ-YnRlSZBtYhwoH8rfeEdDHZ7n8IQQ/exec';
                }
                else if(test_name == "TOEFL ITP"){
                    var url = 'https://script.google.com/macros/s/AKfycbxSYQQDfqmpWV_NkXVlclN2Vftr3QD2Z5_iXBf413IJeVyZ31QzCUE6CUfaCdxuLc-h/exec';
                }
                else if(test_name == "GRE"){
                    var url = 'https://script.google.com/macros/s/AKfycbxKtkS8Md4_2ki9K8qCO2RYDDNn3mgCy6ateWBIgaiSFkRwxu7efReymkf6ZeNCSWpE/exec';
                }
                else if(test_name == 'IELTS'){
                    var url = 'https://script.google.com/macros/s/AKfycbzl5Vaxj4QfRo-wGlagN11KHEri6Y__9j_C9BrIfluMUjBDsBnNqgrhy48_YTiQzMSQ/exec';
                }
                else if(test_name == 'TOEIC'){
                    var url = 'https://script.google.com/macros/s/AKfycbz6FGGfZ_WvCtJ9hMw2XtZ31VjPnFDx4bESdvhwDf2YsZeogIKC3NIQqqFT8-BWctFUGQ/exec';
                }
                else if(test_name == 'GMAT'){
                    var url = 'https://script.google.com/macros/s/AKfycbxoXHnTLEE-DLm0jPzaSEOWvI0_QcEa-nT4CmFxmbaU5ktW5dJ9lflVKX724R5QUwmIpQ/exec';
                }
                else if(test_name == 'SAT'){
                    var url = 'https://script.google.com/macros/s/AKfycbziP543jf3TtDMxzsQ86MSM6HSFdEzl1Mfb8IBlP9jrow-qvBcSMYQ5mItvWGmRTEkskA/exec';
                }
                else if(test_name == 'USMLE'){
                    var url = 'https://script.google.com/macros/s/AKfycbxMSS92La3-SAtZItFk0KpZiykFcXkdk-TAWcYd5vlyR45xcoUnBWVB6W7E3U1Vpktk/exec';
                }
            }
          
            $.ajax({
                url: url,
                type: 'GET',
                success:function(response){
                    var obj = response.data;

                    if(typeof(obj) !== 'undefined'){
                        var thedata = obj.output;
                        var rev_date = obj.date;
                        var date_updated =  moment(new Date(rev_date)).format("DD MMMM YYYY");
                        var schedule = $('.schedule');

                        if(response){
                            setTimeout( () => {
                                $('.spinner-border').css('display', 'none');
                                $('#backdrop').css('display', 'none');
                                $('.p-table').css('display','table');
                                $('#now').html("<strong>Terakhir di Perbarui: </strong>" + date_updated);

                                if(thedata.length === 0){
                                    var tr = $("<tr>");
                                    schedule.append(tr);
                                    tr.html(`
                                        <td style="text-align: center;" colspan="2">Sorry! We don't have any available schedule.</td>
                                    `);
                                }else{
                                    
                                    let isAvailable = false;

                                    thedata.forEach((row) => {
                                        var currentDate = new Date();
                                        var scheduleDate = new Date(row.Tanggal);
                                        if(scheduleDate >= currentDate){
                                            isAvailable = true;
                                            var tr = $("<tr>");
                                            schedule.append(tr);
                                            tr.html(`
                                                <td>${moment(new Date(row.Tanggal)).format("DD MMMM YYYY")}</td>
                                                <td>${row.Jam}</td>
                                            `);
                                        }
                                    });

                                    if(!isAvailable) {
                                        var tr = $("<tr>");
                                        schedule.append(tr);
                                        tr.html(`
                                            <td style="text-align: center;" colspan="2">Sorry! We don't have any available schedule.</td>
                                        `);
                                    }
                                }
                            }, 1000);
                        }
                    }
                }

            });
            
        });
    }

}
export default edu003_testSchedule;