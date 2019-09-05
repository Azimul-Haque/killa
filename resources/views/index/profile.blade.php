@extends('layouts.index')
@section('title')
    Killa Consultancy | {{ Auth::user()->name }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')
    <section id="features" class="border-bottom no-padding-bottom xs-onepage-section">
        <div class="container">
            <div class="row margin-four">
                <div class="col-md-12 text-center">
                    <h2 class="section-title no-padding">{{ $user->name }}</h2>
                </div>
            </div>
            @if($user->activation_status == 0)
            <div class="row margin-two">
                <div class="col-md-12 text-center">
                    <h2>Application submitted!</h2>
                    <h3>After the successfull activation, you will be able to do all the activities.</h3>
                </div>
            </div>
            @endif
            <div class="row margin-three no-margin-bottom">
                <div class="col-md-6 col-sm-6 text-center xs-margin-bottom-ten">
                    <center>
                        <img src="{{ asset('images/users/'.$user->image) }}" alt="image of {{ $user->name }}" class="img-responsive shadow" style="width: 250px; height: auto;" /><br/>
                    </center>
                </div>
                <div class="col-md-6 col-sm-6 sm-margin-bottom-ten">
                    <div class="col-md-12 col-sm-12 no-padding">
                        <table class="table table-condensed">
                            <tr>
                                <td width="30%">Designation</td>
                                <td>: {{ $user->designation }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>: {{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Social</td>
                                <td>: 
                                    @if($user->fb != null)
                                    <a href="{{ $user->fb }}" style="font-size: 25px;" target="_blank"><i class="fa fa-facebook-official" style="color: #4267B0;"></i></a>
                                    @endif

                                    @if($user->twitter != null)
                                    <a href="{{ $user->twitter }}" style="font-size: 25px" target="_blank"><i class="fa fa-twitter-square" style="color: #20A1F0;"></i></a>
                                    @endif

                                    @if($user->linkedin != null)
                                    <a href="{{ $user->linkedin }}" style="font-size: 25px" target="_blank"><i class="fa fa-linkedin-square" style="color: #0874B1;"></i></a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection