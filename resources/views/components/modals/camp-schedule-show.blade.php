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
                        <div class="item-value">
                            {{ $campSchedule->place->name }}
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
                            {{ $campSchedule->place->address }}
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
                            {{ $campSchedule->place->tel_number }}
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
                @if (!empty($campSchedule->url))
                    <div class="show-item">
                        <label>URL</label>
                        <div class="item-value">
                            <a href="{{ $campSchedule->place->url }}" target="_blank">
                                {{ $campSchedule->place->url }}
                            </a>
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->note))
                    <div class="show-item">
                        <label>備考</label>
                        <div class="item-value">
                            {!! nl2br(e($campSchedule->note)) !!}
                        </div>
                    </div>
                @endif
                @if (count($campSchedule->images) !== 0)
                    <div class="show-item">
                        <label>画像</label>
                        <div class="item-value images">
                            @foreach ($campSchedule->images as $image)
                                <img src="{{ $image->image_path }}" alt="画像" class="js-modal-image js-image-{{ $image->id }}" data-id="{{ $image->id }}" />
                            @endforeach
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
<div class="image-modal-prev">＜</div>
<div class="image-modal-bg"></div>
<div class="image-modal-next">＞</div>

