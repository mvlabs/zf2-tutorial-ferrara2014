<?php

namespace Application\Service;

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class QueueService {

    private $params;
    
    
    public function __construct(array $params) {
        $this->params = $params;
    }
    
    private function getConnection() {
        
        return new AMQPConnection($this->params['host'],
                                  $this->params['port'],
                                  $this->params['user'],
                                  $this->params['password'],
                                  $this->params['vhost']);
    
    }    

    public function enqueueEvent($e) {
        
        $connection = $this->getConnection();

        $channel = $connection->channel();

        $channel->queue_declare($this->params['queue-name'], true, true, false, false);

        $msg = new AMQPMessage(json_encode($e->getParams()),
                               array('delivery_mode' => 2) // make message persistent
                               );

        $channel->basic_publish($msg, '', $this->params['queue-name']);

        $channel->close();
        $connection->close();
        
    }

    public function loop() {
            
        $connection = $this->getConnection();
        
        $channel = $connection->channel();

        $channel->queue_declare($this->params['queue-name'], true, true, false, false);
        
        echo ' [*] Waiting for events. To exit press CTRL+C', "\n";
    
        $callback = function($msg) {

            // send ack
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);

            echo 'Received event: ' . $msg->body . "\n";

        };


        $channel->basic_qos(null, 1, null);
        $channel->basic_consume($this->params['queue-name'], '', false, false, false, false, $callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
        
    }        
    
}
