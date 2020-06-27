<?php
// Seo
function seo($str, $options = array())
{
    $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

// Xss Clean
function clean($data)
{
    $t = &get_instance();
    // Fix &entity\n;
    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);

    // we are done...
    return html_purify($t->security->xss_clean(htmlspecialchars(addslashes(strip_tags(trim($data))))));
}

// Improved Strto
function strto($to, $str)
{
    if (!function_exists('rp')) :
        function rp($i, $str)
        {
            $B = array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç');
            $k = array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç');
            $Bi = array(' I', ' ı', ' İ', ' i');
            $ki = array(' I', ' I', ' İ', ' İ');
            if ($i == 1) :
                return str_replace($B, $k, $str);
            elseif ($i == 2) :
                return str_replace($k, $B, $str);
            elseif ($i == 3) :
                return str_replace($Bi, $ki, $str);
            endif;
        }
    endif;
    if (!function_exists('cf')) :
        function cf($c = array(), $str)
        {
            foreach ($c as $cc) {
                $s = explode($cc, $str);
                foreach ($s as $k => $ss) {
                    $s[$k] = strto('ucfirst', $ss);
                }
                $str = implode($cc, $s);
            }
            return $str;
        }
    endif;
    if (!function_exists('te')) :
        function te()
        {
            return trigger_error('Lütfen geçerli bir strto() parametresi giriniz.', E_USER_ERROR);
        }
    endif;
    $to = explode('|', $to);
    if ($to) :
        foreach ($to as $t) {
            if ($t == 'lower') :
                $str = mb_strtolower(rp(1, $str), "utf-8");
            elseif ($t == 'upper') :
                $str = mb_strtoupper(rp(2, $str), "utf-8");
            elseif ($t == 'ucfirst') :
                $str = mb_strtoupper(rp(2, mb_substr($str, 0, 1, "utf-8")), "utf-8") . mb_substr($str, 1, mb_strlen($str, "utf-8") - 1, "utf-8");
            elseif ($t == 'ucwords') :
                $str = ltrim(mb_convert_case(rp(3, ' ' . $str), MB_CASE_TITLE, "utf-8"));
            elseif ($t == 'capitalizefirst') :
                $str = cf(array('. ', '.', '? ', '?', '! ', '!', ': ', ':'), $str);
            else :
                $str = te();
            endif;
        } else :
        $str = te();
    endif;
    return $str;
}

