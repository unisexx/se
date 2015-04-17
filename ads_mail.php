#!/usr/local/bin/php
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('application/helpers/MY_url_helper.php');
include('adodb/adodb.inc.php');
include('autopost/config.php');
$db = ADONewConnection($_config['dbdriver']);
$db->Connect($_config['server'],$_config['username'],$_config['password'],$_config['database']);
$db->Execute('SET character_set_results=utf8');
$db->Execute('SET collation_connection=utf8_unicode_ci');
$db->Execute('SET NAMES utf8');
//$db->debug = true;

$mail = $db->GetRow("select * from newsletters where id = 1");
$max_id = $db->GetOne('select max(id) from newsletters_email_lists where status="approve"');

$last_id = $db->GetOne('select id from newsletters_email_lists where current = "this"');
if($max_id == $last_id){
    $current = $db->GetRow("select * from newsletters_email_lists where id = (SELECT min(id) AS id FROM newsletters_email_lists WHERE id > 0 and status='approve')");
}else{
    $current = $db->GetRow("select * from newsletters_email_lists where id = (SELECT min(id) AS id FROM newsletters_email_lists WHERE id > ".$last_id." and status='approve')");
}

$db->Execute("UPDATE newsletters_email_lists SET current='this' WHERE id = ".$current['id']);
$db->Execute("UPDATE newsletters_email_lists SET current='' WHERE id <> ".$current['id']);

// echo "ส่งเมล์ไปที่ ".$current['email'];
send_mail($current['email'],$mail['title'],$mail['detail']);

function send_mail($email,$subject,$message){
    // ###### PHPMailer #### 
    require_once("PHPMailer_v5.1/class.phpmailer.php"); // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'ssl://smtp.googlemail.com';
    $mail->Port = 465;
    $mail->Username = 'kpoplover.info@gmail.com';
    $mail->Password = 'Des@gn;9';
    $mail->SMTPAuth = true;
    $mail->CharSet = "utf-8";
    $mail->From = "kpoplover.info@gmail.com";       //  account e-mail ของเราที่ใช้ในการส่งอีเมล
    $mail->FromName = "kpoplover.com";
    $mail->IsHTML(true);                            // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
    $mail->Subject = $subject;            // หัวข้อที่จะส่ง
    $mail->Body = $message;              // ข้อความ ที่จะส่ง
    $mail->SMTPDebug = false;
    $mail->do_debug = 0;
    $mail->AddAddress($email);                      // Email ปลายทางที่เราต้องการส่ง
    $mail->send();
    $mail->ClearAddresses();
    // if (!$mail->send())
    // {                                                                            
        // echo "Mailer Error: " . $mail->ErrorInfo;
        // exit;                        
    // }
}
?>