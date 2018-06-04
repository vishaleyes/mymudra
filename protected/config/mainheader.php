<?php

define("MANDRILL_USERNAME","test");
define("MANDRILL_PASSWORD","test");

define("MANDRILL_HOST","smtp.sendgrid.net");
define("MANDRILL_PORT","587");
define("MANDRILL_SMTPSECURE","tls");


define('DEFAULT_CONTROLLER',"admin");
define('DEFAULT_ACTION',"index");
define('DEFAULT_LANGUAGE',"eng");
define('DEFAULT_THEME',1);


// charset for web pages and emails

$basepath = str_replace("\\","/",dirname(dirname(__FILE__)));
$basepath .= "/";



define('BASEPATH',  $basepath);
define("_SITENAME_",'Mymudra');
define("_SITENAME_NO_CAPS_",'Mymudra');
define("_SITENAME_CAPS_",'Mymudra');

//Set partner role
//define('PARTNER_ROLE_ID',  6);

$is_live = true;  // for live dfault

if(isset($_SERVER['SERVER_NAME'])) {
    if($_SERVER['SERVER_NAME'] == "localhost") {
        $is_live = false;  //false is for local
    }
}
$baseUrl="";
if($is_live)
{
    //Local
    define('WEB_HOST_NAME','mymudra.com');
    define('SITE_NAME','MyMudra');
    //$baseUrl.=WEB_HOST_NAME.'/viia';
    $baseUrl.=WEB_HOST_NAME.'/mymudra';
    define('FILE_UPLOAD', '/var/www/html/mymudra/assets/upload/');
    define('FILE_PATH','/var/www/html/mymudra/');
    define('DEFAULT_FILE_PATH','/var/www/html/mymudra/');
    define('LOGS_PATH','/var/www/html/dlogs/');
    define('DB_SERVER', 'localhost');
    define('DB_SERVER_USERNAME', 'bypt');
    define('DB_SERVER_PASSWORD', 'Bypt@2012');
    define('DB_DATABASE', 'mymudra');
    define('MAIL_SERVER_FROMNAME', 'no-reply@mymudra.com');
    define('MAIL_SERVER', 'mymudra.com');
    define('MAIL_SERVER_USERNAME', 'no-reply');
    define('MAIL_SERVER_PASSWORD', 'nor373');
    define('MAIL_SERVER_PORT_DEFAULT', true);
    define('MAIL_SERVER_SMTP_SECURE', false);
    define('MAIL_SERVER_SMTP_AUTH', false);
    define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/');
    define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/m/');
    define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/');
    define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/');
    define('DOMAIN_NAME', 'mymudra.com');
    define('SMS_NUMBER', '');
    define('USE_SOLR', 'true'); // false -> no, true -> yes
    define('ADMIN_EMAIL','vishal.panchal@bypt.in');
    define('API_KEY_GOOGLE_MAP','ABQIAAAAGadnb68hworsU9g2Ph1YBRQtlEzpQNiw_VFD179wQexLmE_W-xSNBeBdeZKJg37poRNks4BNN4lExQ');

}
else
{

    //Local
    define('WEB_HOST_NAME','localhost');
    define('SITE_NAME','MyMudra');
    $baseUrl.=WEB_HOST_NAME.'/MyMudra';
    $filename="D:/wamp/www/MyMudra";
    if (file_exists($filename)) {

        /*define('FILE_UPLOAD', 'C:/wamp64/www/viia/assets/upload/');
        define('FILE_PATH','C:/wamp64/www/viia/');
        define('LOGS_PATH','C:/wamp64/www/viia/dlogs/');
        define('DEFAULT_FILE_PATH','C:/wamp64/www/viia/');*/

        define('FILE_UPLOAD', 'D:/wamp/www/mymudra/assets/upload/');
        define('FILE_PATH','D:/wamp/www/MyMudra/');
        define('LOGS_PATH','D:/wamp/www/mymudra/dlogs/');
        define('DEFAULT_FILE_PATH','D:/wamp/www/mymudra/');
    }
    /*else
    {
        define('FILE_UPLOAD', 'E:/wamp/www/viia/assets/upload/');
        define('FILE_PATH','E:/wamp/www/viia/');
        define('LOGS_PATH','E:/wamp/www/viia/dlogs/');
          define('DEFAULT_FILE_PATH','E:/wamp/www/viia/');
    }*/
    else
    {
        /*define('FILE_UPLOAD', 'D:/wamp/www/viia/assets/upload/');
        define('FILE_PATH','D:/wamp/www/viia/');
        define('LOGS_PATH','D:/wamp/www/viia/dlogs/');
        define('DEFAULT_FILE_PATH','D:/wamp/www/viia/');*/

        define('FILE_UPLOAD', 'D:/wamp/www/MyMudra/assets/upload/');
        define('FILE_PATH','D:/wamp/www/MyMudra/');
        define('LOGS_PATH','D:/wamp/www/MyMudra/dlogs/');
        define('DEFAULT_FILE_PATH','D:/wamp/www/MyMudra/');
    }

    // Data base
    define('DB_SERVER', 'BYPTSERVER');
    define('DB_SERVER_USERNAME', 'bypt');
    define('DB_SERVER_PASSWORD', 'Bypt@2012');
    define('DB_DATABASE', 'mymudra');
    define('MAIL_SERVER', 'smtp.gmail.com');
    define('MAIL_SERVER_FROMNAME', 'no-reply@'._SITENAME_NO_CAPS_.'.com');
    define('MAIL_SERVER_USERNAME', 'mymudra@gmail.com');
    define('MAIL_SERVER_PASSWORD', '123456');
    define('MAIL_SERVER_PORT_DEFAULT', false);
    define('MAIL_SERVER_SMTP_SECURE', true);
    define('MAIL_SERVER_SMTP_AUTH', true);
    define('SMS_NUMBER', '9724882220');
    define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
    define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/m/');
    define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
    define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
    define('USE_SOLR', 'false');
    define('ADMIN_EMAIL','vpanchal911@gmail.com');
    //define('API_KEY_GOOGLE_MAP','ABQIAAAAoKEOVeH5Ak8SaEmM-hRytBRSYwPj9khfICxBbljTfsfiJS8R_BRzFQ9tZSd52bOGUKRQru8MIcs0aA');
    define("API_KEY_GOOGLE_MAP","AIzaSyAUd4Nkyxh9_vff93YnEPeCuCaJLrwjMK0");
}

