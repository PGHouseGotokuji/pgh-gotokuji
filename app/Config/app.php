<?php
define('TODAY_DATE', date('Y-m-d'));                             // 今日の日付
define('YESTERDAY_DATE', date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m'), date('d')-1, date('Y')))); // 昨日の日付
define('TITLE', 'PGHouse豪徳寺');                                // タイトル
define('SUB_TITLE', '〜プログラミングを学び合うシェアハウス〜'); // サブタイトル
define('PRODUCT_FROM', 'PGHouse-Gotokuji');                      // 製作元
define('AJAX_SELECT_LIMIT', 10);                                 // ajax-select上限
