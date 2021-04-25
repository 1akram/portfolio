@extends('masterLayout.layout')
@section('pageTitle')
    @lang('texts.EDIT_KEY'){{" ".$project->title}}
@endsection
@section('head')
@endsection
@section('content')


<div class="nav">
    <div class="nav-item"><a href="{{route('profile')}}"><i class="fas fa-home"></i></a></div>
    <div class="nav-item"><a href="{{route('logout')}}"><i class="fas fa-door-open"></i></a></div>

</div>

<div class="container">
    <div class="row"  >
        <form action="{{ route('updateProject')}}" method="post" enctype="multipart/form-data" id="add">
             @csrf
             <input type="hidden" name="id" value="{{$project->id}}">
        </form>


            <div class="col-sm-12">
                <input type="text" name="title" value="{{$project->title}}" placeholder="@lang('texts.PROJECT_TITLE_KEY')" class="input @error('title') is-invalid-input @enderror" form="add">
                @error('title')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12">
                <textarea class="input @error('description') is-invalid-input @enderror " placeholder="@lang('texts.DESCRIPTION_KEY')" 
                    name="description" cols="30" rows="30" form="add">{{$project->description}}</textarea>
                @error('description')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <h1>@lang('texts.TECHNIQUES_KEY')</h1>
            <div class="col-sm-12 techniques">
                @foreach ($techniques as $technique)
                    <div class="custom-checkbox">
                        <input type="checkbox" id="t{{$technique->id}}" name="techniques[]" value="{{$technique->id}}"
                             @if ($project->techniques->contains('id',$technique->id)) checked @endif form="add">
                        <label for="t{{$technique->id}}">
                            <span>{{$technique->name}}</span>
                        </label>
                    </div>
                @endforeach
               
                 
            </div>
            <h1>@lang('texts.LINKS_KEY')</h1>
            <div class="col-sm-12">
                <input type="url" name="download" value="{{$project->download }}" class="input @error('download') is-invalid-input @enderror " placeholder="@lang('texts.DOWNLOAD_KEY')" form="add">
                @error('download')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
                <input type="url" name="demo" value="{{$project->demo}}" class="input @error('demo') is-invalid-input @enderror " placeholder="@lang('texts.DEMO_KEY')" form="add">
                @error('demo')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <h1>@lang('texts.IMAGES_KEY')</h1>
            <div class="col-sm-12">
                <div class="row">
                    @foreach ($project->images as $image)
                    <div class="div-thumbnail">
                        <form action="{{ route('deleteProjectImage',['projectId'=>$project->id]) }}" method="POST" id="deleteImage{{$image->id}}">
                            @csrf 
                            <input type="hidden" name="id" value="{{$image->id}}">
                        </form>
                        <a data-delete="deleteImage{{$image->id}}" href="#deleteImage" class="jq-delete-image"><img src="{{asset(Storage::url($image->url))}}" class="img-thumbnail" alt="{{$project->title}}"></a>
                    </div>
                    @endforeach
                </div>
                <input type="file" multiple accept=".png,.jpg,.jpeg" name="images[]" class="input @error('images') is-invalid-input @enderror" form="add">
                @error('images')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12 row">
                <div class="col-md-6 col-sm-12"><button class="btn" type="submit" form="add"><i class="fas fa-save"></i>@lang('texts.SAVE_KEY')</button></div>
                <div class="col-md-6 col-sm-12"><a href="{{route('dashboard')}}" class="btn" ><i class="fas fa-times-circle"></i> @lang('texts.CANCEL_KEY')</a></div>
             </div>
       
    </div>

</div>
 
@endsection


@section('extr')
<script>
    $(document).ready(function () {
        $(".jq-delete-image").click(function(){

            if (confirm("did you want to delete this image ?")) {
              $('#'+$(this).data("delete")).submit();
            }
        
        });
    });
</script>
@endsection