// Turkish Date
function turkishDate($f, $zt = 'now')
{
    $z = date("$f", strtotime($zt));
    $donustur = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach ($donustur as $en => $tr) {
        $z = str_replace($en, $tr, $z);
    }
    if (strpos($z, 'Mayıs') !== false && strpos($f, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}

// Turkish Time Ago
function time_ago($timestamp)
{

    date_default_timezone_set("Europe/Istanbul");
    $time_ago        = strtotime($timestamp);
    $current_time    = time();
    $time_difference = $current_time - $time_ago;
    $seconds         = $time_difference;

    $minutes = round($seconds / 60); // value 60 is seconds
    $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
    $weeks   = round($seconds / 604800); // 7*24*60*60;
    $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
    $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

    if ($seconds <= 60) {

        return "Henüz";
    } else if ($minutes <= 60) {

        if ($minutes == 1) {

            return "1 Dakika Önce";
        } else {

            return "$minutes Dakika Önce";
        }
    } else if ($hours <= 24) {

        if ($hours == 1) {

            return "1 Saat Önce";
        } else {

            return "$hours Saat Önce";
        }
    } else if ($days <= 7) {

        if ($days == 1) {

            return "Dün";
        } else {

            return "$days Gün Önce";
        }
    } else if ($weeks <= 4.3) {

        if ($weeks == 1) {

            return "1 Hafta Önce";
        } else {

            return "$weeks Hafta Önce";
        }
    } else if ($months <= 12) {

        if ($months == 1) {

            return "Bir Ay Önce";
        } else {

            return "$months Ay Önce";
        }
    } else {

        if ($years == 1) {

            return "Bir Yıl Önce";
        } else {

            return turkishDate('j F Y , l', $timestamp);
        }
    }
}

// Recursive Xss Clean
function rClean($array)
{
    $cleanedArray = [];
    foreach ($array as $key => $value) {
        if (is_array($key)) {
            $value = rClean($key);
        } else {
            $key = clean($key);
        }

        if (is_array($value)) {
            $value = rClean($value);
        } else {
            $value = clean($value);
        }
        $cleanedArray[$key] = $value;
    }
    return $cleanedArray;
}

// Format Phone Number
function formatPhoneNumber($phoneNumber)
{
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree . '-' . $lastFour;
    }

    return $phoneNumber;
}

// Format Price To Written Text
function sayiyiYaziyaCevir($sayi, $kurusbasamak, $parabirimi, $parakurus, $diyez, $bb1, $bb2, $bb3)
{
    // kurusbasamak virgülden sonra gösterilecek basamak sayısı
    // parabirimi = TL gibi , parakurus = Kuruş gibi
    // diyez başa ve sona kapatma işareti atar # gibi

    $b1 = array("", "Bir ", "İki ", "Üç ", "Dört ", "Beş ", "Altı ", "Yedi ", "Sekiz ", "Dokuz ");
    $b2 = array("", "On ", "Yirmi ", "Otuz ", "Kırk ", "Elli ", "Altmış ", "Yetmiş ", "Seksen ", "Doksan ");
    $b3 = array("", "Yüz ", "Bin ", "Milyon ", "Milyar ", "Trilyon ", "Katrilyon ");

    if ($bb1 != null) { // farklı dil kullanımı yada farklı yazım biçimi için
        $b1 = $bb1;
    }
    if ($bb2 != null) { // farklı dil kullanımı
        $b2 = $bb2;
    }
    if ($bb3 != null) { // farklı dil kullanımı
        $b3 = $bb3;
    }

    $say1 = "";
    $say2 = ""; // say1 virgül öncesi, say2 kuruş bölümü
    $sonuc = "";

    $sayi = str_replace(",", ".", $sayi); //virgül noktaya çevrilir

    $nokta = strpos($sayi, "."); // nokta indeksi

    if ($nokta > 0) { // nokta varsa (kuruş)

        $say1 = substr($sayi, 0, $nokta); // virgül öncesi
        $say2 = substr($sayi, $nokta, strlen($sayi)); // virgül sonrası, kuruş

    } else {
        $say1 = $sayi; // kuruş yoksa
    }

    $son = "";
    $w = 1; // işlenen basamak
    $sonaekle = 0; // binler on binler yüzbinler vs. için sona bin (milyon,trilyon...) eklenecek mi?
    $kac = strlen($say1); // kaç rakam var?
    $sonint = ""; // işlenen basamağın rakamsal değeri
    $uclubasamak = 0; // hangi basamakta (birler onlar yüzler gibi)
    $artan = 0; // binler milyonlar milyarlar gibi artışları yapar
    $gecici = "";

    if ($kac > 0) { // virgül öncesinde rakam var mı?

        for ($i = 0; $i < $kac; $i++) {

            $son = $say1[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
            $sonint = $son; // işlenen rakam Integer.parseInt(

            if ($w == 1) { // birinci basamak bulunuyor

                $sonuc = $b1[$sonint] . $sonuc;
            } else if ($w == 2) { // ikinci basamak

                $sonuc = $b2[$sonint] . $sonuc;
            } else if ($w == 3) { // 3. basamak

                if ($sonint == 1) {
                    $sonuc = $b3[1] . $sonuc;
                } else if ($sonint > 1) {
                    $sonuc = $b1[$sonint] . $b3[1] . $sonuc;
                }
                $uclubasamak++;
            }

            if ($w > 3) { // 3. basamaktan sonraki işlemler

                if ($uclubasamak == 1) {

                    if ($sonint > 0) {
                        $sonuc = $b1[$sonint] . $b3[2 + $artan] . $sonuc;
                        if ($artan == 0) { // birbin yazmasını engelle
                            $sonuc = str_replace($b1[1] . $b3[2], $b3[2], $sonuc);
                        }
                        $sonaekle = 1; // sona bin eklendi
                    } else {
                        $sonaekle = 0;
                    }
                    $uclubasamak++;
                } else if ($uclubasamak == 2) {

                    if ($sonint > 0) {
                        if ($sonaekle > 0) {
                            $sonuc = $b2[$sonint] . $sonuc;
                            $sonaekle++;
                        } else {
                            $sonuc = $b2[$sonint] . $b3[2 + $artan] . $sonuc;
                            $sonaekle++;
                        }
                    }
                    $uclubasamak++;
                } else if ($uclubasamak == 3) {

                    if ($sonint > 0) {
                        if ($sonint == 1) {
                            $gecici = $b3[1];
                        } else {
                            $gecici = $b1[$sonint] . $b3[1];
                        }
                        if ($sonaekle == 0) {
                            $gecici = $gecici . $b3[2 + $artan];
                        }
                        $sonuc = $gecici . $sonuc;
                    }
                    $uclubasamak = 1;
                    $artan++;
                }
            }

            $w++; // işlenen basamak

        }
    } // if(kac>0)

    if ($sonuc == "") { // virgül öncesi sayı yoksa para birimi yazma
        $parabirimi = "";
    }

    $say2 = str_replace(".", "", $say2);
    $kurus = "";

    if ($say2 != "") { // kuruş hanesi varsa

        if ($kurusbasamak > 3) { // 3 basamakla sınırlı
            $kurusbasamak = 3;
        }
        $kacc = strlen($say2);
        if ($kacc == 1) { // 2 en az
            $say2 = $say2 . "0"; // kuruşta tek basamak varsa sona sıfır ekler.
            $kurusbasamak = 2;
        }
        if (strlen($say2) > $kurusbasamak) { // belirlenen basamak kadar rakam yazılır
            $say2 = substr($say2, 0, $kurusbasamak);
        }

        $kac = strlen($say2); // kaç rakam var?
        $w = 1;

        for ($i = 0; $i < $kac; $i++) { // kuruş hesabı

            $son = $say2[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
            $sonint = $son; // işlenen rakam Integer.parseInt(

            if ($w == 1) { // birinci basamak

                if ($kurusbasamak > 0) {
                    $kurus = $b1[$sonint] . $kurus;
                }
            } else if ($w == 2) { // ikinci basamak
                if ($kurusbasamak > 1) {
                    $kurus = $b2[$sonint] . $kurus;
                }
            } else if ($w == 3) { // 3. basamak
                if ($kurusbasamak > 2) {
                    if ($sonint == 1) { // 'biryüz' ü engeller
                        $kurus = $b3[1] . $kurus;
                    } else if ($sonint > 1) {
                        $kurus = $b1[$sonint] . $b3[1] . $kurus;
                    }
                }
            }
            $w++;
        }
        if ($kurus == "") { // virgül öncesi sayı yoksa para birimi yazma
            $parakurus = "";
        } else {
            $kurus = $kurus . " ";
        }
        $kurus = $kurus . $parakurus; // kuruş hanesine 'kuruş' kelimesi ekler
    }

    $sonuc = $diyez . $sonuc . " " . $parabirimi . " " . $kurus . $diyez;
    return $sonuc;
}

// Image Rotation Converter
function correctImageOrientation($filename)
{
    if (function_exists('exif_read_data')) {
        $exif = exif_read_data($filename);
        if ($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if ($orientation != 1) {
                $img = imagecreatefromjpeg($filename);
                $deg = 0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                if ($deg) {
                    $img = imagerotate($img, $deg, 0);
                }
                // then rewrite the rotated image back to the disk as $filename
                imagejpeg($img, $filename, 100);
            } // if there is some rotation necessary
        } // if have the exif orientation info
    } // if function exists
}

/**
 * shortens the supplied text after last word
 * @param string $string
 * @param int $max_length
 * @param string $end_substitute text to append, for example "..."
 * @param boolean $html_linebreaks if LF entities should be converted to <br />
 * @return string
 */
function mb_word_wrap($string, $max_length, $end_substitute = null, $html_linebreaks = true)
{

    if ($html_linebreaks) $string = preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    $string = strip_tags($string); //gets rid of the HTML

    if (empty($string) || mb_strlen($string) <= $max_length) {
        if ($html_linebreaks) $string = nl2br($string);
        return $string;
    }

    if ($end_substitute) $max_length -= mb_strlen($end_substitute, 'UTF-8');

    $stack_count = 0;
    while ($max_length > 0) {
        $char = mb_substr($string, --$max_length, 1, 'UTF-8');
        if (preg_match('#[^\p{L}\p{N}]#iu', $char)) $stack_count++; //only alnum characters
        elseif ($stack_count > 0) {
            $max_length++;
            break;
        }
    }
    $string = mb_substr($string, 0, $max_length, 'UTF-8') . $end_substitute;
    if ($html_linebreaks) $string = nl2br($string);

    return $string;
}

// Function to get the user IP address
function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if ($ip === "::1") {
        $ip = "localhost";
    }
    return $ip;
}

function getFileName($id)
{
    $ci = &get_instance();
    $ci->load->model("product_image_model");
    $fileName = $ci->product_image_model->get(
        array(
            "id" => $id
        )
    );
    return $fileName->img_url;
}

function get_readable_date($date)
{
    return strftime('%e %B %Y', strtotime($date));
}
function get_active_user()
{
    $t = &get_instance();
    $user = $t->session->userdata("user");
    if ($user) {
        return $user;
    } else {
        return false;
    }
}
function get_activity_category_title($id)
{
    $ci = &get_instance();
    $ci->load->model("activity_category_model");
    $item = $ci->activity_category_model->get(['id' => $id]);
    return $item->title;
}
function get_portfolio_cover($id)
{
    $t = &get_instance();
    $t->load->model("portfolio_image_model");
    $photo = $t->portfolio_image_model->get([
        "portfolio_id" => $id,
        "isCover" => 1
    ]);
    if ($photo) {
        return $photo->img_url;
    } else {
        return "default_image.png";
    }
}


function get_test_title($id)
{
    $ci = &get_instance();
    $ci->load->model("test_model");
    $item = $ci->test_model->get(['id' => $id]);
    return $item->title;
}
function get_news_category_title($id)
{
    $ci = &get_instance();
    $ci->load->model("news_category_model");
    $item = $ci->news_category_model->get(['id' => $id]);
    return $item->title;
}
function get_rank($id, $model)
{
    $t = &get_instance();
    $t->load->model($model);
    $rank = $t->$model->get(["id" => $id]);
    return $rank;
}
function get_news_title($id)
{
    $ci = &get_instance();
    $ci->load->model("news_model");
    $item = $ci->news_model->get(['id' => $id]);
    return $item->title;
}
function get_count($model)
{
    $t = &get_instance();
    $t->load->model($model);
    $count = $t->$model->rowCount([
        "isActive" => 1
    ]);
    return $count;
}
function get_voting_title($id)
{
    $ci = &get_instance();
    $ci->load->model("votings_model");
    $item = $ci->votings_model->get(['id' => $id]);
    return $item->title;
}

function get_book_category_title($id)
{
    $ci = &get_instance();
    $ci->load->model("book_category_model");
    $item = $ci->book_category_model->get(['id' => $id]);
    return $item->title;
}
function get_cinema_category_title($id)
{
    $ci = &get_instance();
    $ci->load->model("cinema_category_model");
    $item = $ci->cinema_category_model->get(['id' => $id]);
    return $item->title;
}
function isAdmin()
{
    $t = &get_instance();
    $user = $t->session->userdata("user");

    return true;
}
function getControllerList()
{

    $t = &get_instance();

    $controllers = array();
    $t->load->helper("file");

    $files = get_dir_file_info(APPPATH . "controllers", FALSE);

    foreach (array_keys($files) as $file) {
        if ($file !== "index.html") {
            $controllers[] = strtolower(str_replace(".php", '', $file));
        }
    }

    return $controllers;
}
function get_controller_name($seo)
{
    $t = &get_instance();

    $tr = [
        'activity' => "Etkinlik",
        "product_categories" => "Ürün Kategorileri",
        'product' => "Ürünler",
        'activity_category' => "Etkinlik Kategori",
        'advertisement' => "İlanlar",
        'book' => "Kitaplar",
        'book_category' => "Kitap Kategori",
        'brands' => "Markalar",
        'cinema' => "Sinema Filmleri",
        'cinema_category' => "Film Kategorileri",
        'dashboard' => "Admin Panel",
        'emailsettings' => "Mail Ayarları",
        'galleries' => "Galeriler",
        'home_banner' => "Anasayfa Banner",
        'news' => "Haberler",
        'news_box' => "Haber İçinde widget Haber",
        'news_categories' => "Haber Kategori",
        'options' => "Test Şıkları",
        'questions' => "Test Soruları",
        'settings' => "Site Ayarları",
        'slides' => "Slider",
        'social_media_talk' => "Haber Sosyal Medya Widget",
        'test' => "Test Soruları",
        'users' => " Kullanıcılar",
        'user_role' => "Kullanıcı Yetkileri",
        'video' => "Videolar",
        'votings' => "Oylama Soruları",
        'voting_options' => "Oylama Şıkları",
        'writers' => "Yazarlar/Editörler"
    ];
    foreach ($tr as $key => $v) {
        if ($key == $seo) {
            return $v;
        }
    }
}
function isAllowedViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');

    if (isset($user_roles[$user->role_id])) {
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->read)) {
            return true;
        }
    }

    return false;
}
function isAllowedWriteViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');

    if (isset($user_roles[$user->role_id])) {
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->write)) {
            return true;
        }
    }

    return false;
}
function isAllowedUpdateViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');

    if (isset($user_roles[$user->role_id])) {
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->update)) {
            return true;
        }
    }

    return false;
}
function isAllowedDeleteViewModule($modulName = "")
{
    $t = &get_instance();
    $modulName = (empty($modulName)) ? $t->router->fetch_class() : $modulName;
    $user = get_active_user();
    $user_roles = $t->session->userdata('user_roles');

    if (isset($user_roles[$user->role_id])) {
        $permission = json_decode($user_roles[$user->role_id]);
        if (isset($permission->$modulName) && isset($permission->$modulName->delete)) {
            return true;
        }
    }

    return false;
}

