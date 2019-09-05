@extends('layouts.index')
@section('title')
    Killa Consultancy | {{ $expertise->title }}
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
                  <h1 class="black-text">{{ $expertise->title }}</h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">{{ $expertise->title }}</a></li>
                  </ul>
                  <!-- end breadcrumb -->
              </div>
          </div>
      </div>
    </section>

    <!-- content section -->
    <section class="bg-dark-gray wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  @if($expertise->image != null)
                    <img src="{{ asset('images/expertises/'.$expertise->image)}}"  class="img-responsive" style="width: 100%;" />
                  @else
                    <img src="{{ asset('images/abc.png')}}"  class="img-responsive" />
                  @endif
                  <br/><br/>

                  <div class="text-large white-text">
                    {!! $expertise->description !!}
                  </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('js')
   
@endsection