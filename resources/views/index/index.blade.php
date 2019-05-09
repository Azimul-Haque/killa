@extends('layouts.index')
@section('title')
    IIT Alumni
@endsection

@section('css')

@endsection

@section('content')
    @extends('partials._slider')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <span class="title-large text-uppercase letter-spacing-1 font-weight-600 black-text">Who are we</span>
                    <div class="separator-line-thick bg-fast-pink no-margin-lr"></div>
                    <p class="no-margin-bottom">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book.</p>
                    <a class="highlight-button-black-border btn btn-small no-margin-bottom inner-link sm-margin-bottom-ten" href="#">Read More</a>
                </div>
                <div class="col-md-3 col-sm-6 text-center col-md-offset-1 xs-margin-bottom-ten">
                    <img src="{{ asset('images/spa-img3.jpg') }}" class="xs-img-full" alt="" />
                </div>
                <div class="col-md-3 col-sm-6 text-center ">
                    <img src="{{ asset('images/spa-img4.jpg') }}" class="xs-img-full" alt="" />
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 13px 0;">
        <div class="container">
            <div class="row">
                <!-- features item -->
                <div class="col-md-4 col-sm-6 sm-margin-bottom-ten xs-text-center">
                    <h3>news</h3>
                    <span class="title-small text-uppercase font-weight-700 black-text letter-spacing-1 margin-seven display-block">We're ready
                        <br> to start now</span>
                    <p class="margin-ten no-margin-top width-90 xs-center-col xs-display-block">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the text.</p>
                    <a href="#" class="highlight-link text-uppercase white-text">Read More
                        <i class="fa fa-long-arrow-right extra-small-icon white-text"></i>
                    </a>
                </div>
                <!-- end features item -->
                <!-- features item -->
                <div class="col-md-4 col-sm-6 sm-margin-bottom-ten xs-text-center">
                    <h3>Event</h3>
                    <span class="title-small text-uppercase font-weight-700 black-text letter-spacing-1 margin-seven display-block">Always on time
                        <br> call support</span>
                    <p class="margin-ten no-margin-top width-90 xs-center-col xs-display-block">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the text.</p>
                    <a href="#" class="highlight-link text-uppercase white-text">Read More
                        <i class="fa fa-long-arrow-right extra-small-icon white-text"></i>
                    </a>
                </div>
                <!-- end features item -->
                <!-- features item -->
                <div class="col-md-4 col-sm-6 xs-margin-bottom-ten xs-text-center">
                    <h3>Notice</h3>
                    <span class="title-small text-uppercase font-weight-700 black-text letter-spacing-1 margin-seven display-block">We Deliver the
                        <br> highest quality</span>
                    <p class="margin-ten no-margin-top width-90 xs-center-col xs-display-block">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the text.</p>
                    <a href="#" class="highlight-link text-uppercase white-text">Read More
                        <i class="fa fa-long-arrow-right extra-small-icon white-text"></i>
                    </a>
                </div>
                <!-- end features item -->

            </div>
        </div>
    </section>
    <section class="wow fadeIn bg-gray">
        <div class="container">
            <div class="row">
                <!-- call to action -->
                <div class="col-md-7 col-sm-12 text-center center-col">
                    <p class="title-large text-uppercase letter-spacing-1 black-text font-weight-600 wow fadeIn">Want to be a memeber of IITAluni?</p>
                    <a href="{{ route('index.application') }}" class="highlight-button-black-border btn margin-six wow fadeInUp">Apply Now!</a>
                </div>
                <!-- end call to action -->
            </div>
        </div>
    </section>
    <!-- blog content section -->
    <section class="">
        <div class="container">
             <div class="row">
                <!-- call to action -->
                <div class="col-md-7 col-sm-12 text-center center-col">
                    <p class="title-large text-uppercase letter-spacing-1 black-text font-weight-600 wow fadeIn">Latest Blogs</p>
                </div>
                <!-- end call to action -->
            </div>
            <div class="row">
                <!-- post item -->
                @php
                    $eventwaitduration = 300;
                @endphp
                @foreach($blogs as $blog)
                <div class="col-md-3 col-sm-6 col-xs-6 blog-listing wow fadeInRight" data-wow-duration="{{ $eventwaitduration }}ms">
                    <div class="blog-image">
                        <a href="{{ route('blog.single', $blog->slug) }}">
                            @if($blog->featured_image != null)
                            <img src="{{ asset('images/blogs/'.$blog->featured_image) }}" alt=""/>
                            @else
                            <img src="{{ asset('images/600x315.png') }}" alt=""/>
                            @endif
                        </a>
                    </div>
                    <div class="blog-details">
                        <div class="blog-date"><a href="{{ route('blog.single', $blog->slug) }}">{{ $blog->user->name }}</a> | {{ date('F d, Y', strtotime($blog->created_at)) }}</div>
                        <div class="blog-title"><a href="{{ route('blog.single', $blog->slug) }}">{{ $blog->title }}</a></div>
                        <div class="blog-short-description" style="text-align: justify; text-justify: inter-word; width: 100%; min-height: 160px;">
                            @if(strlen(strip_tags($blog->body))>300)
                            {{ mb_substr(strip_tags($blog->body), 0, stripos($blog->body, " ", stripos(strip_tags($blog->body), " ")+200))." [...] " }}
                            @else
                                {{ strip_tags($blog->body) }}
                            @endif
                        </div>
                        <div class="separator-line bg-black no-margin-lr"></div>
                        <div>
                            <a href="#!" class="blog-like"><i class="fa fa-heart-o"></i>{{ $blog->likes }} Like(s)</a>
                            <a href="#" class="comment"><i class="fa fa-comment-o"></i>
                            <span id="comment_count{{ $blog->id }}"></span> comment(s)</a>
                            <script type="text/javascript" src="{{ asset('vendor/hcode/js/jquery.min.js') }}"></script>
                            <script type="text/javascript">
                                $.ajax({
                                    url: "https://graph.facebook.com/v2.2/?fields=share{comment_count}&id={{ url('/blog/'.$blog->slug) }}",
                                    dataType: "jsonp",
                                    success: function(data) {
                                        $('#comment_count{{ $blog->id }}').text(data.share.comment_count);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                @php
                    $eventwaitduration = $eventwaitduration + 300;
                @endphp
                @endforeach
                <!-- end post item -->
            </div>
        </div>
    </section>
    <!-- end blog content section -->
@endsection

@section('js')

@endsection