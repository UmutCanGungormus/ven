<?php
if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
    $basepath = "https://".$_SERVER["HTTP_HOST"];
}else{
    $basepath = "http://".$_SERVER["HTTP_HOST"];
}
require_once ("application/vendor/autoload.php");
use Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC/53OXohedIuE8
J3XuXhgvQVdxFEzMeSTDz2ADqWqTgdM9VFL+Bj9BWvQI9lc4fL5nLlGdl6DbHGAK
p9UOkETb4lAWhx3xLtBCTD1skRvlV4lA5aYjFgcfzTh0td+uXdKwgtQ7RjUZXE/J
NT5yQ/AdIwQWiu3sH0UVfqyJRaocscSl8rwtKB3ly5zqpXPzUZD0cTT0QKdJgWp5
pxvPZtpb3IUyhQOtCjKgULPXIbRSFM+7GRTsW6r9wfm2l03pyiVFFdaAru21C4Nt
HF1pWQ8VwTfPRdBVRh9+n4/laojIJ4Hx4WDOBf+LSZa/JD/VQYVvW/Pq/6stmllA
aSk3x+7ZAgMBAAECggEAVM8R26pr6yr2BWKfELgO0ht7bGL/ScIkCFFGanfdvNC8
LTdt8guKuvRaMvfDNhiTAQCMWywej5brrunbE7OYauCKalpOVj9NFG+jGa7LeECG
TOLw2EKs5VYJpDKYZvPZ394Bsyxk3Q9Zx187eL4jiIzoCppdaWOsYUJ5N7VM5563
YPgzYHocA/9Z/CrqyeQjI21iACo8AZlCds74CIC3THS1pADYwo1ptErpgxTNBpxh
6Fr/WOuijYaOJIqpgbx9WjSGwA0khDzKL0Z90iZ342+92ATvMZLmSOHobspcmmOq
5bzByT95BPMomxROtlC9fll8Rp3OXzOVuSZinZX/AQKBgQD3jC+53j02s9qZHep8
e382WykfsPS4gxA5cn+MCaukVDGfxBLD/t4icGRNWZBYWKAyAt+b0duycZHAa5t/
bsquz+vuvH710C/GFaNh6UlhvWW4iJaJlLewPpYImQVEcYDLZ9wc1PcHoZ9Zak4I
AIn+wADaelVKGguiRWZ+YXlaeQKBgQDGdOKj5zl+cdxilUazXcYzQIIdgTOx7g47
Jdkb+GOX2R89x0XGEBruZhmoNR8pA8aVR+RpFFJZbdEscLovuNxzghiU4RUjKmrh
m2Jqe/LYK5eCtSwkIDf01XTdaMdrRp+8lNMgedjmEns2P9YfaZg/P515RSjxZ/gQ
2z4aF5gfYQKBgQC9/3X+Jeo72y1TyldYdf08vhlBPrOGDupb/VqSJDX+abSw2HBC
yJK8QiFqEO0uMc+6suPnl9oVCwAAfVcbJvEf3WxLj5eumbyhP6hoFQMCpri1Ovi3
3lJiTpcfQDt/vdJJzIxwALEdxVol6ea8U5WW1s2Q4sYlmvoE8VlqdOwMmQKBgBkH
GqIDAhwxLdL88mqic+F4zC/+YE+bLw5EiqndXGoFBsyaufDtjQfttmShNmnMwRmI
dITP/Eas88k/+isUjDDBAmqcLDdAHTSQjQvSz+B1NulUAdoYehYVaWSW1zdvM6vr
tOiOlU0GnaVMzasufPXVBv4JO82eCAnQLHfL6/JhAoGBAM5NATxGU+5naTOLZKB1
OE8ChmEVaR0ytVGHZr0GojLv79f5xkXNixnbj3iTGbU0GtMEcTXlB7pe79pYfAZL
Ge98/0c/nADM2HtzI778j03gu5w+l1bwdtLGzDlwDe3XKJxXSPM9Jbu1LWLSXxRO
jMe8jhjxsERzs9YActR4gcHv
-----END PRIVATE KEY-----
EOD;

$payload = array(
    // Unique user id string
    "sub" => "123",

    // Full name of user
    "name" => "Erman Erzübek",

    // Optional custom user root path
    // "https://claims.tiny.cloud/drive/root" => "/johndoe",

    // 10 minutes expiration
    "exp" => time() + 60 * 10
);

try {
    $token = JWT::encode($payload, $privateKey, 'RS256');
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(array("token" => $token));
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo $e->getMessage();
}
?>