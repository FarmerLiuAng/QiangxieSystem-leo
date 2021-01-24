<?php
namespace app\rabbitmq\controller;

use AMQPConnection;
use AMQPChannel;
use AMQPExchange;
use AMQPQueue;

use think\Config;
class Client
{
    public $conn = "";//连接对象
    public $channel = "";//通道对象

    /**
     * 连接到rabbitmq
     *
     * @access public
     * @param mixed $connName 连接名
     */
    public function connect($connName){
        $Config =Config::get('rabbitmq.'.$connName);
        $connConfig = $Config["conn"];
        $this->conn = new AMQPConnection($connConfig);//建立连接
        if($this->conn->connect()){
            echo "连接名 ".$connName." 成功建立连接！\n";
        }
        //创建channel（信道或者叫通道）
        $this->channel = new AMQPChannel($this->conn);
        echo "连接名 ".$connName." 创建通道完毕！\n";
    }

    /**
     * 初始化rabbitmq
     *
     * @access public
     */

    public function initializationRabbitmq(){
        //获取rabbitmq配置
        $config=Config::get('rabbitmq');
        foreach($config as $key => $vo){
            echo $key;
            echo "开始创建交换区与队列\n";
            $this->createExchangeQueue($key,$vo["queue"]);
            echo "创建交换区与队列结束\n";
        }
    }

    /**
     * 使用析构函数关闭rabbitmq的连接
     *
     * @access public
     */
    public function __destruct(){
        $conn = $this->conn;
        $conn->disconnect(); //关闭连接
        echo "成功关闭连接\n";
    }

    /**
     * 创建交换区与队列
     *
     * @access public
     * @param mixed $connName 连接名
     * @param mixed $queueConfig 队列配置
     * @return array 返回类型
     * 
     */

    public function createExchangeQueue($connName,  $queueConfig){;
        $this->connect($connName);
        $channel = $this->channel;
        foreach($queueConfig as $key=>$vo){
            //创建交换机对象
            $exChange = new AMQPExchange($channel);
            $exChange->setName($vo["exchange"]);
            $exChange->setType($vo["exchangeType"]); //direct类型
            $exChange->setFlags($vo["exchangeFlags"]); //持久化 ,支持rabbitMq重启时交换机自动恢复
            echo "连接名 ".$connName." 交换机名 ".$vo["exchange"]." 完成交换机对象！ Exchange Status:".$exChange->declareExchange()."\n";//查看如果交换机不存在则进行创建

            //创建队列
            $queue = new AMQPQueue($channel);
            $queue->setName($vo["queue"]);
            $queue->setFlags($vo["queueFlags"]); //队列持久化
            echo "连接名 ".$connName." 交换机名 ".$vo["exchange"]." 队列名 ".$vo["queue"]." 完成队列！ Message Total:".$queue->declareQueue()."\n";//查看，如果不存在则创建

            //rabbitmq不是直接发送到队列，发送到交换区，由交换区决定发给某个队列
            echo '队列绑定！: '.$queue->bind($vo["exchange"], $key)."\n"; //绑定路由
        }
    }

    /**
     * 生产者
     *
     * @access public
     * @param mixed $msg    消息
     * @param mixed $connName 连接名
     * @param mixed $routeKey 路由键
     * @return bool
     */
    public function producerMsg($msg = "测试了", $connName = "localhost", $routeKey ="collectorder.route"){
        $this->connect($connName);
        $channel = $this->channel;
        $config=Config::get('rabbitmq.'.$connName);
        $queue = $config["queue"][$routeKey];
        //创建交换机对象
        $exChange = new AMQPExchange($channel);
        $exChange->setName($queue["exchange"]);
        $result = $exChange->publish($msg, $routeKey); //发送消息
        if($result){
            echo "生产成功： 连接名 ".$connName." 队列名 ".$queue["queue"]." 生产消息 ".$msg." \n";
        }else{
            echo "生产失败： 连接名 ".$connName." 队列名 ".$queue["queue"]." 生产消息 ".$msg." \n";
        }
    }

    /**
     * 消费者
     *
     * @access public
     * @param mixed $connName 连接名
     * @param mixed $routeKey 路由键
     * @return bool
     */
    public function consumerMsg($connName = "localhost", $routeKey ="collectorder.route"){
        $this->connect($connName);
        $channel = $this->channel;
        $config=Config::get('rabbitmq.'.$connName);
        //创建队列
        $queue = new AMQPQueue($channel);
        $queue->setName($config["queue"][$routeKey]["queue"]);
        $queue->setFlags($config["queue"][$routeKey]["queueFlags"]); //队列持久化

        echo "开始获取连接名 ".$connName." 队列名 ".$config["queue"][$routeKey]["queue"]." 消费消息 \n";//查看如果交换机不存在则进行创建
        //接受消息
        $queue->consume(function ($envelope, $queue) {
            $msg = $envelope->getBody();
            echo $msg."\n"; //处理消息
        }, AMQP_AUTOACK); //自动应答
    }
}




<?php
// rabbitmq配置
return [
    'localhost' => [                                //连接名称
            "conn" => [
                'host' => '127.0.0.1',             //连接地址
                'vhost' => '/',                     //管理，这玩意儿相当于mysql的数据库
                'port' => 5672,                      //端口
                'login' => 'admin',                //账号
                'password' => '123',               //密码
                'heartbeat' => 30,                  //心跳
            ],
            "queue"=>[
                "collectorder.route"=>[                     //路由 key
                    'exchange'=>'collectorder.exchange',  //交换区名称
                    'queue'=>'collectorder.queue',         //队列名
                    'exchangeType'=>AMQP_EX_TYPE_DIRECT,  //交换机类型
                    'exchangeFlags'=>AMQP_DURABLE,         //交换机标志
                    'queueFlags'=>AMQP_DURABLE             //队列标志
                ]
            ]
    ]
];