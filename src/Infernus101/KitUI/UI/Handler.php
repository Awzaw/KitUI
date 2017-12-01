<?php

namespace Infernus101\KitUI\UI;

use Infernus101\KitUI\Main;
use Infernus101\KitUI\UI\windows\KitMainMenu;
use Infernus101\KitUI\UI\windows\KitInfo;
use Infernus101\KitUI\UI\windows\KitError;
use pocketmine\Player;

class Handler {

	const KIT_MAIN_MENU = 100;
	const KIT_INFO = 99;
	const KIT_ERROR = 98;

	private $types = [
		KitMainMenu::class,
		KitInfo::class,
		KitError::class
	];

	public function getWindowJson(int $windowId, Main $loader, Player $player): string {
		return $this->getWindow($windowId, $loader, $player)->getJson();
	}

	public function getWindow(int $windowId, Main $loader, Player $player): Window {
		$windowId = $this->getWindowIdFor($windowId);
		if(!isset($this->types[$windowId])) {
			throw new \OutOfBoundsException("Tried to get window of non-existing window ID.");
		}
		return new $this->types[$windowId]($loader, $player);
	}

	public function getWindowIdFor(int $windowId): int {
		return 100 - $windowId;
	}
}
