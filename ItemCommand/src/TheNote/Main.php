<?php

#Copyright by TheNote

namespace TheNote;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->saveResource("config.yml", false);
        $this->getServer()->getPluginManager()->registerEvents($this, ($this));

    }

    public function onInteract(PlayerInteractEvent $event)
    {
        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $player = $event->getPlayer();
        $item = $event->getItem();
        $command = $cfg->getNested("Command");
        if ($item->getId() === $cfg->get("ItemID")) {
            Server::getInstance()->dispatchCommand(new ConsoleCommandSender(), str_replace(["{player}"], [$player->getName()], $command));
        }
        return true;
    }
}