<?php
include("connection.php");

// class Fruit{
//   public $name;
//   public $color;

//   function __construct($name,$color){
//     $this->name = $name;
//     $this->color = $color;
//   }
//   function get_name(){
//     return $this->name;
//   }
//   function get_color(){
//     return $this->color;
//   }
// }
// $apple = new Fruit("Apple","red");
// echo $apple->get_name();
// echo "<br>";
// echo $apple->get_color();

// Class and Object () Example
 
// class calculation{
//   public $a,$b,$c;

//   function sum(){
//     $this->c = $this->a + $this->b;
//     return $this->c;
//   }
//   function sub() {
//     $this->c = $this->a-$this->b;
//     return $this->c;
//   }
// }
// $c1 = new calculation();
// $c1->a = 20;
// $c1->b = 10;

// $c2 =  new calculation();
// $c2->a = 50;
// $c2->b = 35;

// echo "C1 Valaues: ". $c1->sum() . "\n";
// echo "C2 Valaues: ". $c2->sub();

// constructon

// class person{
//   public $name;
//   public $age;

//   function __construct($name = "No name",$age = 0){
//     $this->name = $name;
//     $this->age = $age;
//   }
//   function show(){
//     echo $this->name ."-".$this->age ."<br>";
//   }
// }
// $p1 = new person();
// $p2 = new person("Ram kumar",15);
// $p3 = new person("Neel Maniya",22);
// $p1->show();
// $p2->show();
// $p3->show();

// Inheritance

// class employee{
//   public $name;
//   public $age;
//   public $salary;

//   function __construct($n,$a,$s){
//     $this->name = $n;
//     $this->age = $a;
//     $this->salary = $s;
//   }
  
//   function info(){
//     echo "<h3>Employee Profile</h3>";
//     echo "Employee Name :".$this->name."<br>";
//     echo "Employee Age  :".$this->age."<br>";
//     echo "Employee salary:".$this->salary."<br>";
//   }
// }
// class manager extends employee{
//   function __construct(){
//     echo "Manager Constructor";
//   }
// }


// $e1 = new employee("Ram",25,2000);

// $e1->info();

// class base{
//   public  $name;
//   public function __construct($n){
//           $this->name = $n;
//   }
//   public function show(){
//     echo "Your name:".$this->name."<br>";
//   }
// }
//   $test = new base("Yahoo Baba");
//   $test->name = "Baba Yahoo";
//   $test->show();


// overriding Methods & ProPerties

// class base{

//   public $name = "Parent Class";

//   public function calc($a,$b){
//     return $a*$b;
//   }

// }
// class derived extends base{

//   public $name = "Child Class";
//   public function calc($a,$b){
//     return $a+$b;
//   }

// }

// $test = new derived();

// echo $test->calc(2,10);


// abstract
// abstract class parentclass{
//   public $name;
//   abstract protected function calc($a,$b);
// }
//   class childClass extends parentclass{
//     public function calc($c,$d){
//       // echo $c+$d;
//       echo "Hello Neel";
//     }
//   }
//   $test = new childClass();
//   $test->calc(10,20);


// interface parent1{
//   public function calc($a,$b);
// }
// interface parent2{
//   public function sub($a,$b);
// }
// class childClass implements parent1, parent2{
//   public function calc($a,$b){
//     echo $a+$b;
//   }
//   public function sub ($c,$d){
//     echo $c-$d;
//   }
// }
// $test = new childClass();
// $test->calc(20,20);

// echo "<br>";

// $test->sub(20,15);

// class MyClass {
//   public static $str = "Hello World!";
  
//   public static function hello() {
//     echo MyClass::$str;
//   }
// }
// echo MyClass::$str;
// echo "<br>";
// echo MyClass::hello();

// class MyClass{
//   public static $str = "Hello Neel Maniya";

//   public static function hello(){
//     echo MyClass::$str;
//   }
// }
// echo MyClass::$str;
// echo "<br>";

// class base{
//   public static $name = "Yahoo Baba";
// }
// class derived extends base{
//   public static function show(){
//     echo parent::$name;
//   }
// }
// $test = new derived();
// $test->show();
// class base{
//   protected static $name = "Yahoo ";
//   public function show(){
//     echo self::$name;
//       echo static::$name;
//   }
//   }
//   class derived extends base{
//     protected static $name = "Baba";
//   }
//   $test = new derived();
//   $test->show();


// trait hello{
//   public function sayhello(){
//     echo "Hello! Neel L Maniya";
//       } 
//   }
//   class base {
//     use hello;
//   }
//   $test = new base();
//   $test->sayhello();


// trait hello{
//   private function sayhello(){
//     echo "Hello from Hello Trait.\n";
//   }
// }
// class base{
//   use hello {
//     hello::sayhello as public newhello;
//   }
// }
// $test = new base();

