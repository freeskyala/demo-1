<?php declare(strict_types=1);
/**
 * This file is part of EasySwoole
 * @link     https://github.com/easy-swoole
 * @document https://www.easyswoole.com
 * @license https://github.com/easy-swoole/easyswoole/blob/3.x/LICENSE
 */

namespace App\HttpController;
use App\WebSocket\Actions\Broadcast\BroadcastMessage;
use EasySwoole\EasySwoole\Task\TaskManager;
use App\Task\BroadcastTask;

/**
 * 登录系统
 * Class Register
 * @package App\HttpController
 */
class Test extends Base
{
    public function index()
    {
        $params = $this->request()->getRequestParam();
        $message = new BroadcastMessage;
        $message->setFromUserFd($params['fd']);
        $message->setContent('test'.time());
        $message->setType('text');
        $message->setSendTime(date('Y-m-d H:i:s'));
        TaskManager::getInstance()->async(new BroadcastTask(['payload' => $message->__toString(), 'fromFd' => $params['fd']]));

        $this->writeJson(200, ['code' => 1, 'msg' => 'aaa','test'=>$params]);
    }
}
