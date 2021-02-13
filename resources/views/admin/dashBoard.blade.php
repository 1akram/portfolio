@extends('masterLayout.layout')
@section('pageTitle')
    @lang('texts.DASHBOARD_KEY')
@endsection
@section('head')
@endsection
@section('content')
 
     <!--  body -->
     {{-- top nav bar  --}}
    <div class="nav">
        <div class="nav-item"><a href="{{route('profile')}}"><i class="fas fa-home"></i></a></div>
    </div>

    {{-- end top nav bar  --}}

    
    <div>
         
       
 
        <div class="container">
            <!-- aboutME  -->
            <div id="aboutMe" class="row">
                <div class="col-md-10 col-sm-12 p-content">
                    <h1 class="p-title">@lang('texts.ABOUT_ME_KEY')</h1>
                    <form action="{{route('aboutMe.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="input @error('name') is-invalid-input @enderror" name="name" value="{{$user->name}}" placeholder="@lang('texts.NAME_KEY')" >
                        @error('name')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="date" class="input @error('birthDay') is-invalid-input @enderror"  name="birthDay" value="{{$user->birthDay}}" placeholder="@lang('texts.BIRTHDAY_KEY')">
                        @error('birthDay')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="email" class="input @error('email') is-invalid-input @enderror" name="email" value="{{$user->email}}" placeholder="@lang('texts.EMAIL_KEY')">
                        @error('email')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="text" class="input @error('phone') is-invalid-input @enderror" name="phone" value="{{$user->phone}}" placeholder="@lang('texts.PHONE_KEY')">
                        @error('phone')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="text" class="input @error('address') is-invalid-input @enderror" name="address" value="{{$user->address}}" placeholder="@lang('texts.ADDRESS_KEY')">
                        @error('address')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="file" class="input" name="avatar"  accept="jpg,png,jpeg">
                        @error('avatar')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea name="description" class="input" placeholder="@lang('texts.DESCRIPTION_KEY')">{{$user->description}}</textarea>
                        <div id="skills">
                            <h1 class="p-title">@lang('texts.SKILLS_KEY')<span></span> </h1>
                            <div class="row skillsForm">
                                <div class="col-md-2">
                                    <button id="addSkill" type="button" class="btn"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            
                            @error('skillName.*')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror 
                            @error('skillProgress.*')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror  

                            @foreach ($user->skills as $skill)
                                <div class="row skillsForm">
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" class="input" value="{{$skill->name}}" name="skillName[]" placeholder="@lang('texts.SKILL_NAME_KEY')">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <input type="text" class="input" name="skillProgress[]" value="{{$skill->progress}}" placeholder="@lang('texts.SKILL_PROGRESS_KEY')">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="deleteSkill" type="button" class="btn"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            @endforeach
 
                        </div>
                        <div id="networks">
                            <h1 class="p-title">@lang('texts.SOCIAL_NETWORKS_KEY')<span></span></h1>
                            <div class="row networkForm">
                                <div class="col-md-2">
                                    <button id="addNetwork" type="button" class="btn"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            @error('networkUrl.*')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror 
                            @error('networkIcon.*')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror  
                            @foreach ($user->socialMediaLinks as $socialMediaLink)
                            <div class="row networkForm">
                                <div class="col-md-6 col-sm-12">
                                    <input type="url" class="input" value="{{$socialMediaLink->url}}" name="networkUrl[]" placeholder="url">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <input type="text" class="input" value="{{$socialMediaLink->icon}}" name="networkIcon[]" placeholder="icon">
                                </div>
                                <div class="col-md-2">
                                    <button id="deleteNetwork" type="button" class="btn"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn"><i class="fas fa-save"></i>@lang('texts.SAVE_KEY')</button>
                    </form>
                </div>
            </div>
            <!-- end aboutME  -->

            <!-- portfolio  -->

            <div id="portfolio" class="row ">

                <div class="separation col-md-10 col-sm-12 p-content">
                    <h1 class="p-title">@lang('texts.PORTFOLIO_KEY')</h1>

                    <div>
                        @foreach ($user->projects   as $project)
                        <div class="row p-info">
                            <div class="col-md-6">
                                <h3>{{$project->title}}</h3>
                            </div>
                            <div class="col-md-3">
                                <h3>{{$project->created_at->format('d/m/y')}}</h3>
                            </div>
                            <div class="col-md-3 row edit-btns">
                                <div class="col-md-6 col-sm-12"><a href="{{ route('editProject', ['id'=>$project->id]) }}" class="btn"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-md-6 col-sm-12"><a href="" class="btn"><i
                                            class="fas fa-trash-alt"></i></a></div>
                            </div>
                        </div>
                            
                        @endforeach


                    </div>

                    <div class="row add-project">
                        <div class="col-md-6 col-sm-12"><a href="addProject.html" class="btn"><i
                                    class="fas fa-plus"></i></a></div>
                    </div>
                </div>
            </div>
            <!-- end portfolio  -->
            <!-- services  -->

            <div id="services" class="row ">

                <div class="separation col-md-10 col-sm-12 p-content">
                    <h1 class="p-title">@lang('texts.SERVICES_KEY')</h1>

                    @foreach ($services as $service)
                        
                    @endforeach
                    <div class="row p-info">
                        <div class="col-md-6">
                            <h3>{{$service->title}}</h3>
                        </div>
                        <div class="col-md-3">
                            <h3>{{$service->created_at->format('d/m/Y')}}</h3>
                        </div>
                        <div class="col-md-3 row edit-btns">
                            <div class="col-md-6 col-sm-12"><a href="{{route('editService',$service->id)}}" class="btn"><i class="fas fa-edit"></i></a></div>
                            <div class="col-md-6 col-sm-12"><a href="" class="btn"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>

  


                    <div class="row add-service">
                        <div class="col-md-6 col-sm-12"><a href="{{route('addService')}}" class="btn"><i
                                    class="fas fa-plus"></i></a></div>
                    </div>
                </div>
            </div>
            <!-- end services  -->

            <!-- settings  -->
            <div id="settings" class="row ">

                <div class="separation col-md-10 col-sm-12 p-content">
                    <h1 class="p-title">@lang('texts.SETTINGS_KEY')</h1>
                    <form action="" method="get">
                        <input type="text" class="input" name="title" placeholder="@lang('texts.SITE_TITLE_KEY')">
                        <input type="text" class="input" name="KeyWords" placeholder="@lang('texts.SITE_KEYWORDS_KEY')">
                        <input type="file" class="input" name="logo" accept="image/png">
                        <button type="submit" class="btn"><i class="fas fa-save"></i>@lang('texts.SAVE_KEY')</button>
                    </form>
                </div>
            </div>
            <!-- end settings  -->
        </div>
    </div>
    <!-- end body -->