// $test->newhello();

// function fruits (array $names){
//   foreach ($names as $name){
//     echo $name."<br>";
//   }
// }
// $test = ["Apple","Avocado","Strawberry"];
// fruits($test);

// class school{
//   public function getNames($names){
//     foreach($names -> Names() as $name){
//       echo $name."<br>";
//     }
//   }
// }
// class student{
//   public function Names(){
//     return ["Ram","Krishan","Gopal","het","Vasu"];
//   }
// }
// $stu = new student();
// $sch = new school();

// $sch->getNames($stu);

// class abc{
//   public function first(){
//     echo "This is first function";
//     echo "<br>";
//     return $this;
//   }
//   public function second(){
//     echo "This is second function";
//     echo "<br>";
//     return $this;
//   }

//   public function third(){
//     echo "This is third function";
//     echo "<br>";
//   }
// }
// $test = new abc();
// $test ->first()->second()->third();


// class abc {
//   public  function __construct(){
//     echo "<br>";
//     echo "This is Construct function";
//   }
//   public function hello(){
//     echo "<br>";
//     echo "Hello Everyone\n";
//   }
//   public function __destruct(){
//     echo "<br>";
//     echo "This is destruct function \n";
//   }
// }
// $test = new abc();
// $test->hello();

// class Fruit{
//   var $name;
//   var $color;
//   function __construct($name,$color){
//     $this->name = $name;
//     $this->color = $color;
//   }
//   function __destruct(){
//     echo "The fruit is {$this->name} and the color is {$this->color}.";
//   }
// }
// $apple = new Fruit();

//  --- Get Method ---

// class abc{
//   private $data = ["name"=>"Neel Maniya","course"=>"PHP","fee"=>2000];
//   public function __get($key){
//     if(array_key_exists($key,$this->data)){
//       return $this->data[$key];
//     }else{
//       return "This key($key) is not defined";
//     }
//   }
// }
// $test = new abc();
// echo $test->age;

// --- set Method ---

// class student{
//   private $name;
//   public function __get($property){
//     echo "Your are trying to access Non existing or private property($property)\n";
//   }
//   public function __set($property,$value){
//     if(property_exists($this,$property)){
//       $this->$property = $value;
//     } else{
//       echo "Property does not exist : $property";
//     }
//   }
// }
// $test = new student();
// $test->name = "Neel Maniya";


// --- call Method---

// class student{
//   private $first_name;
//   private $last_name;

//   private function setName($fname,$lname){
//     $this->first_name = $fname;
//     $this->last_name = $lname;
//   }
//   public function __call($method,$args){
//     if(method_exists($this,$method)){
//       call_user_func_array([$this,$method],$args);
//     }else{
//       echo "Method does not exist:$method";
//     }
//   }
// }
// $test = new student();
// $test->setName("Neel L","Maniya");

// echo "<pre>";
// print_r($test);
// echo "<pre>";

// --- CallStatic Method ex ---
// class Student{
//   private static function hello($name){
//     echo "Hello $name";
//   }
//   public static function __callStatic($method, $args){
//     if(method_exists(__class__,$method)){
//       call_user_func_array([__class__,$method],$args);
//     } else{
//       echo "Method does not exist: $method";
//     }
//   }
// }
// Student::hello("Neel L Maniya");


// __isset Method Ex

// class student {
//   public $course;
//   private $first_name;
//   private $last_name;
//   private $detail = ['name'=>'Test Name','age' =>'20'];

//   public function setName($fname,$lname)
//   {
//     $this->first_name = $fname;
//     $this->last_name = $lname;
//   }

//   public function __isset($name){
//     echo isset($this->detail[$name]);
//   }
// }
// $test = new student();
// echo isset($test->age);


//  unset Method Ex
// class student {
//   public  $course = "PHP";
//   private $first_name;
//   private $last_name;

//   public function setName($fname,$lname){
//     $this->first_name = $fname;
//     $this->last_name = $lname;
//   }
//   public function __unset($property){
//     unset($this->$property);
//   }
// }
// $test = new student();
// $test->setName("Neel","Maniya");
// unset($test->course);
// print_r($test);

// echo "<br>";

//  __tostring Method

// class abc{
//   public function __toString(){
//     return "Can't Print object as a string of class:".get_class($this);
//   }
// }
// $test = new abc();
// echo $test;
// echo "<br>";

// __sleep Method 
class student {
  public $course = "PHP";
  private $first_name;
  private $last_name;

  public function setName($fname,$lname){
    $this->first_name = $fname;
    $this->last_name = $lname;
  }
  public function __sleep(){
    return array('first_name','last_name');
  }
}
$obj = new student();
$obj->setName("Neel","Maniya");
$srl = serialize($obj);
echo $srl;

?>
