<?php
/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/08/23
 * Time: 15:22
 */

namespace AntiCheat\Task;


use AntiCheat\Main;
use pocketmine\Server;
use pocketmine\utils\Config;

class CheckPlayerTask extends PluginTask
{
    protected $banapi;
	/**@var string*/
	private $serverIp;
	/**@var string*/
	private $serverName;
	/**@var string*/
	private $path;

    public function __construct(Main $plugin)
    {
        parent::__construct($plugin);
		$this->plugin =$plugin;
        $this->banapi = $this->owner->getServer()->getPluginManager()->getPlugin("BanAPI");
    }

    public function onRun($currentTick) {
		foreach ($this->plugin->hackScore as $playerId => $data){		
			if($data["suspicion"] > 0){
				$this->plugin->hackScore[$playerId]["suspicion"] --;
			}
		}
		$server = Server::getInstance();
		foreach($server->getOnlinePlayers() as $sender){
		$Logger = Server::getInstance()->getLogger();
		$LegitOPsYML = new Config($this->plugin->getDataFolder() . "OP.yml", Config::YAML);
		$cfg = new Config($this->plugin->getDataFolder() . "Config.yml", Config::YAML);
		if ($sender->isOp()){
        if (!in_array($sender->getName(), $LegitOPsYML->get("LegitOPs"))){
          if ($sender instanceof Player)
          {
            $sname = $sender->getName();
            $message  = "SkillsMC > $sname used ForceOP!";
            $server->broadcastMessage(TF::AQUA . $message . "\n");				
            $sender->getPlayer()->kick("SkillsMC > ForceOP detected!");
          }
        }
      }
		}	
	}
}