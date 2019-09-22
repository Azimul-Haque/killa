@extends('layouts.index')
@section('title')
    Killa Consultancy | Disaster Data
@endsection

@section('css')
  {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
  {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/KBmapmarkers.css') }}"> --}}
  {{-- <style type="text/css">
    body {
      overflow-x: hidden;
    }
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
  </style> --}}

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />

  <style type="text/css">
    #map {
      height: 620px;
      width: 100%;      
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
                  <h1 class="black-text">Disaster Data <span id="datacetnameheader"></span></h1>
                  <!-- end page title -->
              </div>
              <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">
                  <!-- breadcrumb -->
                  <ul>
                      {{-- <li><a href="{{ route('index.index') }}">Home</a></li>
                      <li><a href="#">Disaster Data</a></li> --}}
                  </ul>
                  <!-- end breadcrumb -->
              </div>
          </div>
      </div>
    </section>
    <!-- end head section -->
    
    <section id="" class="padding-three">
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <select class="form-control select" name="discategory_id" id="discategory_id" data-placeholder="Select Disaster Category">
                  <option value="" disabled="" selected="">Select Disaster Category</option>
                  @foreach($discategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <br/>
                <h3>Showing data for: <span id="datacetnameh3"></span></h3><br/>
              </div>
              <div class="col-md-8">
                <div id="map" class="shadow"></div>

                {{-- <section class="no-padding KBmap" id="KBtestmap" style="float: right;">
                  <div class="KBmap__mapContainer">
                    <div class="KBmap__mapHolder"><img src="/images/map/districts.png" alt="Bangladesh Districts Map"></div>
                  </div>
                </section> --}}
              </div>
            </div>
        </div>
    </section>    
@endsection



@section('js')
  {{-- <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script> --}}
  {{-- <script type="text/javascript" src="{{ asset('js/KBmapmarkers.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/KBmapmarkersCords.js') }}"></script> --}}
  {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}

  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
  <script type="text/javascript">
    var zoomlevel = 7;
    if($(window).width() < 768) {
      $('#map').css({"height": "550px"});
      zoomlevel = 6.6;
    }

    var map = L.map('map', {
        center: [23.7104, 90.40744],
        zoom: zoomlevel,
        zoomSnap: 0.1
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '<a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap</a> contributor'
    }).addTo(map);

    var marker = [];
    var oldmarkercount = 0;

    $('#discategory_id').change(function() {
      var api_url = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '')+'/disaster/data/'+ $('#discategory_id').val() +'/api';
      $.get(api_url, function(data, status){
        if(data.districtscords) {
          $('#datacetnameh3').text(data.discategory.name);
          $('#datacetnameheader').html('<big>- '+ data.discategory.name +'</big>');
          
          // console.log(oldmarkercount);
          for(var j=0; j<oldmarkercount; j++) {
            if(marker[j] != undefined) {
              map.removeLayer(marker[j]);
            }
          }
          
          marker = [];
          for(var i=0; i<data.districtscords.length; i++) {
            var cords = data.districtscords[i].coordinates.split(",");
            marker[i] = L.marker([cords[0], cords[1]]).bindPopup("<big>"+ data.discategory.name +"</big><br/><b>District: "+ data.districtscords[i].name +"</b><br/><a href='#!'>⇓ Download</a>").addTo(map);
            // marker1.bindPopup("Test<br/><a href='#!'>Click</a>"); // .openPopup() to open it onready
          }
          oldmarkercount = marker.length;
        } else {
          if($(window).width() > 768) {
            toastr.info('No data on this Category', 'INFO').css('width', '400px');
          } else {
            toastr.info('No data on this Category', 'INFO').css('width', ($(window).width()-25)+'px');
          }
        }
      });
    });

    $(document).ready(function(){
      // $('.select').select2();
    });
  </script>
@stop

