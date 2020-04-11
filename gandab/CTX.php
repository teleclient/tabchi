<?php

class Text
{

    public function Sudo($mode, $E1 = null, $E2 = null, $E3 = null)
    {
        switch ($mode) {
            case 'start':
                $_TEXT = "⭐️ سلام مدیر عزیز\n\n🌺 به پنل مدیریت رباتساز تبچی خوش آمدید\n\n🙏 لطفا یکی از بخش های مدیریتی خود را انتخاب کنید 👇\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'menu_setting':
                $_TEXT = "⭐️ بخش #تنظیمات پنل مدیریت\n\n🔅 از بخش #تنظیمات_جوین میتوانید کانال های قفل جوین اجباری را تنظیم نمیایید\n\n🔅 از بخش #تنظیمات_سکه میتوانید مقدار سکه روزانه و یا زیر مجموعه یا عضویت را تعیین یا خاموش روشن نمایید\n\n🔅 از بخش #تنظیمات_عمومی میتوانید بخش های (ساخت ربات _ ربات _ و ...) ربات را خاموش یا روشن نمایید.\n\n🙏 لطفا بخش مدیریتی را انتخاب نمایید 👇\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'menu_stats':
                $_TEXT = "⭐️ بخش #آمار رباتساز\n\n🔅 از بخش فوروارد و ارسال ها میتوانید تبلیغات لحظه ای خود برای کاربرات رباتساز را ارسال نمایید\n\n🔅 از بخش بن کردن میتوانید کاربران را مسدود یا خروج مسدودیت کنید\n\n🔅 از بخش کد هدیه میتوانید یک کد برای تعریف کرده و مقدار سکه معیین را تعریف کنید\n\n🔅 از بخش سکه همگانی یا تکی میتوانید به یک کاربر خاص یا تمام کاربران سکه ارسال نمایید\n\n🙏 به دلخواه خود یک بخش را انتخاب نمایید \n➖➖➖➖➖➖➖➖➖";
                break;
            case 'menu_admin':
                $_TEXT = "⭐️ بخش #ادمین های رباتساز\n\n🔅 از بخش افزودن میتوانید یک ادمین را با ایدی عددی برای رباتساز تنظیم نمایید .\n\n🔅 از بخش حذف میتوانید یک ادمین را با ایدی عددی عزل نمایید\n\n🔅 از بخش لیست میتوانید لیست ادمین های حاضر را مشاهده فرمایید\n\n🔅 از بخش تنظیمات دسترسی میتوانید سطح دسترسی هر یک از ادمین هارا جداگانه در رباتساز تنظیم نمایید\n\n🙏 کلید مورد نظر خورد را انتخاب نمایید 👇\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'setting_menu_coin':
                $_TEXT = "⭐️ بخش #تنظیمات_سکه رباتساز\n\n🔅 از بخش سکه روزانه میتوانید سکه روزانه که به کاربران داده میشود خاموش روشن یا اینکه تعداد سکه را تعیین نمایید\n\n🔅 از بخش سکه زیر مجموعه میتوانید مقدار سکه که کاربران با اوردن هر زیر مجموعه میگیرند را تعیین نمایید\n\n🔅 از بخش سکه CLI و API میتوانید مقدار سکه برای ساخت ربات هارا تعیین نمایید که از حساب کاربران کسر خواهد شد\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'setting_menu_join':
                $_TEXT = "⭐️ بخش #تنظیمات_جوین رباتساز\n\n🔅 از بخش کانال یک میتوانید کانال قفل جوین اجباری شماره یک را برای کاربران فعال یا تنظیم یا غیر فعال نمایید\n\n🔅 از بخش کانال دو میتوانید کانال قفل جوین اجباری شماره دو را برای کاربران فعال یا تنظیم یا غیر فعال نمایید\n\n📍#نکته : دقت داشته باشید که #کانال_اخبار از قبل قفل بوده تنظیم شده است و نمیتوانید بر رویه ان تنظیماتی اعمال کنید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'admin_setting_once':
                $_TEXT = "⭐️ بخش #تنظیم دسترسی ادمین [ $E1 ]\n\n🔅 از کلید های زیر میتوانید سطح دسترسی این ادمین را تغییر دهید\n\n🔅 دقت داشته باشید اگر دسترسی روبرویه هر پارامتر غیز فعال باشد ادمین مورد نظر نمیتواند به این بخش در پنل مدیریت مراجعه کند و قفل خواهد بود\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'admin_setting_list':
                $_TEXT = "⭐️ بخش #لیست_ادمین‌ها رباتساز\n\n🔅 برای اینکه سطح دسترسی هر یک از ادمین های زیر را جدا گانه تنظیم نمایید لطفا بر رویه ایدی عددی  آن ادمین در کلید زیر کلید نمایید\n\n➖➖➖➖➖➖➖➖➖➖";
                break;
            case 'setting_menu_public':
                $_TEXT = "⭐️ بخش #تنظیمات_عمومی رباتساز\n\n🔅 هر کدام از بخش هارا که غیر فعال کنید برای عموم کاربران غیر قابل دسترس خواهد بود  \n\n🔅 کلید ✅ بیان گر روشن بودن بخش و کلید ☑️ بیان گر خاموش بودن بخش مورد نظر میباشد \n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'stats_send':
                $_TEXT = "⭐️ مدیر عزیز بنر شما به تعداد $E1 کاربر با موفقیت ارسال شد";
                break;
            case 'stats_forward':
                $_TEXT = "⭐️ مدیر عزیز بنر شما به تعداد $E1 کاربر با موفقیت فوروارد";
                break;
            case 'good_stats_ban':
                $_TEXT = "⭐️ مدیر عزیز کاربر با ایدی $E1 با موفقیت به لیست بن شدگان پیوست | تعداد افراد بن شده : $E2";
                break;
            case 'bad_stats_ban_isset':
                $_TEXT = "⭐️ مدیر عزیز کاربر با ایدی $E1 از قبل در لیست بن شدگان وجود دارد | تعداد افراد بن شده : $E2";
                break;
            case 'bad_stats_ban_numberic':
                $_TEXT = "🕹 خطا : لطفا ایدی عددی را درست ارسال نمایید";
                break;
            case 'good_stats_unban':
                $_TEXT = "⭐️ مدیر عزیز کاربر با ایدی $E1 با موفقیت از لیست بن شدگان حذف شد | تعداد افراد بن شده : $E2";
                break;
            case 'bad_stats_unban_issntset':
                $_TEXT = "⭐️ مدیر عزیز کاربر با ایدی $E1 در لیست بن شدگان وجود ندارد ک بخواهید ان را حذف کنید | تعداد بن شدگان : $E2";
                break;
            case 'bad_stats_unban_numberic':
                $_TEXT = "🕹 خطا : لطفا ایدی عددی را درست ارسال نمایید";
                break;
            case 'stats_coinone_coin':
                $_TEXT = "⭐️ مدیر عزیز لطفا تعداد سکه برای کاربر با ایدی $E1 را بصورت عدد لاتین ارسال نماید";
                break;
            case 'bad_stats_coinone_notuser':
                $_TEXT = "⭐️ مدیر عزیز کاربر لیست وجود ندارد که بخواهید به آن سکه ارسال نمایید";
                break;
            case 'bad_stats_coinone_numberic':
                $_TEXT = "🕹 خطا : لطفا ایدی عددی را درست ارسال نمایید";
                break;
            case 'good_stats_coinone':
                $_TEXT = "⭐️ مدیر عزیز تعداد $E1 سکه به کاربر $E2 با موفقیت ارسال شد \n● تعداد سکه قبلی کاربر $E3\n● تعداد سکه فعلی کاربر $E4";
                break;
            case 'bad_stats_coinone_coin_numberic':
                $_TEXT = "🕹 خطا مدیر عزیز لطفا مقدار سکه ارسالی را صحیح وارد نمایید";
                break;
            case 'good_stats_coinall':
                $_TEXT = "⭐️ مدیر عزیز مقدار سکه $E1 به تمام کاربران ربات افزوده شد\n⭐️ تمام سکه داده شده : $E2\n⭐️ تعداد کاربرانی که سکه گرفتمد  $E3";
                break;
            case 'bad_stats_coinall_numberic':
                $_TEXT = "🕹 خطا مدیر عزیز لطفا مقدار سکه ارسالی را صحیح وارد نمایید";
                break;
            case 'stats_coinless_coin':
                $_TEXT = "⭐️ مدیر عزیز لطفا مقدار سکه کسری از کاربر با ایدی $E1 را به عدد لاتین ارسال نمایید ";
                break;
            case 'bad_stats_coinless_notuser':
                $_TEXT = "⭐️ مدیر عزیز کاربر لیست وجود ندارد که بخواهید از ان سکه کسر کنید";
                break;
            case 'bad_stats_coinless_numberic':
                $_TEXT = "🕹 خطا : لطفا ایدی عددی را درست ارسال نمایید";
                break;
            case 'good_stats_coinless_coin':
                $_TEXT = "⭐️ مدیر عزیز تعداد $E1 سکه از کاربر $E2 با موفقیت کسر شد\n● تعداد سکه قبلی کاربر $E3\n● تعداد سکه فعلی کاربر $E4";
                break;
            case 'bad_stats_coinless_coin_numberic':
                $_TEXT = "🕹 خطا مدیر عزیز لطفا مقدار سکه ارسالی را صحیح وارد نمایید";
                break;
            case 'stats_card_coin':
                $_TEXT = "⭐️ مدیر عزیز لطفا مقدار سکه کد هدیه ها را به عدد لاتین ارسال نمایید \n● کد [ $E1 ]";
                break;
            case 'bad_stats_card_isset':
                $_TEXT = "🕹 خطا : مدیر عزیز این کد هدیه از قبل وجود دارد [ $E1 ] ";
                break;
            case 'bad_stats_card_char':
                $_TEXT = "🕹 خطا : مدیر عزیز تعداد کارکتر های کد شما بیشتر از 30 کارکتر است لطفا تعداد کاراکتر را کمتر کنید";
                break;
            case 'good_stats_card_coin':
                $_TEXT = "⭐️ مدیر عزیز کد [ $E2 ] با مقدار سکه $E1 با موفقیت ساخته شد و به کانال ارسال شد";
                break;
            case 'bad_stats_card_coin_number':
                $_TEXT = "🕹 خطا مدیر عزیز لطفا مقدار سکه ارسالی را صحیح وارد نمایید";
                break;
            case 'good_add_admin':
                $_TEXT = "⭐️ مدیر عزیز کاربر با ایدی $E1 با موفقیت به لیست ادمین های رباتساز پیوست | تعداد ادمین های رباتساز $E2";
                break;
            case 'bad_add_admin_isset':
                $_TEXT = "⭐️ مدیر عزیز کاربر با ایدی $E1 از قبل در لیست ادمین های رباتساز وجود دارد";
                break;
            case 'bad_add_admin_isban':
                $_TEXT = "🕹 خطا : مدیر عزیز کاربر با ایدی $E1 جزو افراد بن شده میباشد و شما نمیتوانید ان را ادمین کنید";
                break;
            case 'bad_add_admin_numbric':
                $_TEXT = "🕹 خطا : مدیر عزیز لطفا ایدی عددی کاربر را درست ارسال نمایید";
                break;
            case 'good_del_admin':
                $_TEXT = "⭐️ مدیر عزیز ادمین با ایدی $E1 با موفقیت از لیست ادمین های رباتساز حذف شد | تعداد ادمین های رباتساز $E2";
                break;
            case 'bad_del_admin_isntset':
                $_TEXT = "🕹 خطا : مدیر عزیز کاربر با ایدی $E1 در لیست ادمین های رباتساز وجود ندارد";
                break;
            case 'bad_del_admin_numbric':
                $_TEXT = "🕹 خطا : مدیر عزیز لطفا ایدی عددی کاربر را درست ارسال نمایید";
                break;
            case 'good_join_set_ch1':
                $_TEXT = "⭐️✅ مدیر عزیز کانال @$E1 با موفقیت به قفل شماره یک تنظیم شد";
                break;
            case 'bad_join_set_ch1':
                $_TEXT = "⭐️ مدیر عزیز ربات در کانال @$E1 ادمین نمیباشد شما نمیتوانید ربات را بر رویه این کانال قعل نمایید _ لطفا اول ربات را در کاناله مربوطه ادمین کرده و مجددا تلاش کنید";
                break;
            case 'good_join_set_ch2':
                $_TEXT = "⭐️✅ مدیر عزیز کانال @$E1 با موفقیت به قفل شماره دو تنظیم شد";
                break;
            case 'bad_join_set_ch2':
                $_TEXT = "⭐️ مدیر عزیز ربات در کانال @$E1 ادمین نمیباشد شما نمیتوانید ربات را بر رویه این کانال قعل نمایید _ لطفا اول ربات را در کاناله مربوطه ادمین کرده و مجددا تلاش کنید";
                break;
            case 'stats_delbot_api':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی ربات api را جهت حذف کردن از رباتساز ارسال نمایید ";
                break;
            case 'stats_delbot_cli':
                $_TEXT = "⭐️ مدیر عزیز لطفا شماره اکانت تبچی CLI را جهت حذف کردن با کد کشور وارد نمایید";
                break;
            case 'stats_delbot_bad':
                $_TEXT = "🕹 خطا : مدیر عزیز لطفا برای حذف ربات api . کلمه api _ و برای حذف ربات cli کلمه cli را ارسال نمایید";
                break;
            case 'good_stats_delbot_api':
                $_TEXT = "⭐️ مدیر عزیز ربات Api با مشخاص زیر با موفقیت حذف شد \n👌 ایدی : $E3\n👌 توکن :\n$E1\n👌 ایدی عددی : $E4\n👌 کد فایل : $E2\n";
                break;
            case 'bad_stats_delbot_api':
                $_TEXT = "⭐️ مدیر عزیز همچین رباتی با ایدی $E1 در دیتا بیس ربات وجود ندارد";
                break;
            case 'good_stats_delbot_cli':
                $_TEXT = "⭐️ مدیر عزیز یک ربات تبچی CLI با مشخصات زیر از دیتا بیس ربات حذف شد\nشماره : $E1";
                break;
            case 'Qry_cant':
                $_TEXT = "⭐️ ادمین عزیز شما دسترسی به این بخش را ندارید";
                break;
            case 'Qry_simple':
                $_TEXT = "⭐️ مدیر عزیز این کلید ها فقط برای نمایش میباشند";
                break;
            case 'Qry_loading':
                $_TEXT = "🧬 درحال پردازش.....";
                break;
            case 'first_stats_send':
                $_TEXT = "⭐️ مدیز عزیز لطفا بنر خود جهت ارسال همگانی در قالب ( متن ) ارسال نمایید";
                break;
            case 'first_stats_forward':
                $_TEXT = "⭐️ مدیر عزیز لطفا بنر را جهت فوروارد همگانی ارسال یا فوروادد نمایید";
                break;
            case 'first_stats_seeinfo':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی عددی خص کاربر جهت بررسی اطلاعات را وارد نمایید . دقت داشته باشید که شخص باید در رباتساز عضو باشد ";
                break;
            case 'first_stats_unban':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی عددی کاربر ربات را جهت آن بن کردن ارسال نمایید";
                break;
            case 'first_stats_ban':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی عددی کاربر را جهت بن کردن از ربات ارسال نمایید";
                break;
            case 'first_stats_coinone':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی عددی کاربری که میخواهید به آن سکه ارسال کنید را ارسال نمایید";
                break;
            case 'first_stats_coinall':
                $_TEXT = "⭐️ کاربر عزیز لطفا مقدار سکه همگانی را ارسال نمایید . این مقدار برای هر کاربر محاسبه خواهد شد";
                break;
            case 'first_stats_card':
                $_TEXT = "⭐️ مدیر عزیز لطفا کد مورد نظر را جهت ست کردن بر رویه کد هدیه ارسال نمایید \n\nمثال : botsaz2628";
                break;
            case 'first_stats_coinless':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی عددی شخصی که میخواهید سکه هایش را کاهش دهید را ارسال نمایید";
                break;
            case 'first_stats_tabbots':
                $_TEXT = "⭐️ مدیر عزیز لطفا بنر را در قالب ( متن ) ارسال نمایید دقت داشته باشید که این بنر توسط ربات هایی که با رباتساز ساخته شده ان ارسال همگانی خواهد شد";
                break;
            case 'first_stats_delbot':
                $_TEXT = "⭐️ مدیر عزیز لطفا جهت حذف ربات api کلمه ( api ) را ارسال نمایید و برای حذف ربات cli کلمه cli را ارسال نماایید";
                break;
            case 'stats_user':
                $_TEXT = "⭐️ لیست کاربران رباتساز 👇 \n\n";
                $users = explode("\n", file_get_contents("data/data/users/list.txt"));
                $c = 0;
                foreach ($users as $user) {
                    $_TEXT .= "$c 》 <a href='tg://user?id=$user'>$user</a> \n";
                    $c++;
                }
                $_TEXT .= "\n\n➖➖➖➖➖➖➖➖";
                break;
            case 'stats_listmaker':
                $_TEXT = "⭐️ لیست کاربران ربات ساخته 👇 \n\n";
                $users = explode("\n", file_get_contents("data/data/users/makers.txt"));
                $c = 0;
                foreach ($users as $user) {
                    $_TEXT .= "$c 》 <a href='tg://user?id=$user'>$user</a> \n";
                    $c++;
                }
                $_TEXT .= "\n\n➖➖➖➖➖➖➖➖";
                break;
            case 'first_add_admin':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی عددی کاربر را جهت ادمین کردن در رباتساز وارد نمایید";
                break;
            case 'first_del_admin':
                $_TEXT = "⭐️ مدیر عزیز لطفا ایدی ادمین را جهت عزل کردن ارسال نمایید";
                break;
            case 'admin_list':
                $_TEXT = "⭐️ لیست ادمین های ربات 👇 \n\n";
                $users = explode("\n", file_get_contents("data/data/adm/list.txt"));
                $c = 0;
                foreach ($users as $user) {
                    $_TEXT .= "$c 》 <a href='tg://user?id=$usee'>$user</a> \n";
                    $c++;
                }
                $_TEXT .= "\n\n➖➖➖➖➖➖➖➖";
                break;
            case 'bas_stats_seeinfo_num':
                $_TEXT = "🕹 خطا : مدیر عزیز لطفا ایدی عددی کاربر را صحیح وارد نمایید";
                break;
            case 'bas_stats_seeinfo_isban':
                $_TEXT = "⭐️ مدیر عزیز کاربر مربوطه در لیست بن شده های ربات میباشد و دیتایی و اطلاعاتی در دیتا بیس رباتساز ندارد";
                break;
            case 'bas_stats_seeinfo_isset':
                $_TEXT = "⭐️ خطا مدیر عزیز کاربر مربوطه عضو رباتساز نمیباشد";
                break;
            case 'good_stats_seeinfo':
                $_TEXT = "⭐️ آمار کاربر $E1 در رباتساز ⭐️\n";
                if (is_dir("data/data/users/" . $E1 . "/bots/api") == true) {
                    $scan_api = scandir("data/data/users/" . $E1 . "/bots/api");
                    $diff_api = array_diff($scan_api, ['.', '..']);
                    $api_c = count($diff_api);
                    $ck_api = "🔅 تعداد ربات api : $api_c\n";
                    foreach ($diff_api as $diff) {
                        $bt = file_get_contents("data/data/users/" . $E1 . "/bots/api/" . $diff . "/token.txt");
                        $ck_api .= "……………………………………………\n📍ایدی ربات  : $diff\n📍 توکن ربات :\n$bt\n🕹 مالک : $E1\n……………………………………………\n\n";
                    }
                } else {
                    $ck_api = "🧬 کاربر ربات api ای ندارد";
                }
                if (is_dir("data/data/users/" . $E1 . "/bots/cli") == true) {
                    $scan_cli = scandir("data/data/users/" . $E1 . "/bots/cli");
                    $diff_cli = array_diff($scan_cli, ['.', '..']);
                    $cli_c = count($diff_cli);
                    $ck_cli = "\n🔅 تعداد ربات cli : $cli_c\n";
                    foreach ($diff_cli as $diff) {
                        $ck_cli .= "………………………………………\n🕹 شماره ربات : $diff\n🕹 مالک : $E1\n………………………………………";
                    }
                } else {
                    $ck_cli = "🧬 کاربر ربات cli ای ندارد";
                }
                $coins = file_get_contents("data/data/users/" . $E1 . "/coins.txt");
                $_TEXT .= "🔅 نام کاربری : $E1\n🔅 مقدار سکه : $coins\n🔅لیست ربات ها 👇👇👇\n$ck_api\n〰〰〰〰〰〰\n$ck_cli\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'good_stats_tabbots':
                $_TEXT = "⭐️ بنر شما با موفقیت با $E1 ربات api ارسال همگانی به گروه ها و کاربران شد";
                break;
            case 'first_join_set_ch1':
                $_TEXT = "⭐️ مدیر عزیز شما در حال تنظیم قفل کانال شماره یک میباشید\n\n⭐️ لطفا ایدی کانال را با @ ارسال نمایید";
                break;
            case 'first_join_set_ch2':
                $_TEXT = "⭐️ مدیر عزیز شما در حال تنظیم قفل کانال شماره دو میباشید\n\n⭐️ لطفا ایدی کانال را با @ ارسال نمایید";
                break;
            case 'stats_stats':
                $Lock_day_coin = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_day_coin.txt"));
                $coin_day_count = file_get_contents("data/data/settings/coin_day_count.txt");
                $coin_mget_count = file_get_contents("data/data/settings/coin_mget_count.txt");
                $coin_api_count = file_get_contents("data/data/settings/coin_api_count.txt");
                $coin_cli_count = file_get_contents("data/data/settings/coin_cli_count.txt");
                $Lock_channel_1 = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_channel_1.txt"));
                $Lock_channel_2 = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_channel_2.txt"));
                $channel_1 = file_get_contents("data/data/settings/channel_1.txt");
                $channel_2 = file_get_contents("data/data/settings/channel_2.txt");
                $Lock_bot = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_bot.txt"));
                $Lock_mk_cli = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_mk_cli.txt"));
                $Lock_mk_api = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_mk_api.txt"));
                $Lock_del_cli = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_del_cli.txt"));
                $Lock_del_api = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_del_api.txt"));
                $Lock_cron_jobs = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/data/settings/Lock_cron_jobs.txt"));
                $users = count(explode("\n", file_get_contents("data/data/users/list.txt")));
                $bans = count(explode("\n", file_get_contents("data/data/users/bans.txt")));
                $adms = count(explode("\n", file_get_contents("data/data/adm/list.txt")));
                $makers = count(explode("\n", file_get_contents("data/data/users/makers.txt")));
                $api_scan = scandir("data/bots/api");
                $api_diff = array_diff($api_scan, ['.', '..']);
                $apis = count($api_diff);
                $cli_scan = scandir("data/bots/cli");
                $cli_diff = array_diff($cli_scan, ['.', '..']);
                $clis = count($cli_diff);
                $_TEXT = "⭐️ آمار کلی ربات تبچی ساز\n〰〰〰〰〰〰〰〰\n● ربات 》 $Lock_bot\n● ساخت  cli ربات》 $Lock_mk_cli\n● ساخت  api ربات》 $Lock_mk_api\n● حذف ربات cli 》 $Lock_del_cli\n● حذف ربات api 》 $Lock_del_api\n● کرون جابز داخلی 》 $Lock_cron_jobs\n……………………………………\n● قفل کانال یک 》 $Lock_channel_1\n● قفل کانال دو 》 $Lock_channel_2\n● کانال یک 》 $channel_1\n● کانال دو 》 $channel_2\n……………………………………\n● سکه روزانه 》 $Lock_day_coin\n● تعداد سکه روزانه 》 $coin_day_count\n● تعداد سکه زیر مجموعه 》 $coin_mget_count\n● تعداد سکه عضویت 》 1\n● مقدار سکه cli ربات 》 $coin_cli_count\n● مقدار سکه api ربات》 $coin_api_count\n……………………………………\n● تعداد کاربران 》 $users\n● تعداد بن ها 》 $bans\n● تعداد ادمین ها 》 $adms\n● تعداد سازندگان ربات 》 $makers\n……………………………………\n● تعداد ربات api ساخته شده 》 $apis\n● تعداد ربات cli ساخته شده 》 $clis\n〰〰〰〰〰〰〰〰\n🔺 امار کلی ربات تبچی ساز\n";
                break;
        }
        return $_TEXT;
    }



