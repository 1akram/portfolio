@extends('masterLayout.layout')
@section('pageTitle')
@lang('texts.LOGIN_KEY')
@endsection
@section('head')
@endsection
@section('content')




<div class="container loginBox">
    <div class="subContent container">
       <div class="header">
           <h1>@lang('texts.LOGIN_KEY')</h1>
       </div>
           <div class="col-sm-12 col-md-8">
               <form action="{{ route('loginCheck') }}" method="post">
                    @csrf
                    <input type="email" class="input"name="email" value="{{old('email')}}" placeholder="@lang('texts.EMAIL_KEY')">
                    @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                   <input type="password" class="input"name="password" placeholder="@lang('texts.PASSWORD_KEY')">
                   <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>@lang('texts.LOGIN_KEY')</button>
               </form>
           </div>
    </div>
</div>
 
@endsection

@section('extr')
 
 
@endsection