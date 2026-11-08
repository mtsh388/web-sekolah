document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       1. SCROLL ANIMATION
    ============================================================ */

    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    if (animatedElements.length) {

        if ('IntersectionObserver' in window) {

            const animationObserver = new IntersectionObserver(
                function (entries, observer) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            // Support kedua class agar kompatibel
                            // dengan CSS/JS lama dan baru
                            entry.target.classList.add('show');
                            entry.target.classList.add('is-visible');

                            observer.unobserve(entry.target);
                        }

                    });

                },
                {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                }
            );

            animatedElements.forEach(function (element) {
                animationObserver.observe(element);
            });

        } else {

            // Fallback browser lama
            animatedElements.forEach(function (element) {
                element.classList.add('show');
                element.classList.add('is-visible');
            });

        }
    }


    /* ============================================================
       2. DARK / LIGHT MODE
    ============================================================ */

    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const themeText = document.getElementById('theme-text');
    const htmlElement = document.documentElement;

    // Ambil tema yang tersimpan
    const savedTheme = localStorage.getItem('theme') || 'light';

    htmlElement.setAttribute('data-bs-theme', savedTheme);

    function updateToggleButton(theme) {

        if (!themeToggleBtn) {
            return;
        }

        if (theme === 'dark') {

            if (themeIcon) {
                themeIcon.textContent = '☀️';
            }

            if (themeText) {
                themeText.textContent = 'Light Mode';
            }

            themeToggleBtn.classList.remove('btn-outline-secondary');
            themeToggleBtn.classList.add('btn-outline-light');

        } else {

            if (themeIcon) {
                themeIcon.textContent = '🌙';
            }

            if (themeText) {
                themeText.textContent = 'Dark Mode';
            }

            themeToggleBtn.classList.remove('btn-outline-light');
            themeToggleBtn.classList.add('btn-outline-secondary');
        }
    }

    updateToggleButton(savedTheme);

    if (themeToggleBtn) {

        themeToggleBtn.addEventListener('click', function () {

            const currentTheme =
                htmlElement.getAttribute('data-bs-theme');

            const newTheme =
                currentTheme === 'light' ? 'dark' : 'light';

            htmlElement.setAttribute(
                'data-bs-theme',
                newTheme
            );

            localStorage.setItem(
                'theme',
                newTheme
            );

            updateToggleButton(newTheme);
        });
    }


    /* ============================================================
       3. PRELOADER
    ============================================================ */

    const percentageEl =
        document.getElementById('preloader-percentage');

    const preloader =
        document.getElementById('preloader');

    let progress = 0;

    const interval = setInterval(function () {

        if (progress < 95) {

            progress += Math.floor(
                Math.random() * 4
            ) + 1;

            if (progress > 95) {
                progress = 95;
            }

            if (percentageEl) {
                percentageEl.textContent =
                    progress + '%';
            }
        }

    }, 40);


    window.addEventListener('load', function () {

        clearInterval(interval);

        if (percentageEl) {
            percentageEl.textContent = '100%';
        }

        if (preloader) {

            // Beri waktu agar angka 100% terlihat
            setTimeout(function () {

                preloader.classList.add('fade-out');

                // Hapus dari layar setelah animasi selesai
                setTimeout(function () {

                    preloader.style.display = 'none';

                }, 600);

            }, 200);
        }
    });


    /* ============================================================
       4. GOOGLE TRANSLATE
    ============================================================ */

    const langSwitch =
        document.getElementById('languageSwitch');

    if (langSwitch) {

        // Cek cookie Google Translate
        setTimeout(function () {

            const cookies =
                document.cookie.split(';');

            for (let cookie of cookies) {

                cookie = cookie.trim();

                if (cookie.startsWith('googtrans=')) {

                    if (cookie.includes('/en')) {
                        langSwitch.checked = true;
                    }

                    break;
                }
            }

        }, 1000);


        // Event perubahan bahasa
        langSwitch.addEventListener(
            'change',
            function () {

                const targetLang =
                    this.checked ? 'en' : 'id';

                triggerGoogleTranslate(targetLang);
            }
        );
    }


    /* ============================================================
       5. KEUNGGULAN SLIDER
    ============================================================ */

    const slider =
        document.getElementById('keunggulanSlider');

    const btnLeft =
        document.getElementById('btnScrollLeft');

    const btnRight =
        document.getElementById('btnScrollRight');

    if (slider && btnLeft && btnRight) {

        const scrollAmount = 350;
        const autoSlideDelay = 3000;

        let autoSlideInterval = null;


        /* --------------------------------------------------------
           Fungsi Scroll
        -------------------------------------------------------- */

        function scrollSlider(direction) {

            slider.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }


        /* --------------------------------------------------------
           Fungsi Auto Slide
        -------------------------------------------------------- */

        function startAutoSlide() {

            stopAutoSlide();

            autoSlideInterval = setInterval(function () {

                const isAtEnd =
                    slider.scrollLeft +
                    slider.clientWidth >=
                    slider.scrollWidth - 10;

                if (isAtEnd) {

                    slider.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });

                } else {

                    slider.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                }

            }, autoSlideDelay);
        }


        function stopAutoSlide() {

            if (autoSlideInterval) {

                clearInterval(autoSlideInterval);

                autoSlideInterval = null;
            }
        }


        /* --------------------------------------------------------
           Tombol Kiri
        -------------------------------------------------------- */

        btnLeft.addEventListener(
            'click',
            function () {

                scrollSlider(-1);
            }
        );


        /* --------------------------------------------------------
           Tombol Kanan
        -------------------------------------------------------- */

        btnRight.addEventListener(
            'click',
            function () {

                scrollSlider(1);
            }
        );


        /* --------------------------------------------------------
           Pause Saat Mouse Masuk
        -------------------------------------------------------- */

        slider.addEventListener(
            'mouseenter',
            function () {

                stopAutoSlide();
            }
        );


        /* --------------------------------------------------------
           Resume Saat Mouse Keluar
        -------------------------------------------------------- */

        slider.addEventListener(
            'mouseleave',
            function () {

                startAutoSlide();
            }
        );


        /* --------------------------------------------------------
           Mulai Auto Slide
        -------------------------------------------------------- */

        startAutoSlide();
    }

});


