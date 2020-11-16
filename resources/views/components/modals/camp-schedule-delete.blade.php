<div class="popup js-popup" id="campScheduleDeletePopup-{{ $campSchedule->id }}">
    <div class="popup-bg js-popup-close"></div>
    <div class="popup-content">
        <h3>削除確認</h3>
        <p class="my-10">{{ $campSchedule->title }}の予定を本当に削除してもよろしいですか？</p>
        <div class="popup-buttons">
            <form action="{{ route('mypage.camp-schedules.destroy', ['camp_schedule' => $campSchedule]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn danger-btn">はい</button>
            </form>
            <a class="js-popup-close btn default-btn">いいえ</a>
        </div>
    </div>
</div>
