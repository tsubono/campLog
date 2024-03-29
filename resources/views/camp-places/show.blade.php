@php
    $isFront = true;
@endphp

@extends('layouts.app')

@section('content')
<section>
    <div class="camp-places">
        <h1>{{ $campPlace->name }}</h1>

        @if (!$isBookmark)
        <form method="post" action="{{ route('camp-places.add-bookmark', compact('campPlace')) }}">
            @csrf
            <button class="btn success-btn save-btn" type="submit">
                <img src="{{ asset('img/add_bookmark.svg') }}" alt="保存" width="20" />
                &nbsp;行きたいキャンプ場リストへ保存する
            </button>
        </form>
        @else
            <form method="post" action="{{ route('camp-places.remove-bookmark', compact('campPlace')) }}">
                @csrf
                <button class="btn danger-btn save-btn" type="submit">
                    <img src="{{ asset('img/remove_bookmark.svg') }}" alt="保存" width="20" />
                    &nbsp;行きたいキャンプ場リストの保存を解除
                </button>
            </form>
        @endif


        <table class="info-table">
            <tbody>
            @if (!empty($campPlace->address))
                <tr>
                    <th>住所</th>
                    <td>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $campPlace->address }}" target="_blank" rel="noopener">{{ $campPlace->address }}</a>
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->tel_number))
                <tr>
                    <th>電話番号</th>
                    <td>
                        <a href="tel:{{ $campPlace->tel_number }}">{{ $campPlace->tel_number }}</a>
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->check_in))
                <tr>
                    <th>チェックイン</th>
                    <td>
                        {{ $campPlace->check_in }}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->check_out))
                <tr>
                    <th>チェックアウト</th>
                    <td>
                        {{ $campPlace->check_out }}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->business_hours))
                <tr>
                    <th>営業時間</th>
                    <td>
                        {!! nl2br(e($campPlace->business_hours)) !!}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->parking))
                <tr>
                    <th>駐車場</th>
                    <td>
                        {{ $campPlace->parking }}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->holiday))
                <tr>
                    <th>定休日</th>
                    <td>
                        {{ $campPlace->holiday }}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->can_credit))
                <tr>
                    <th>カード決済</th>
                    <td>
                        {{ $campPlace->can_credit }}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->usage_type))
                <tr>
                    <th>利用タイプ</th>
                    <td>
                        {{ $campPlace->usage_type }}
                    </td>
                </tr>
            @endif
            @if (!empty($campPlace->url))
                <tr>
                    <th>HP</th>
                    <td>
                        <a href="{{ $campPlace->url }}" target="_blank">{{ $campPlace->url }}</a>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        <div class="review-list">
            <h2 class="text-center">{{ $campPlace->name }} 口コミ</h2>
            @foreach ($campPlace->camp_schedules_has_review as $campSchedule)
                <div class="review-list__item">
                    <img src="{{ str_replace("camp-schedule/", "camp-schedule/resized-", $campSchedule->review_image) }}" alt="キャンプ場画像" class="js-modal-image js-image-{{ $campSchedule->id }} place-img" data-id="{{ $campSchedule->id }}" />
                    <div class="review-content">
                        <div class="review-content__user">
                            <img src="{{ $campSchedule->user->display_avatar_path }}" alt="アバター画像" class="avatar-img small" />
                            &nbsp;<a href="{{ route('profile.index', ['userName' => $campSchedule->user->name]) }}">{{ $campSchedule->user->handle_name }}</a>
                            <span class="date">行った月：{{ $campSchedule->date->format('Y年m月') }}</span>
                        </div>
                        <span class="pc-only mt-10">{{ Str::limit($campSchedule->review, 215) }}</span>
                        <span class="sp-only mt-10">{{ Str::limit($campSchedule->review, 80) }}</span>
                        <a class="js-show-popup show-link" href="#" onclick="return false;" data-id="reviewShowPopup-{{ $campSchedule->id }}">もっと見る</a>
                    </div>
                </div>
                @include('components.modals.review-show', ['campSchedule' => $campSchedule])
            @endforeach
        </div>

        <a class="btn primary-btn save-btn" href="{{ route('mypage.camp-schedules.create') }}?campPlaceId={{ $campPlace->id }}&campPlaceName={{ $campPlace->name }}">
            <img src="{{ asset('img/messenger_white.svg') }}" alt="口コミを投稿する" width="20" />
            &nbsp;口コミを投稿する
        </a>
    </div>
</section>
<div class="image-modal-bg">
    <div class="image-content"></div>
    <div class="image-modal-close">×</div>
</div>
@endsection
