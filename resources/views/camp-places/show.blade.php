@php
    $isFront = true;
@endphp

@extends('layouts.app')

@section('content')
<h2 style="display: none">{{ $campPlace->name }} 口コミ</h2>
<section>
    <div class="camp-places">
        <h1>{{ $campPlace->name }} 口コミ</h1>

{{--        <button class="btn warning-btn save-btn" type="submit">--}}
{{--            <img src="{{ asset('img/bookmark.svg') }}" alt="保存" width="20" />--}}
{{--            &nbsp;行きたいキャンプ場リストへ保存する--}}
{{--        </button>--}}

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
            @foreach ($campPlace->camp_schedules_has_review as $campSchedule)
                <div class="review-list__item">
                    <img src="{{ $campSchedule->review_image }}" alt="キャンプ場画像" width="130" />
                    <p class="review-content">
                        <span class="pc-only">{{ Str::limit($campSchedule->review, 200) }}</span>
                        <span class="sp-only">{{ Str::limit($campSchedule->review, 100) }}</span>
                        <a class="js-show-popup" href="#" onclick="return false;" data-id="reviewShowPopup-{{ $campSchedule->id }}">詳細こちら</a>
                    </p>
                </div>
                @include('components.modals.review-show', ['campSchedule' => $campSchedule])
            @endforeach
        </div>

        <a class="btn primary-btn save-btn" href="{{ route('register') }}">
            <img src="{{ asset('img/messenger_white.svg') }}" alt="口コミ一覧" width="20" />
            &nbsp;口コミを投稿する
        </a>
    </div>
</section>
@endsection
