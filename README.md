## キャンログWebアプリ用リポジトリ

### 技術
**Laravel 7.29.3*
  - PHP7.4
  - HTML / CSS
  - Vue.js / jQuery

### 最初だけ実行必要なコマンド
```
$ cp .env.example .env
// .envを自分の環境に編集
$ composer install
$ npm install
$ npm run dev
$ php artisan key:generate
$ php artisan migrate --seed
$ php artisan storage:link
```

※ 認証にTwitterを使用しているので、.envにキーの設定が必要です <br>
```
TWITTER_CLIENT_ID=
TWITTER_CLIENT_SECRET=
CALLBACK_URL=
```
不明な場合は問い合わせください。
<br>