define('ENCRIPT_KEY','test123');
/////////////////////////////////////////////////
define('MAIL_FROM_NAME',_SITENAME_.'.com');
define('MAIL_FROM','no-reply@'._SITENAME_NO_CAPS_.'.com');

define('DB_TYPE', 'mysql');
define('DB_PREFIX', '');

define('USE_PCONNECT', 'false');
define('STORE_SESSIONS', 'db');
define('SQL_CACHE_METHOD', 'none');

define('PAGINATE_LIMIT', '5');
define('ADMIN_PAGINATE_LIMIT', '10');
define('SEEKER_PAGINATE_LIMIT', '6');
define('RECENT_ACTIVITY_PAGINATE_LIMIT', '10');
define('LIMIT_10', '3');

define('IMAGESIZE','2');

//For rest Api
define("REST_REQUEST_STATUS",200);
// for check authorize

//Allow image extention
$extArray=array('jpg','jpeg','png','gif','GIF','PNG','JPEG','JPG');
define("IMAGE_EXT",serialize($extArray));
//Allow file extention
$fileExtNotAllowArray=array('php','exe');
define("FILE_NOT_EXT",serialize($fileExtNotAllowArray));


//Register Link Expiry Time
define("ACTIVATION_LINK_EXPIRY_TIME",3 * 24 * 60 * 60);// 3 days; 24 hours; 60 mins; 60secs

//Api Link Expiry Time
define("API_LINK_EXPIRY_TIME",2*60*60);
$NOT_ALLOW_CHAR=array('<','>','[',']','{','}','|','%','/','/\/','~','#','^');
define("NOT_ALLOW_CHAR",serialize($NOT_ALLOW_CHAR));
ini_set('memory_limit', '-1');