<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 ftrTop">
                    <div class="socialLinks">
                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                    
                    <?php if(Session::get('user') == false): ?>
                    <a href="<?php echo e(url('register')); ?>" class="newsBTN">Sign up <i class="fas fa-chevron-right"></i></a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-4 ftrLogo">
                    <img src="<?php echo e(URL::asset('assets/front/images/footerlogo.png')); ?>">
                </div>
                <div class="col-lg-4 col-md-8 ftrCotact">
                    <h2>Contact us</h2>
                    <p>Tel: +968 24828871 / +968 2428872<br />
                        Fax: +968 24828000<br />
                        Email: info@moci.gov.com<br />
                        Po. Box. 550<br />
                        Location: Way 3505, Ruwi, Muscat, Sultanate of Oman</p>
                </div>
            </div>
        </div>
        <div class="footerLast">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 ftrBottom">
                        <p class="copyright">Ministry of commerce and industry 2020</p>
                        <ul class="ftrLinks">
                            <li><a href="#">Privacy notice</a></li>
                            <li><a href="#">Cookie policye</a></li>
                            <li><a href="#">Term of use </a></li>
                            <li><a href="#">Accessibility</a></li>
                            <li><a href="#">Site map</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </footer>

    // <script src="<?php echo e(URL::asset('assets/front/js/jquery.min.js')); ?>"></script>

    <!-- // <script src="<?php echo e(URL::asset('assets/front/js/fontawesome.js')); ?>"></script> -->
    <script src="<?php echo e(URL::asset('assets/front/js/jquery.fancybox.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/front/js/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/front/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/front/js/sticky_script.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/front/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/front/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/pages/sweet-alert.init.js')); ?>"></script>


    <script>
        $('.carousel').carousel({
            interval: false
        });

        new WOW().init();

        $(document).ready(function () {
            $("#myBtn").click(function () {
                $("#myModal").modal();
            });
        });

        $('.fancybox').fancybox();
        $(document).ready(function () {
            $('#owl-carousel').owlCarousel({
                autoplay: true,
                loop: true,
                margin: 25,
                responsiveClass: true,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        });
    </script>
</body>

</html>