<div class="popup js-popup camp-schedule-show" id="campScheduleShowPopup-{{ $campSchedule->id }}">
    <div class="popup-bg js-popup-close"></div>
    <div class="popup-content">
        <h3>{{ $campSchedule->title }}</h3>
        <div class="camp-schedule-show-wrapper">
            <div class="camp-schedule-show">
                <div class="show-item">
                    <label>日付</label>
                    <div class="item-value">
                        {{ $campSchedule->date->format('Y.m.d') }}
                    </div>
                </div>
                @if (!empty($campSchedule->place->name))
                    <div class="show-item">
                        <label>キャンプ場</label>
                        <a class="review-link" target="_blank" href="{{ route('camp-places.show', ['campPlace' => $campSchedule->place]) }}">
                           <img src="{{ asset('img/messenger.svg') }}" alt="口コミ一覧" width="15" />
                           口コミ一覧
                        </a>
                        <div class="item-value">
                            @if (!empty($campSchedule->place->url))
                                <a href="{{ $campSchedule->place->url }}" target="_blank" rel="noopener">{{ $campSchedule->place->name }}</a>
                            @else
                                {{ $campSchedule->place->name }}
                            @endif
                        </div>
                    </div>
                @endif
                @if (count($campSchedule->images) !== 0)
                    <div class="show-item">
                        <label>画像</label>
                        <div class="item-value images">
                            @foreach ($campSchedule->images as $image)
                                <img src="{{ str_replace("camp-schedule/", "camp-schedule/resized-", $image->image_path) }}" alt="画像" class="js-modal-image js-image-{{ $image->id }}" data-id="{{ $image->id }}" width="auto" height="auto" />
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="show-item">
                    <label>泊数</label>
                    <div class="item-value">
                        {{ $campSchedule->number_of_stay_text }}
                    </div>
                </div>
                <div class="show-item">
                    <label>人数</label>
                    <div class="item-value">
                        {{ $campSchedule->number_of_people }}人
                    </div>
                </div>
                @if (!empty($campSchedule->place->address))
                    <div class="show-item">
                        <label>住所</label>
                        <div class="item-value">
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $campSchedule->place->address }}" target="_blank" rel="noopener">{{ $campSchedule->place->address }}</a>
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->check_in))
                    <div class="show-item">
                        <label>チェックイン</label>
                        <div class="item-value">
                            {{ $campSchedule->place->check_in }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->check_out))
                    <div class="show-item">
                        <label>チェックアウト</label>
                        <div class="item-value">
                            {{ $campSchedule->place->check_out }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->business_hours))
                    <div class="show-item">
                        <label>営業時間</label>
                        <div class="item-value">
                            {!! nl2br(e($campSchedule->place->business_hours)) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->tel_number))
                    <div class="show-item">
                        <label>電話番号</label>
                        <div class="item-value">
                            <a href="tel:{{ $campSchedule->place->tel_number }}">{{ $campSchedule->place->tel_number }}</a>
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->parking))
                    <div class="show-item">
                        <label>駐車場</label>
                        <div class="item-value">
                            {{ $campSchedule->place->parking }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->holiday))
                    <div class="show-item">
                        <label>定休日</label>
                        <div class="item-value">
                            {{ $campSchedule->place->holiday }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->can_credit))
                    <div class="show-item">
                        <label>カード決済</label>
                        <div class="item-value">
                            {{ $campSchedule->place->can_credit }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->place->usage_type))
                    <div class="show-item">
                        <label>利用タイプ</label>
                        <div class="item-value">
                            {{ $campSchedule->place->usage_type }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->review))
                    <div class="show-item">
                        <label>口コミ</label>
                        <div class="item-value">
                            {!! nl2br($campSchedule->review) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->note) && $campSchedule->is_public_note)
                    <div class="show-item">
                        <label>メモ</label>
                        <div class="item-value">
                            {!! nl2br($campSchedule->note_with_link) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="popup-buttons">
            <a class="js-popup-close btn default-btn">閉じる</a>
        </div>
    </div>
</div>
<div class="image-modal-bg">
    <div class="image-content"></div>
    <div class="image-modal-prev">＜</div>
    <div class="image-modal-next">＞</div>
    <div class="image-modal-close">×</div>
</div>

