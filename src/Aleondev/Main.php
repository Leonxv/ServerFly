<?php

namespace Aleondev;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\player\PlayerMoveEvent;

class Main extends PluginBase implements Listener {

    public $players = array();

     public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN . "ServerFly Enable");
     }

     public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "ServerFly Disable");
     }
   
    public function onCommand(CommandSender $sender, Command $cmd, $label,array $args) : bool {
        if(strtolower($cmd->getName()) == "fly") {
            if($sender instanceof Player) {
                if($this->isPlayer($sender)) {
                    $this->removePlayer($sender);
                    $sender->setAllowFlight(false);
                    $sender->sendMessage("§e[Fly]§b >> §4Fly ist §cDisable");
				$sender->addTitle("§e[ServerFly]\n§cIst Disable\n§e[ServerFly] §aBy Aleondev");
                    return true;
                }
                else{
                    $this->addPlayer($sender);
                    $sender->setAllowFlight(true);
                    $sender->sendMessage("§e[Fly]§b >> §4Fly Ist §aEnable");
				$sender->addTitle("§e[ServerFly]\n§4Ist §aEnable\n§e[ServerFly] §aBy Aleondev");
                    return true;
                }
            }
            else{
                $sender->sendMessage("§e[Fly]§b >> §4Fly Ist §cDisable");
				$sender->addTitle("§e[ServerFly]\n§4Ist §cDisable\n§e[ServerFly] §aBy Aleondev");
                return true;
            }
        }
    }
    public function addPlayer(Player $player) {
        $this->players[$player->getName()] = $player->getName();
    }
    public function isPlayer(Player $player) {
        return in_array($player->getName(), $this->players);
    }
    public function removePlayer(Player $player) {
        unset($this->players[$player->getName()]);
    }
}
