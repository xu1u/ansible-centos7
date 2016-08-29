<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO取得スタイル
    |--------------------------------------------------------------------------
    |
    | デフォルトでデータベースの結果はPHP stdClassオブジェクトのインスタンスが
    | リターンされます。しかし、ご希望であればレコードを単純な配列の形式でも
    | 取得できます。ここで取得するスタイルを調整します。
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | デフォルトデータベース接続名
    |--------------------------------------------------------------------------
    |
    | ここでは全てのデータベース動作で用いられるデフォルトデータベース接続を
    | 指定することができます。もちろん、データベースライブラリーを使用することで
    | 多くの接続を一度に使うことができます。
    |
    */

    'default' => env('DB_CONNECTION', '{{ DB_CONNECTION }}'),

    /*
    |--------------------------------------------------------------------------
    | データベース接続
    |--------------------------------------------------------------------------
    |
    | ここではアプリケーションで用いる各データベース接続を設定します。
    | もちろん、以下はLaravelでサポートされているデータベースシステムの
    | サンプル設定で、簡単に開発ができることを示すため設置してあります。
    |
    |
    | Laravelで動作する全てのデータベースはPHP PDO機能上で動作します。
    | ですから開発を始める前に選択したデータベースのドライバーが開発機に
    | インストールされていることを確認してください。
    |
    */

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => storage_path('database.sqlite'),
            'prefix'   => '',
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', '{{ DB_HOST }}'),
            'database'  => env('DB_DATABASE', '{{ DB_DATABASE }}'),
            'username'  => env('DB_USERNAME', '{{ DB_USERNAME }}'),
            'password'  => env('DB_PASSWORD', '{{ DB_PASSWORD }}'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', '{{ DB_HOST }}'),
            'database' => env('DB_DATABASE', '{{ DB_DATABASE }}'),
            'username' => env('DB_USERNAME', '{{ DB_USERNAME }}'),
            'password' => env('DB_PASSWORD', '{{ DB_PASSWORD }}'),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST', '{{ DB_HOST }}'),
            'database' => env('DB_DATABASE', '{{ DB_DATABASE }}'),
            'username' => env('DB_USERNAME', '{{ DB_USERNAME }}'),
            'password' => env('DB_PASSWORD', '{{ DB_PASSWORD }}'),
            'prefix'   => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | マイグレーションリポジトリテーブル
    |--------------------------------------------------------------------------
    |
    | こで指定したテーブルに、アプリケーションで実行済みの全マイグレーション
    | 情報が保存されます。この情報を使用することで、ディスク上の
    | どのマイグレーションが未実行なのかを判断することができます。
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redisデータベース
    |--------------------------------------------------------------------------
    |
    | Redisはオープンソースで、早く、進歩的なキー／値保存システムであり
    | APCやMemecachedのような典型的なキー／値システムよりも、豊富なコマンドが
    | 用意されています。Laravelはこれを使用しやすくします。
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'database' => 0,
        ],

    ],

];