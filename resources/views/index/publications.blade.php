@extends('layouts.index')
@section('title')
    KillaBD | Projects
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}"> --}}
@endsection

@section('content')
    <!-- head section -->
    <section class="content-top-margin page-title page-title-small bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                    <!-- page title -->
                    <h1 class="black-text">Projects</h1>
                    <!-- end page title -->
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                    <!-- breadcrumb -->
                    <ul>
                        <li><a href="{{ route('index.index') }}">Home</a></li>
                        <li><a href="#">Projects</a></li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
      </section>
      <!-- end head section -->
      
      <section id="features" class="features wow fadeIn" style="margin-bottom: 40px; padding: 60px 0;">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <!-- features item -->
                      <div class="features-section col-md-4 col-sm-6 no-padding wow fadeInUp">
                          <div class="col-md-3 col-sm-2 col-xs-2 ">
                              <a href=""><img src="images/photography-15.jpg" alt=""></a>
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
                              <a href=""><img src="images/photography-15.jpg" alt=""></a>
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
@endsection

@section('js')
   
@endsection