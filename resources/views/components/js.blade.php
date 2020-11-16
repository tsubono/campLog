<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $(function () {
        /**
         * タブ切り替え
         */
        $('.js-tab-item').click(function () {
            //現在activeが付いているクラスからactiveを外す
            $('.active').removeClass('active');

            //クリックされたタブメニューにactiveクラスを付与。
            $(this).addClass('active');

            //一旦showクラスを外す
            $('.show').removeClass('show');

            //クリックしたタブのインデックス番号取得
            const index = $(this).index();

            //タブのインデックス番号と同じコンテンツにshowクラスをつけて表示する
            $('.tab-content').eq(index).addClass('show');
        });

        /**
         * ポップアップ
         */
        $('.js-show-popup').click (function() {
            $('#' + $(this).data('id')).fadeIn();
        })

        $('.js-popup-close').on('click',function(){
            $(this).parents('.js-popup').fadeOut();
            return false;
        });
    });
</script>
