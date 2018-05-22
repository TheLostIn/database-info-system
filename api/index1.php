<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET,POST');
header('Access-Control-Allow-Headers: Content-Type');
// session_start();
// /*
// ini_set("display_errors", "On");

// error_reporting(E_ALL | E_STRICT);
// */

require_once './include/Medoo.php';
require_once './include/config.php';
// require_once './include/result.class.php';
// // require_once './include/info.function.php';
// require_once './include/token.class.php';
// require_once './include/request.class.php';

// Request::initialize();

// echo('ppppp');
echo '1<br />';
$query = "select * from s,sc where sc.Cno = 1 and s.Sno=sc.Sno";
// echo '<p>' . $query;

$result = $db1->query($query);
while($row = mysqli_fetch_array($result))
{
  echo $row['Sno'] . " " . $row['Sdept'];
  echo "<br />";
}
echo '2<br />';
$query = "select * from s,sc,c where sc.Cno = c.Cno and s.Sno=sc.Sno and c.Cname='数据结构'";
// echo '<p>' . $query;

$result = $db1->query($query);
while($row = mysqli_fetch_array($result))
{
  echo $row['Sno'] . " " . $row['Sname'];
  echo "<br />";
}

echo '3<br />';
$query = "select * from s where not exists (select * from sc where sc.Cno=1 and sc.Sno=s.sno)";
// echo '<p>' . $query;

$result = $db1->query($query);
while($row = mysqli_fetch_array($result))
{
  echo $row['Sno'] . " " . $row['Sname'];
  echo "<br />";
}

echo '4<br />';
$query = "select * from s where not exists (select * from c where not exists (select * from sc where sc.Cno = c.Cno and sc.Sno=s.Sno))";
// echo '<p>' . $query;

$result = $db1->query($query);
while($row = mysqli_fetch_array($result))
{
  echo $row['Sno'] . " " . $row['Sname'];
  echo "<br />";
}
echo '5<br />';
$query = "select s.Sno,avg(sca.Grade) from s join sc as sca where not exists(select * from sc as scb where scb.Sno = s.Sno and scb.Cno!=1 and scb.Grade<60) and sca.Sno=s.Sno group by s.Sno order by avg(sca.Grade)";
// echo '<p>' . $query;
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where   group by Sno";
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where not exists(select * from sc as scb where scb.Grade<60)  group by Sno";
$result = $db1->query($query);
// var_dump($result);
while($row =mysqli_fetch_assoc($result))
{
  // echo $row['Sno'] . " ,.." . $row['Sname'];
  echo "<br />";
  var_dump($row);
}
echo '6<br />';
$query = "select s.Sname from s,sc,c where s.Sno = sc.Sno and sc.Cno and c.Cno and c.Cname ='数据库原理' order by Grade limit 1,1";
// echo '<p>' . $query;
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where   group by Sno";
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where not exists(select * from sc as scb where scb.Grade<60)  group by Sno";
$result = $db1->query($query);
// var_dump($result);
while($row =mysqli_fetch_assoc($result))
{
  // echo $row['Sno'] . " ,.." . $row['Sname'];
  echo "<br />";
  var_dump($row);
}

echo '<br />7<br />';
$query = "select s.Sname from sc as sca,s,c where sca.Sno=s.Sno and sca.Cno= c.Cno and c.Ccredit=3 and Grade > 80 group by s.Sno having count(*)>3";
// echo '<p>' . $query;
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where   group by Sno";
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where not exists(select * from sc as scb where scb.Grade<60)  group by Sno";
$result = $db1->query($query);
// var_dump($result);
while($row =mysqli_fetch_assoc($result))
{
  // echo $row['Sno'] . " ,.." . $row['Sname'];
  echo "<br />";
  var_dump($row);
}

echo '<br />8<br />';
$query = "select sca.Sno,count(*) from sc as sca group by sca.Sno having count(*) not in ( select count(*) from sc as scb where sca.Sno != scb.Sno group by scb.Sno) ";
// echo '<p>' . $query;
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where   group by Sno";
// $query = "select count(sca.*),avg(sca.Grade),Sno from sc as sca where not exists(select * from sc as scb where scb.Grade<60)  group by Sno";
$result = $db1->query($query);
// var_dump($result);
while($row =mysqli_fetch_assoc($result))
{
  // echo $row['Sno'] . " ,.." . $row['Sname'];
  echo "<br />";
  var_dump($row);
}

