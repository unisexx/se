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
// $db->debug = true;

$mails = $db->GetArray("select * from banners WHERE datediff(end_date, now()) = 7 or datediff(end_date, now()) = 3 or datediff(end_date, now()) = 1");

// print_r($mails);

foreach($mails as $row){
	if($row['email'] != ""){
		$email = $row['email'];
		$title = "แจ้งเตือนแบนเนอร์หมดอายุครับ (kpoplover.com)";
		$detail ='
		สวัสดีครับ ร้านค้า <br> '.$row['url'].'<br><br>
		
		แบนเนอร์ของคุณจะหมดอายุในวันที่  '.DB2Date($row['end_date']).'<br>
		
		คุณสามารถต่ออายุแบนเนอร์ได้ใน ราคาเดิมนะครับ<br><br>
		
		200 บาท/เดือน, หรือเหมา 3 เดือน (600 บาท) ลดพิเศษในราคาเพียง 500 บาท<br>
		หรืออ่านรายละเอียดเพิ่มเติมตามลิ้งค์ http://www.kpoplover.com/tickers/view/2<br><br>
		โดยโอนเงินชำระค่าโฆษณามาที่<br>
		<table border="1" style="border-collapse: collapse;">
			<tr>
				<th width="70">ธนาคาร</th>
				<th width="100"></th>
				<th width="120">สาขา</th>
				<th width="120">เลขบัญชี</th>
				<th width="150">ชื่อบัญชี</th>
				<th width="120">ประเภทบัญชี</th>
			</tr>
			<tr align="center">
				<td><img src="https://lh5.googleusercontent.com/SggE_bo4XLpnBiy7v4q2k2OmpTZqH1GSZ1C9VvcRglG4vyq6T_RsihLQfEfW12FSAG38x1259Bbx6mX5oTWl7NEkVFwcUa-nWlDTCo99Zvi9PDDGrWNRaC-4" width="24" height="24"></td>
				<td>ไทยพาณิชย์</td>
				<td>เซ็นทรัลปิ่นเกล้า2</td>
				<td>264-213509-3</td>
				<td>นายรัฐศักดิ์ เพิ่มชอบ</td>
				<td>ออมทรัพย์</td>
			</tr>
			<tr align="center">
				<td><img src="https://lh5.googleusercontent.com/AlNxOwcB7rM0HjCOmFYKtWED9ERdCt-1hurGj1uOp3WSqWJDZmikbZHrYdFQSkWRhWx6N9BrhllOmMtCvspSJMq-sY26VfkjwevtJtD7QphJmGzHihhxK6rt" width="24" height="24"></td>
				<td>กรุงเทพ</td>
				<td>เซ็นทรัลปิ่นเกล้า2</td>
				<td>909-0-19904-4</td>
				<td>นายรัฐศักดิ์ เพิ่มชอบ</td>
				<td>สะสมทรัพย์</td>
			</tr>
			<tr align="center">
				<td><img src="https://lh3.googleusercontent.com/lvUlCh02_DyY2cA1IgWEgRTNCeouCSg0Dy2z4eYOMCuiEeulNa6OaKTaVMZAx3EIoRWpap6sJQfK6YsLFdo4xTbqRTVs0x7iOrFiJfmoG3TmtiErOouCEFnu" width="24" height="24"></td>
				<td>กสิกรไทย</td>
				<td>เซ็นทรัลปิ่นเกล้า</td>
				<td>758-2-94744-3</td>
				<td>นายรัฐศักดิ์ เพิ่มชอบ</td>
				<td>ออมทรัพย์</td>
			</tr>
			<tr align="center">
				<td><img src="https://lh3.googleusercontent.com/nJxiwUcR5ft7zVsWYkGkL73GzxEp6H-JBVP1-6NGTVsquzKyYPYRiKNaWf_7lpyJY4FnQQn99BCnnxWTXdt6ljwLJGypEiOtWx8HlM51E2LmAbmjHrla9IeH" width="24" height="24"></td>
				<td>กรุงไทย</td>
				<td>รามอินทรา กม.2</td>
				<td>060-0-41846-4</td>
				<td>นายรัฐศักดิ์ เพิ่มชอบ</td>
				<td>ออมทรัพย์</td>
			</tr>
		</table><br>
		เมื่อโอนแล้วให้ทำการแจ้งโอนมาที่อีเมล์ kpoplover.info@gmail.com<br>
		เมื่อทางเราตรวจสอบเรียบร้อยแล้วจะทำการแจ้งกลับให้เร็วที่สุดครับ<br><br>
		
		ขอบคุณครับ<br>
		ทีมงาน kpoplover.com<br>
		Tel. 085-861-6058
		';
		
		send_mail($email,$title,$detail);
	}
}

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

function DB2Date($Dt){ 
	if(($Dt!=NULL)&&($Dt != '0000-00-00')){
		@list($date,$time) = explode(" ",$Dt);
		list($y,$m,$d) = explode("-",$date);
		return $d."/".$m."/".($y+543);
	}else{
		$Dt = "";
		return $Dt; 
	}
}
?>