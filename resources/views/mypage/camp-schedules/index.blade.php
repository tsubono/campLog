@extends('layouts.app')

@section('content')
    <section class="camp-schedule-section">
        @include('mypage._tab')
        <div class="content">
            <h2>キャンプ予定一覧</h2>

            <div class="flex-right">
                <a class="btn primary-btn item" href="{{ route('mypage.camp-schedules.create') }}">新規追加</a>
            </div>
            <div class="camp-schedule-list">
                @forelse ($campSchedules as $campSchedule)
                    <div class="camp-schedule-item">
                        <img class="eye-catch-image content-part" src="{{ $campSchedule->eye_catch_image_path }}" alt="アイキャッチ画像" />
                        <div class="content-part">{{ $campSchedule->date->format('Y.m.d') }}</div>
                        <div class="content-part">{{ $campSchedule->place->name }}</div>
                        <div class="content-part">{{ $campSchedule->number_of_stay_text }}</div>
                        <div class="buttons">
                            <a class="btn default-btn content-part js-show-popup" data-id="campScheduleShowPopup-{{ $campSchedule->id }}">詳細</a>
                            @include('components.modals.camp-schedule-show', ['campSchedule' => $campSchedule])
                            <div class="flex-column content-part">
                                <a class="btn warning-btn" href="{{ route('mypage.camp-schedules.edit', ['camp_schedule' => $campSchedule]) }}">編集</a>
                                <a class="btn danger-btn js-show-popup" data-id="campScheduleDeletePopup-{{ $campSchedule->id }}">削除</a>
                                @include('components.modals.camp-schedule-delete', ['campSchedule' => $campSchedule])
                            </div>
                        </div>
                    </div>
                @if (!$loop->last)
                        <hr>
                @endif
                @empty
                    <p>まだ登録されていません</p>
                @endforelse

                {{ $campSchedules->links() }}
            </div>
        </div>
    </section>
@endsection
