 <?php
 function get_dept()
    {
        global $db;
        $re = $db->select('s',['Sdept'],[
            "GROUP" => ["Sdept"]
        ]);
        return $re;
    }
    function get_c($page,$page_num,$Cpno,$Cname)
    {
        global $db;
        if($Cpno=='')
        {
            $re = $db->select('c','*',[
                'Cname[~]' =>$Cname,
                "ORDER" => ["Cno" => "DESC"],
                "LIMIT" => [$page*$page_num,$page_num]
            ]);
        }else {
            # code...
            $re = $db->select('s','*',[
                'AND'=>[
                    'Cname[~]' =>$Cname,
                    'OR'=>[
                        'Sno[~]' =>$Cpno,
                        'Sname[~]' =>$Cpno,
                        'Sage[~]' =>$Cpno,
                        'Ssex[~]' =>$Cpno
                    ]
                    ],
                "ORDER" => ["Sno" => "DESC"],
                "LIMIT" => [$page*$page_num,$page_num]
            ]);
        }
        return $re;
    }
    function search_s($word)
    {
        global $db;
        $re = $db->select('s','*',[
            'OR'=>[
                'Sno[~]' =>$word,
                'Sname[~]' =>$word,
                'Sage[~]' =>$word,
                'Sdept[~]' =>$word,
                'Ssex[~]' =>$word
            ]
        ],[
            "ORDER" => ["Sno" => "DESC"],
            // "LIMIT" => [$page*$page_num,$page_num]
        ]);
        return $re;
    }
    function delete_s($Sno)
    {
        global $db;
        $re = $db->delete('s',[
            'Sno'=>$Sno
        ]);
        // var_dump($re);
        return $re;
    }
    function insert_s($Sno,$Sname,$Sage,$Sdept,$Ssex)
    {
        global $db;
        $re = $db->has('s',['Sno'=>$Sno]);
        if(!$re)
        {
            $re = $db->insert('s',[
                'Sno' =>$Sno,
                'Sname' =>$Sname,
                'Sage' =>$Sage,
                'Sdept' =>$Sdept,
                'Ssex' =>$Ssex
            ]);
            $result['status'] = 1;
        }else {
            $result['status']=0;
        }
        return $result;
    }
    function update_s($Sno,$Sname,$Sage,$Sdept,$Ssex)
    {
        global $db;
        $re = $db->update('s',[
            'Sname' =>$Sname,
            'Sage' =>$Sage,
            'Sdept' =>$Sdept,
            'Ssex' =>$Ssex
        ],[
            'Sno' => $Sno
        ]);
        return $re;
    }
    //  function get_c($page,$page_num)
    // {
    //     global $db;
    //     $re = $db->select('c','*',[
    //         "ORDER" => ["Cno" => "DESC"],
    //         "LIMIT" => [$page*$page_num,$page_num]
    //     ]);
    //     return $re;
    // }
    // function get_sc($page,$page_num)
    // {
    //     global $db;
    //     $re = $db->select('sc','*',[
    //         "ORDER" => ["Sno" => "DESC"],
    //         "LIMIT" => [$page*$page_num,$page_num]
    //     ]);
    //     return $re;
    // }