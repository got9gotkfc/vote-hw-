<?php
// 呼叫資料庫
function pdo()
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    return  new PDO($dsn, 'root', '');
}
// 在畫面列出陣列
function chk_array($a)
{
    echo "<br>";
    print_r($a);
    echo "</br>";
}



// 將建好的投票存入資料庫
// 目標:$sql="INSERT INTO $table('array_keys($arg)') VALUES ('$arg');"
function  save($table,$arg,$chk){
    $pdo=pdo();
    $sql="";
    
    // 如果這個subject原本就存在 資料庫會給他一個id 判斷有沒有id 就知道有沒有在資料庫 有在資料庫的話就改為更新
    // 目標:$sql="UPDATE $table SET `$key`='$value' WHERE `id`='$arg['id']'";
    if(isset($chk['id'])){
        //update

        foreach($chk as $key => $value){
            // id要放在WHERE之後，先把id以外的值取出來
            if($key!='id'){

                $tmp[]="`$key`='$value'";
            }

        }
        //完成目標sql語法 implode用,隔開
        $sql.="UPDATE $table SET ".implode(" , " ,$tmp)." WHERE `id`='{$chk['id']}'";

    }else{
        //insert
        $cols=implode("`,`",array_keys($arg));
        $values=implode("','",$arg);

        //建立新增的sql語法
        $sql="INSERT INTO $table (`$cols`) VALUES('$values')";

    }
    //echo $sql;
    return $pdo->exec($sql);

}

// 在資料庫中找到目標
//目標$sql="SELECT * FROM $table WHERE $arg(條件);
function search($table,$arg){
    $pdo=pdo();
    
    $sql="SELECT * FROM $table WHERE ";
        // 判斷是不是陣列 如果是用foreach串起來
        if(is_array($arg)){
    
            foreach($arg as $key => $value){
    
                $tmp[]="`$key`='$value'";
    
            }
    
            $sql.=implode(" AND " ,$tmp);
    
        }else{
    
            $sql.="$arg";
    
        }
    
        return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

// 叫出資料庫所有符合條件的資料，可輸入多個$arg
function all($table, ...$arg)
{
    $pdo = pdo();

    //設定一個字串變數為基本SQL語法
    $sql = "SELECT * FROM $table ";

    //依參數數量來決定進行的動作因此使用switch...case
    switch (count($arg)) {
        case 1:

            //判斷參數是否為陣列
            if (is_array($arg[0]) && !empty($arg[0])) {

                //使用迴圈來建立條件語句的字串型式，並暫存在陣列中
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                //使用implode()來轉換陣列為字串並和原本的$sql字串再結合
                $sql .= " WHERE " . implode("", $tmp);
            } else if (empty($arg[0])) {
            } else {
                //如果參數不是陣列，那應該是SQL語句字串，因此直接接在原本的$sql字串之後即可
                $sql .= $arg[0];
            }
            break;
        case 2:

            if (!empty($arg[0])) {
                //第一個參數必須為陣列，使用迴圈來建立條件語句的陣列
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                //將條件語句的陣列使用implode()來轉成字串，最後再接上第二個參數(必須為字串)
                $sql .= " WHERE " . implode(" ", $tmp) . $arg[1];
            } else {
                $sql .= $arg[1];
            }
            break;

            //執行連線資料庫查詢並回傳sql語句執行的結果
    }

    //fetchAll()加上常數參數FETCH_ASSOC是為了讓取回的資料陣列中
    //只有欄位名稱,而沒有數字的索引值
    // echo $sql;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}




function del($table,$arg){
    $pdo=pdo();

    $sql="DELETE FROM $table WHERE ";
    if(is_array($arg)){

        foreach($arg as $key => $value){

            $tmp[]="`$key`='$value'";

        }

        $sql.=implode(" AND " ,$tmp);

    }else{

        $sql.=" `id`='$arg'";

    }

    return $pdo->exec($sql);
}
function math($table,$math,$col,...$arg){
    $pdo=pdo();
    
    $sql="SELECT $math(`$col`) FROM $table ";
    
        if(!empty($arg[0])){
    
            foreach($arg[0] as $key => $value){
    
                $tmp[]="`$key`='$value'";
    
            }
    
            $sql.=" WHERE " . implode(" AND " ,$tmp);
    
        }
    
        //使用fetchColumn()來取回第一欄位的資料，因為這個SQL語法
        //只有select 一個欄位的資料，因此這個函式會直接回傳計算的結果出來
        return $pdo->query($sql)->fetchColumn();
    }
/**
 * $url - 要導向的檔案路徑及檔名
 */

function  to($url){

    header("location:".$url);

}


/**
 * $sql - SQL語句字串，取出符合SQL語句的全部資料
 */

function  q($sql){
    $pdo=pdo();
    
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}


?>