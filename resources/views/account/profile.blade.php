<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @include('layouts.mainCSS')
    @include('layouts.mainJS')
    <script type='module' defer src="{{asset('js/profile/toolProfile.js')}}"></script>

</head>
<body>
    <div id="root" class="root">
<header>
    
<!-- RESPONSIVE -->
@include('layouts.headerResponsive')
<!-- FORM SEARCH -->
@include('layouts.search')
<!-- FORM CART  -->
{{--@include('layouts.cart')--}}
<!-- Header begin -->
@include('layouts.header')
<!-- Header end -->
</header>
        <content>
            @if (isset($account))
                <div class="container-profile">
                    <div class="main-profile">
                        <div class="sidebar-profile">
                            <div class="header-sidebar_profile">
                                <div class="sectionAvatar-header__sidebar_profile">
                                    <img src="{{asset($account->url_avatar_account)}}" alt="" class="Avatar-header__sidebar_profile">
                                </div>
                                <div class="sectionNameUser-header__sidebar_profile">
                                    <div class="messNameUser-header__sidebar_profile">Welcome back</div>
                                    <div class="textNameUser-header__sidebar_profile">{{$account->fname}}</div>
                                </div>
                                <div class="sectionBtnSetting-header__sidebar_profile">
                                    <div class="btnSetting-header__sidebar_profile">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="content-sidebar_profile">
                                <div class="sectionMenu-sidebar_profile">
                                    <div class="listTabMenu-content__sidebar_profile">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body-profile">
                            <div class="header-body_profile">
                                <div class="sectionTabs-header__body_profile">
                                    <div class="listTab-header__body_profile">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="hr-body_profile">

                            </div>
                            <div class="content-body_profile">
                                                        
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </content>
    </div>
</body>
</html>