<?php
namespace launchpencil\joinmessage;//ファイルの位置

//呼び出し軍
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class Main extends pluginBase implements Listener
{
    public function onEnable()//起動時の処理
    {
        $this->getLogger()->notice("-----------------------");
        $this->getLogger()->notice("入退室通知プラグインの ");
        $this->getLogger()->notice(" 準備が完了しました。  ");
        $this->getLogger()->notice("-----------------------");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function join(PlayerJoinEvent $event)//参加時
    {
        $name = $event->getPlayer()->getName();
        $event->setJoinMessage("§a$name さんが参加しました。ごゆっくりどうぞ。");
    }

    public function onquit(PlayerQuitEvent $event)//退出時
    {
        $reason = $event->getQuitReason();
        $player = $event->getPlayer();
        $name   = $event->getPlayer()->getName();

        ///変数の置き換え
        $quit1 = "§a$name さんが切断により退出しました。";
        $quit2 = "§a$name さんがタイムアウトにより退出しました。";
        $quit3 = "§a$name さんがサーバーのエラーにより退出しました。";
        $quit4 = "§a$name さんがにより退出しました。";
        $quit5 = "§a$name さんがにより退出しました。";

        //退出時のif判定
        switch($reason)
        {
            case 'client disconnect':
                $event->setQuitMessage($quit1);//ここで上のものを流す
                break;
                
            case 'timeout':
                $event->setQuitMessage($quit2);//ここで上のものを流す
                break;
                
            case 'Internal server error':
                $event->setQuitMessage($quit3);
                break;
        }       
     }
}
