@extends('masterLayout.layout')
@section('pageTitle')
    @lang('texts.INDEX_KEY')
@endsection
@section('head')
@endsection
@section('content')
 
     {{-- <!--  body --> --}}
     <nav class="home">
        <a id="aboutMe" href="#aboutMe" class="item bg-color-bittersweet">@lang('texts.ABOUT_ME_KEY')</a>
        <a id="portfolio" href="#portfolio" class="item bg-color-light-gray">@lang('texts.PORTFOLIO_KEY')</a>
        <a id="services" href="#services" class="item bg-color-bittersweet">@lang('texts.SERVICES_KEY')</a>
    </nav>


    {{-- <!-- aboutMe section --> --}}
    <div data-content="aboutMe" class="content">


        <div class="close"></div>
        <div class="subContent container">
            {{-- <!-- info section  --> --}}
            <div class="info">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <img class=" avatar" src="{{asset(Storage::url($user->avatar))}}" alt="{{$user->name}}">
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <ul>
                            <li><span>@lang('texts.NAME_KEY') : </span>{{$user->name}}</li>
                            <li><span>@lang('texts.AGE_KEY') : </span>{{$user->age()}}</li>
                            <li id="emali"><span>@lang('texts.EMAIL_KEY') : </span>{{$user->email}}</li>
                            <li><span>@lang('texts.PHONE_KEY') : </span>{{$user->phone}}</li>
                            <li><span>@lang('texts.ADDRESS_KEY') : </span>{{$user->address}}</li>
                        </ul>
                    </div>
                </div>
                <div class="row links">
                    @foreach ($user->socialMediaLinks as $socialMediaLink)
                        <span><a href="{{$socialMediaLink->url}}" target="_blank"><i class="{{$socialMediaLink->icon}}"></i></a></span>
                    @endforeach
                </div>
            </div>
            {{-- <!-- end info section  --> --}}

            {{-- <!-- description section  --> --}}
            <div class="row description">

                <h1 class="des-title">@lang('texts.ABOUT_ME_KEY')</h1>
                <p class="des-content">{{$user->description}}</p>
            </div>
            {{-- <!-- end description section  --> --}}

            {{-- <!-- skills section  --> --}}
            <div class="skills">
                <h1 class="skl-title">@lang('texts.SKILLS_KEY')</h1>
                <div class="row">
                    @foreach ($user->skills as $skill)
                        <div class="col-sm-6 skill">
                            <div class="skl-name">
                                <span>{{$skill->name}}</span>
                                <span>{{$skill->progress}}%</span>
                            </div>
                            <div data-progress="{{$skill->progress}}" class="progress">
                                <div ></div>
                            </div>
                        </div>
                    @endforeach
             
                </div>
            </div>
            {{-- <!-- end skills section  --> --}}

        </div>








    </div>
    {{-- <!-- end aboutMe section  --> --}}

    {{-- <!-- portfolio section  --> --}}
    <div data-content="portfolio" class="content">
        <div class="close "></div>
        <div class="subContent container">
            <div class="header">
                <h1>@lang('texts.MY_PROJECTS_KEY')</h1>
            </div>
            <div class="projects">
               
                {{-- <!-- Projects  --> --}}
                @foreach ($user->projects as $project)
                <div class="row project">
                    <div class="col-md-4 col-sm-12 p-img"><img src=" @if ($project->haveImages()) {{ asset(Storage::url($project->images[0]->url)) }} @else {{asset('img/project.jpg')}}  @endif"  alt="{{$project->title}}"></div> 

                    <div class=" row col-md-8 col-sm-12 p-content">

                        <h1 class="p-title"><a href="{{ route('showProject', ['id'=>$project->id,'title'=>$project->title]) }}">{{$project->title}}</a></h1>
                        <p class="p-desctiption">{{$project->description}}</p>
                        <div class="p-techniques">
                            @foreach ($project->techniques as $technique) 
                              <span>{{$technique->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <!-- end projects section  --> --}}
            </div>




        </div>
    </div>
    {{-- <!-- end portfolio section  --> --}}

    {{-- <!-- services section  --> --}}
    <div data-content="services" class="content">
        <div class="close"></div>
        <div class="subContent container">
            <div class="header">
                <h1>@lang('texts.OUR_SERVICES_KEY')</h1>
            </div>
            <div class="row services">
                {{-- <!-- service section  --> --}}
                @foreach ($user->services as $service)
                <div class="col-md-4 col-sm-6 service">
                    <div class="s-icon"><i class="far {{$service->icon}}"></i></div>
                    <h1 class="s-title">{{$service->title}}</h1>
                    <div class="s-description">{{$service->description}}</div>
                </div>   
                @endforeach
                {{-- <!-- end service section  --> --}}
 
             
            </div>
        </div>

    </div>
    {{-- <!-- end services section  --> --}}

    {{-- <!-- contactMe section  --> --}}
    <div data-content="contactMe" class="content">
        <div class="close"></div>
        <div class="subContent container">
            <div class="header">
                <h1>@lang('texts.CONTACT_ME_KEY')</h1>
            </div>
            <div class="row contactFormBox">
                <div class="col-sm-12 col-md-8">
                    <form action="" method="post">
                        <input type="text" class="input" name="name" placeholder="@lang('texts.FULL_NAME_KEY')">
                        <input type="email" class="input" name="email" placeholder="@lang('texts.EMAIL_KEY')">
                        <input type="text" class="input" name="subject" placeholder="@lang('texts.SUBJECT_KEY')">
                        <textarea name="message" class="input" placeholder="@lang('texts.MESSAGE_KEY')"></textarea>
                        <button type="submit" class="btn"><i class="fas fa-paper-plane"></i>@lang('texts.SEND_KEY')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- end contactMe section  --> --}}
    {{-- <!-- end body --> --}}

@endsection

@section('extr')
    <script>
        var zIndex = 1;
        $(document).ready(function () {

            var element;
            var height;
            $(".item").click(function () {
                element = $("[data-content=" + $(this).attr("id") + "]");
                height = "auto";
                element.addClass("active");
                zIndex++;
                element.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function (e) {
                    $(this).css("height", height);
                });
            });
            $(".close").click(function () {
                height = "100vh";
                $(this).parent().css("height", height);
                $(this).parent().removeClass("active");
                zIndex = 1;
            });

            $(".skills .skill ").each(function (index) {
                var progress = $(this).find(".progress");
                progress.find("div").css("width", progress.attr("data-progress") + "%");
            });

        });
    </script>
@endsection