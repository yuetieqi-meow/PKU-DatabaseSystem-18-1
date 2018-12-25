<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>折线图</title>
    <style>
        .a{
            background: #0bfefb;
        }
    </style>
</head>
    
<body>
    <canvas id="chart" height="400" width="600" style="margin:50px"> 你的浏览器不支持HTML5 canvas </canvas>

    <script type="text/javascript">
    	function goChart(dataArr){
		
		
		    // 声明所需变量
		    var canvas,ctx;
		    // 图表属性
		    var cWidth, cHeight, cMargin, cSpace;
		    var originX, originY;
		    // 折线图属性
		    var tobalDots, dotSpace, maxValue;
		    var totalYNomber;
		    // 运动相关变量
		    var ctr, numctr, speed;
		
		    // 获得canvas上下文
		    canvas = document.getElementById("chart");
		    if(canvas && canvas.getContext){
		        ctx = canvas.getContext("2d");
		    }
		    initChart(); // 图表初始化
		    drawLineLabelMarkers(); // 绘制图表轴、标签和标记
		    drawLineAnimate(); // 绘制折线图的动画
		
		    //点击刷新图表
		    canvas.onclick = function(){
		        initChart(); // 图表初始化
		        drawLineLabelMarkers(); // 绘制图表轴、标签和标记
		        drawLineAnimate(); // 绘制折线图的动画
		    };
		
		    // 图表初始化
		    function initChart(){
		        // 图表信息
		        cMargin = 60;
		        cSpace = 80;
		        /*这里是对高清屏幕的处理，
		         	方法：先将canvas的width 和height设置成本来的两倍
		         	然后将style.height 和 style.width设置成本来的宽高
		         	这样相当于把两倍的东西缩放到原来的 1/2，这样在高清屏幕上 一个像素的位置就可以有两个像素的值
		         	这样需要注意的是所有的宽高间距，文字大小等都得设置成原来的两倍才可以。
		        */
		        canvas.width = Math.floor( (window.innerWidth-100)/2 ) * 2 ;
		        canvas.height = 740;
		        canvas.style.height = canvas.height/2 + "px";
		        canvas.style.width = canvas.width/2 + "px";
		        cHeight = canvas.height - cMargin - cSpace;
		        cWidth = canvas.width - cMargin - cSpace;
		        originX = cMargin + cSpace;
		        originY = cMargin + cHeight;
		
		        // 折线图信息
		        tobalDots = dataArr.length;
		        dotSpace = parseInt( cWidth/tobalDots );
		        maxValue = 0;
		        for(var i=0; i<dataArr.length; i++){
		            var dotVal = parseInt( dataArr[i][1] );
		            if( dotVal > maxValue ){
		                maxValue = dotVal;
		            }
		        }
		        maxValue += 50;
		        totalYNomber = 10;
		        // 运动相关
		        ctr = 1;
		        numctr = 100;
		        speed = 6;
		
		        ctx.translate(0.5,0.5);  // 当只绘制1像素的线的时候，坐标点需要偏移，这样才能画出1像素实线
		    }
		
		    // 绘制图表轴、标签和标记
		    function drawLineLabelMarkers(){
		        ctx.font = "24px Arial";
		        ctx.lineWidth = 2;
		        ctx.fillStyle = "#566a80";
		        ctx.strokeStyle = "#566a80";
		        // y轴
		        drawLine(originX, originY, originX, cMargin);
		        // x轴
		        drawLine(originX, originY, originX+cWidth, originY);
		
		        // 绘制标记
		        drawMarkers();
		    }
		
		    // 画线的方法
		    function drawLine(x, y, X, Y){
		        ctx.beginPath();
		        ctx.moveTo(x, y);
		        ctx.lineTo(X, Y);
		        ctx.stroke();
		        ctx.closePath();
		    }
		
		    // 绘制标记
		    function drawMarkers(){
		        ctx.strokeStyle = "#E0E0E0";
		        // 绘制 y 轴 及中间横线
		        var oneVal = parseInt(maxValue/totalYNomber);
		        ctx.textAlign = "right";
		        for(var i=0; i<=totalYNomber; i++){
		            var markerVal =  i*oneVal;
		            var xMarker = originX-5;
		            var yMarker = parseInt( cHeight*(1-markerVal/maxValue) ) + cMargin;
		            
		            ctx.fillText(markerVal, xMarker, yMarker+3, cSpace); // 文字
		            if(i>0){
		                drawLine(originX+2, yMarker, originX+cWidth, yMarker);
		            }
		        }
		        // 绘制 x 轴 及中间竖线
		        ctx.textAlign = "center";
		        for(var i=0; i<tobalDots; i++){
		            var markerVal = dataArr[i][0];
		            var xMarker = originX+i*dotSpace;
		            var yMarker = originY+30;
		            ctx.fillText(markerVal, xMarker, yMarker, cSpace); // 文字
		            if(i>0){
		                drawLine(xMarker, originY-2, xMarker, cMargin	);
		            }
		        }
		        // 绘制标题 y
		        ctx.save();
		        ctx.rotate(-Math.PI/2);
		        ctx.fillText("访问量", -canvas.height/2, cSpace-10);
		        ctx.restore();
		        // 绘制标题 x
		        ctx.fillText("月份", originX+cWidth/2, originY+cSpace/2+20);
		    };
		
		    //绘制折线图
		    function drawLineAnimate(){
		        ctx.strokeStyle = "#566a80";  //"#49FE79";
		
		        //连线
		        ctx.beginPath();
		        for(var i=0; i<tobalDots; i++){
		            var dotVal = dataArr[i][1];
		            var barH = parseInt( cHeight*dotVal/maxValue* ctr/numctr );//
		            var y = originY - barH;
		            var x = originX + dotSpace*i;
		            if(i==0){
		                ctx.moveTo( x, y );
		            }else{
		                ctx.lineTo( x, y );
		            }
		        }
		        ctx.stroke();
		
		        //背景
		        ctx.lineTo( originX+dotSpace*(tobalDots-1), originY);
		        ctx.lineTo( originX, originY);
		        //背景渐变色
		        //柱状图渐变色
		        var gradient = ctx.createLinearGradient(0, 0, 0, 300);
		        gradient.addColorStop(0, 'rgba(133,171,212,0.6)');
		        gradient.addColorStop(1, 'rgba(133,171,212,0.1)');
		        ctx.fillStyle = gradient;
		        ctx.fill();
		        ctx.closePath();
		        ctx.fillStyle = "#566a80";
		
		        //绘制点
		        for(var i=0; i<tobalDots; i++){
		            var dotVal = dataArr[i][1];
		            var barH = parseInt( cHeight*dotVal/maxValue * ctr/numctr );
		            var y = originY - barH;
		            var x = originX + dotSpace*i;
		            drawArc( x, y );  //绘制点
		            ctx.fillText(parseInt(dotVal*ctr/numctr), x+15, y-8); // 文字
		        }
		
		        if(ctr<numctr){
		            ctr++;
		            setTimeout(function(){
		                ctx.clearRect(0,0,canvas.width, canvas.height);
		                drawLineLabelMarkers();
		                drawLineAnimate();
		            }, speed);
		        }
		    }
		
		    //绘制圆点
		    function drawArc( x, y, X, Y ){
		        ctx.beginPath();
		        ctx.arc( x, y, 3, 0, Math.PI*2 );
		        ctx.fill();
		        ctx.closePath();
		    }
	
	
		}
    </script>
    
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
        $sql_query = "SELECT osale, sum(oamount) FROM order_detail GROUP BY osale";
        $sql_query_name = "SELECT stime,sID from sale";
		$result = $mysqli->query($sql_query, MYSQLI_STORE_RESULT);
		$result_name = $mysqli->query($sql_query_name, MYSQLI_STORE_RESULT);
        
        $number = array();
        while(list($sale, $amount) = $result->fetch_row()){
            array_push($number, [$sale, $amount]);
        }
        
        $month = array();
        $count = 0;
        while(list($stime,$sID) = $result_name->fetch_row()){
            list($Y,$M,$D) = explode("-", $stime);
            array_push($month, [$sID, $M]);
        }
        
        $month_out = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($month as [$id, $m]){
            //echo $id.'aaa'.$m.'<br>';
            foreach($number as [$sid, $amount]){
                if($sid == $id){
                    //echo $sid." ".$amount."asd";
                    $month_out[$m - 1] += $amount;
                }
            }
        }
        
        $all = [];
        for($i = 0; $i <12; $i++){
            $all[$i] = '["2018/'.($i + 1).'",'.$month_out[$i].']';
            }
        
        ?>
    
    <script type="text/javascript">
        <?php
            
        echo 'var charData = [';
            for($i = 0; $i < sizeof($all); $i++){
                echo $all[$i].', ';
            }
            echo '];';  
        ?>
    	var chartData = [["2017/01", 50], ["2017/02", 60], ["2017/03", 100], ["2017/04",200], ["2017/05",350], ["2017/06",600]];
		goChart(charData);
    </script>
</body>
</html>