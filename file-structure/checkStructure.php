<?php
ini_set('max_execution_time', 0); // 0 = Unlimited
include('include/conn.php');

/**
 * 
 */
class scanDirectory
{
	public $db = '';
	public $html = '';
	// public $array = array(
	//    	array('id' => 1, 'title' => 'Flash', 'parentId' => 0, 'mainDirectory' => 'c:/Drivers'),
	//     array('id' => 2, 'title' => '20210508.11315467', 'parentId' => 1, 'mainDirectory' => 'c:/Drivers/Flash'),
	//     array('id' => 3, 'title' => 'CUCN27WW_71WW.exe',
	//         'parentId' => 2,
	//         'mainDirectory' => 'c:/Drivers/Flash/20210508.11315467',
	//     ),
	//     array(
	//         'id' => 4,
	//         'title' => '20221506.21495691',
	//         'parentId' => 3,
	//         'mainDirectory' => 'c:/Drivers/Flash',
	//     ),
	//     array(
	//         'id' => 5,
	//         'title' => 'CUCN29WW_73WW.exe',
	//         'parentId' => 4,
	//         'mainDirectory' => 'c:/Drivers/Flash/20221506.21495691'
	//     )
	// );

	function __construct($conn)
	{
		$this->db = $conn;
	}



	public function checkDir(string $dir) {

		$list = @scandir($dir);
		if(is_array($list)) {
			unset($list[array_search('.', $list, true)]);
		    unset($list[array_search('..', $list, true)]);
		}
	    
	    // prevent empty ordered elements
	    if (is_array($list) && count($list) < 1) {
	    	$this->saveDir($dir, $list);
	        return false;
	    }


	    foreach($list as $folder) {
	    	$this->saveDir($dir, $folder);
	        if(is_dir($dir.'/'.$folder)) {
	        	$this->checkDir($dir.'/'.$folder);
	        }
	    }
	}

	private function saveDir($dir, $folder)
	{
		$lastDir = explode("/", $dir);
		$lastDirs = end($lastDir);
		$parentId = $this->db->query('select id from directory where title="'.$lastDirs.'" limit 0,1');
		$pId = (!empty($parentId->num_rows)) ? $parentId->fetch_assoc()['id'] : 0;		
		$last_id_in_table1 = ($pId) ? $pId : 0;
		$this->db->query('insert into directory(title, parentId, mainDirectory) value("'.$folder.'", '.$last_id_in_table1.',"'.$dir.'")');
	}

	public function buildTree(array $elements, $parentId = 0) {
	    $branch = array();
	    foreach ($elements as $element) {
	        if ($element['parentId'] == $parentId) {  
	            $children = $this->buildTree($elements, $element['id']);
	            if ($children) {
	                $element['children'] = $children;
	            }
	            $branch[] = $element;
	        }
	    }
	    return $branch;
	}


	public function buildMenu($menu_array, $parentId = 0)
	{
		foreach ($menu_array as $value) {

			if(!empty($value['children']) ) {
				$this->html .= '<tr data-widget="expandable-table" aria-expanded="false">
							<td><i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
							'.$value['title'].' ('.$value['mainDirectory'].')
							</td>
						</tr> 
						<tr class="expandable-body">
	                      <td>
	                        <div class="p-0">
	                          <table class="table table-hover">
	                            <tbody>';
	                         		$this->buildMenu($value['children'],$value['parentId']);
	            	$this->html .= '</tbody>
		                      </table>
		                    </div>
		                  </td>
		                </tr>';
			} else {
				$this->html .= '<tr>
	                      	<td>'.$value['title'].' ('.$value['mainDirectory'].')</td>
	                    </tr>';
			}
		}

	    return $this->html;
	}

}


$html = '<tr><td class="border-0">No directory available</td></tr>';
$obj = new scanDirectory($conn);
if(!empty($_POST['scanDirectory'])) {
	$conn->query('truncate table directory');
	$result = $obj->checkDir($_POST['scanDirectory']);
}

$search = false;
$query = "select * from directory";
if(!empty($_POST['searchDirectory'])) {
	$search = true;
	$query = "select * from directory where mainDirectory like '%".$_POST['searchDirectory']."%' or title like '%".$_POST['searchDirectory']."%'";
}
$tree = array();
$res = $conn->query($query);

if ($res->num_rows > 0) {
	$tree = $res->fetch_all(MYSQLI_ASSOC);
	if(!$search) {
		$tree = $obj->buildTree($tree);	
	}
	$html = $obj->buildMenu($tree);
}