@php
    $isMypage = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="camp-schedule-section">
        @include('mypage._tab')
        <div class="content">
            <h3 class="head-with-border small">キャンプ予定一覧</h3>

            <a class="btn primary-btn item create-btn" href="{{ route('mypage.camp-schedules.create') }}">新規追加</a>

            <div>
                {{ $campSchedules->links() }}
            </div>

            <div class="camp-schedule-list">
                @forelse ($campSchedules as $campSchedule)
                    <div class="camp-schedule-item">
                        <a class="js-show-popup delete-btn" data-id="campScheduleDeletePopup-{{ $campSchedule->id }}">
                            ×
                        </a>
                        @include('components.modals.camp-schedule-delete', ['campSchedule' => $campSchedule])
                        <div class="schedule-content">
                            <img class="eye-catch-image content-part" src="{{ $campSchedule->eye_catch_image_path }}" alt="アイキャッチ画像" />
                            <div class="text-left">
                                <div class="content-part">日程：{{ $campSchedule->date->format('Y.m.d') }}</div>
                                <div class="content-part">場所：{{ $campSchedule->place->name }}</div>
                                <div class="content-part">泊数：{{ $campSchedule->number_of_stay_text }}</div>
                            </div>
                        </div>
                        <div class="buttons">
                            <a class="btn default-btn content-part js-show-popup" data-id="campScheduleShowPopup-{{ $campSchedule->id }}">詳細</a>
                            @include('components.modals.camp-schedule-show', ['campSchedule' => $campSchedule])
                            <div class="flex-column content-part">
                                <a class="btn gray-btn" href="{{ route('mypage.camp-schedules.edit', ['camp_schedule' => $campSchedule]) }}">編集</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>まだ登録されていません</p>
                @endforelse
            </div>

            <div class="mt-20">
                {{ $campSchedules->links() }}
            </div>
        </div>
    </section>
@endsection

@include('components.modals.share-modal')

@section('js')
    <script>
      $(function() {
        if ("{{ session('showSharePopup') }}") {
          $('#sharePopup').fadeIn();
          if (!$('body').hasClass('is-modal')) {
            $('body').addClass('is-modal')
          }
        }
      })
    </script>
@endsection

