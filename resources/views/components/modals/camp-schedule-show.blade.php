<div class="popup js-popup camp-schedule-show" id="campScheduleShowPopup-{{ $campSchedule->id }}">
    <div class="popup-bg js-popup-close"></div>
    <div class="popup-content">
        <h3>{{ $campSchedule->title }}</h3>
        <div class="camp-schedule-show-wrapper">
            <div class="camp-schedule-show">
                <div class="item">
                    <label>日付</label>
                    <div class="item-value">
                        {{ $campSchedule->date->format('Y.m.d') }}
                    </div>
                </div>
                <div class="item">
                    <label>泊数</label>
                    <div class="item-value">
                        {{ $campSchedule->number_of_stay_text }}
                    </div>
                </div>
                <div class="item">
                    <label>人数</label>
                    <div class="item-value">
                        {{ $campSchedule->number_of_people }}人
                    </div>
                </div>
                @if (!empty($campSchedule->url))
                    <div class="item">
                        <label>URL</label>
                        <div class="item-value">
                            <a href="{{ $campSchedule->url }}" target="_blank">
                                {{ $campSchedule->url }}
                            </a>
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->cancel_note))
                    <div class="item">
                        <label>キャンセル規程</label>
                        <div class="item-value">
                            {!! nl2br(e($campSchedule->cancel_note)) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->in))
                    <div class="item">
                        <label>イン</label>
                        <div class="item-value">
                            {{ $campSchedule->in }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->out))
                    <div class="item">
                        <label>アウト</label>
                        <div class="item-value">
                            {{ $campSchedule->out }}
                        </div>
                    </div>
                @endif
                @if (!empty($campSchedule->tel_number))
                    <div class="item">
                        <label>電話番号</label>
                        <div class="item-value">
                            {{ $campSchedule->tel_number }}
                        </div>
                    </div>
                @endif
                @if (count($campSchedule->images) !== 0)
                    <div class="item">
                        <label>画像</label>
                        <div class="item-value images">
                            @foreach ($campSchedule->images as $image)
                                <img src="{{ $image->image_path }}" alt="画像" />
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
