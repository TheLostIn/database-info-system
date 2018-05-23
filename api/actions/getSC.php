<?php
// require_once './include/student.function.php';
require_once './include/sc.function.php';
    if(isset($_GET['action_type']))
    {
        $action_type = $_GET['action_type'];
    }
    else {
        Result::error('wrong action_type');
    }
    // var_dump('token');
    // var_dump($_GET['token']);
    $page_num = isset($_GET['page_num'])?$_GET['page_num']:10;
    $page = isset($_GET['page'])?$_GET['page']:1;
    switch($action_type)
    {

        case 'get_sc':
            $Sname = isset($_GET['Sname'])?$_GET['Sname']:'';
            $Cname = isset($_GET['Cname'])?$_GET['Cname']:'';
            $result = get_sc($page,$page_num,$Sname,$Cname);
            break;

        case 'search_sc':
            if(isset($_GET['word']))
            {
                $word = $_GET['word'];
                $result = search_sc($word);
            }else {
                Result::error('missing parameter');
            }
            break;
        case 'insert_sc':
            if(isset($_GET['Cno'],$_GET['Sno'],$_GET['Grade']))
            {
                $Cno = $_GET['Cno'];
                $Sno = $_GET['Sno'];
                $Grade = $_GET['Grade'];

                $result = insert_sc($Cno,$Sno,$Grade);
            } else {
                Result::error('missing parameter');
            }
            break;
        case 'update_sc':
            if(isset($_GET['Cno'],$_GET['Sno'],$_GET['Grade']))
            {
                $Cno = $_GET['Cno'];
                $Sno = $_GET['Sno'];
                $Grade = $_GET['Grade'];
                $result = update_sc($Cno,$Sno,$Grade);
            } else {
                Result::error('missing parameter');
            }
            break;
        case 'delete_sc':
            if(isset($_GET['Cno'],$_GET['Sno']))
            {
                $Cno = $_GET['Cno'];
                $Sno = $_GET['Sno'];
                $result = delete_sc($Cno,$Sno);
            } else {
                Result::error('missing parameter');
            }
            break;
        case 'get_cname':
            $result = get_cname();
            break;
    }
    Result::success($result);