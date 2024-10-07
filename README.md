<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# データエンジニアカタパルト Phase01 課題

## 挑戦した課題

[✅] 初級

[] 上級

## 実装した内容
サインアップ時に64種類の花の内、3種類を選び、それらの花を基にMBTIのタイプをユーザーに表示させ、MBTIのタイプごとにユーザーを分けるSNSの作成を行った。
64種類の花の情報：https://freezing-crocus-633.notion.site/flowers_mbti-csv-10e27629cdd780b698afe709eda6f078

## デプロイ先の URL または画面収録したファイル名
画面収録したファイル名：画面録画 2024-10-07 171818.mp4

## 使い方

1. サインアップ時に64種類の花の内、3種類の花を選ぶ

2. 3種類の花の中から、ユーザーのMBTIのタイプを表示する

3. MBTIのタイプごとの投稿やユーザーを表示する（未実装）

...

## 工夫した点
64種類の花ごとにMBTIの特性を設定し、3つの花のうち最も近いMBTIのタイプを決定するロジックを組み立てた。

## 苦戦した点
使い方における2と3のフェーズがうまくいかなかった。
前者の3種類の花の中から、ユーザーのMBTIのタイプを表示することにおいて、セッションに含まれるJSONデータにユーザが選んでいない情報も送付してしまったことをTest機能を使って発見したときの
脱力感がすごかった。なぜこんな初歩的なところでつまづいてるんだろうと自分自身悔しかった。
後者のMBTIのタイプごとの投稿やユーザーを表示することにおいては、SQLの操作を行うことで実装できる機能であるので提出後も開発を続けてプロダクトを完成させたい。

## Phase01 終えての感想
学習した内容をしっかり理解できたつもりだったが、画面遷移の処理で詰まるという初歩的な部分でつまずいてしまったり、
MBTIのタイプごとの投稿やユーザーを表示するというデータベースの処理を扱うG's Academyにとって中核となる部分を作成できなかったのが悔しかった。
歯がゆい気持ちでいっぱいなので提出後も引き続きこのプロダクトの開発を行う。

