@extends('layouts.index')
@section('title')
    IIT Alumni | Disaster Data
@endsection

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/KBmapmarkers.css') }}">
  <style type="text/css">
    .KBmap__markerTitle{
      font-family: Arial;
      color: #56270c;
    }
    .KBmap__mapContainer{
      height: 85vh;
      max-height: 100vh;
    }
    .KBmap__mapHolder{
      height: 100%;
      -webkit-box-shadow: 0px 0px 15px 3px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 0px 15px 3px rgba(0, 0, 0, 0.15);
    }
    .KBmap__mapHolder img{
        width: auto;
        height: 100%;
    }
  </style>
@stop

@section('content')
    <!-- head section -->
    <section class="content-top-margin page-title page-title-small bg-gray">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-12 wow fadeInUp" data-wow-duration="300ms">
                  <!-- page title -->
                  <h1 class="black-text">Disaster Data</h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">Disaster Data</a></li>
                  </ul>
                  <!-- end breadcrumb -->
              </div>
          </div>
      </div>
    </section>
    <!-- end head section -->
    
    <section id="" class="padding-one wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                  <section class="no-padding KBmap" id="KBtestmap" style="">
                    <div class="KBmap__mapContainer">
                      <div class="KBmap__mapHolder"><img src="/images/map/districts.png" alt="Bangladesh Districts' Map"></div>
                    </div>
                  </section>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-primary btn-sm" id="changeCords">Test</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
{{-- <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/KBmapmarkers.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/KBmapmarkersCords.js') }}"></script>
<script type="text/javascript">
  $(function(){
   // $('a[title]').tooltip();
   // $('button[title]').tooltip();
  });

  var json2 =
  {
    @foreach($districts as $district)
    "mapMarker{{ $district->id }}": {
      "cordX": "{{ $district->cordx }}",
      "cordY": "{{ $district->cordy }}",
      "icon": "/images/map/map-marker.svg",
      "modal": {
        "title": "{{ $district->name }}",
        "content": "<p>ফাইলঃ <a href='/images/map/districts.png' target='_blank' download>⭳ ডাউনলোড</a></p>"
      }
    },
    @endforeach
  };

  // (function($) {

  //   $(document).ready(function(){

  //     createKBmap('KBtestmap', '/images/map/districts.png');

  //     KBtestmap.importJSON(json2);

  //     KBtestmap.showAllMapMarkers();

  //   });

  // })(jQuery);

  var myData = {};
  var json = {};
  $('#changeCords').click(function() {
    for(var i=0; i<10; i++) {
      var obj = { 
            cordX: Math.floor(Math.random() * 100),
            cordY: Math.floor(Math.random() * 100),
            icon: "/images/map/map-marker.svg",
            modal: {
              "title": "Test"+i,
              "content": "<p>ফাইলঃ <a href='/images/map/districts.png' target='_blank' download>⭳ ডাউনলোড</a></p>"
            }
        };
        myData['mapMarker'+i] = obj;
    }
    json = myData;
    console.log(json);
    createKBmap('KBtestmap', '/images/map/districts.png');

    KBtestmap.importJSON(json);

    KBtestmap.showAllMapMarkers();
  });


  
</script>
@stop