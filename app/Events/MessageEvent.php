<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    /**
     * 信息通知事件
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = ['power'=>'10'];
    }

    /**
     * 频道
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['message-channel'];
    }
}
