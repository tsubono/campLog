@php
    $isMypage = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="bookmark-section">
        @include('mypage._tab')
        <div class="content">
            <p class="description mb-10">
                <i class="fas fa-ellipsis-v handle"></i> ボタンを動かすと順番の並べ替えができます
            </p>
            <bookmark-list
                :prop-bookmarks="{{ $bookmarks }}"
                token="{{ auth()->user()->api_token }}"
            ></bookmark-list>
        </div>
    </section>
@endsection
