@php
    $isMypage = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="camp-schedule-section">
        @include('mypage._tab')
        <div class="content">
            <div class="camp-schedule-form">
                <form method="POST" action="{{ route('mypage.camp-schedules.update', ['camp_schedule' => $campSchedule]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-content">
                        @include('mypage.camp-schedules._form')

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">更新する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
