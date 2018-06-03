<?php
//冒泡排序
function bubbleSort($arr)
{
	$len = count($arr);
	for($i=0;$i<$len-1;$i++)
	{
		for($j=0;$j<$len-1-$i;$j++)
		{
			if($arr[$j]>$arr[$j+1])
			{
				$temp = $arr[$j];
				$arr[$j] = $arr[$j+1];
				$arr[$j+1] = $temp;
			}
		}
	}
}
//递归
function abc($n)
{
	if($n == 1)
	{
		return 1;
	}else
	{
		return $n*abc($n-1);
	}
}

//二分法查找
function search($array,$k,$low=0,$high=0)
{	
	//判断是否第一次调用
	if(count($array)!=0 and $high == 0)
	{
		$high = count($array);
	}	
	if($low<=$high)
	{
		$mid = intval(($low+$high)/2);
		if($array[$mid] == $k)
		{
			return $mid;
		}elseif($k < $array[$mid])
		{
			return search($array,$k,$low,$mid-1);
		}else
		{
			return search($array,$k,$mid+1,$high);
		}

	}
	return -1;
}
//快排
function quick_sort($arr)
{	

	if(count($arr)<=1)
	{
		return $arr;
	}
	$key = array_shift($arr);
	$key_arr = array($key);
	$left_arr = array();
	$right_arr = array();
	foreach($arr as $value)
	{
		if($value < $key)
		{
			$left_arr[] = $value;
		}else
		{
			$right_arr[] = $value;
		}
	}
	return array_merge(quick_sort($left_arr),$key_arr,quick_sort($right_arr));
}

//创建多级目录
function create_dir($path,$mode=0777)
{
	if(is_dir($path))
	{
		echo '该目录已经存在';
	}else
	{
		if(mkdir($path,$mode,true))
		{
			echo '创建目录成功';
		}else
		{
			echo '创建目录失败';
		}
	}
}

// 单例
//定义单例的数据库操作类
class Db{
	//私有的静态的保存对象的属性
	private static $obj = NULL;
	//私有的构造方法：阻止类外new对象
	private function __construct(){}
	//私有的克隆方法：阻止类外clone对象
	private function __clone(){}
	//公共的静态的创建对象的方法
	public static function getInstance(){
		//判断对象是否存在
		if(!self::$obj instanceof self)
		{
			//如果对象不存在，则创建它
			self::$obj = new self;
		}
		return self::$obj;//返回对象
	}
}
//创建类的对象
$obj1 = Db::getInstance();
$obj2 = Db::getInstance();
var_dump($obj1,$obj2);

//工厂
//(1)定义一个学生类
class Student{}
//(2)定义一个教师类
class Teacher{}
//(3)创建一个工厂类：生产不同类的对象的工厂
final class Factory{
	//公共的静态的创建不同类对象的方法
	public static function getInstance($className)
	{
		return new $className();
	}
}

//(4)创建学生类和教师类对象
$stuObj = Factory::getInstance("Student");
$teaObj = Factory::getInstance("Teacher");
var_dump($stuObj,$teaObj);


//单例工厂
//(1)定义一个学生类
class Student{}
//(2)定义一个教师类
class Teacher{}
//(3)创建一个工厂类：生产不同类的对象的工厂
final class Factory{
	//私有的静态的保存对象的数组属性
	private static $obj = array();

	//公共的静态的创建不同类对象的方法
	public static function getInstance($className)
	{
		//判断对应的类的对象是否存在
		if(!isset(self::$obj[$className]))
		{
			//创建新对象，并存于数组属性中
			/*
				$obj[Student] = Student对象
				$obj[Teacher] = Teacher对象
				$obj[Product] = Product对象
			*/
			self::$obj[$className] = new $className;
		}
		//返回类的对象
		return self::$obj[$className];
	}
}

//(4)创建学生类和教师类对象
$obj1 = Factory::getInstance("Student");
$obj2 = Factory::getInstance("Teacher");
$obj3 = Factory::getInstance("Student");
$obj4 = Factory::getInstance("Teacher");
var_dump($obj1,$obj2,$obj3,$obj4);


//二维数组排序
$guys = Array
(
    [0] => Array
        (
            [name] => jake
            [score] => 80
            [grade] => A
        )
    [1] => Array
        (
            [name] => jin
            [score] => 70
            [grade] => A
        )
    [2] => Array
        (
            [name] => john
            [score] => 80
            [grade] => A
        )
    [3] => Array
        (
            [name] => ben
            [score] => 20
            [grade] => B
        )
)
// 例如我们想按成绩倒序排列，如果成绩相同就按名字的升序排列。
// 这时我们就需要根据$guys的顺序多弄两个数组出来：
$scores = array(80,70,80,20);
$names = array('jake','jin','john','ben');
// 然后
array_multisort($scores, SORT_DESC, $names, $guys);//就行了

//定义一个方法使，数组中的偶数做键，奇数做值，返回数组
function odd($var)
{
	return($var & 1);
}
function even($var)
{
	return(!($var & 1));
}
$arr1 = array('name','aaa','birth','1995','latest','5.6.0');
function demo($arr1)
{
	$arreven = array_filter($arr1, "even");
	$arrodd = array_filter($arr1, "odd");
	$arr2 = array_combine($arreven, $arrodd);
	return $arr2;
}
var_dump(demo($arr1));

//数组去重