@endsection

@section('extr')
<script>
    $(document).ready(function () {

        var Skills = $("#skills");
        $("#addSkill").click(function () {
            var skill = '<div class="row skillsForm"><div class="col-md-6 col-sm-12"><input type="text" class="input" name="skillName[]" placeholder="skill name"></div><div class="col-md-4 col-sm-12"><input type="text" class="input" name="skillProgress[]" placeholder="skill progress"></div><div class="col-md-2"><button id="deleteSkill" type="button" class="btn"><i class="fas fa-minus"></i></button></div></div>';
            Skills.append(skill);

        });
        $("#skills").on("click", "#deleteSkill", function () {

            $(this).closest(".skillsForm").remove();

        });


        var networks = $("#networks");
        $("#addNetwork").click(function () {
            var network = '<div class="row networkForm"><div class="col-md-6 col-sm-12"><input type="url" class="input" name="networkUrl[]" placeholder="url"></div><div class="col-md-4 col-sm-12"><input type="text" class="input" name="networkIcon[]" placeholder="icon"></div><div class="col-md-2"><button id="deleteNetwork" type="button" class="btn"><i class="fas fa-minus"></i></button></div></div>';
            networks.append(network);

        });
        $("#networks").on("click", "#deleteNetwork", function () {

            $(this).closest(".networkForm").remove();

        });




    });
</script>
@endsection