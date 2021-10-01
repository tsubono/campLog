@php
    $isFront = true;
@endphp

@extends('layouts.app')

@section('content')
<h1 style="display: none">キャンプ場検索</h1>
<h2 style="display: none">キャンプ場検索</h2>
<section>
    <div class="camp-places">
        <div class="camp-places-keyword-form">
            <div class="form-content">
                <div class="form-group">
                    <camp-place-select-box-for-search
                            :items="{{ $campPlaces }}"
                    />
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
