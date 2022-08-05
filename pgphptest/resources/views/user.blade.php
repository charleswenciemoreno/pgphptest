@extends('layout')

@section('styles')
@endsection

@section('title', 'User Card - '.$user->name) 

@section('content')
<section id="main">
	<header>
		<span class="avatar"><img src="{{asset('images/users/'.$user->id.'.jpg') }}" alt="" /></span>
	    <h1>{{ $user->name }}</h1>
	    <p>{!! nl2br($user->comments) !!}</p>
	</header>
</section>

<button id="comment-section-btn" class="text-white mb-3 mt-3">ADD COMMENT</button>

@include('create_comment')

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/user.js?v=1') }}"></script>
@endsection

