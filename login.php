<?
// gunakan variabel session pada halaman ini. 
// fungsi ini harus diletakkan di awal halaman.
session_start();

////// Bagian Logout. Delete variabel session.
session_destroy();
$message="";

////// Bagian Login.
$Login=$_POST['Login'];

if($Login){ // jika tombol Login diklik.
   $username=$_POST['username'];
   // Encrypt password dengan fungsi md5(). 
   $md5_password=md5($_POST['password']); 

   // Connect ke database. 
   $host="localhost"; // Host name.
   $db_user=""; // MySQL username.
   $db_password=""; // MySQL password.
   $database="tutorial"; // Database.
   mysql_connect($host,$db_user,$db_password);
   mysql_select_db($database);

   // Cocokkan  username dan password.
   $result=mysql_query("select * from admin where username='$username' and password='$md5_password'");
   
   // Jika cocok.   
   if(mysql_num_rows($result)!='0'){ 
       session_register("username"); // buat session username.
       header("location:main.php"); // Re-direct ke main.php
       exit;
   } else{ // Jika tidak cocok.
      $message="--- Username atau Password SALAH---";
   }
} // akhir dari otorisasi Login.

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Halaman Login</title>
</head>
<body>
<? echo $message; ?>
<form id="form1" name="form1" method="post" action="<? echo $PHP_SELF; ?>">

<table>
   <tr>
     <td>Username : </td>
     <td><input name="username" type="text" id="username" /></td>
   </tr>
   <tr>
     <td>Password : </td>
     <td><input name="password" type="password" id="password" /></td>
   </tr>
</table>

<input name="Login" type="submit" id="Login" value="Login" />
</form>
</body>
</html> 
