 <?php
 function get_cpno()
    {
        global $db;
        $re = $db->select('c',['Cpno'],[
            "GROUP" => ["Cpno"]
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
            $re = $db->select('c','*',[
                'AND'=>[
                    'Cname[~]' =>$Cname,
                    'OR'=>[
                        'Cno[~]' =>$Cpno,
                        'Cpno[~]' =>$Cpno,
                        'Ccredit[~]' =>$Cpno
                    ]
                    ],
                "ORDER" => ["Cno" => "DESC"],
                "LIMIT" => [$page*$page_num,$page_num]
            ]);
        }
        return $re;
    }
    function search_c($word)
    {
        global $db;
        $re = $db->select('c','*',[
            'OR'=>[
                'Cno[~]' =>$word,
                'Sname[~]' =>$word,
                'Sage[~]' =>$word,
                'Sdept[~]' =>$word,
                'Ssex[~]' =>$word
            ]
        ],[
            "ORDER" => ["Cno" => "DESC"],
            // "LIMIT" => [$page*$page_num,$page_num]
        ]);
        return $re;
    }
    function delete_c($Cno)
    {
        global $db;
        $re = $db->delete('c',[
            'Cno'=>$Cno
        ]);
        // var_dump($re);
        return $re;
    }
    function insert_c($Cno,$Cname,$Cpno,$Ccredit)
    {
        global $db;
        $re = $db->has('c',['Cno'=>$Cno]);
        if(!$re)
        {
            $re = $db->insert('c',[
                'Cno' =>$Cno,
                'Cname' =>$Cname,
                'Cpno' =>$Cpno,
                'Ccredit' =>$Ccredit,
            ]);
            $result['status'] = 1;
        }else {
            $result['status']=0;
        }
        return $result;
    }
    function update_c($Cno,$Cname,$Cpno,$Ccredit)
    {
        global $db;
        $re = $db->update('c',[
            'Cname' =>$Cname,
            'Cpno' =>$Cpno,
            'Ccredit' =>$Ccredit,
        ],[
            'Cno' => $Cno
        ]);
        return $re;
    }