 <?php
 function get_cname()
    {
        global $db;
        $re = $db->select('c',['Cname','Cno'],[
            "GROUP" => ["Cno"]
        ]);
        return $re;
    }
    function get_sc($page,$page_num,$Sname,$Cname)
    {
        global $db;
        if($Cname=='')
        {
            $re = $db->select('sc',[
                "[>]s" => ['Sno'],
                "[>]c" => ['Cno'],
            ],[
                'sc.Sno',
                's.Sname',
                'sc.Cno',
                'c.Cname',
                'sc.Grade',
                'c.Ccredit',
            ],[
                'OR'=>[
                    'c.Cname[~]' =>$Sname,
                    's.Sname[~]' =>$Sname,
                    'c.Cno[~]' =>$Sname,
                    's.Sno[~]' =>$Sname,
                    'c.Cpno[~]' =>$Sname,
                    'c.Ccredit[~]' =>$Sname
                ],
                // "ORDER" => ["Cno" => "DESC"],
                "LIMIT" => [$page*$page_num,$page_num]
            ]);
            // $re = $db->select('sc',[
            //     // "[>]s" => ["sc.Sno" => "s.Sno"],
            //     // "[>]c" => ["sc.Cno" => "c.Cno"],
            // ],[
            //     'sc.Sno'
            // ],[
            //     // 'Cname[~]' =>$Cname,
            //     // "ORDER" => ["Cno" => "DESC"],
            //     "LIMIT" => [$page*$page_num,$page_num]
            // ]);
            // var_dump($re);
        }else {
            # code...
            $re = $db->select('sc',[
                "[>]s" => ['Sno'],
                "[>]c" => ['Cno'],
            ],[
                'sc.Sno',
                's.Sname',
                'sc.Cno',
                'c.Cname',
                'sc.Grade',
                'c.Ccredit',
            ],[
                'AND'=>[
                'c.Cname[~]' =>$Cname,
                'OR'=>[
                    's.Sname[~]' =>$Sname,
                    'c.Cno[~]' =>$Sname,
                    's.Sno[~]' =>$Sname,
                    'c.Cpno[~]' =>$Sname,
                    'c.Ccredit[~]' =>$Sname
                ]
                ],
                "ORDER" => ["Cno" => "DESC"],
                "LIMIT" => [$page*$page_num,$page_num]
            ]);
        }
        return $re;
    }
    function search_sc($word)
    {
        global $db;
        $re = $db->select('sc','*',[
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
    function delete_sc($Cno,$Sno)
    {
        global $db;
        $re = $db->delete('sc',[
            'Cno'=>$Cno,
            'Sno'=>$Sno
        ]);
        // var_dump($re);
        return $re;
    }
    function insert_sc($Cno,$Sno,$Grade)
    {
        global $db;
        $re = $db->has('sc',['Cno'=>$Cno,'Sno'=>$Sno]);
        if(!$re)
        {
            $re = $db->insert('sc',[
                'Cno' =>$Cno,
                'Sno' =>$Sno,
                'Grade' =>$Grade,
            ]);
            $result['status'] = 1;
        }else {
            $result['status']=0;
        }
        return $result;
    }
    function update_sc($Cno,$Sno,$Grade)
    {
        global $db;
        $re = $db->update('sc',[
            'Grade' =>$Grade,
        ],[
            'Cno' => $Cno,
            'Sno' => $Sno
        ]);
        return $re;
    }