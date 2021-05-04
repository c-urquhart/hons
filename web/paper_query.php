<?PHP
	function getPaper($constr){
		$sql = 'select * from papers';
		$result = $constr->query($sql);
		return $result;
	}
?>