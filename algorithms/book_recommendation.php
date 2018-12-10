    <?php

     function sql_query($mysqli, $sql){  //执行sql查寻的函数，输入sqli对象和要执行的语句，返回查询结果对象
            $sql_result = $mysqli -> query($sql, MYSQLI_STORE_RESULT);
            return $sql_result;
        }

        function get_sales_vector($mysqli, $customer_name, $type_array){    //获取指定用户的销售向量的函数
            $tempo = array();   //存储当前用户的购买向量
            //开始计算本用户的购买向量
            foreach($type_array as $tp){
                $sql = "SELECT sum(oamount) FROM order_detail WHERE 
                obook in
                (SELECT bISBN FROM bookall WHERE btype = '".$tp."')
                AND 
                osale in
                (SELECT sID FROM sale WHERE scustomer in
                (SELECT cID FROM customer WHERE cname = '".$customer_name."'))";

                $sql_result = sql_query($mysqli, $sql);
                list($type_amount)=$sql_result->fetch_row();

                if(!isset($type_amount)) $type_amount = 0;
                array_push($tempo, $type_amount);
            }
            return $tempo;
        }

        function vector_dot_product($vec1, $vec2){
            if(sizeof($vec1) != sizeof($vec2))return -1;    //如果向量维度不等，返回-1
            $ret = 0;
            for($i = 0; $i < sizeof($vec1); ++$i){
                $ret += $vec1[$i] * $vec2[$i];
            }
            return $ret;
        }

        function vector_cosine($vec1, $vec2){
            if(sizeof($vec1) != sizeof($vec2))return -1;    //如果向量维度不等，返回-1
            if(vector_dot_product($vec1, $vec1) == 0 || vector_dot_product($vec2, $vec2) == 0) return 0;    //如果其中一个向量是零向量就返回0
            return vector_dot_product($vec1, $vec2)/(sqrt(vector_dot_product($vec1, $vec1)) * sqrt(vector_dot_product($vec2, $vec2)));
        }

        function recommend(){
            error_reporting(0);
            $username = 'root';
            $password = '';
            $sqlname = 'booksql';
            if(isset($_COOKIE['username']))$username = $_COOKIE['username'];
            if(isset($_COOKIE['password']))$password = $_COOKIE['password'];
            if(isset($_COOKIE['sqlname']))$sqlname = $_COOKIE['sqlname'];

            $mysqli = new mysqli('localhost', $username, $password, $sqlname);
            $mysqli->query('set names utf8') or die('query字符集错误');  

            //拥有的书目类型列表
            $type_array = array('小说','历史','经济','教材','科技','其他');

            if(!isset($_COOKIE['customer_name'])){  //如果没有登录，执行默认推荐

                $sql_result = sql_query($mysqli, 'SELECT obook, sum(oamount) FROM order_detail GROUP BY obook;');
                $book_rank_array = array();
                
                while(list($isbn, $sale) = $sql_result -> fetch_row()){
                    $book_rank_array[$isbn] = $sale;
                }
                
                arsort($book_rank_array);
                
                //遍历，输出前五个
                $i= 0;
                while(list($isbn, $sale) = each($book_rank_array)){
                    echo "<tr>";
                    $book_result = sql_query($mysqli, 'SELECT bname, bauthor, bpress FROM bookall WHERE bISBN = "'.$isbn.'"');
                    list($bname, $bauthor, $bpress) = $book_result -> fetch_row();
                    echo "<td>".$bname."</td><td>".$bauthor."</td><td>".$bpress."</td>";
                    $i += 1;
                    if($i == 5)break;
                    echo "</tr>";
                }
                

            }
            else{       //如果有用户登录信息
                $customer_name = $_COOKIE['customer_name'];
                $curr_user_vector = get_sales_vector($mysqli, $customer_name, $type_array);

                //foreach ($curr_user_vector as $value) {
                //      echo $value.' ';
                //  }
                //echo '<br>';

                //$tempo是当前用户的购买向量

                //首先生成一个所有书目的清单，销量记为0
                $book_isbn_sales_array = array();
                $book_isbn_result = sql_query($mysqli, "SELECT bISBN FROM bookall");
                while($isbn = $book_isbn_result -> fetch_row()){
                    $book_isbn_sales_array[$isbn] = 0;
                }

                $ocn = sql_query($mysqli, 'SELECT cname FROM customer WHERE cname != "'.$customer_name.'"');

                while (list($other_customer_name) = $ocn -> fetch_row()) {

                    //echo $other_customer_name;

                    $this_user_vector = get_sales_vector($mysqli, $other_customer_name, $type_array);

                    //foreach ($this_user_vector as $value) {
                    //  echo $value.' ';
                    //}

                    //求向量夹角作为权重
                    $weight = vector_cosine($curr_user_vector, $this_user_vector);

                    //echo 'weight: '.$weight;

                //获得这个用户购买的书的isbn和数量的键值对
                    $sql = 'SELECT obook, sum(oamount) FROM order_detail WHERE osale IN (SELECT sID FROM sale WHERE scustomer in (SELECT cID from customer where cname = "'.$other_customer_name.'")) group by obook';
                    $sales_list = sql_query($mysqli, $sql);
                    //将销售信息加权后加入所有书目清单中
                    while(list($isbn, $sales) = $sales_list -> fetch_row()){
                
                        $book_isbn_sales_array[$isbn] += $sales * $weight;
                    }
                }

                //while(list($isbn, $sale) = each($book_isbn_sales_array)){
                //  echo $isbn." ".$sale;
                //  echo "<br>";
                //}

                arsort($book_isbn_sales_array);

                //先检查这个用户是不是已经购买了这本书，所以要生成用户已经购买了的书单
                $customer_bought = sql_query($mysqli, 'SELECT obook FROM order_detail WHERE osale in (SELECT sID FROM sale WHERE scustomer in (SELECT cID from customer where cname = "'.$customer_name.'"))');
                $customer_bought_list = array();
                while(list($isbn) = $customer_bought -> fetch_row()){
                    array_push($customer_bought_list, $isbn);
                //  echo $isbn.' ';
                }

                //遍历销量排名，输出前五个
                $i= 0;
                while(list($isbn, $sale) = each($book_isbn_sales_array)){

                    //如果这本书用户已经买过了，跳过
                    if(in_array($isbn, $customer_bought_list))continue;

                    echo "<tr>";
                    $book_result = sql_query($mysqli, 'SELECT bname, bauthor, bpress FROM bookall WHERE bISBN = "'.$isbn.'"');
                    list($bname, $bauthor, $bpress) = $book_result -> fetch_row();
                    echo "<td>".$bname."</td><td>".$bauthor."</td><td>".$bpress."</td>";
                    $i += 1;
                    if($i == 5)break;
                    echo "</tr>";
                }
            }
        }
?>