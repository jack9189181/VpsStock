<?php
/*
 * 获取相关VPS网页信息数据
 */
include 'mysql.php';
class getinfo {
	//读取数据库信息
	public function readsql() {
		$db = new mysql;
		$dbinfo = $db->db();
		return $dbinfo;
	}

	//更新存库信息
	public function update() {
		$a = new getinfo;
		$b = $a->readsql();
		//循环读取数据库中的商家信息
		foreach ($b as $key => $value) {
			$url = $value['buylink'];
			$html = file_get_contents($url);
			preg_match('|<h1>(.*?)<\/h1>|i', $html, $m);
			if ($m['1'] == 'Oops, there\'s a problem...') {
				//无货
				return false;
			} else {
				//有货
				return true;
			}
		}
	}
}

$a = new getinfo;
$b = $a->update();
?>