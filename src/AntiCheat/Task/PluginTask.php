<?php
/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/07/17
 * Time: 13:20
 */

namespace AntiCheat\Task;

use pocketmine\scheduler\Task;
use pocketmine\plugin\Plugin;

abstract class PluginTask extends Task
{
    /** @var Plugin */
    protected $owner;
	/**@var AntiHack*/
	private $plugin;
	/**@var string*/
	private $serverIp;
	/**@var string*/
	private $serverName;
	/**@var string*/
	private $path;
    /**
     * PluginTask constructor.
     * @param Plugin $plugin
     */
    public function __construct(Plugin $plugin)
    {
        $this->owner = $plugin;
    }

    /**
     * @return Plugin
     */
    final public function getOwner(): Plugin
    {
        return $this->owner;
    }
}
