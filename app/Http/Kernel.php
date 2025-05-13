<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     * 
     * グローバルミドルウェア（すべてのリクエストに適用）
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class, // ホスト名（例: example.com）を検証するためのミドルウェア
        \App\Http\Middleware\TrustProxies::class, // リバースプロキシ（Cloudflareなど）からのリクエストの信頼設定
        \Illuminate\Http\Middleware\HandleCors::class, // **CORS（クロスオリジンリソース共有）**の設定を処理
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // アプリがメンテナンスモードのときにリクエストをブロック
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // POSTリクエストの最大サイズを検証（超えるとエラーに）
        \App\Http\Middleware\TrimStrings::class, // リクエストデータの 前後の空白を削除
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // 空文字列 "" を null に変換（バリデーション処理と相性が良い）
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     * 
     * ミドルウェアグループ（web, api ルート用）
     */
    protected $middlewareGroups = [
        'web' => [ // ブラウザ用ルートに適用されるミドルウェア群
            \App\Http\Middleware\EncryptCookies::class, // クッキーの暗号化
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // 後でレスポンスに追加するクッキーを処理
            \Illuminate\Session\Middleware\StartSession::class, // セッション開始
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // バリデーションエラーなどをビューに共有
            \App\Http\Middleware\VerifyCsrfToken::class, // CSRF対策のトークンを検証
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [ // API用ルートに適用されるミドルウェア群
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // Laravel Sanctumを使用する時のミドルウェア
            'throttle:api', // APIリクエストに対して レート制限（例: 毎分60件）を適用
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // モデルのルートバインディングを適用
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     * 
     * ルートミドルウェア（個別ルートで指定できる）
     */
    protected $routeMiddleware = [ // 個々のルートに対して ->middleware('auth') のように使うためのミドルウェア
        'auth' => \App\Http\Middleware\Authenticate::class, //  認証（ログイン）が必要なルート用
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // Basic認証（ユーザー名/パスワード）を使用
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, // 認証セッションの管理
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // HTTPレスポンスにキャッシュヘッダを追加
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // @can ディレクティブなどで使われる 権限チェック
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // ゲスト（未ログイン）でない場合リダイレクト
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // パスワード再確認が必要なルート用
        'signed' => \App\Http\Middleware\ValidateSignature::class, // サイン付きURL（署名付きリンク）の検証
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // レート制限（アクセス制限）を適用
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // メールアドレス確認済みであることを要求
    ];
}