// echo '<br />3.1 <br />';
// $query = "update sc set sc.Grade = sc.Grade*1.1 from sc inner join c on c.Cno=sc.Cno where c.Cname='数据结构' and sc.Grade is not NULL";
// $result = $db1->query($query);
// echo $result;

// echo '<br />3.2 <br />';
// $query = "delete sca from sc as sca left join c as ca on sca.Cno=ca.Cno where ca.Cname='PASCAL语言'";
// $result = $db1->query($query);
// var_dump($result);
// echo $result;

// echo '<br />3.3 <br />';
// // $query = "delete sc,s from sc as sca left join s as sa on sca.Sno=sa.Sno where sa.Sno=95005";
// //设置sc表的外键Sno级联删除
// $query = "delete from s where Sno=95005";
// $result = $db1->query($query);
// var_dump($result);
// echo $result;

echo '<br /> 4.1<br />';

$query = "create view boysinfo as  select s.Sno,s.Sname,c.Cname,sc.Grade from s,sc,c where s.Sno=sc.Sno and s.Ssex='男' and c.Cno=sc.Cno";
$result = $db1->query($query);
// while($row =mysqli_fetch_assoc($result))
// {
//   // echo $row['Sno'] . " ,.." . $row['Sname'];
//   echo "<br />";
//   var_dump($row);
// }
echo '<br /> 4.2<br />';
$query = "select Sno,Sname,avg(Grade) from boysinfo group by Sno having avg(Grade)>80";
$result = $db1->query($query);
while($row =mysqli_fetch_assoc($result))
{
  // echo $row['Sno'] . " ,.." . $row['Sname'];
  echo "<br />";
  var_dump($row);
}

echo '<br /> 5.1<br />';
$query = "select Sno,count(*),avg(Grade) from sc where Grade is not NULL group by Sno";
$result = $db1->query($query);
while($row =mysqli_fetch_assoc($result))
{
  // echo $row['Sno'] . " ,.." . $row['Sname'];
  echo "<br />";
  var_dump($row);
}

echo '<br /> 5.2<br />';
$query = "grant select, insert, update, delete,create on sc.* to erestu@'%'";
// REVOKE ALL PRIVILEGES ON `student`.`sc` FROM 'erestu'@'%';
$result = $db1->query($query);
var_dump($result);
// while($row =mysqli_fetch_assoc($result))
// {
//   // echo $row['Sno'] . " ,.." . $row['Sname'];
//   echo "<br />";
//   var_dump($row);
// }



// var_dump($result);
// if(!isset($_SESSION)){
//     session_start();
// }
// // white list
// // $actionList = ['postLogin','upload','getImage','get_show_pic','postSignup','collect_info','chatting','chatting2','getMessages','getGroups','addGroup','addGroupusers','getUsers','addMessage','getLogou'];
// $actionList = ['admin','postLogin','upload','getImage','get_show_pic','postSignup','collect_info','getPersonalInfo','admin','postWork','verifyMailbox','team'];
// $noTokenList = ['postLogin','getImage','get_show_pic','postSignup','collect_info'];

// define('UPLOAD_DIR', '/www/upload/work-system/');

// if (!isset($_GET['_action'])) {
//     Result::error('missing _action');
// }
// if (!in_array($_GET['_action'], $actionList)) {
//     Result::error('_action error');
// }

// if (in_array($_GET['_action'], $noTokenList)){//如果是不需要token的 action 直接进入
//     require_once "actions/{$_GET['_action']}.php";

// } else {//token验证
//     // if (!isset($_GET['token'])){//无token错误
//     //     Result::error('no token');
//     // }
//     // if(Token::userid($_GET['token']) < 1){//token不存在终止
//     //     Result::error('token wrong');
//     // }
//     // //其余为正确情况 全局并进入action
//     // $GLOBALS['uid'] = Token::userid($_GET['token']);
//     // require_once "actions/{$_GET['_action']}.php";
//     if (!isset($_GET['token'])){//无token错误
//         Result::error('no token');
//     }
//     if(Token::userid($_GET['token']) < 1){//token不存在终止
//         Result::error('token wrong');
//     }
//     //其余为正确情况 全局并进入action
//     $GLOBALS['uid'] = Token::userid($_GET['token']);
//     require_once "actions/{$_GET['_action']}.php";
// }
