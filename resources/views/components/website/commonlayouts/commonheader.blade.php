<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link rel="icon" type="image/png" sizes="16x16" href={{ url('/logo/logo.jpg') }} />
<meta name="msapplication-TileColor" content="#000000" />
<meta name="msapplication-TileImage" content={{ url('/website/favicon.png') }} />
<meta name="theme-color" content="#00c5d0" />
<meta name="robots" content="index, follow" />
<meta name="description" content="@yield('description')" />
<meta name="Keywords" content="@yield('keyword')" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta property="og:image" content="@yield('image')" />
<meta property="og:type" content="Jobs Portal" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:site_name" content="www.preparenext.com" />
<link href="{{ Request::url() }}" rel="canonical" />
<link href="https://www.preparenext.com/" rel="home" />
<meta name="twitter:site" content="@preparenext" />
<meta name="twitter:card" content="@yield('title')" />
<meta name="twitter:creator" content="@preparenext" />
<meta name="twitter:title" content="@yield('title')" />
<meta name="twitter:description" content="@yield('description')" />
<meta name="twitter:image" content="@yield('image')" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="author" content="preparenext.com" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="apple-touch-icon" href="{{ url('/logo/logo.jpg') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">
