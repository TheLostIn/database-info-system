<?php
// require_once './include/student.function.php';
require_once './include/s.function.php';
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

        case 'get_s':
            $word = isset($_GET['word'])?$_GET['word']:'';
            $dept = isset($_GET['dept'])?$_GET['dept']:'';
            $result = get_s($page,$page_num,$word,$dept);
            break;

        case 'search_s':
            if(isset($_GET['word']))
            {
                $word = $_GET['word'];
                $result = search_s($word);
            }else {
                Result::error('missing parameter');
            }
            break;
        case 'insert_s':
            if(isset($_GET['Sno'],$_GET['Sname'],$_GET['Sage'],$_GET['Sdept'],$_GET['Ssex']))
            {
                $Sno = $_GET['Sno'];
                $Sname = $_GET['Sname'];
                $Sage = $_GET['Sage'];
                $Sdept = $_GET['Sdept'];
                $Ssex = $_GET['Ssex'];

                $result = insert_s($Sno,$Sname,$Sage,$Sdept,$Ssex);
            } else {
                Result::error('missing parameter');
            }
            break;
        case 'update_s':
            if(isset($_GET['Sno'],$_GET['Sname'],$_GET['Sage'],$_GET['Sdept'],$_GET['Ssex']))
            {
                $Sno = $_GET['Sno'];
                $Sname = $_GET['Sname'];
                $Sage = $_GET['Sage'];
                $Sdept = $_GET['Sdept'];
                $Ssex = $_GET['Ssex'];
                $result = update_s($Sno,$Sname,$Sage,$Sdept,$Ssex);
            } else {
                Result::error('missing parameter');
            }
            break;
        case 'delete_s':
            if(isset($_GET['Sno']))
            {
                $Sno = $_GET['Sno'];
                $result = delete_s($Sno);
            } else {
                Result::error('missing parameter');
            }
            break;
        case 'get_dept':
            $result = get_dept();
            break;
        case 'get_c':
            $page_num = $_GET['page_num']?$_GET['page_num']:1;

            // $page_num = 1;
            $result = get_c($page,$page_num);
            break;
        case 'get_sc':
            $page_num = $_GET['page_num']?$_GET['page_num']:1;

            // $page_num = 1;
            $result = get_sc($page,$page_num);
            break;
    }
    Result::success($result);