<footer>
    <div class="links">
        <a href="{{ route('guide') }}">利用手順</a>
        <a href="{{ route('rules') }}">利用規約</a>
        <a href="{{ route('privacy-policy') }}">プライバシーポリシー</a>
        <a href="https://camplog.in/takeshi" rel="nofollow" target="_blank">運営者</a>
        <a href="https://bit.ly/camplog-contact" rel="nofollow" target="_blank">お問い合わせ</a>
    </div>
    <p class="copy-write">
        &copy;2020-{{ date('Y') != 2020 ? date('Y') : '' }} camplog.in
    </p>
</footer>
