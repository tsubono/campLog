@extends('layouts.app')

@section('content')
    <section class="camp-schedule-section">
        @include('mypage._tab')
        <div class="content">
            <div class="camp-schedule-form">
                <form method="POST" action="{{ route('mypage.camp-schedules.store') }}">
                    @csrf

                    <div class="form-content">
                        @include('mypage.camp-schedules._form')

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
