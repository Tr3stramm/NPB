<?php

declare(strict_types=1);

namespace Tr3stramm;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener {
    private array $allowedPlayers = [
        "Tr3stramm"
    ];

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TF::GREEN . "NPB enabled!");
    }
    public function onDisable(): void {
        $this->getLogger()->info(TF::GREEN . "NPB disable!");
    }

    public function onPlace(BlockPlaceEvent $event): void {
        $player = $event->getPlayer();
        if (!$this->isAllowed($player)) {
            $event->cancel();
            $player->sendActionBarMessage(TF::RED . "You can't place blocks!");
        }
    }

    public function onBreak(BlockBreakEvent $event): void {
        $player = $event->getPlayer();
        if (!$this->isAllowed($player)) {
            $event->cancel();
            $player->sendActionBarMessage(TF::RED . "You can't break blocks!");
        }
    }

    private function isAllowed(Player $player): bool {
        return in_array($player->getName(), $this->allowedPlayers, true);
    }
}
