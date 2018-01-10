<?php
error_reporting(0);
function check($email){
$data = json_decode(file_get_contents("https://team.tatsumi-crew.net/api.php?email={$email}")); //buat link apinya sewaktu waktu script gw hapus :p//


if($data->status == "valid"){
   $kota = $data->country;
   $hasil = fopen("APAL.txt","a");
   fwrite($hasil, "LIVE ".$email."\n");
   fclose($hasil);
   return  "\e[0;32m [ Live - $kota ] \e[m ";
}elseif($data->status == "limited"){
  $kota = $data->country;
  $hasil = fopen("TEAPAL.txt","a");
   fwrite($hasil, "[Limited] ".$email."\n");
   fclose($hasil);

   return "\e[0;34m [ Limited - $kota ] \e[m";
}elseif ($data->status == "invalid"){
   $hasil = fopen("MODAR.txt","a");
   fwrite($hasil, "[Invalid] ".$email."\n");
   fclose($hasil);
  return "\e[0;31m [ Die ] \e[m";
}else{
  return "[CHECKING PROBLEM - CONTACT OWNER]";
}
}

if(isset($argv[1])){
if(file_exists($argv[1])){
cover();
$no=1;

$load = file_get_contents($argv[1]);
$mail_explode = explode("\r\n", $load);
$cont = count($mail_explode);

foreach ($mail_explode as $key => $email) {
    echo "[ $no / $cont ] - $email => ";
    if($mail_explode){
        echo check($email,$api);
       	echo " Rootasuna \r\n";
    }else{
        echo "Invalid! \r\n";
    }
$no++;
}

echo "\r\n\r\n[DONE] Saved On Registered PayPal | Total : $cont\r\n";

}
}else{
    echo "php ".$argv[0]." {list} \r\n";
}

function cover(){
$cover.="--------------------------------------------  \r\n";
$cover.="               Yuuki Asuna                   	\r\n";
$cover.="  											  	\r\n";
$cover.="--------------------------------------------  	\r\n";
$cover.="\r\n\r\n";
echo $cover;
}

?>
