<!DOCTYPE html>
<meta charset="utf-8">
<style>
text{
	font-size:12px;
}
.mainBars rect{
  shape-rendering: auto;
  fill-opacity: 0;
  stroke-width: 0.5px;
  stroke: rgb(0, 0, 0);
  stroke-opacity: 0;
}
.subBars{
	shape-rendering:crispEdges;
}
.edges{
	stroke:none;
	fill-opacity:0.5;
}
.header{
	text-anchor:middle;
	font-size:16px;
}
line{
	stroke:grey;
}
</style>
<body>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="http://vizjs.org/viz.v1.1.0.min.js"></script>
    
        <?php
        error_reporting(0);

		//从cookie获取用户最初在登陆界面输入的信息
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		$sqlname = $_COOKIE['sqlname'];

		//如果没有cookie就把变量设置为默认值以正常连接数据库
		if(!isset($username)) $username = 'root';
		if(!isset($sqlname)) $sqlname = 'booksql';

		//连接数据库
	    //$mysqli = new mysqli('localhost', $username, $password, $sqlname);
        $mysqli = new mysqli('localhost', 'root', '', 'booksql');
		
		//解决中文显示成问号的问题
		$mysqli->query('set names utf8') or die('query字符集错误');

		//执行SQL语句

        $sql_query = "select scustomer,sseller from sale";
        $sql_query_name = "SELECT sum(oamount) from order_detail group by osale";
        $match = "SELECT cID,cname FROM customer";
		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
		$result_name = $mysqli->query($sql_query_name, MYSQLI_STORE_RESULT);
		$result_match = $mysqli->query($match, MYSQLI_STORE_RESULT);
    
        $number = array();
        while(list($scustomer, $sseller) = $result->fetch_row()){
            array_push($number, [$scustomer, $sseller]);
        }
        
        $order = array();
        while(list($oamount) = $result_name->fetch_row()){
            array_push($order, $oamount);
        }
        
        $name = array();
        while(list($cid, $cname) = $result_match->fetch_row()){
            array_push($name, [$cid, $cname]);
        }
 
        for($i = 0; $i < sizeof($number); $i++){
            for($j = 0; $j < sizeof($name); $j++){
                if($number[$i][0] == $name[$j][0]) $number[$i][0] = $name[$j][1];
                if($number[$i][1] == $name[$j][0]) $number[$i][1] = $name[$j][1];
            }
        }
    
        $all = [];
        for($i = 0; $i <12; $i++){
            //$all[$i] = '['.$booksnum[$i].',"'.$colors[$i].'","'.$booksname[$i].'"]';
            //echo $number[$i][0]; 
            //echo $number[$i][1];
            //echo $order[$i].'<br>';
            $all[$i] = '["'.$number[$i][0].'","'.$number[$i][1].'",'.$order[$i].',0]';
            }
        ?>
    
<script>
       <?php  
            echo 'var data = [';
            for($i = 0; $i < sizeof($all); $i++){
                echo $all[$i].', ';
            }
            echo '];';  
        ?>

var color ={张三:"#3366CC", 李四:"#DC3912",  王五:"#FF9900", 敖厂长:"#109618", 张全蛋:"#990099", 吴先生:"#0099C6",王司徒:"#F8F8FF", 面筋哥:"#FFD700", 金坷垃:"#FFD700", aloha:"#20B2AA"};
var svg = d3.select("body").append("svg").attr("width", 960).attr("height", 800);

svg.append("text").attr("x",250).attr("y",70)
	.attr("class","header").text("卖家买家关联表");
	
svg.append("text").attr("x",750).attr("y",70)
	.attr("class","header").text("Sales");

var g =[svg.append("g").attr("transform","translate(150,100)")
		,svg.append("g").attr("transform","translate(650,100)")];

var bp=[ viz.bP()
		.data(data)
		.min(12)
		.pad(1)
		.height(600)
		.width(200)
		.barSize(35)
		.fill(d=>color[d.primary])		
	,viz.bP()
		.data(data)
		.value(d=>d[3])
		.min(12)
		.pad(1)
		.height(600)
		.width(200)
		.barSize(35)
		.fill(d=>color[d.primary])
];
		
[0,1].forEach(function(i){
	g[i].call(bp[i])
	
	g[i].append("text").attr("x",-50).attr("y",-8).style("text-anchor","middle").text("卖家");
	g[i].append("text").attr("x", 250).attr("y",-8).style("text-anchor","middle").text("买家");
	
	g[i].append("line").attr("x1",-100).attr("x2",0);
	g[i].append("line").attr("x1",200).attr("x2",300);
	
	g[i].append("line").attr("y1",610).attr("y2",610).attr("x1",-100).attr("x2",0);
	g[i].append("line").attr("y1",610).attr("y2",610).attr("x1",200).attr("x2",300);
	
	g[i].selectAll(".mainBars")
		.on("mouseover",mouseover)
		.on("mouseout",mouseout);

	g[i].selectAll(".mainBars").append("text").attr("class","label")
		.attr("x",d=>(d.part=="primary"? -30: 30))
		.attr("y",d=>+6)
		.text(d=>d.key)
		.attr("text-anchor",d=>(d.part=="primary"? "end": "start"));
	
	g[i].selectAll(".mainBars").append("text").attr("class","perc")
		.attr("x",d=>(d.part=="primary"? -100: 80))
		.attr("y",d=>+6)
		.text(function(d){ return d3.format("0.0%")(d.percent)})
		.attr("text-anchor",d=>(d.part=="primary"? "end": "start"));
});

function mouseover(d){
	[0,1].forEach(function(i){
		bp[i].mouseover(d);
		
		g[i].selectAll(".mainBars").select(".perc")
		.text(function(d){ return d3.format("0.0%")(d.percent)});
	});
}
function mouseout(d){
	[0,1].forEach(function(i){
		bp[i].mouseout(d);
		
		g[i].selectAll(".mainBars").select(".perc")
		.text(function(d){ return d3.format("0.0%")(d.percent)});
	});
}
d3.select(self.frameElement).style("height", "800px");
</script>
</body>
</html>