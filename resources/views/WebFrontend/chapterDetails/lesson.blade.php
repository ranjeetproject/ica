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

@endsection
@section('customJavascript')

@endsection