<div class="popup js-popup camp-schedule-share" id="sharePopup">
    <div class="popup-bg js-popup-close"></div>
    <div class="popup-content">
        <h3>予定をシェアしませんか？</h3>
        <div class="camp-schedule-share-wrapper">
            <p>登録したキャンプ予定を<br>ツイートでシェアしてみましょう！</p>
            <a href="https://twitter.com/share"
               target="_blank"
               rel="nofollow noopener"
               class="twitter-share-button item mx-10"
               data-url="{{ route('profile.index', ['userName' => auth()->user()->name]) }}"
               data-size="large"
               data-text="{{ session('shareTitle') }}

#キャンログ
#キャンプ記録
">
                予定をシェアする
            </a>
        </div>
        <div class="popup-buttons">
            <a class="js-popup-close btn default-btn">閉じる</a>
        </div>
    </div>
</div>
