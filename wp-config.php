<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86 
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'hello');

/** MySQL データベースのユーザー名 */
//define('DB_USER', '2thinkers');
define('DB_USER', 'root');
/** MySQL データベースのパスワード */
//define('DB_PASSWORD', 'yun12101210');
define('DB_PASSWORD', '');
/** MySQL のホスト名 */
//define('DB_HOST', 'mysql484.db.sakura.ne.jp');
define('DB_HOST', 'localhost');
/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-0k1YG(- o| 2k|6;+}fR(T>>qb+5&WM$])^|r,L~~-Ea=OIk6~:35FS+U$T^D)E');
define('SECURE_AUTH_KEY',  'SdMf7t;v[+U09I%i}IP+[|kW!&a3=LWC=3PSA:F&S]y3a<5tO|XLnmm Je7C~.up');
define('LOGGED_IN_KEY',    'JxJ`_]OwT@n`^HGn}s94$3kwNifmIM5^gft^ezZ9&[Pq-~db0$Gw-1l8:](KuZ)_');
define('NONCE_KEY',        'N^4EWl5+cy5) -K#>1$pz`%.xaw^Si;kE!9& 3qm6Bjax>|%~C}C-j+ ci<(UT<f');
define('AUTH_SALT',        'm`E||e`H 7o~%r/r-u/4.aI$=%po~uoGFVq_nJ3OZ;8bC),~5WZ5OPE!YzjdDl?n');
define('SECURE_AUTH_SALT', 'X5dd$w3Hdzb| G1F!HPw$l)xp5XNY4UY;kd(`*6x5{~@igHA<]7d0/{;JXX9b1E}');
define('LOGGED_IN_SALT',   'rxfQ:g1fmIM |UfT+:c!nlA%I.X!VwMMQ|(PJsr0ey^MCYbNEKHk;2W:31*S=7iM');
define('NONCE_SALT',       'Zgl>NcsqhF{@NKYm-lSk_PXgLd=2k UQ6MmwPj,@va-i2_9^JOws++BS=>U.@/2R');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'cebu_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
