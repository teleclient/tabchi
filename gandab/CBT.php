<?php

class Bottom
{
    public function Sudo($mode, $E1 = null, $E2 = null, $E3 = null)
    {
        switch ($mode) {
            case 'start':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "⚙ تنظیمات", 'callback_data' => 'menu_setting'], ['text' => "📚 آمار", 'callback_data' => 'menu_stats']],
                    [['text' => "👤بخش ادمین ها", 'callback_data' => 'menu_admin']],
                ]]);
                break;
            case 'menu_setting':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "🏅 تنظیمات سکه", 'callback_data' => 'setting_menu_coin'], ['text' => "🔑 تنظیمات جوین", 'callback_data' => 'setting_menu_join']],
                    [['text' => "🖲 تنظیمات عمومی", 'callback_data' => 'setting_menu_public']],
                    [['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'menu_stats']],
                ]]);
                break;
            case 'menu_stats':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "🚜لیست سازندگان", 'callback_data' => 'stats_listmaker'], ['text' => "👥لیست کاربران", 'callback_data' => 'stats_user']],
                    [['text' => "🏷 ارسال همگانی", 'callback_data' => 'stats_send'], ['text' => "🏷 فوروارد همگانی", 'callback_data' => 'stats_forward']],
                    [['text' => "👀 دیدن اطلاعات شخص در دیتا", 'callback_data' => 'stats_seeinfo']],
                    [['text' => "⭕️ ان بن کردن", 'callback_data' => 'stats_unban'], ['text' => "🚫 بن کردن", 'callback_data' => 'stats_ban']],
                    [['text' => "🎖 سکه تکی", 'callback_data' => 'stats_coinone'], ['text' => "🏆 سکه همگانی", 'callback_data' => 'stats_coinall']],
                    [['text' => "🎫 کد هدیه", 'callback_data' => 'stats_card'], ['text' => "❗️کسر سکه", 'callback_data' => 'stats_coinless']],

                    [['text' => "🕹 حذف ربات ساخته شده 🕹", 'callback_data' => 'stats_delbot']],
                    [['text' => "📆 آمار کلی رباتساز", 'callback_data' => 'stats_stats']],
                    [['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'menu_admin']],
                ]]);
                break;
            case 'menu_admin':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "حذف ادمین ➖", 'callback_data' => 'admin_del'], ['text' => "افزودن ادمین ➕", 'callback_data' => 'admin_add']],
                    [['text' => "🧾 لیست ادمین ها", 'callback_data' => 'admin_list']],
                    [['text' => "⚙ تنظیم دسترسی ادمین ها", 'callback_data' => 'admin_setting']],
                    [['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'menu_setting']],
                ]]);
                break;
            case 'setting_menu_coin':
                $Lock_day_coin = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_day_coin.txt"));
                $coin_day_count = file_get_contents("data/data/settings/coin_day_count.txt");
                $coin_mget_count = file_get_contents("data/data/settings/coin_mget_count.txt");
                $coin_api_count = file_get_contents("data/data/settings/coin_api_count.txt");
                $coin_cli_count = file_get_contents("data/data/settings/coin_cli_count.txt");
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "$Lock_day_coin", 'callback_data' => 'setting_coin_lockday'], ['text' => "🔅 سکه روزانه :", 'callback_data' => 'simple']],
                    [['text' => "$coin_day_count", 'callback_data' => 'simple'], ['text' => "🔅تعداد‌سکه‌روزانه :", 'callback_data' => 'simple']],
                    [['text' => "➖", 'callback_data' => 'setting_coin_lessday'], ['text' => "➕", 'callback_data' => 'setting_coin_plusday']],
                    [['text' => "$coin_mget_count", 'callback_data' => 'simple'], ['text' => "🔅سکه‌زیر‌مجموعه:", 'callback_data' => 'simple']],
                    [['text' => "➖", 'callback_data' => 'setting_coin_lessmget'], ['text' => "➕", 'callback_data' => 'setting_coin_plusmget']],
                    [['text' => "〰〰〰〰〰〰〰〰", 'callback_data' => 'simple']],
                    [['text' => "$coin_api_count", 'callback_data' => 'simple'], ['text' => "🔅سکه‌ربات‌Api", 'callback_data' => 'simple']],
                    [['text' => "➖", 'callback_data' => 'setting_coin_lessapi'], ['text' => "➕", 'callback_data' => 'setting_coin_plusapi']],
                    [['text' => "$coin_cli_count", 'callback_data' => 'simple'], ['text' => "🔅سکه‌ربات‌cli", 'callback_data' => 'simple']],
                    [['text' => "➕", 'callback_data' => 'setting_coin_lesscli'], ['text' => "➕", 'callback_data' => 'setting_coin_pluscli']],
                    [['text' => "🔙 بازگشت", 'callback_data' => 'menu_setting'], ['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'setting_menu_join']],
                ]]);
                break;
            case 'setting_menu_join':
                $Lock_channel_1 = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_channel_1.txt"));
                $Lock_channel_2 = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_channel_2.txt"));
                $channel_1 = file_get_contents("data/data/settings/channel_1.txt");
                $channel_2 = file_get_contents("data/data/settings/channel_2.txt");
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "$Lock_channel_1", 'callback_data' => 'join_lock_1'], ['text' => "🔅قفل‌کانال‌یک :", 'callback_data' => 'simple']],
                    [['text' => "$channel_1", 'url' => 'http://t.me/' . $channel_1], ['text' => "🔅کانال یک⇦", 'callback_data' => 'simple']],
                    [['text' => "🕹 تنظیم کانال برای قفل یک", 'callback_data' => 'join_set_ch1']],
                    [['text' => "$Lock_channel_2", 'callback_data' => 'join_lock_2'], ['text' => "🔅قفل‌کانال‌دو :", 'callback_data' => 'simple']],
                    [['text' => "$channel_2", 'url' => 'http://t.me/' . $channel_2], ['text' => "🔅کانال دو⇦", 'callback_data' => 'simple']],
                    [['text' => "🕹 تنظیم کانال برای قفل دو", 'callback_data' => 'join_set_ch2']],
                    [['text' => "🔙 بازگشت", 'callback_data' => 'menu_setting'], ['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'setting_menu_public']],
                ]]);
                break;
            case 'admin_setting_once':
                if (isset($E1)) {
                    $adm_setting = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_setting.txt"));
                    $adm_stats = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_stats.txt"));
                    $adm_ban = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_ban.txt"));
                    $adm_unban = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_unban.txt"));
                    $adm_tab = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_tab.txt"));
                    $adm_coin = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_coin.txt"));
                    $adm_adm = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/adm/" . $E1 . "/adm_adm.txt"));
                    $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                        [['text' => "ادمین ⇦ $E1", 'callback_data' => 'simple']],
                        [['text' => "$adm_setting", 'callback_data' => 'adm_setting_' . $E1], ['text' => "🕹 تنظیمات", 'callback_data' => 'settings']],
                        [['text' => "$adm_stats", 'callback_data' => 'adm_stats_' . $E1], ['text' => "🕹 آمار", 'callback_data' => 'simple']],
                        [['text' => "$adm_ban", 'callback_data' => 'adm_ban_' . $E1], ['text' => "🕹بن کردن", 'callback_data' => 'simple']],
                        [['text' => "$adm_unban", 'callback_data' => 'adm_unban_' . $E1], ['text' => "🕹 آن بن کردن", 'callback_data' => 'simple']],
                        [['text' => "$adm_tab", 'callback_data' => 'adm_tab_' . $E1], ['text' => "🕹 تبلیغات", 'callback_data' => 'simple']],
                        [['text' => "$adm_coin", 'callback_data' => 'adm_coin_' . $E1], ['text' => "🕹 عملیات سکه", 'callback_data' => 'simple']],
                        [['text' => "$adm_adm", 'callback_data' => 'adm_adm_' . $E1], ['text' => "🕹بخش ادمین", 'callback_data' => 'simple']],
                        [['text' => "🔙 بازگشت", 'callback_data' => 'admin_setting'], ['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'admin_list']],
                    ]]);
                } else {
                    $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                        [['text' => "⚠️ خطای رخ داده (خانه)کلیک کنید⚠️", 'callback_data' => 'simple']],
                        [['text' => "🔙 بازگشت", 'callback_data' => 'admin_setting']],
                    ]]);
                }
                break;
            case 'admin_setting_list':
                $_KEY = [];
                $adm_list = explode("\n", file_get_contents("data/data/adm/list.txt"));
                foreach ($adm_list as $adm) {
                    $_KEY[] = [['text' => "ادمین : $adm", 'callback_data' => 'adm-' . $adm]];
                }
                $_KEY[] = [['text' => "🔙 بازگشت", 'callback_data' => 'menu_admin'], ['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'admin_list']];
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => $_KEY]);
                break;
            case 'setting_menu_public':
                $Lock_bot = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_bot.txt"));
                $Lock_mk_cli = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_mk_cli.txt"));
                $Lock_mk_api = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_mk_api.txt"));
                $Lock_del_cli = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_del_cli.txt"));
                $Lock_del_api = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_del_api.txt"));
                $Lock_cron_jobs = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_cron_jobs.txt"));
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "$Lock_bot", 'callback_data' => 'setting_public_bot'], ['text' => "🔅وضعیت ربات", 'callback_data' => 'simple']],
                    [['text' => "$Lock_mk_cli", 'callback_data' => 'setting_public_mkcli'], ['text' => "🔅ساخت cli", 'callback_data' => 'simple']],
                    [['text' => "$Lock_mk_api", 'callback_data' => 'setting_public_mkapi'], ['text' => "🔅ساخت api", 'callback_data' => 'simple']],
                    [['text' => "$Lock_del_cli", 'callback_data' => 'setting_public_delcli'], ['text' => "🔅 حذف cli", 'callback_data' => 'simple']],
                    [['text' => "$Lock_del_api", 'callback_data' => 'setting_public_delapi'], ['text' => "🔅 حذف api", 'callback_data' => 'simple']],
                    [['text' => "$Lock_cron_jobs", 'callback_data' => 'setting_public_cronjobs'], ['text' => "🔅 کرون جابز داخلی", 'callback_data' => 'simple']],
                    [['text' => "🔙 بازگشت", 'callback_data' => 'menu_setting'], ['text' => "🏚 خانه", 'callback_data' => 'home'], ['text' => "🔜 بعدی", 'callback_data' => 'setting_menu_coin']],
                ]]);
                break;
            case 'back':
            case 'cancell':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "🔙 بازگشت", 'callback_data' => 'back_' . $E1]],
                ]]);
                break;
        }
        return $_KEY;
    }



    public function User($mode, $E1 = null, $E2 = null, $E3 = null)
    {
        switch ($mode) {
            case 'start':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "🎞 پیش نمایش"], ['text' => "🚜 ساخت ربات"]],
                    [['text' => "🛍 سکه رایگان"], ['text' => "♨️ حذف ربات"]],
                    [['text' => "👤حساب کاربری"], ['text' => "📩راهنما و پشتیبانی"]],
                ]]);
                break;
            case 'make':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "🧬 تبچی API"], ['text' => "🧬 تبچی CLI"]],
                    [['text' => "🕳بازگشت🕳"]],
                ]]);
                break;
            case 'show':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "🎥 تبچی API"], ['text' => "🎥 تبچی CLI"]],
                    [['text' => "🕳بازگشت🕳"]],
                ]]);
                break;
            case 'delete':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "♨️ تبچی API"], ['text' => "♨️ تبچی CLI"]],
                    [['text' => "🕳بازگشت🕳"]],
                ]]);
                break;
            case 'coin':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "💰 خرید سکه 💰"]],
                    [['text' => "🎁 کد هدیه"], ['text' => "🎈 زیرمجموعه"]],
                    [['text' => "🕳بازگشت🕳"]],
                ]]);
                break;
            case 'help':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "📣 پشتیبانی", 'url' => 'http://t.me/' . $E1], ['text' => "📜 راهنمای ربات", 'callback_data' => 'help_bot']],
                ]]);
                break;
            case 'stats':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "📅ربات های API"], ['text' => "📆ربات های CLI"]],
                    [['text' => "🕳بازگشت🕳"]],
                ]]);
                break;
            case 'back':
                $_KEY = json_encode(['resize_keyboard' => true, 'keyboard' => [
                    [['text' => "🕳بازگشت🕳"]],
                ]]);
                break;
            case 'buy':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "📣 پشتیبانی", 'url' => 'http://t.me/' . $E1]],
                ]]);
                break;
            case 'ch_lock':
                if (file_get_contents("data/data/settings/Lock_channel_1.txt") == "on" and json_decode(file_get_contents("https://api.telegram.org/bot" . $E1 . "/getChatMember?chat_id=@" . file_get_contents("data/data/settings/channel_1.txt") . "&user_id=" . $E2))->result->status == "administrator") {
                    $ch_1 = true;
                } else {
                    $ch_1 = false;
                }
                if (file_get_contents("data/data/settings/Lock_channel_2.txt") == "on" and json_decode(file_get_contents("https://api.telegram.org/bot" . $E1 . "/getChatMember?chat_id=@" . file_get_contents("data/data/settings/channel_2.txt") . "&user_id=" . $E2))->result->status == "administrator") {
                    $ch_2 = true;
                } else {
                    $ch_2 = false;
                }

                if ($ch_1 == true and $ch_2 == true) {
                    $cc1 = file_get_contents("data/data/settings/channel_1.txt");
                    $cc2 = file_get_contents("data/data/settings/channel_2.txt");
                    $cc3 = $E3;
                    $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                        [['text' => "📍 کانال اخبار", 'url' => 'https://t.me/' . $cc3]],
                        [['text' => "💎کانال 2", 'url' => 'https://t.me/' . $cc2], ['text' => "💎کانال 2", 'url' => 'https://t.me/' . $cc1]],
                    ]]);
                }
                if ($ch_1 == false and $ch_2 == true) {
                    $cc2 = file_get_contents("data/data/settings/channel_2.txt");

                    $cc3 = $E3;
                    $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                        [['text' => "📍 کانال اخبار", 'url' => 'https://t.me/' . $cc3]],
                        [['text' => "💎کانال 2", 'url' => 'https://t.me/' . $cc2]],
                    ]]);
                }
                if ($ch_1 == true and $ch_2 == false) {
                    $cc1 = file_get_contents("data/data/settings/channel_1.txt");

                    $cc3 = $E3;
                    $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                        [['text' => "📍 کانال اخبار", 'url' => 'https://t.me/' . $cc3]],
                        [['text' => "💎کانال 1", 'url' => 'https://t.me/' . $cc1]]
                    ]]);
                }
                if ($ch_1 == false and $ch_2 == false) {
                    $cc3 = $E3;
                    $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                        [['text' => "📍 کانال اخبار", 'url' => 'https://t.me/' . $cc3]],
                    ]]);
                }
                break;
            case 'login_cli':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "♻️ رفتن به url و لاگین اکانت ♻️", 'url' => $E2 . "/" . $E3 . "/data/bots/cli/" . $E1 . "/index.php"]],
                ]]);
                break;
        }
        return $_KEY;
    }
    public function Channel($mode, $E1 = null, $E2 = null, $E3 = null, $E4 = null)
    {
        switch ($mode) {
            case 'goto_bot':
                $_KEY = json_encode(['resize_keyboard' => true, 'inline_keyboard' => [
                    [['text' => "🏅 رفتن به ربات 🏅", 'url' => 'https://t.me/' . $E1]],
                ]]);
                break;
        }
        return $_KEY;
    }
}
