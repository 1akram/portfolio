@extends('masterLayout.layout')
@section('pageTitle')
    {{$project->title}}
@endsection
@section('head')
@endsection
@section('content')
  
     {{-- top nav bar  --}}
     <div class="nav">
        <div class="nav-item"><a href="{{route('profile')}}"><i class="fas fa-home"></i></a></div>
    </div>

    {{-- end top nav bar  --}}
    @foreach ($project->images as $image)
        <div class="p-img-full"><img src="{{asset(Storage::url($image->url))}}" alt="{{$project->title}}"></div>
        @php
            break;
        @endphp
    @endforeach
    <div>
        <div class="container">
            <div class=" row">
                <div class=" col-md-8 col-sm-12 p-content">
                    <h1 class="p-title"><a href="#">{{$project->title }}</a></h1>
                    <p class="p-desctiption">{{$project->description}}</p>
                    <div class="p-techniques">
                        @foreach ($project->techniques as $technique)
                             <span>{{$technique->name}}</span>    
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        
                        <div class="col-sm-12 btn @if ($project->demoLink==null) btn-not-active @endif"><a @if ($project->demoLink!=null)href="{{$project->demoLink}}"@endif ><i class="far fa-desktop-alt"></i>@lang('texts.DEMO_KEY')</a></div>
                        <div class="col-sm-12 btn @if ($project->downloadLink==null) btn-not-active @endif"><a @if ($project->downloadLink!=null)href="{{$project->downloadLink}}"@endif><i class="fas fa-download"></i>@lang('texts.DOWNLOAD_KEY')</a></div>
                    </div>
                    <div>
    
                    </div>
    
    
    
                </div>
            </div>
    
        </div>
    </div>
    
    

@endsection

@section('extr')
 
@endsection