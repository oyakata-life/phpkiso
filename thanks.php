<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>サンクス</title>
  </head>
  <body>
<?php
  try 
  {
    $nickname=$_POST['nickname'];
    $email=$_POST['email'];
    $goiken=$_POST['goiken'];

    $dsn='mysql:dbname=phpkiso;host=localhost';
    $user='test';
    $password='test1234';
    $dbh=new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $sql='INSERT INTO anketo (nickname, email, goiken) VALUES ("'.$nickname.'","'.$email.'","'.$goiken.'")';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $dbh=null;

    print $nickname;
    print '様<br />';
    print 'ご意見ありがとうございました。<br />';
    print '頂いたご意見「';
    print $goiken;
    print '」<br />';
    print $email;
    print 'にメールを送りましたのでご確認ください。';

    $mail_sub='アンケートを受け付けました。';
    $mail_body=$nickname."様へ\nアンケートご協力ありがとうございました。";
    $mail_body=html_entity_decode($mail_body,ENT_QUOTES,"UTF-8");
    $mail_head='Form:no-reply@oyakata-life.net';
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($email,$mail_sub, $mail_body, $mail_head);

  }
  catch (Exception $e) 
  {
    print '障害が発生しています。';
  }

?>
  </body>
</html>