    public function User($mode, $E1 = null, $E2 = null, $E3 = null, $E4 = null)
    {
        switch ($mode) {
            case 'start_first':
                $_TEXT = "⭐️ سلام کاربر عزیز <a href='tg://user?id=$E1'>$E1</a> \n\n⭐️ عضویت شما را به رباتساز <a href='tg://user?id=$E2'>$E3</a> تبریک میگویم 🌹\n\n⭐️ شما میتوانید از کلید های ربات به بخش های دلخواه دسترسی پیدا کنید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'start':
                $_TEXT = "⭐️ سلام کاربر عزیز <a href='tg://user?id=$E1'>$E1</a> \n\n⭐️ به پنل کاربری رباتساز <a href='tg://user?id=$E2'>$E3</a> خوش اومدین 😊\n\n⭐️ شما میتوانید از کلید های ربات به بخش های دلخواه دسترسی پیدا کنید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'show':
                $_TEXT = "⭐️ بخش #پیش_نمایش \n\n☂ در این بخش میتوانید ویدیو کوتاهی از ربات مورد نظر cli و api جهت ساخت تماشا کنید \n\n☂ لطفا بر رویه ربات مورد نظر خود کلیک کنید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'make':
                $_TEXT = "⭐️ بخش انتخاب #ساخت_ربات\n\n👌 کاربر عزیز <a href='tg://user?id=$E1'>$E1</a> برای ساخت ربات اول باید نوع ربات مد نظر خود را تعیین نمایید\n\n☂ ربات تبچی API ربات رسمی تلگرام هست که بر رویه ان سورس کد تبلیغاتی نصب میشود و قابلیت تبلیغی دارد\n\n☂ ربات تبچی CLI نیز یک اکانت تلگرامی هست که دارای شماره میباشد و شما میتوانید با ساختن این نوع ربات در گروه های مختلف بدون محدودیت تبلیغ کنید\n\n👌 لطفا از کلید های زیر انتخاب کنید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'delete':
                $_TEXT = "⭐️ بخش #حذف_ربات\n\n👌 کاربر عزیز <a href='tg://user?id=$E1'>$E1</a> برای حذف ربات اول باید نوع ربات مد نظر خود را تعیین نمایید\n\n☂ در این بخش میتوانید ربات هایی که ساختید را بصورت کلی یا بصورت تکی از رباتساز ما حذف نمایید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'coin':
                $_TEXT = "⭐️ بخش #افزایش_موجودی\n\n☂ از بخش زیر مجموعه گیری میتوانید با دریافت بنر و پخش آن بین دوستان و مخاطبین خود با عضویت ان ها به رباتساز ما مقداری سکه دریافت نمایید\n\n☂ از بخش خرید سکه و یا کد هدیه نیز میتوانید بصورت لحظه ای سکه دریافت کنید و برای خرید میتوانید به پشتیبانی ربات پیام ارسال کرده و مقداری سکه خریداری نمایید\n\n👌 لطفا بخش مورد نظر خود را انتخاب کنید\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'help':
                $_TEXT = "⭐️ بخش راهنما و پشتیبانی رباتساز\n\n☂ از بخش کلید پشتیبانی به پیوی یا ربات پشتیبانی متصل میشوید و میتوانید نظر و مشکلات خود را مطرح کنید و یا سکه خریداری نمایید\n\n☂ از بخش راهنما نیز میتوانید جواب برخی سوالات خود را پیدا کنید\n\n👌 لطفا به دلخواه خود انتخاب نمایید \n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'info':
                $scan_api = scandir("data/data/users/" . $E1 . "/bots/api");
                $diff_api = array_diff($scan_api, ['.', '..']);
                $c_api = 0;
                foreach ($diff_api as $diff) {
                    if (is_dir("data/data/users/" . $E1 . "/bots/api/" . $diff) == true) {
                        $c_api++;
                    }
                }
                $scan_cli = scandir("data/data/users/" . $E1 . "/bots/cli");
                $diff_cli = array_diff($scan_cli, ['.', '..']);
                $c_cli = 0;
                foreach ($diff_cli as $diff) {
                    if (is_dir("data/data/users/" . $E1 . "/bots/cli/" . $diff) == true) {
                        $c_cli++;
                    }
                }
                $coins = file_get_contents("data/data/users/" . $E1 . "/coins.txt");

                $_TEXT = "👤 آمار کاربری شما\n\n💈 شناسه شما : $E1\n💈 تعداد سکه شما : $coins\n💈 تعداد ربات API : $c_api\n💈 تعداد ربات CLI : $c_cli\n\n……………………………………………\n🧬 برای دیدن لیست ربات های خود از کلید های زیر استفاده کنید  👇\n";
                break;
            case 'info_api':
                $_TEXT = "☂ لیست ربات های Api شما 👇\n➖➖➖➖➖➖➖➖➖";
                $scan_api = scandir("data/data/users/" . $E1 . "/bots/api");
                $diff_api = array_diff($scan_api, ['.', '..']);
                $c_api = 1;
                foreach ($diff_api as $diff) {
                    if (is_dir("data/data/users/" . $E1 . "/bots/api/" . $diff) == true) {
                        $date = file_get_contents("data/data/users/" . $E1 . "/bots/api/" . $diff . "/date.txt");
                        $token = file_get_contents("data/data/users/" . $E1 . "/bots/api/" . $diff . "/token.txt");
                        $_TEXT .= "………………………………………\n👌 شماره : $c_api\n👌 ایدی ربات : $diff\n👌 توکن ربات :\n$token\n👌 زمان ساخت : $date\n………………………………………\n";
                        $c_api++;
                    }
                }
                $_TEXT .= "\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'info_cli':
                $_TEXT = "☂ لیست ربات های CLI شما 👇\n➖➖➖➖➖➖➖➖➖";
                $scan_cli = scandir("data/data/users/" . $E1 . "/bots/cli");
                $diff_cli = array_diff($scan_cli, ['.', '..']);
                $c_cli = 0;
                foreach ($diff_cli as $diff) {
                    if (is_dir("data/data/users/" . $E1 . "/bots/cli/" . $diff) == true) {
                        $date = file_get_contents("data/data/users/" . $E1 . "/bots/cli/" . $diff . "/date.txt");
                        $_TEXT .= "……………………………………\n👌 شماره ربات : $c_cli\n👌 شماره اکانت : $diff\n👌 تاریخ ساخت : $date\n……………………………………\n";
                        $c_cli++;
                    }
                }
                $_TEXT .= "\n\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'help_text':
                $_TEXT = "☂ راهنمای رباتساز ☂\n\n🔺 توکن چیست ؟\n✅ توکن یک هش کد رمزگزاری شده هست برای ارتباط بین سرور رباتساز ما با سرور های تلگرام که میتوانید از طریغ ربات @botfather آن را بدست بیاورید\n\n🔺 تبچی چیست ؟\n✅ تبچی مخفف عبارت ( تبلیغاتی ) هست که ربات های تبلیغاتی در گروه های تلگرامی عضو میشوند و هر از چند گاهی توسط مدیریت انان تبلیغاتی در گروه ها قرار داده میشود\n\n🔺 تبچی api چیست ؟\n✅ تبچی api یک ربات api ( رسمی ) تلگرام هست که حاوی شماره نیست و قابلیت عضویت در گروه هارا دارا نیست و فقط با ربات های CLI در گروه ها ادد میشود و شروع به تبلیغ میکند\n\n🔺 تبچی cli چیست ؟\n✅ تبچی cli به ربات تبچی گفته میشود که بر رویه اکانت شماره دار تلگرامی نصب میشود و در لینک گروه ها عضو میشود و شروع به تبلیغات میکند\n\n🔺 میدلاین چیست ؟\n✅ میدلاین یک کتابخانه تلگرامی هست که ربات های cli ما با آن کتاخانه ساخته شده اند\n\n👌 برای سوالات بیشتر میتوانید به پشتیبانی ربات پیام ارسال نمایید\n➖➖➖➖➖➖➖➖➖";
                break;
            case 'buy':
                $_TEXT = "⭐️ کاربر عزیز برای خرید سکه و ویژه کردن حساب خود میتوانید به پشتیبانی ربات پیام ارسال کرده و از آن سکه خریداری نمایید\n\n⭐️ دقت داشته باشید که پس از واریز سکه ها بصورت لحظه ای از پنل مدیریت به حساب کاربری شما در ربات افزوده خواهد شد";
                break;
            case 'mgeting':
                $_TEXT = "⭐️ کاربر عزیز بنر بالا را 👆 به دوستان و مخاطبین خود ارسال نمایید\n\n⭐️ هر شخصی که با لینک مخصوص شما وارد ربات شود مقداری سکه به حساب کاربری شما افزوده خواهد شد 😊";
                break;
            case 'baner':
                $_TEXT = "🙊 میخوای ربات بسازی ولی بلد نیستی ؟؟؟\n😄 میخوای کانال و گروهتو تبلیغ کنی ولی نمیدونی چیکار کنی ؟؟\n😅 مقدار پولت واسه ساخت ربات کمه ؟؟؟\n\n😳 خب کاری نداره عضو رباتساز ما شو واسه خودت ربات تبلیغاتی بساز و کانال و گروهتو تبلیغ کن 😉👇👇\n\nhttp://t.me/{$E2}?start=$E1";
                break;
            case 'card':
                $_TEXT = "⭐️ کاربر عزیز لطفا کد هدیه را وارد کنید \n\n⭐️ پس از این عملیات اگر کد هدیه شما صحیح باشد مقداری سکه به شما تعلق خواهد گرفت";
                break;
            case 'show_api':
                $_TEXT = "🎥 ویدیو پیش نمایش ربات های ApI که با رباتساز ما میتوانید بسازید\n\n🛠 شما میتوانید از بخش ساخت ربات اقدام به ساخت ربات api برای تود به تعداد دلخواه کنید";
                break;
            case 'show_cli':
                $_TEXT = "🎥 ویدیو پیش نمایش ربات های Cli که با رباتساز ما میتوانید بسازید\n\n🛠 شما میتوانید از بخش ساخت ربات اقدام به ساخت ربات Cli برای تود به تعداد دلخواه کنید";
                break;
            case 'make_api':
                $_TEXT = "⭐️ کاربر عزیز \n\n⭐️ شما در حال #ساخت ربات API میباشید\n\n⭐️ لطفا #توکن ربات خود را ارسال نمایید دقت داشته باشید که میتوانید از ربات @botfather توکن خود را بدست بیاورید\n\n🔺برای انصراف برگشت را کلیک کنید\n";
                break;
            case 'make_cli':
                $_TEXT = "⭐️ کاربر عزیز \n\n⭐️ شما در حال #ساخت ربات CLI میباشید\n\n⭐️ لطفا #شماره_اکانت ربات خود را با کد کشور ارسال نمایید \n--نمونه--\n+98901283829\n\n🔺برای انصراف برگشت را کلیک کنید\n";
                break;
            case 'delete_api':
                $_TEXT = "⭐️ کاربر عزیز \n\n⭐️ شما در حال حذف ربات API خود میباشید\n\n⭐️ لطفا ایدی ربات خود را با @ ارسال نمایید\n\n🔺 در صورت انصراف برگشت را کلیک کنید\n";
                break;
            case 'delete_cli':
                $_TEXT = "⭐️ کاربر عزیز \n\n⭐️ شما در حال حذف ربات CLI خود میباشید\n\n⭐️ لطفا #شماره_اکانت ربات خود را  ارسال نمایید\n--نمونه--\n+98901828671\n🔺 در صورت انصراف برگشت را کلیک کنید\n";
                break;
            case 'mget_coin':
                $_TEXT = "⭐️😍 کاربر عزیز یک شخص با لینک شما وارد ربات شد \n\n👌 مقدار $E2 به سکه های شما افزوده شد\n\n👌 تعداد سکه فعلی $E3\n";
                break;
            case 'lock_join':
                $_TEXT = "⭐️ کاربر عزیز برای استفاده از رباتساز قدرتمند ما باید در کانال اخبار و کانالی مربوطه زیر #عضو شده باشید\n\n⭐️ لطفا عضو کانال ها شده و از اول /start کنید 😊";
                break;
            case 'cli_created':
                $_TEXT = "✅ کاربر عزیز تبچی CLI شما با شماره $E1 با موفقیت لاگین شد میتوانید به ربات خود رفته و دستور ( راهنما ) را ارسال نمایید";
                break;
            case 'sudo_del_your_bot_cli':
                $_TEXT = "📍 کاربر عزیز _ تبچی CLI شما با شماره ( $E1 ) توسط مدیریت رباتساز #حذف شد";
                break;
            case 'sudo_del_your_bot_api':
                $_TEXT = "📍 کاربر عزیز _ تبچی API شما \n📍 با آیدی $E3\n📍 کد : $E2\n📍توکن : \n$E1\nتوسط مدیریت ربات #حذف شد\n";
                break;
            case 'good_del_admin':
                $_TEXT = "⭐️ ادمین عزیز شما از لیست مدیران ربات #حذف شدید";
                break;
            case 'good_add_admin':
                $_TEXT = "⭐️ کاربر عزیز شما با موفقیت ادمین رباتساز شدید ";
                break;
            case 'good_stats_coinone':
                $_TEXT = "⭐️ کاربر عزیز از سمت مدیریت به شما سکه افزوده شد\n🕹 تعداد سکه افزوده : $E1\n🕹 تعداد سکه قبلی شما : $E3\n⭐️ تعداد سکه فعلی : $E4\n";
                break;
            case 'stats_coinall':
                $_TEXT = "⭐️ کاربر عزیز از سمت مدیریت به شما سکه افزوده شد\n🕹 تعداد سکه افزوده : $E1\n🕹 تعداد سکه قبلی شما : $E3\n⭐️ تعداد سکه فعلی : $E4\n";
                break;
            case 'good_stats_coinless':
                $_TEXT = "⭐️ کاربر عزیز از سمت مدیریت از سکه شما کسر شد\n🕹 تعداد سکه کسری : $E1\n🕹 تعداد سکه قبلی شما : $E3\n⭐️ تعداد سکه فعلی : $E4\n";
                break;
            case 'make_api_isset':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 این ربات با ایدی $E2 از قبل در دیتا بیس ربات ساخته شده است لطفا از توکنی دیگر برای ساخت ربات استفاده کنید\n\n♨️ در غیر این صورت بر رویه برگشت کلیک کنید";
                break;
            case 'make_api_false_token':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 توکن ارسالی شما نادرست میباشد _ لطفا از توکن صحیح جهت ارسال استفاده نمایید\n\n♨️ درغیر این صورت بر رویه کلید بازگشت کلیک  کنید";
                break;
            case 'make_api_false_coin':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 تعداد سکه شما برای ساخت ربات ApI کمتر از حد مجاز است\n\n🔅 مقدار سکه شما : $E2\n🔅 مقدار سکه مجاز : $E3\n";
                break;
            case 'make_api_off':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 ضمن پوزش از شما _ ساخت ربات های api توسط مدیریت ربات برای #عموم غیر فعال شده است";
                break;
            case 'make_cli_isset':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 همچین ربات cli با شماره [ $E2 ] در دیتا بیس ربات ساخته شده است لطفا از شماره دیگری جهت ساخت ربات تبچی خود استفاده کنید\n\n♨️ در غیر این صورت بر رویه کلید بازگشت کلیک کنید";
                break;
            case 'make_cli_false_phone':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 شماره ارسالی شما نادرست میباشد [ $E2 ] لطفا شماره ربات خود را جهت لاگین بصورت صحیح ارسال نمایید\n\n♨️ در غیر این صورت بر رویه کلید بازگشت کلیک کنید";
                break;
            case 'make_cli_false_coin':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 تعداد سکه شما برای ساخت ربات ClI کمتر از حد مجاز است\n\n🔅 مقدار سکه شما : $E2\n🔅 مقدار سکه مجاز : $E3\n";
                break;
            case 'make_cli_off':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 ضمن پوزش از شما _ ساخت ربات های cli توسط مدیریت ربات برای #عموم غیر فعال شده است";
                break;
            case 'delete_api_false_sudo':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 شما سازنده این ربات api نمیباشید که بخواهید ان را حذف نمایید";
                break;
            case 'delete_api_false_isset':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 همچین رباتی با ایدی مورد نظر شما در دیتا بیس رباتساز وجود ندارد تا بخواهید ان را حذف کنید";
                break;
            case 'delete_api_off':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 با ضمن پوزش شما حذف ربات های api در ربات برای #عموم غیر فعال شده است";
                break;
            case 'delete_cli_false_sudo':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 شما سازنده این ربات cli نمیباشید که بخواهید ان را حذف نمایید";
                break;
            case 'delete_cli_false_sset':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 همچین رباتی با ایدی مورد نظر شما در دیتا بیس رباتساز وجود ندارد تا بخواهید ان را حذف کنید";
                break;
            case 'delete_cli_off':
                $_TEXT = "⚠️ خطا کاربر عزیز $E1 با ضمن پوزش شما حذف ربات های cli در ربات برای #عموم غیر فعال شده است";
                break;
            case 'card_true':
                $_TEXT = "✅ کاربر عزیز $E1 با ضمن تبریک به شما مقدار [ $E2 ] سکه به تعداد سکه های شما با کد هدیه تعلق گرفت ";
                break;
            case 'card_used':
                $_TEXT = "‼️ کاربر عزیز $E1 این کد هدیه قبلا مورد استفاده قرار گرفته است";
                break;
            case 'card_isset':
                $_TEXT = "‼️ خطا کاربر عزیز $E1 این کد هدیه وارد شده شما در دیتا بیس ربات موجود نمیباشد";
                break;
            case 'maked_api':
                $_TEXT = "✅ کاربر عزیز $E1 ربات API شما با موفقیت ساخته شد \n🔅 ایدی ربات : $E2\n🔅 سکه کسر شده : $E4\n🔅 سکه فعلی شما : $E3\n➖➖➖➖➖➖➖➖\n● به Pv ربات خود رفته و دستور /start را ارسال نمایید\n";
                break;
            case 'maked_cli':
                $_TEXT = "✅ کاربز عزیز  $E1ربات cli شما با موفقیت ساخته شد\n🔅 شماره : $E2\n🔅 مقدار سکه کسر شده : $E4\n🔅 مقدار سکه فعلی : $E3\n➖➖➖➖➖➖➖➖\n✅ لطفا جهت لاگین کردن اکانت تبچی با شماره مور نظر بر رویه کلید زیر کلیک نمایید 👇👇\n";
                break;
            case 'date_coin':
                $_TEXT = "⭐️ کاربر عزیز $E1 سکه روزانه شما با موفقیت هدیه داده شد\n✨ تعداد سکه افزوده $E3\n✨ تعداد سکه قبلی $E2\n✨ تعداد سکه فعلی $E4\n";
                break;
            case 'text':
                $_TEXT = "TEXT";
                break;
            case 'text':
                $_TEXT = "TEXT";
                break;
            case 'text':
                $_TEXT = "TEXT";
                break;
            case 'text':
                $_TEXT = "TEXT";
                break;
        }
        return $_TEXT;
    }
    public function Channel($mode, $E1 = null, $E2 = null, $E3 = null, $E4 = null)
    {
        switch ($mode) {
            case 'stats_card':
                $_TEXT = "⭐️ یک کد هدیه توسط مدیر ربات ساخته شد\n\n🕹 کد $E2\n🕹 مقدار سکه کد $E1\n\n✅ برای استفاده از کد به ربات وارد شوید 👇\n";
                break;
            case 'good_stats_delbot_api':
                $_TEXT = "⭐️ یک ربات توسط مدیریت حذف شد\n\n🕹 نوع ربات : API\n🕹 کد ربات : $E2\n🕹 ایدی ربات : $E3\n➖➖➖➖➖➖➖➖";
                break;
            case 'good_stats_delbot_cli':
                $_TEXT = "⭐️ یک ربات توسط مدیریت حذف شد\n\n🕹 نوع ربات : CLI\n🕹 شماره ربات : $E1\n➖➖➖➖➖➖➖➖";
                break;
            case 'maked_api':
                $_TEXT = "⭐️ یک ربات توسط کاربر ساخته شد\n\n🕹 نوع ربات : API\n🕹 ایدی ربات : $E2\n🕹 مالک ربات : $E1\n➖➖➖➖➖➖➖➖";
                break;
            case 'maked_cli':
                $_TEXT = "⭐️ یک ربات توسط کاربر ساخته شد\n\n🕹 نوع ربات : CLI\n🕹 شماره ربات : $E2\n🕹 مالک ربات : $E1\n➖➖➖➖➖➖➖➖";
                break;
            case 'card_true':
                $_TEXT = "🔆 اطلاعیه 🔆\n\n🔅 یک کد هدیه توسط کاربر $E1 مورد استفاده قرار گرفت \n\n🔅 مقدار $E2 سکه به سکه های کاربر افزوده شد";
                break;
            case 'text':
                $_TEXT = "TEXT";
                break;
        }
        return $_TEXT;
    }
}
