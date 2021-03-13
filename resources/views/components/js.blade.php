<script src="{{ mix('js/app.js') }}" defer></script>
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
            if (!$('body').hasClass('is-modal')) {
                $('body').addClass('is-modal')
            }
        })

        $('.js-popup-close').on('click',function(){
            $(this).parents('.js-popup').fadeOut();
            $('body').removeClass('is-modal')
            return false;
        });

        /**
         * Twitter
         */
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

        /**
         * 画像モーダル
         */
        $('.js-modal-image').click(function(event) {
            event.stopPropagation();
            // 左右コントロールのdisabled更新
            toggleDisabled($(this));
            // 画像表示
            $('.image-modal-bg .image-content').html($(this).prop('outerHTML').replace(/resized-/i, ''));
            $('.image-modal-bg').fadeIn(200);
            if (!$('body').hasClass('is-modal')) {
                $('body').addClass('is-modal')
            }
        });
        $('.image-modal-bg').click(function(event) {
            event.stopPropagation()
            // 画像非表示
            $(".image-modal-bg").removeClass('active').fadeOut(200);
            $('body').removeClass('is-modal')
        });
        $('.image-modal-prev').click(function(event) {
            event.stopPropagation()
            moveImage('prev')
        });
        $('.image-modal-next').click(function(event) {
            event.stopPropagation()
            moveImage('next')
        });
        /**
         * 画像を左右に移動する
         */
        function moveImage(direction) {
            if ($('.image-modal-' + direction).hasClass('disabled')) {
                return false;
            }
            // 画像取得 & 表示
            let target = null
            if (direction === 'next') {
                target = $('.js-image-' + $('.image-modal-bg img').data('id')).next('img');
            } else if (direction === 'prev') {
                target = $('.js-image-' + $('.image-modal-bg img').data('id')).prev('img');
            }

            if (target !== null) {
                $('.image-modal-bg .image-content').html(target.prop('outerHTML').replace(/resized-/i, ''));
                // 左右コントロールのdisabled更新
                toggleDisabled(target);
            }
        }
        document.onkeydown = function(e) {
            e.stopPropagation()
            if (e.keyCode) {
                // 右
                if (e.keyCode === 39) {
                    moveImage('next')
                }
                // 左
                if (e.keyCode === 37) {
                    moveImage('prev')
                }
            }
        };

        /**
         * 画像スワイプ対応
         */
        $('.image-modal-bg .image-content').on('touchstart', onTouchStart);
        $('.image-modal-bg .image-content').on('touchmove', onTouchMove);
        $('.image-modal-bg .image-content').on('touchend', onTouchEnd);
        let direction, position;

        // スワイプ開始時の横方向の座標を格納
        function onTouchStart(event) {
            direction = '';
            position = event.originalEvent.touches[0].pageX;
        }

        // スワイプの方向（left or right）を取得
        function onTouchMove(event) {
            // 閾値は30pxとする
            if (position - event.originalEvent.touches[0].pageX > 30) {
                direction = 'left';
            } else if (position - event.originalEvent.touches[0].pageX < -30){
                direction = 'right';
            }
        }

        function onTouchEnd() {
            // 右スワイプ
            if (direction === 'right'){
                moveImage('prev')
            // 左スワイプ
            } else if (direction === 'left'){
                moveImage('next')
            }
        }

        /**
         * 横に画像がなければdisabledにする
         */
        function toggleDisabled(target) {
            $('.image-modal-prev, .image-modal-next').removeClass('disabled')
            if (target.next('img').length === 0) {
                $('.image-modal-next').addClass('disabled')
            }
            if (target.prev('img').length === 0) {
                $('.image-modal-prev').addClass('disabled')
            }
        }

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
