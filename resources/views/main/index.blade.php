<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container my-4">
    <!-- Weather and date information -->
    <div class="weather-info">
        <div>{{ __('attributes.destination') }}</div>
        <div>{{ __('attributes.datetime') }}</div>
        <div>{{ __('attributes.temperature') }}</div>
    </div>
    <div class="col-2">
        <form method="GET" action="{{ route('top-news.index') }}">
            <select class="form-select m-4" name="lang" onchange="this.form.submit()">
                <option value="vi" {{ request('lang') == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                <option value="en" {{ request('lang') == 'en' ? 'selected' : '' }}>English</option>
                <option value="zh" {{ request('lang') == 'zh' ? 'selected' : '' }}>中文</option>
            </select>
        </form>
    </div>

    <!-- Main content area -->
    <div class="row">
        <!-- Left Column (Main News + Spotlight) -->
        <div class="col-lg-8">
            <!-- Main Headline -->
            <div class="news-card">
                <div class="news-image">
                    <img src="{{ asset('assets/img/img_news1.png') }}" alt="Main News">
                </div>
                <h2 class="headline mt-3">{{ $latestNews['title'] }}</h2>
                <p>{{ $latestNews['content'] }}</p>
            </div>

            <!-- Sub-news (small articles below the headline) -->
            <div class="row">
                @foreach ($relatedNews as $post)
                <div class="col-md-6 news-card">
                    <div class="news-image">
                        <img src="{{ asset('assets/img/img_news1.png') }}" alt="Sub News 2">
                    </div>
                    <h3 class="sub-news-title mt-2">{{ $post['title'] }}</h3>
                    <p>{{ $post['content'] }}</p>
                </div>
                @endforeach
            </div>

            <!-- Spotlight section -->
            <div class="news-card">
                @foreach ($differentPosts as $differentPost)
                <div class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('assets/img/img_news1.png') }}" alt="Spotlight 2">
                    </div>
                    <h5 class="sub-news-title mt-3">{{ $differentPost['title'] }}</h5>
                    <p>{{ $differentPost['content'] }}</p>
                </div>
                @endforeach
            </div>

            
        </div>

       
        <div class="col-lg-4">
            
            @foreach($sidePosts as $sidePost)
            <div class="sidebar-news mb-4">
                <h5 class="sub-news-title">{{ $sidePost['title'] }}</h5>
                <p>{{ $sidePost['content'] }}</p>
            </div>
            @endforeach
           
            <div class="ad-banner mb-4">
                <img src="{{ asset('assets/img/img_news1.png') }}" alt="">
            </div>

           
            @foreach($sidePosts as $sidePost)
            <div class="sidebar-news mb-4">
                <h5 class="sub-news-title">{{ $sidePost['title'] }}</h5>
                <p>{{ $sidePost['content'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
