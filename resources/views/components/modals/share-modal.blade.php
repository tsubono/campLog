<div class="popup js-popup camp-schedule-share" id="sharePopup">
    <div class="popup-bg js-popup-close"></div>
    <div class="popup-content">
        <h3>
            @if (session('shareIsPast'))
                キャンプ記録をシェアしませんか？
            @else
                キャンプ予定をシェアできます。
            @endif
        </h3>
        <div class="camp-schedule-share-wrapper">
            @if (session('shareIsPast'))
                <p>キャンプ記録をシェアしませんか？<br>登録したキャンプ記録をツイートでシェアしてみましょう！</p>
            @else
                <p>※防犯を意識して慎重に行って下さい。<br>キャンプへ行ったあとの記録もシェアできます。</p>
            @endif
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
                @if (session('shareIsPast'))
                    記録をシェアする
                @else
                    予定をシェアする
                @endif
            </a>
        </div>
        <div class="popup-buttons">
            <a class="js-popup-close btn default-btn">閉じる</a>
        </div>
    </div>
</div>