function userRole()
{
    $t = &get_instance();
    $t->load->model("user_role_model");
    $c = $t->user_role_model->get_all(['isActive' => 1]);
    $roles = [];
    foreach ($c as $v) {
        $roles[$v->id] = $v->permissions;
    }
    $t->session->set_userdata('user_roles', $roles);
}
function send_email($toEmail = "", $subject = "", $message = "")
{
    $t = &get_instance();
    $t->load->model("emailsettings_model");
    $emailsettings = $t->emailsettings_model->get(
        array(
            "isActive" => 1
        )
    );
    $config = array(
        "protocol" => $emailsettings->protocol,
        "smtp_host" => $emailsettings->host,
        "smtp_port" => $emailsettings->port,
        "smtp_user" => $emailsettings->user,
        "smtp_pass" => $emailsettings->password,
        "starttls" => true,
        "charset" => "utf-8",
        "mailtype" => "html",
        "wordwrap" => true,
        "newline" => "\r\n"
    );
    $t->load->library("email", $config);
    $t->email->from($emailsettings->from, $emailsettings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);
    return $t->email->send();
}
function get_settings()
{
    $t = &get_instance();
    $t->load->model("settings_model");
    if ($t->session->userdata("settings")) {
        $settings = $t->session->userdata("settings");
    } else {
        $settings = $t->settings_model->get();
        if (!$settings) {
            $settings = new stdClass();
            $settings->company_name = "CMS";
            $settings->logo = "default";
        }
        $t->session->set_userdata("settings", $settings);
    }
    return $settings;
}
function get_category_title($category_id = 0)
{
    $t = &get_instance();
    $t->load->model("portfolio_category_model");
    $category = $t->portfolio_category_model->get(
        array(
            "id" => $category_id
        )
    );
    if ($category) {
        return $category->title;
    } else {
        return "<b style='color:red'>Tanımlı Değil</b>";
    }
}
function get_product_category_title($category_id = 0)
{
    $t = &get_instance();
    $t->load->model("product_category_model");
    $category = $t->product_category_model->get(
        array(
            "id" => $category_id
        )
    );
    if ($category) {
        return $category->title;
    } else {
        return "<b style='color:red'>Tanımlı Değil</b>";
    }
}
function get_banner_photo($seo)
{
    $t = &get_instance();
    $t->load->model("home_banner_model");
    $photo = $t->home_banner_model->get([
        "title" => $seo
    ]);
    return $photo->img_url;
}
function get_product_cover_photo($id)
{
    $t = &get_instance();
    $t->load->model("product_image_model");
    $photo = $t->product_image_model->get(
        array(
            "product_id" => $id,
            "isCover" => 1
        )
    );
    if ($photo) {
        return $photo->img_url;
    } else {
        return "myresim2.jpg";
    }
}
//$_FILES["img_url"]["tmp_name"]
//100,200
//uploads/$t->viewFolder/deneme.png
function upload_picture($file, $uploadPath, $width, $height, $name)
{
    $t = &get_instance();
    $t->load->library("simpleimagelib");
    if (!is_dir("{$uploadPath}/{$width}x{$height}")) {
        mkdir("{$uploadPath}/{$width}x{$height}");
    }
    $upload_error = false;
    try {
        $simpleImage = $t->simpleimagelib->get_simple_image_instance();
        $simpleImage
            ->fromFile($file)
            //->thumbnail($width,$height,'center')
            ->toFile("{$uploadPath}/{$width}x{$height}/$name", null, 75);
    } catch (Exception $err) {
        $error =  $err->getMessage();
        $upload_error = true;
    }
    if ($upload_error) {
        echo $error;
    } else {
        return true;
    }
}
function get_picture($path = "", $picture = "", $resolution = "50x50")
{
    if ($picture != "") {
        if (file_exists(FCPATH . "panel/uploads/$path/$resolution/$picture")) {
            $picture = base_url("panel/uploads/$path/$resolution/$picture");
        } else {
            $picture = base_url("assets/assets/images/default_image.png");
        }
    } else {
        $picture = base_url("assets/assets/images/default_image.png");
    }
    return $picture;
}
function get_page_list($page = null)
{
    $page_list = array(
        "home_v"                => "Anasayfa",
        "about_v"               => "Hakkımızda Sayfası",
        "news_list_v"           => "Haberler Sayfası",
        "galleries"             => "Galeri Sayfası",
        "portfolio_list_v"      => "Portfolyo Sayfası",
        "reference_list_v"      => "Referanslar Sayfası",
        "service_list_v"        => "Hizmetler Sayfası",
        "course_list_v"         => "Eğitimler Sayfası",
        "brand_list_v"          => "Markalar Sayfası",
        "contact_v"             => "İletişim Sayfası",
    );
    return (empty($page)) ? $page_list : $page_list[$page];
}


