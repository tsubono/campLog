<div class="popup js-popup camp-schedule-show" id="reviewShowPopup-{{ $campSchedule->id }}">
    <div class="popup-bg js-popup-close"></div>
    <div class="popup-content">
        <h3>{{ $campSchedule->place->name }} 口コミ詳細</h3>
        <div class="camp-schedule-show-wrapper">
            <div class="camp-schedule-show">
                <div class="show-item">
                    <div class="item-value">
                        {!! nl2br(e($campSchedule->review)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-buttons">
            <a class="js-popup-close btn default-btn">閉じる</a>
        </div>
    </div>
</div>

