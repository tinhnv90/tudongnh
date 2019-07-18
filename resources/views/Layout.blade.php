<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="_token" content="{{csrf_token()}}" />

    <meta property="fb:app_id" content="" />
    <meta property="og:url"         content="{{url()->current()}}" />
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:site_name" content="@yield('title')"/>
    <meta property="fb:pages" content="137693146948818">
    <meta property="ia:markup_url" content="{{url()->current()}}">

    <link rel="stylesheet" type="text/css" href="{{$style.'Stylesheet.css'}}">
    <link rel="stylesheet" type="text/css" href="{{$style.'mobile.css'}}">
    @yield('stylesheet')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{$script.'parchaseEvent.js'}}"></script>
    @yield('javascript')
    <script src="https://kit.fontawesome.com/6776076893.js"></script>
    <meta name="copyright" content="Copyright © 2019 tudongnhahang.com by tinhnv">
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=301735517272841&autoLogAppEvents=1"></script>
    
    <div id="layout-left" class="hide-mobile"></div>
    <div id="container">
        @include('Common.Header')
        @yield('content')
        @include('Common.Footer')
    </div>
    <div id="layout-right" class="hide-mobile"></div>
</body>
</html>