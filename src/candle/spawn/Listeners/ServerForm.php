<?php

namespace candle\spawn\Listeners;


use jojoe77777\FormAPI\SimpleForm;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;
use candle\spawn\Candle;

class ServerForm implements Listener
{
    public function newSimpleForm($player): SimpleForm
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if ($data === null) return;
            switch ($data) {
                case 0:
                $player->transfer("SeverIP", "PORT", "ConsoleMessage");
                    break;
                case 1:
                    $player->transfer("SeverIP", "PORT", "ConsoleMessage");
                    break;
            }
        });
        $form->setTitle(TextFormat::ITALIC . TextFormat::DARK_AQUA . "⇒ Server Selector");
        $form->addButton(TextFormat::ITALIC . TextFormat::AQUA . "⇒ Factions");
        $form->addButton(TextFormat::ITALIC . TextFormat::AQUA . "⇒ Practice");
        $player->sendForm($form);
        return $form;

    }

    /**
     * @handleCancelled
     */
    public function onItemUse(PlayerItemUseEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();

        if ($item->getCustomName() == TextFormat::ITALIC . "Server selector") {
            $this->newSimpleForm($player);
        }
    }
}
