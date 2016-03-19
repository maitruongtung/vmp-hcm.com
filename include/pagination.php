<?php
if(isset($pageNum)){
	// xu ly url
	$urlFirst = $urlCur = $urlLast = "";
	$pageCur = 1;
	if(strpos($_SERVER['REQUEST_URI'], '&page=')){
		// Cat chuoi &page=
		$explodePage = explode('&page=', $_SERVER['REQUEST_URI']);
		if(strpos($explodePage[1], '&')){
			$explodeItem = explode('&', $explodePage[1]);
			$pageCur = $explodeItem[0];
		}else{
			$pageCur = $explodePage[1];
		}
		$urlFirst = str_replace("&page={$pageCur}", "&page=1", $_SERVER['REQUEST_URI']);
		$urlCur = str_replace("&page={$pageCur}", "&page=__CUR_PAGE__", $_SERVER['REQUEST_URI']);
		$urlLast = str_replace("&page={$pageCur}", "&page={$pageNum}", $_SERVER['REQUEST_URI']);
	}else{
		$urlFirst = $_SERVER['REQUEST_URI'] . "&page=1";
		$urlCur = $_SERVER['REQUEST_URI'] . "&page=__CUR_PAGE__";
		$urlLast = $_SERVER['REQUEST_URI'] . "&page={$pageNum}";
	}
?>
<nav>
  <ul class="pagination pagination-sm">
    <li>
      <a href="<?php echo $urlFirst; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php
		for ($i=1; $i <= $pageNum ; $i++) { 
			$url = str_replace('__CUR_PAGE__', $i, $urlCur);
    ?>
    <li class="<?php echo ($pageCur==$i) ? 'active' : ''; ?>"><a href="<?php echo $url; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <li>
      <a href="<?php echo $urlLast; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php } ?>