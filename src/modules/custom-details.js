import $ from 'jquery';

class edu003_customDetails {
    constructor() {
        this.initMutationObserver();
        this.bindEvents();
    }

    initMutationObserver() {
        $.fn.attrchange = function(callback) {
            const MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

            if (MutationObserver) {
                const options = {
                    subtree: false,
                    attributes: true
                };

                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        callback.call(mutation.target, mutation.attributeName);
                    });
                });

                return this.each(function() {
                    observer.observe(this, options);
                });
            }
        };
    }

    bindEvents() {
        $(document).ready(() => {
            // Kustom klik pada .details-tab untuk menangani toggle
            $('.details-tab').on("click", function(e) {
                const detailsElement = $(this).parent();

                // Jika 'open', toggle manual. Jika tidak, biarkan berlaku default.
                if (detailsElement.attr("open")) {
                    e.preventDefault(); // Mencegah aksi default
                    detailsElement.removeAttr("open"); // Tutup jika sudah terbuka
                } // Jika tidak terbuka, tidak perlu intervensi karena akan terbuka secara default
            });

            // Untuk memastikan hanya satu <details> yang terbuka setiap saat
            $('.details-item').attrchange(function(attribute) {
                if (attribute === "open" && $(this).attr("open")) {
                    $(this).siblings().removeAttr("open");
                }
            });

            // Penanganan keyboard untuk aksesibilitas
            $('.details-tab').on("keydown", function(e) {
                if (e.keyCode === 32 || e.keyCode === 13) {
                    e.preventDefault(); // Mencegah scroll saat space dan toggle saat enter
                    $(this).click(); // Pemicu klik programatik
                }
            });
        });
    }
}

export default edu003_customDetails;
