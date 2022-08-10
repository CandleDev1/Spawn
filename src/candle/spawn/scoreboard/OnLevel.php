<?php

namespace candle\spawn\scoreboard;

use candle\spawn\Candle;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class OnLevel implements Listener {


    private $plugin;
    private $player;
    private $Main;


    public function onTeleportEvent(EntityTeleportEvent $event): void
    {

        $player = $event->getEntity();
        if ($player instanceof Player) {
            if ($event->getTo()->getWorld()->getFolderName() === "WorldNameHere") {
                Scoreboard::remove($player);
                Scoreboard::new($player, "world", TextFormat::DARK_AQUA. "ServerName");
                Scoreboard::setLine($player, 1, TextFormat::AQUA . " ⇒ Mode: " . TextFormat::AQUA . "Spawn" );
                Scoreboard::setLine($player, 2, TextFormat::AQUA . " ⇒ Online : " . TextFormat::AQUA . $players = count(Server::getInstance()->getOnlinePlayers()));
                Scoreboard::setLine($player, 3, TextFormat::AQUA . " ⇒ ip : " . TextFormat::AQUA . "Server IP here");
            }
        }
    }

}