// ADDRESS MODEL IS IN THE AUTOLOAD NO NEED TO RE-LOAD THEM.
// GET CITIES OR CITY
function get_cities($city_id = null)
{
    $t = &get_instance();
    $cities = [];
    if (!empty($city_id)) :
        array_push($cities, $t->address_model->get("cities", [
            "city_id" => $city_id
        ]));
    else :
        $cities = $t->address_model->get_all("cities");
    endif;
    return $cities;
}

// GET DISTRICTS OR DISTRICT
function get_districts($city_id, $district_id = null)
{
    $districts = [];
    if (!empty($city_id)) :
        $t = &get_instance();
        if (!empty($district_id)) :
            array_push($districts, $t->address_model->get("districts", [
                "cities_id" => $city_id,
                "district_id" => $district_id
            ]));
        else :
            $districts = $t->address_model->get_all("districts", ["cities_id" => $city_id]);
        endif;
    endif;
    return $districts;
}

// GET NEIGHBORHOODS OR NEIGHBORHOOD
function get_neighborhoods($district_id, $neighborhood_id = null)
{
    $neighborhoods = [];
    if (!empty($district_id)) :
        $t = &get_instance();

        if (!empty($neighborhood_id)) :
            array_push($neighborhoods, $t->address_model->get("neighborhoods", [
                "districts_id" => $district_id,
                "neighborhood_id" => $neighborhood_id
            ]));
        else :
            $neighborhoods = $t->address_model->get_all("neighborhoods", ["districts_id" => $district_id]);
        endif;
    endif;
    return $neighborhoods;
}

// GET QUARTERS OR QUARTER WITH POSTAL CODE
function get_quarters($neighborhood_id, $quarter_id = null)
{
    $quarters = [];
    if (!empty($neighborhood_id)) :
        $t = &get_instance();

        if (!empty($quarter_id)) :
            array_push($quarters, $t->address_model->get("quarters", [
                "neighborhoods_id" => $neighborhood_id,
                "quarter_id" => $quarter_id
            ]));
        else :
            $quarters = $t->address_model->get_all("quarters", ["neighborhoods_id" => $neighborhood_id]);
        endif;
    endif;
    return $quarters;
}
