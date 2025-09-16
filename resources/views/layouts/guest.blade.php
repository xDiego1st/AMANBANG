<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-small.png') }}">
    <meta name="author" content="DISKOMINFO">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Page Title  -->
    <title> {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/skins/theme-blue.css') }}">
    <link rel="{{ asset('assets/css/libs/fontawesome-icons.css') }}">
    @filepondScripts
    @livewireStyles
    <style>
        /* Umum: siapkan slider-wrap agar dots bisa absolute di bawah */
        .slider-wrap {
            position: relative;
            height: 100%;
            min-height: 100vh;
            /* biar penuh layar */
        }

        /* Style slick dots agar selalu di bawah tengah */
        .slider-wrap .slick-dots {
            position: absolute;
            bottom: 20px;
            /* jarak dari bawah */
            left: 50%;
            transform: translateX(-50%);
            /* center horizontal */
            margin: 0;
            padding: 0;
            list-style: none;
            z-index: 10;
            text-align: center;
            width: auto;
        }

        .slider-wrap .slick-dots li {
            display: inline-block;
            margin: 0 5px;
        }

        .slider-wrap .slick-dots button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            background: #bbb;
            text-indent: -9999px;
            cursor: pointer;
        }

        .slider-wrap .slick-dots .slick-active button {
            background: #333;
        }

        /* Desktop: hanya background */
        .nk-split-content[data-content="athPromo"] {
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Sembunyikan <img> di desktop */
        .nk-split-content[data-content="athPromo"] .nk-feature-img img {
            display: none !important;
        }

        /* Hilangkan layer putih default */
        .nk-split-content[data-content="athPromo"] .slider-wrap {
            background: none !important;
        }

        .nk-split-content[data-content="athPromo"] {
            background: none;
            /* jangan ada background */
        }
    </style>


<body>
    <div class="font-sans antialiased text-gray-900">
        {{ $slot }}
    </div>


    <!-- CSS SCRIPT -->
    <link rel="stylesheet" href="{{ asset('assets/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/editors/tinymce.css') }}">
    <!-- CSS SCRIPT -->

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/libs/editors/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/editors.js') }}"></script>
    <script src="{{ asset('assets/js/libs/editors/tinymce.js') }}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="{{ asset('js/custom-scripts.js') }}"></script>
    <script src="{{ asset('assets/js/example-sweetalert.js') }}"></script>

    @livewireScripts
    @stack('scripts')
    @include('notify::components.notify')
    @notifyJs

    @if (session()->has('alert'))
        <div x-data="{
            init() {
                this.$nextTick(() => {
                    this.$dispatch('showAlert', {{ json_encode([session('alert')]) }});
                })
            }
        }"></div>
    @endif
    <script>
        // Pastikan jQuery & Slick sudah ada
        document.addEventListener('DOMContentLoaded', function() {
            var $container = $('.nk-split-content[data-content="athPromo"]');
            var $slider = $container.find('.slider-init');

            // Set background panel berdasarkan slide ke-X
            function setBg(index) {
                // Ambil <img> dari slide aktif (support sebelum & sesudah slick init)
                var $img = $slider.find('.slick-slide[data-slick-index="' + index + '"] img');
                if ($img.length === 0) {
                    // fallback sebelum slick init
                    $img = $slider.find('.slider-item').eq(index).find('img');
                }

                var src = $img.attr('src');
                if (src) {
                    $container.css({
                        'background-image': 'url(' + src + ')',
                        'background-size': 'cover',
                        'background-position': 'center',
                        'background-repeat': 'no-repeat'
                    });
                }
            }

            // Update saat slide berubah
            $slider.on('afterChange', function(e, slick, current) {
                setBg(current);
            });

            // Init (kalau sudah init duluan oleh theme, ambil current; kalau belum, pakai slide 0 lalu update saat 'init')
            if ($slider.hasClass('slick-initialized')) {
                setBg($slider.slick('slickCurrentSlide'));
            } else {
                setBg(0);
                $slider.on('init', function(e, slick) {
                    setBg(slick.currentSlide || 0);
                });
            }

            // Responsif: jika resize melewati breakpoint, set ulang background
            $(window).on('resize', function() {
                var cur = $slider.hasClass('slick-initialized') ? $slider.slick('slickCurrentSlide') : 0;
                setBg(cur);
            });
        });
    </script>
</body>

</html>
