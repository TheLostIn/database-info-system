<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET,POST');
header('Access-Control-Allow-Headers: Content-Type');
// session_start();
// /*
// ini_set("display_errors", "On");

// error_reporting(E_ALL | E_STRICT);
// */
set_time_limit(0);         //取消脚本执行延时上限

ignore_user_abort(TRUE); //如果客户端断开连接，不会引起脚本abort
ini_set('memory_limit','2048M');

require_once './include/Medoo.php';
require_once './include/config.php';
// require_once './include/result.class.php
$name=['有米','有菜','有肉','菜花','张华','小胖','佩奇','钱宝','赵宏','华明','东风','富贵','瓦瓦','瓦力','小明','小明明','小敏','小蔡','小羽','啾啾','嘉懿','煜城','懿轩','烨伟','苑博','伟泽','熠彤','鸿煊','博涛','烨霖','烨华','煜祺','智宸','正豪','昊然','明杰','立诚','立轩','立辉','峻熙','弘文','熠彤','鸿煊','烨霖','哲瀚','鑫鹏','致远','俊驰','雨泽','烨磊','晟睿','天佑','文昊','修洁','黎昕','远航','旭尧','鸿涛','伟祺','荣轩','越泽','浩宇','瑾瑜','皓轩','擎苍','擎宇','志泽','睿渊','楷瑞','子轩','弘文','哲瀚','雨泽','鑫磊','修杰','伟诚','建辉','晋鹏','天磊','绍辉','泽洋','明轩','健柏','鹏煊','昊强','伟宸','博超','君浩','子骞','明辉','鹏涛','炎彬','鹤轩','越彬','风华','靖琪','明诚','高格','光华','国源','冠宇','晗昱','涵润','翰飞','翰海','昊乾','浩博','和安','弘博','宏恺','鸿朗','华奥','华灿','嘉慕','坚秉','建明','金鑫','锦程','瑾瑜','晋鹏','经赋','景同','靖琪','君昊','俊明','季同','开济','凯安','康成','乐语','力勤','良哲','理群','茂彦','敏博','明达','朋义','彭泽','鹏举','濮存','溥心','璞瑜','浦泽','奇邃','祺祥','荣轩','锐达','睿慈','绍祺','圣杰','晟睿','思源','斯年','泰宁','天佑','同巍','奕伟','祺温','文虹','向笛','心远','欣德','新翰','兴言','星阑','修为','旭尧','炫明','学真','雪风','雅昶','阳曦','烨熠','英韶','永贞','咏德','宇寰','雨泽','玉韵','越彬','蕴和','哲彦','振海','正志','子晋','自怡','德赫','君平'];
$sex = ['男','女'];
$dept = ['CS','IS','MA','SS','CC','DD','QQ','WW','pp','LL','AA','BB','CC','EE','FF','GG','HH','II','JJ','KK','LL','MM','NN','RR','SS','TT','PPO'];
$len=count($name);
$dlen=count($dept);
var_dump($len);
// $db1->query('BEGIN');
$sql = "INSERT INTO `s` (`Sno`, `Sname`, `Sage`, `Sdept`, `Ssex`) VALUES ";
$start = 0;
$end = 1000000;
// for($i=$start;$i<$end;$i++)
// {
//     $j=rand();
//     // var_dump('pooo');
//     // var_dump($i);
//     $n = $name[$j%$len].($j%10000);
//     $d = $dept[$j%$dlen];
//     $s = $sex[$j%2];
//     $a = $j%20+10;
//     // if($i==$start)
//     //   $sql="INSERT INTO `s` (`Sno`, `Sname`, `Sage`, `Sdept`, `Ssex`) VALUES ('$i', '$n', '$a', '$d', '$s')";
//     // else
//     //   $sql.=",('$i', '$n', '$a', '$d', '$s')";
//     if($i%40000!=0)
//     {
//         if(($i+1)%40000!=0)
//         {
//           $sql.=",('$i', '$n', '$a', '$d', '$s')";
//         }
//         else {

//           $sql.=",('$i', '$n', '$a', '$d', '$s')";
//           $result = $db1->query($sql);
//           $sql="INSERT INTO `s` (`Sno`, `Sname`, `Sage`, `Sdept`, `Ssex`) VALUES ";
//           var_dump($result);
//           echo $i;
//         }
//     }else {
//         $sql.="('$i', '$n', '$a', '$d', '$s')";
//     }
// }
$t=time();   
$cno = "SELECT Cno FROM `c` where true";
$result = $db1->query($cno);
$cno=[];
// var_dump($result);
while($row = mysqli_fetch_array($result))
{
  array_push($cno,$row['Cno']);
}
$lenc = count($cno);
// $query = "INSERT INTO `sc` (`Sno`, `Cno`, `Grade`) VALUES ('$i', '$cno[$k]', '$grade');";
$sql= "INSERT INTO `sc` (`Sno`, `Cno`, `Grade`) VALUES ";
$start=30000;
$end=40000;
for($i=$start;$i<$end;$i++)
{
  // for($k=0;$k<$lenc;$k++)
  for($k=0;$k<$lenc;$k++)
  {
    $j=rand();
    $grade = $j%100;
    $sql.="('$i','$cno[$k]', '$grade'),";
//     // echo '<p>pppp' . $query;
    // $k+=$j%4;
  }
  if(($i+1)%1000==0)
  {
    $sql=substr($sql,0,strlen($sql)-1);
    // echo $sql;
    $result = $db1->query($sql);
    var_dump($result);
    echo '</br>'.$i.'</br>';
    $sql= "INSERT INTO `sc` (`Sno`, `Cno`, `Grade`) VALUES ";
  }

  // echo $i.'ok</br>';
  // sleep(3);
}
echo"</br>写入成功,耗时：",time()-$t;

// $db1->query('COMMIT');