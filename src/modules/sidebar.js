import $ from 'jquery';

class edu003_sidebarJS {
    constructor() {
        this.events();
    }

    events() {
        this.initializeSidebarToggle();
        this.setupDynamicSectionIDs();
        this.setupTableOfContentsNavigation();
    }

    initializeSidebarToggle() {
        $('#sidebar-toggle').on('click', function (e) {
            e.preventDefault();
    
            var wrapper = $('#wrapper');
            var sidebar = $('#sidebar-wrapper');
            var mainWrapper = $('#main-wrapper');
    
            if (!wrapper.hasClass('toggled')) {
                // Tambahkan kelas toggled terlebih dahulu
                wrapper.addClass('toggled');
    
                // Tampilkan sidebar
                sidebar.css({
                    display: 'block',
                    width: '0'
                });
    
                // Tambahkan transisi untuk memperbesar
                setTimeout(function () {
                    var targetWidth = window.matchMedia('(min-width: 768px)').matches ? '350px' : '70%';
                    sidebar.css({
                        transition: 'width 0.3s ease',
                        width: targetWidth
                    });
                }, 10);
            } else {
                // Hapus kelas toggled terlebih dahulu
                wrapper.removeClass('toggled');
    
                // Kecilkan sidebar
                sidebar.css({
                    transition: 'width 0.3s ease',
                    width: '0'
                });
    
                // Setelah transisi selesai, ubah display menjadi none
                setTimeout(function () {
                    sidebar.css('display', 'none');
                }, 300);
            }
        });
    }
    
    setupDynamicSectionIDs() {
        const sectionIds = [
            'section-1', // Tentang Universitas
            'section-2', // Biaya Kuliah
            'section-3', // Alasan Kuliah
            'section-4', // Syarat Masuk
            'section-5', // Jurusan Kuliah
            'section-6'  // Event & Scholarship
        ];

        $('.tab-pane').each(function (index) {
            const sectionId = sectionIds[index];
            $(this).find('h2').attr('id', sectionId);

            let counter = 1;
            $(this).find('h3').each(function () {
                const newId = `${sectionId}-${counter}`;
                $(this).attr('id', newId);
                counter++;
            });
        });
    }

    setupTableOfContentsNavigation() {
        $('#toc a').on('click', function (e) {
            e.preventDefault();
            const targetId = $(this).attr('href');
            const tabId = $(this).data('tab');
            const isMobile = window.matchMedia('(max-width: 767px)').matches;
    
            if (tabId) {
                const tabTrigger = $(`a[data-bs-toggle="tab"][href="#${tabId}"]`);
                const targetElement = $(`h2${targetId}, h3${targetId}`);
    
                if (tabTrigger.length && targetElement.length) {
                    const scrollToTarget = () => {
                        // Hitung offset navbar dan tambahan
                        const navbarHeight = $('#navbar-wrapper').outerHeight() || 0;
                        const additionalOffset = 100; // Sesuaikan nilai ini sesuai kebutuhan
                        const offset = navbarHeight + additionalOffset;
    
                        // Dapatkan posisi target yang disesuaikan
                        const targetPosition = targetElement.offset().top - offset;
    
                        // Scroll ke posisi yang benar
                        $('html, body').animate({
                            scrollTop: targetPosition
                        }, 500);
                    };
    
                    if (isMobile) {
                        const closeSidebar = () => {
                            return new Promise(resolve => {
                                if ($('#wrapper').hasClass('toggled')) {
                                    $('#sidebar-toggle').trigger('click');
                                    setTimeout(resolve, 350);
                                } else {
                                    resolve();
                                }
                            });
                        };
    
                        closeSidebar().then(() => {
                            tabTrigger.tab('show');
                            // Tunggu sampai tab benar-benar aktif
                            setTimeout(scrollToTarget, 100);
                        });
                    } else {
                        tabTrigger.tab('show');
                        // Tunggu sampai tab aktif
                        setTimeout(scrollToTarget, 100);
                    }
                }
            }
        });
    }
}

export default edu003_sidebarJS;
