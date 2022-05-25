@extends('WebFrontend.layout.afterLoginApp')
@section('content')
<section class="header">
    <div class="header-top">
        @include('WebFrontend.layout.afterLoginHeaderTop')
    </div>
    <div class="header-bottom">
        @include('WebFrontend.layout.afterLoginNav')
    </div>

</section>

<section class="exam-list-wr">
    <div class="container">
        <h3 class="e-title">
            Notification list
            <span class="blue-bar"></span>
        </h3>
        @if($notification->total() > 0)
        @foreach ($notification as $key=>$notify)
        <div class="list-item exlist">
            <span>{{$key+1}}</span>
            <p>{{$notify->message}}</p>
        </div>
        @endforeach
        @else
        <div class="list-item">
            <p class="noDt">No data available</p>
        </div>
        @endif
        <nav aria-label="...">
            {{ $notification->links('WebFrontend.custom-notification-list-pagination') }}
        </nav>
    </div>
</section>
@endsection
