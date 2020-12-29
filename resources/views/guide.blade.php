@php
    $isNotHeaderNav = true;
    $isPageHeaderNav = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="page-section">
        <h2>利用手順</h2>

        <div class="content guide">
            <h3>新規登録方法</h3>
            <div class="content-part">
                <p>【Twitterで登録する】</p>
                <img src="{{ secure_asset('img/guide/twitter-register.jpg') }}" alt="Twitterで登録する"/><br>
                <p>1、緑のボタン「無料登録」をタップ</p><br>
                <img src="{{ secure_asset('img/guide/twitter-register2.jpg') }}" alt="「無料登録」をタップ"/><br>
                <p>2、「Twitterで登録」をタップ</p><br>
                <img src="{{ secure_asset('img/guide/twitter-register3.jpg') }}" alt="「Twitterで登録」をタップ"/><br>
                <p>3、ログイン情報を入力し、「ログイン」をタップ</p><br>
                <img src="{{ secure_asset('img/guide/twitter-register4.jpg') }}" alt="「ログイン」をタップ"/><br>
                <p>4、登録完了です。Twitterのアイコン等が引き継がれています。続いて、プロフィール設定をしていきます。</p>
                <br>
                <p>【メールアドレスで登録する】</p>
                <img src="{{ secure_asset('img/guide/mail-register.jpg') }}" alt="メールアドレスで登録する"/><br>
                <p>
                    無料登録ボタンをタップ後、メールアドレスで登録画面から各情報を入力。パスワードは8文字以上でご入力ください。最後に青いボタン「無料登録する」をタップで登録完了です。<br>
                    　※入力されたメールアドレスにメールは送られません。
                </p>
            </div>


            <h3>プロフィール設定方法</h3>
            <div class="content-part">
                <img src="{{ secure_asset('img/guide/setting-profile.jpg') }}" alt="プロフィール設定方法"/><br>
                <p>ログイン後、「プロフィール設定」をタップで行えます。</p><br>
                <img src="{{ secure_asset('img/guide/setting-profile1.jpg') }}" alt="アイコン画像、背景画像"/><br>
                <p>
                    1、アイコン画像、背景画像は自由に編集できます。<br>
                    「削除する」で削除したあと「ファイルを選択」で新しい画像をお選びください。
                </p><br>
                <div class="row">
                    <img src="{{ secure_asset('img/guide/setting-profile2-1.jpg') }}" alt="各種情報"/><br>
                    <img src="{{ secure_asset('img/guide/setting-profile2-2.jpg') }}" alt="各種情報"/><br>
                </div>
                <p>
                    2、各種情報を入力していきます。<br>
                    &nbsp;&nbsp;ユーザー名：Twitter登録の場合、TwitterのIDと同じになります。変更も可能です。ここで入力されたものがそのままあなただけのURLとなります。<br>
                    &nbsp;&nbsp;ニックネーム：ご自由に入力してください。<br>
                    &nbsp;&nbsp;性別：ご選択ください。非公開にもできます。<br>
                    &nbsp;&nbsp;年齢：ご入力ください。<br>
                    &nbsp;&nbsp;キャンプ歴：西暦でご入力ください。<br>
                    &nbsp;&nbsp;拠点：ご入力ください。<br>
                    &nbsp;&nbsp;自己紹介：ご入力ください。最大◯◯文字までです。<br>
                </p><br>
                <img src="{{ secure_asset('img/guide/setting-profile3.jpg') }}" alt="各SNSのURL"/><br>
                <p>3、各SNSのURLを入力していきます。入力された情報はプロフィールページにて表示されます。非公開設定も可能です。</p><br>
                <img src="{{ secure_asset('img/guide/setting-profile4.jpg') }}" alt="「更新する」ボタンをタップ"/><br>
                <p>4、メールアドレス、パスワードは変更する場合のみ入力してください。最後に「更新する」ボタンをタップで完了です。</p>
                <br>
                <p>【アカウント削除の方法】</p>
                <img src="{{ secure_asset('img/guide/delete-profile.jpg') }}" alt="アカウント削除の方法"/><br>
                <p>プロフィール設定画面最下部から削除ができます。一度消したデータは戻りませんのでご注意ください。</p><br>

                <h3>キャンプデータ登録方法</h3>
                <img src="{{ secure_asset('img/guide/camp-schedule.jpg') }}" alt="キャンプデータ登録方法"/><br>
                <p>「キャンプ予定管理」より、過去のキャンプ記録、未来のキャンプ予定を入力していきます。</p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule1.jpg') }}" alt="「新規追加」をタップ"/><br>
                <p>1、「新規追加」をタップ</p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule2.jpg') }}" alt="キャンプの記録を入力"/><br>
                <p>2、こちらからキャンプの記録を入力していきます。</p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule3.jpg') }}" alt="キャンプ場所"/><br>
                <p>3、まずはキャンプ場所です。こちらに文字を入力すると候補が表示されます。</p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule4.jpg') }}" alt="該当のキャンプ場を選択"/><br>
                <p>
                    4、該当のキャンプ場を選択します。<br><br>
                    ※※キャンプ場が出てこない場合※※<br>
                    一旦「リストなし」と入力後に選択、登録まで済ませます。<br>
                    その後、<a href="" rel="nofollow" target="_blank">こちら</a>のキャンログユーザーコミュニティより、ご報告ください。<br>
                    早急に追加させて頂きます。
                </p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule5.jpg') }}" alt="日付を選択、拍数、人数を入力"/><br>
                <p>
                    5、日付を選択、拍数、人数を入力していきます。デイキャンプの場合は0をお入れください。<br>
                    備考欄には、キャンプのメモを自由にご記入頂けます。(最大700文字まで)
                </p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule6.jpg') }}" alt="画像を登録"/><br>
                <p>6、続いて画像を登録していきます。一枚目の画像は、一覧で見た場合の表示画像、つまりアイキャッチ画像となります。「ファイルを選択」→「フォトライブラリ」をタップしてカメラロールから登録したい画像を選びます。画像は最大で5枚まで登録できます。</p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule7.jpg') }}" alt="公開/非公開を選択"/><br>
                <p>7、このキャンプの記録の公開/非公開を選択します。最後に「登録する」ボタンをタップでします。</p><br>
                <img src="{{ secure_asset('img/guide/camp-schedule8.jpg') }}" alt="登録が完了"/><br>
                <p>
                    8、これで登録が完了し、公開の設定をしていれば一覧に表示されます。容量の大きい画像の場合は登録に時間がかかる場合がありますので、何も押さずにしばらくお待ち下さい。<br>
                    上部の「自分のページを確認」をタップするとあなたのページが表示されます。
                </p>
            </div>

            <h3>プロフィールページについて</h3>
            <div class="content-part">
                <img src="{{ secure_asset('img/guide/profile.jpg') }}" alt="プロフィールページについて"/><br>
                <p>
                    あなただけのプロフィールページが完成し、世界に一つだけのURLが発行されます。<br>
                    各SNSボタンは右にスクロールできます。ACTIVITYも同様で、年間宿泊数、年間デイ数、<br>
                    利用キャンプ場数、月別宿泊数が表示されます。
                </p><br>
                <img src="{{ secure_asset('img/guide/profile2.jpg') }}" alt="プロフィールページについて"/><br>
                <p>
                    下部に下がるとキャンプの記録、キャンプの予定が表示されます。GRIDは画像での一覧表示(タップで詳細表示が可能)、LISTは文字のみの一覧です。LISTから、キャンプ場名タップでHPへ、住所タップでGoogle Mapへ、電話番号タップで電話をかけることができます。
                </p>
            </div>

            <h3>他SNSでの共有方法</h3>
            <div class="content-part">
                <p>TwitterプロフィールのURL登録方法　シェア方法</p>
                <p>インスタプロフィールのURL登録方法</p>
                <p>QRコード</p>
            </div>

            <h3>Q＆A</h3>
            <div class="content-part">
                <p>coming soon</p>
            </div>
            <br>
        </div>
    </section>
@endsection
