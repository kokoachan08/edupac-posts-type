import $ from 'jquery';

class edu003_owlCarousel{
    constructor(){
        this.events();
    }
    events(){
        $('.university-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        });

        $('.short-course-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
            dots: false,
            lazyLoad:true,
            responsive: {
              0: {
                items: 1
              },
              768: {
                items: 1
              },
              1200: {
                items: 1
              }
            }
        });
    }
}
export default edu003_owlCarousel;
