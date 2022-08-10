<?php

namespace candle\spawn;

use candle\spawn\Listeners\ServerForm;
use candle\spawn\scoreboard\OnLevel;
use candle\spawn\scoreboard\Scoreboard;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;


class Candle extends PluginBase implements Listener
{
    public function onEnable(): void {
        $this->getLogger()->info("Spawn been enabled");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getServer()->getWorldManager()->loadWorld("world");
        $this->getServer()->getPluginManager()->registerEvents(new ServerForm(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new OnLevel(), $this);
    }

    public function onDisable(): void
    {
        $this->getLogger()->info("Spawn been Disabled");
    }

    public function onJoin(PlayerJoinEvent  $e) {
        $player = $e->getPlayer();
        $player->teleport(new Position(0, 50, -5, Server::getInstance()->getWorldManager()->getWorldByName("world")));
        $e->setJoinMessage(TextFormat::ITALIC . $player->getName()   ." has joined the server");
        $player->getInventory()->setItem(0, VanillaItems::COMPASS()->setCustomName(TextFormat::ITALIC . "Server selector")->setLore(["§fServers"]));
    }

    public function onQuit(PlayerQuitEvent $e){
        $player = $e->getPlayer();
        $e->setQuitMessage(TextFormat::ITALIC . $player->getName() . " has left the server");
    }

    public function DamageEvent(EntityDamageEvent $event)
    {
        $cause = $event->getCause();
        if ($cause == $event::CAUSE_FALL) {
            $event->cancel();
        }
    }

    public function NoPvP(EntityDamageEvent $event) {
        $cause = $event->getCause();
        if ($event->getEntity()->getWorld()->getDisplayName() === "world") {
            if($cause == $event::CAUSE_ENTITY_ATTACK) {
                $event->cancel();
            }
        }
    }


}