/* ================================================================
   6. GOOGLE TRANSLATE FUNCTION
================================================================ */

function triggerGoogleTranslate(lang) {

    // Cookie dengan domain
    document.cookie =
        `googtrans=/id/${lang}; path=/; domain=${document.location.hostname}`;

    // Cookie tanpa domain
    document.cookie =
        `googtrans=/id/${lang}; path=/;`;

    // Reload agar bahasa diterapkan
    window.location.reload();
}


/* ================================================================
   7. BACK TO TOP
================================================================ */

$(document).ready(function () {

    const $backToTopBtn =
        $('#backToTopBtn');

    if (!$backToTopBtn.length) {
        return;
    }


    /* ------------------------------------------------------------
       Tampilkan / sembunyikan tombol
    ------------------------------------------------------------ */

    $(window).on('scroll', function () {

        if ($(this).scrollTop() > 300) {

            $backToTopBtn.addClass('show');

        } else {

            $backToTopBtn.removeClass('show');
        }
    });


    /* ------------------------------------------------------------
       Kembali ke atas
    ------------------------------------------------------------ */

    $backToTopBtn.on('click', function (e) {

        e.preventDefault();

        $('html, body').animate(
            {
                scrollTop: 0
            },
            500
        );
    });

});

document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       FILTER TAHUN AJARAN
    ============================================================ */

    const filter =
        document.getElementById('filterTahunAjaran');

    const items =
        document.querySelectorAll('.calendar-item');


    if (filter) {

        filter.addEventListener('change', function () {

            const selectedYear =
                this.value;


            items.forEach(function (item) {

                const itemYear =
                    item.dataset.tahunAjaran;


                if (
                    selectedYear === '' ||
                    itemYear === selectedYear
                ) {

                    item.style.display = '';

                } else {

                    item.style.display = 'none';

                }

            });

        });

    }


    /* ============================================================
       SCROLL ANIMATION
    ============================================================ */

    const animatedElements =
        document.querySelectorAll('.animate-on-scroll');


    if (
        animatedElements.length &&
        'IntersectionObserver' in window
    ) {

        const observer =
            new IntersectionObserver(
                function (entries, observer) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add('show');
                            entry.target.classList.add('is-visible');

                            observer.unobserve(
                                entry.target
                            );

                        }

                    });

                },
                {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                }
            );


        animatedElements.forEach(function (element) {

            observer.observe(element);

        });

    } else {

        animatedElements.forEach(function (element) {

            element.classList.add('show');
            element.classList.add('is-visible');

        });

    }

});
