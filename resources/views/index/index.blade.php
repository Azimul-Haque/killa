@extends('layouts.index')
@section('title')
    KillaBD
@endsection

@section('css')
    <style type="text/css">
        body {
            overflow: hidden;
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background-color:#fff; /* change if the mask should have another color then white */
            z-index:99999;
        }

        #status {
            width:200px;
            height:200px;
            position:absolute;
            left:50%;
            top:50%;
            background-image:url({{ asset('images/3362406.gif') }}); /* path to your loading animation */
            background-repeat:no-repeat;
            background-position:center;
            margin:-100px 0 0 -100px;
        }
    </style>
@endsection

@section('content')
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    {{-- @include('partials._slider') --}}
    <!-- start section -->
    <section class="bg-gray" style="margin-top: 80px; padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 xs-margin-bottom-four">
                    <span class="owl-subtitle">K I L L A</span>
                    <span class="owl-title" style="line-height: 35px;font-size: 25px; font-weight: 600; display: block; letter-spacing: 4px;">sjdhd sdjhdsh sdjhdsfh sdjhksjdh sdhkjdsh dsjhdh skdhjkdfh sdhkjdfhk</span>
                    <a href="contact.html" class="highlight-button-dark btn margin-four">Let Explore Our Works</a>

                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-4 col-sm-4 text-right xs-text-left">
                    <img alt="" class="get-bg xs-display-none" style="padding-top: 12%;" src="{{ asset('images/abc.png') }}" />
                </div>


            </div>
        </div>
    </section>
    <!-- end start section -->
    <!-- about section -->
    <section class=" wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-10 text-center center-col">
                    <span class="margin-five no-margin-top display-block letter-spacing-2">EST. 2018</span>
                    <h2>Killa-Knowledge Information and Learning for Local Adaptation</h2>
                    <p class="text-med width-90 center-col margin-seven no-margin-bottom"> We've been crafting beautiful websites, launching stunning brands and making clients happy for years. With our prestigious craftsmanship, remarkable client care and passion for design.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->
    <section class="padding-three bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">Recent Works</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <section class="work-4col gutter work-with-title wide wide-title padding-three">
        <div class="container">
            <div class="row">
                <div class="col-md-12 grid-gallery overflow-hidden no-padding" >
                    <div class="tab-content">
                        <!-- tour grid -->
                        <ul class="grid masonry-items">
                            <!-- tour item -->
                            <li class="holidays luxury safari">
                                <figure>
                                    <div class="gallery-img"><a href="project-single.html"><img src="{{ asset('images/travel-agency-packages08.jpg') }}" alt=""></a></div>
                                    <figcaption>
                                        <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                        <a class="btn inner-link btn-black btn-small" href="project-single.html">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <!-- end tour item -->
                            <!-- tour item -->
                            <li class="holidays luxury">
                                <figure>
                                    <div class="gallery-img"><a href=""><img src="{{ asset('images/travel-agency-packages01.jpg') }}" alt=""></a></div>
                                    <figcaption>
                                        <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                        <a class="btn inner-link btn-black btn-small" href="#contact-us">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <!-- end tour item -->
                            <!-- tour item -->
                            <li class="honeymoon family safari luxury">
                                <figure>
                                    <div class="gallery-img"><a href=""><img src="{{ asset('images/travel-agency-packages04.jpg') }}" alt=""></a></div>
                                    <figcaption>
                                        <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                        <a class="btn inner-link btn-black btn-small" href="#contact-us">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <!-- end tour item -->
                            <!-- tour item -->
                            <li class="holidays luxury safari">
                                <figure>
                                    <div class="gallery-img"><a href="project-single.html"><img src="{{ asset('images/travel-agency-packages08.jpg') }}" alt=""></a></div>
                                    <figcaption>
                                        <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                        <a class="btn inner-link btn-black btn-small" href="project-single.html">Explore Now</a>
                                    </figcaption>
                                </figure>
                            </li>
                            <!-- end tour item -->
                            
                        </ul>
                        <!-- end tour grid -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-three bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">Latest Publications</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <section id="features" class="features wow fadeIn" style="margin-bottom: 40px; padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- features item -->
                    <div class="features-section col-md-4 col-sm-6 no-padding wow fadeInUp">
                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                            <a href=""><img src="{{ asset('images/photography-15.jpg') }}" alt=""></a>
                        </div>
                        <div class="col-md-9 col-sm-9 no-padding col-xs-9 text-left f-right">
                            <a href=""><h5 style="margin: 5px;">Lorem Ipsum is simply dummy text of the printing and typesetting</h5></a>
                            <div class="separator-line bg-yellow"></div>
                        </div>
                    </div>
                    <!-- end features item -->
                    <!-- features item -->
                    <div class="features-section col-md-4 col-sm-6 no-padding wow fadeInUp">
                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                            <a href=""><img src="{{ asset('images/photography-15.jpg') }}" alt=""></a>
                        </div>
                        <div class="col-md-9 col-sm-9 no-padding col-xs-9 text-left f-right">
                            <a href=""><h5 style="margin: 5px;">Lorem Ipsum is simply dummy text of the printing and typesetting</h5></a>
                            <div class="separator-line bg-yellow"></div>
                        </div>
                    </div>
                    <!-- end features item -->
                    <!-- features item -->
                    <div class="features-section col-md-4 col-sm-6 no-padding wow fadeInUp">
                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                            <a href=""><img src="{{ asset('images/photography-15.jpg') }}" alt=""></a>
                        </div>
                        <div class="col-md-9 col-sm-9 no-padding col-xs-9 text-left f-right">
                            <a href=""><h5 style="margin: 5px;">Lorem Ipsum is simply dummy text of the printing and typesetting</h5></a>
                            <div class="separator-line bg-yellow"></div>
                        </div>
                    </div>
                    <!-- end features item -->
                   
                     
                </div>
            </div>
        </div>
    </section>
    <section class="padding-three bg-gray">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-6 col-sm-6">
                    <span class="text-large letter-spacing-2 black-text font-weight-600 agency-title">Killa at a Glance</span>
                </div>
                <!-- end section title -->
                <!-- section highlight text -->
                <div class="col-md-6 col-sm-6 text-right xs-text-left">
                </div>
                <!-- end section highlight text -->
            </div>
        </div>
    </section>
    <!-- counter section -->
    <section id="counter" class="wow fadeIn border-bottom">
        <div class="container">
            <div class="row">
                <!-- counter -->
                <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten" data-wow-duration="300ms">
                    <span class="timer counter-number" data-to="312" data-speed="7000"></span>
                    <span class="counter-title">Employee</span>
                </div>
                <!-- end counter -->
                <!-- counter -->
                <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten" data-wow-duration="600ms">
                    <span class="timer counter-number" data-to="430" data-speed="7000"></span>
                    <span class="counter-title">Ongoing Project</span>
                </div>
                <!-- end counter -->
                <!-- counter -->
                <div class="col-md-3 col-sm-6 bottom-margin-small text-center counter-section wow fadeInUp xs-margin-bottom-ten" data-wow-duration="900ms">
                    <span class="timer counter-number" data-to="690" data-speed="7000"></span>
                    <span class="counter-title">Projects Completed</span>
                </div>
                <!-- end counter -->
                <!-- counter -->
                <div class="col-md-3 col-sm-6 text-center counter-section wow fadeInUp" data-wow-duration="1200ms">
                    <span class="timer counter-number" data-to="826" data-speed="7000"></span>
                    <span class="counter-title">Publications</span>
                </div>
                <!-- end counter -->
            </div>
        </div>
    </section>
    <!-- end counter section -->
    <!-- highlight section -->
    <section class="bg-fast-yellow no-padding wow fadeInUp">
        <div class="container">
            <div class="row padding-five sm-text-center">
                <div class="col-md-1">
                    <i class="medium-icon black-text no-margin icon-toolbox"></i>
                </div>
                <div class="col-md-6 no-padding">
                    <span class="text-med text-uppercase letter-spacing-2 margin-two black-text font-weight-600 xs-margin-top-six xs-margin-bottom-six display-block">Want to Work With Us?</span>
                </div>
                <div class="col-md-5 no-padding">
                    <a class="highlight-button-dark btn btn-medium button xs-margin-bottom-five xs-no-margin-right" href="portfolio-wide-with-title-gutter-4columns.html">View Our Projects</a>
                    <a class="highlight-button btn btn-medium button xs-margin-bottom-five xs-no-margin-right" href="#">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end highlight section -->
@endsection

@section('js')
<!-- Preloader -->
<script type="text/javascript">
    //<![CDATA[
        $(window).load(function() { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(1000).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(1000).css({'overflow':'visible'});
        })
    //]]>
</script>
@endsection