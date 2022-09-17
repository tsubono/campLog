@php
    $isFront = true;
@endphp

@extends('layouts.app')

@section('content')
<h1 style="display: none">{{ $user->handle_name }}のキャンプの記録</h1>
<h2 style="display: none">{{ now()->year }}年のキャンプ記録</h2>
<section>
    <header class="header-image">
        <img alt="背景画像" src="{{ $user->display_background_path }}" width="auto" height="auto" />
    </header>
    <div class="profile">
        <div class="avatar">
            <img alt="アバター画像" class="avatar-img" src="{{ $user->display_avatar_path }}" width="auto" height="auto">
        </div>
        <div class="text">
            <h2 class="name">{{ $user->handle_name }}</h2>
            <div class="introduction">
                <p>
                    @if (!empty($user->gender) && $user->is_public_gender)性別／{{ $user->gender_txt }}　@endif
                    @if (!empty($user->age) && $user->is_public_age)年齢／{{ $user->age }}歳　@endif
                    @if (!empty($user->camp_start_date) && $user->is_public_camp_history)キャンプ歴／{{ $user->camp_history }}　@endif
                    @if (!empty($user->location) && $user->is_public_location)拠点／{{ $user->location }}　@endif
                </p>
            </div>
        </div>
    </div>
    <div class="self-introduction">
        @if ($user->is_public_introduction)
            <br>
            <p>
                {!! nl2br(e($user->introduction)) !!}
            </p>
        @endif
    </div>
    @if ($user->is_public_link)
        <div class="sns-list">
            <div class="sns-wrapper">
                @foreach ($user->links as $link)
                    @if ($link['is_public'] && !empty($link['url']))
                        <a class="sns-item" href="{{ $link['url'] }}" target="_blank" rel="noopener">
                            <img alt="アイコン" src="{{ $link['icon_path'] }}" class="icon" width="auto" height="auto">
                            @if (!is_null($link['name']))<span>{{ $link['name'] }}</span>@endif
                        </a>
                   @endif
                @endforeach
            </div>
        </div>
    @endif
    <div class="summary">
        @if (!empty($user->summary))
            <div class="sticky">
                <div class="arrows" id="moveArrows">
                    <a class="summary-arrow-link js-scrollto-prev-summary">
                        <img src="{{ asset('img/left-arrow-round.svg') }}" alt="左矢印" width="auto" height="auto" />
                    </a>
                    <a class="summary-arrow-link js-scrollto-next-summary">
                        <img src="{{ asset('img/right-arrow-round.svg') }}" alt="右矢印" width="auto" height="auto" />
                    </a>
                </div>
            </div>
        @endif
        <div class="scrolled">
        @foreach ($user->summary as $year => $summaryData)
            <div class="summary-wrapper">
                <h2 class="summary-title" id="summary-{{ $year }}">{{ $year }} ACTIVITY</h2>
                <div class="cards">
                    <div class="card long">
                        <div class="card-title">宿泊</div>
                        <div class="card-data">
                            <span>{{ $summaryData['stayCount'] }}</span>
                            <span class="unit">泊</span>
                        </div>
                    </div>
                    <div class="card yellow">
                        <div class="card-title">デイ</div>
                        <div class="card-data">
                            <span>{{ $summaryData['dayCount'] }}</span>
                            <span class="unit">回</span>
                        </div>
                    </div>
                    <div class="card red">
                        <div class="card-title">キャンプ場</div>
                        <div class="card-data">
                            <span>{{ $summaryData['campPlaceCount'] }}</span>
                            <span class="unit place">
                                <span>箇</span>
                                <span>所</span>
                            </span>
                        </div>
                    </div>
                    <div class="monthly-list">
                        <div class="list-title camping">
                            <img src="./img/icon_stay.svg" alt="宿泊月別アイコン" width="auto" height="auto" />
                            <span>宿泊</span>
                            <span>月別</span>
                        </div>
                        <ul class="list">
                            @foreach ($summaryData['stayCountByMonth'] as $month => $stayCount)
                                <li class="item">{{ $month }}月<span class="stays">{{ $stayCount }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <div class="camp-schedules" id="campSchedules">
        <ul class="tab-menu">
            <li class="js-tab-item tab-item type-grid active">GRID</li>
            <li class="js-tab-item tab-item type-list">LIST</li>
        </ul>
        <div class="grid-tab-content tab-content show">
            <div class="list">
                @foreach ($campSchedules as $campSchedule)
                    <div class="item" data-id="campScheduleShowPopup-{{ $campSchedule->id }}" onclick="location.href='{{ route('camp-schedules.show', compact('campSchedule')) }}'">
                        @include('components.modals.camp-schedule-show', ['campSchedule' => $campSchedule])
                        <img class="eye-catch" src="{{ $campSchedule->eye_catch_image_path }}" alt="アイキャッチ画像" width="auto" height="auto" />
                        <div class="date {{ Carbon\Carbon::parse($campSchedule->date)->isFuture() ? 'is-future' : '' }}">
                            {{ $campSchedule->date->format('Y.m.d') }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="camp-schedule-pagination">
                {{ $campSchedules->fragment('campSchedules')->links() }}
            </div>
        </div>
        <div class="list-tab-content tab-content">
            <ul class="list">
                @foreach ($campSchedules as $campSchedule)
                    <li class="item {{ Carbon\Carbon::parse($campSchedule->date)->isFuture() ? 'is-future' : '' }}">
                        <p class="date">{{ $campSchedule->date->format('Y-m-d') }}</p>
                        <p class="title">
                            @if (!empty($campSchedule->place->url))
                                <a href="{{ $campSchedule->place->url }}" target="_blank" rel="noopener">{{ $campSchedule->place->name }}</a>
                            @else
                                {{ $campSchedule->place->name }}
                            @endif
                        </p>
                        <p class="address">
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $campSchedule->place->address }}" target="_blank" rel="noopener">{{ $campSchedule->place->address }}</a>
                        </p>
                        <p class="tel">
                            @if (!empty($campSchedule->place->tel_number))
                                <a href="tel:{{ $campSchedule->place->tel_number }}">{{ $campSchedule->place->tel_number }}</a>
                            @else
                                {{ $campSchedule->place->tel_number }}
                            @endif
                        </p>
                        <p class="check-in-out">
                            @if (!empty($campSchedule->place->check_in))
                                チェックイン: <br> {{ $campSchedule->place->check_in }} <br>
                            @endif
                            @if (!empty($campSchedule->place->check_out))
                                チェックアウト: <br> {{ $campSchedule->place->check_out }}
                           @endif
                        </p>
                    </li>
                @endforeach
            </ul>
            <div class="camp-schedule-pagination">
                {{ $campSchedules->fragment('campSchedules')->appends(['type' => 'list'])->links() }}
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
$(function() {
    // scroll to next/previous activity
    (function() {
        const summary = document.querySelector('.summary');
        const marginTop = 40;

        let currentSummary = document.querySelector('.summary-wrapper');
        summary.addEventListener('scroll', () => {
            const { x, y } = summary.getBoundingClientRect();
            const pointElement = document.elementFromPoint(x, y + marginTop);
            currentSummary = pointElement.closest('.summary-wrapper');
        });

        // to previous
      if (document.querySelector('.js-scrollto-prev-summary') !== null) {
        document.querySelector('.js-scrollto-prev-summary').addEventListener('click', () => {
          const scrollToElement = currentSummary.offsetLeft === summary.scrollLeft ? currentSummary.previousElementSibling : currentSummary;
          if (scrollToElement) {
            animateScrollTo(scrollToElement, {
              elementToScroll: summary,
            });
          }
        });
      }

      if (document.querySelector('.js-scrollto-next-summary') !== null) {
        // to next
        document.querySelector('.js-scrollto-next-summary').addEventListener('click', () => {
          if (currentSummary.nextElementSibling) {
            animateScrollTo(currentSummary.nextElementSibling, {
              elementToScroll: summary,
            });
          }
        });
      }

      if ("{{ request()->type }}" ===  'list') {
        document.querySelector('.js-tab-item.type-list').click()
      }
    })();
})
</script>
@endsection
