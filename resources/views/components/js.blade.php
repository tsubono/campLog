<script src="{{ secure_asset('js/app.js') }}" defer></script>
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

        /**
         * Twitter
         */
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

        /**
         * 画像モーダル
         */
        $('.js-modal-image').click(function() {
            $('.image-modal-bg').html($(this).prop('outerHTML'));
            $('.image-modal-bg').fadeIn(200);
        });
        $('.image-modal-bg, .image-modal-bg img').click(function() {
            $(".image-modal-bg").fadeOut(200);
        });

        /**
         * アカウント削除確認
         */
        $('.js-profile-delete-link').click (function() {
            if (confirm('本当に削除してもよろしいですか？')) {
                $('#profile-delete-form').submit();
            }
        });
    });

    function copyToClipboard(id) {
        let range = document.createRange();
        let text = document.getElementById(id);
        range.selectNodeContents(text);
        let selection = document.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand("Copy");
    }
</script>
