@php
    $isMypage = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="bookmark-section">
        @include('mypage._tab')
        <div class="content">
            <bookmark-list
                :prop-bookmarks="{{ $bookmarks }}"
                token="{{ auth()->user()->api_token }}"
            ></bookmark-list>
        </div>
    </section>
@endsection
