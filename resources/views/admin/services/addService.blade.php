@extends('masterLayout.layout')
@section('pageTitle')
@lang('texts.ADD_SERVICE_KEY')
@endsection
@section('head')
@endsection
@section('content')
 
     {{-- <!--  body --> --}}
     {{-- top nav bar  --}}
     <div class="nav">
        <div class="nav-item"><a href="{{route('profile')}}"><i class="fas fa-home"></i></a></div>
        <div class="nav-item"><a href="{{route('logout')}}"><i class="fas fa-door-open"></i></a></div>

    </div>
 
    <div class="container">
        <div class="row"  >
            <form action="{{route('saveService')}}" method="post" id="add">@csrf </form>


                <div class="col-sm-12">
                    <input type="text" name="title" placeholder="@lang('texts.SERVICE_TITLE_KEY')" value="{{old('title')}}" class="input @error('name') is-invalid-input @enderror" form="add">
                    @error('title')
                      <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12">
                    <textarea class="input @error('description') is-invalid-input @enderror " placeholder="@lang('texts.SERVICE_DESCRIPTION_KEY')" name="description" cols="30" rows="30" form="add">{{old('description')}}</textarea>
                    @error('description')
                        <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 icons-box  ">
                    <input type="text" name="icon" value="{{old('icon')}}" placeholder=" @lang('texts.ICON_WITHOUT_FAR_KEY')" class="input  @error('icon') is-invalid-input @enderror" form="add">
                    @error('description')
                      <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 row">
                    <div class="col-md-6 col-sm-12"><button class="btn" type="submit" form="add"><i class="fas fa-save"></i>@lang('texts.SAVE_KEY')</button></div>
                    <div class="col-md-6 col-sm-12"><a href="{{route('dashboard')}}" class="btn" ><i class="fas fa-times-circle"></i>@lang('texts.CANCEL_KEY')</a></div>
                 </div>
           
        </div>

    </div>
@endsection

@section('extr')
 
 
@endsection