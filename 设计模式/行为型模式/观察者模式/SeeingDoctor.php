﻿<?php
/*
 * 观察者模式：就医
 *
 */


//抽象主体
interface Subject{
    public function add(Observer $observer);
    public function delete(Observer $observer);
    public function notifyObservers();
}

//抽象观察者
interface Observer{
    public function update();   //收到通知或触发事件后要执行的操作
}

//具体主体：科室
class Doctor implements Subject{
    private $_observers;
    public function __construct(){
        $this->_observers = [];  //在主体内部创建一个观察者的对象列表，这个数组的元素都是对象类型
    }

    /**
     * 患者挂号
     * @param Observer $observer
     */
    public function add(Observer $observer){
        $this->_observers[] = $observer;  //新增一个观察者
    }

    /**
     * 触发叫号事件，通知用户notifyObservers
     * @return bool
     */
    public function notifyObservers(){  //相当于component中的trigger
        if(!is_array($this->_observers)){
            return false;
        }

        foreach($this->_observers as $observer){  //通知每一个观察者
            $observer->update();
        }
        return true;
    }

    /**
     * 取消挂号
     * @param Observer $observer
     * @return bool
     */
    public function delete(Observer $observer){
        $index = array_search($observer,$this->_observers);

        if($index === false || !array_key_exists($index,$this->_observers)){
            return false;
        }

        unset($this->_observer[$index]); //删除一个观察者
        return true;
    }


}
 

//具体观察者：患者
class Patientor implements Observer{
     private $_name;
     public function __construct($name){
          $this->_name = $name;
     }
 
     public function update(){
          echo '患者：   “',$this->_name.'”  已收到通知，  会马上前去就诊' . PHP_EOL;
     }
}
 


$doctor = new Doctor();  //创建一个主体对象

//新增第一个观察者
$patientor1 = new Patientor('奥巴马');
//将这个观察者注册到主体当中，相当于注册事件
$doctor->add($patientor1);
//通知，相当于触发事件
$doctor->notifyObservers();

//新增第二个观察者
$observer2 = new Patientor('山姆');
$doctor->add($observer2);
//通知
$doctor->notifyObservers();






?>