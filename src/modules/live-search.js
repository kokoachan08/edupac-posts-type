import $ from 'jquery';

class edu003_liveSearch{
    constructor(){
        this.events();
    }

    events(){
        const list = $('#list');
        const noResult = $('<li class="list-group-item fs-6">No university found. <span id="requni" class="link-primary" style="cursor: pointer; text-decoration: underline;">&raquo;&nbsp;Click Here to Request University&nbsp;&laquo;</span></li>').hide();
        list.append(noResult);
    
        $('#searchUniversity').on('input', function(){
            const searchValue = this.value.toLowerCase().trim();
            let resultCount = 0;
            
            if(searchValue !== ''){
                list.show();
                list.find('li').each(function(){
                    const text = $(this).text().toLowerCase();
                    if(text.includes(searchValue)){
                        $(this).show();
                        resultCount++;
                    } else {
                        $(this).hide();
                    }
                });

                if(resultCount === 0){
                    noResult.show();
                } else {
                    noResult.hide();
                }

                if(list.find('li:visible').length > 3){
                    list.css({
                        'height': '19rem',
                        'overflow-y': 'scroll'
                    });
                } else {
                    list.css({
                        'height': '',
                        'overflow-y': ''
                    });
                }
            } else{
                list.hide();
            }
        });
    }
}

export default edu003_liveSearch;
