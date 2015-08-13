<?php
/**
 * PHP Board System
 * 
 * PHP 게시판 시스템
 * 
 *  author ZerglingGo <zerglinggo@zerglinggo.net>
 *  GitHub http://github.com/ZerglingGo/ZergBoard
 * license http://opensource.org/licenses/MIT MIT License
 */

class ZergBoard {
	private $mysqli;

	public function __construct($host, $dbid, $dbpw, $scheme, $prefix = "zbrd_") {
		$this->mysqli = new mysqli($host, $dbid, $dbpw, $scheme);
		$isExistsTable = $this->mysqli->query("SHOW TABLES LIKE '{$prefix}%'")->num_rows >= 4;
		if(!$isExistsTable) {
			$q = "CREATE TABLE `{$scheme}`.`{$prefix}board_data` (   `no` INT NOT NULL AUTO_INCREMENT ,".
																	"`boardname` TINYTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,".
																	"`boarddata` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,".
																	"PRIMARY KEY (`no`))".
																	"ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
			$this->mysqli->query($q);
			$q = "CREATE TABLE `{$scheme}`.`{$prefix}board` (    `no` INT NOT NULL AUTO_INCREMENT ,".
																"`writer` VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,".
																"`data` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,".
																"PRIMARY KEY  (`no`))".
																"ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
			$this->mysqli->query($q);
			//reply, file
		}

	}
}
?>