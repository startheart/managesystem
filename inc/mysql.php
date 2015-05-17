<?php
class mysql{
    //连接服务器、数据库以及执行SQL语句的类库
    public $database;
    public $server_username;
    public $server_userpassword;
    function mysql()
  	{  //构造函数初始化所要连接的数据库
       $this->server_username="root";
       $this->server_userpassword="2126726";
       }//end mysql()
	function link($database)
  	{  //连接服务器和数据库
     
        if ($database==""){
            $this->database="msfc";
            }else{
            $this->database=$database;
            }
        //连接服务器和数据库
     	if($id=mysql_connect('localhost',$this->server_username,$this->server_userpassword)){
          //mysql_query("SET CHARACTER SET gb2312");
     		mysql_query("SET NAMES UTF8");
            mysql_query("set character_set_client=utf8"); 
            mysql_query("set character_set_results=utf8");
		  if(!mysql_select_db($this->database,$id)){
		       echo "数据库连接错误！！！";
               exit;
               }
 	       }else{
               echo "服务器正在维护中，请稍后重试！！！";
               exit;
      	   }
      	   return $id;
		//mysql_query("SET CHARACTER SET gb2312");
	}//end link($database)
	function excu($query)
    {     //执行SQL语句
    		if($result=mysql_query($query)){
				return $result;
        	}else{
                echo mysql_error();
             	echo "sql语句执行错误！！！请重试!!!";
       		    exit;
        	}
    } //end  exec($query)
} //end class mysql
?>
