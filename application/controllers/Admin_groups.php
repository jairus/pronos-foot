<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin_groups extends CI_Controller {
	var $table;
	var $controller;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "groups";
		$this->controller = "Admin_groups";
	}
	public function index(){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		$controller = $this->controller;
		$start = $_GET['start'];
		$start += 0;
		$limit = 50;
		$sort = $_GET['sort'];
		if($sort!="asc"&&$sort!="desc"){
			$sort = "asc";
		}
		$sortby = $_GET['sortby'];
		$sortby = str_replace("`", "", $sortby);
		$sortby = trim($sortby);
		if($sortby){
			$sql = "select * from `".$table."` where `deleted`<>1 order by `".db_escape($sortby)."` ".$sort." limit $start, $limit";
		}
		else{
			$sql = "select * from `".$table."` where `deleted`<>1 order by `name` asc limit $start, $limit";
		}
		$export_sql = md5($sql);
		$_SESSION['export_sqls'][$export_sql] = $sql;
		$q = $this->db->query($sql);
		$records = $q->result_array();		
		
		$sql = "select count(`id`) as `cnt` from `".$table."` where `deleted`<>1" ;
		$q = $this->db->query($sql);
		$cnt = $q->result_array();
		$pages = ceil($cnt[0]['cnt']/$limit);
		
		$data = array();
		$data['records'] = $records;
		$data['export_sql'] = $export_sql;
		$data['pages'] = $pages;
		$data['start'] = $start;
		$data['sort'] = $sort;
		$data['sortby'] = $sortby;
		$data['limit'] = $limit;
		$data['cnt'] = $cnt[0]['cnt'];
		$data['controller'] = $controller;
		$data['content'] = $this->load->view($controller.'/main', $data, true);
		$this->load->view('admin_layout/main', $data);
	}		
	public function search(){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		$controller = $this->controller;
		$start = $_GET['start'];
		$filters = $_GET['filters'];
		$start += 0;
		$limit = 50;
		$sort = $_GET['sort'];
		if($sort!="asc"&&$sort!="desc"){
			$sort = "asc";
		}
		$sortby = $_GET['sortby'];
		$sortby = str_replace("`", "", $sortby);
		$sortby = trim($sortby);
		$search = strtolower(trim($_GET['search']));
		$searchx = trim($_GET['search']);
		
		$sql = "select * from `".$table."`  where `deleted`<>1 ";
		if($search != ''){
			if(is_array($filters)){
				$sql .= "and (0 ";
				foreach($filters as $filter){
					$filter = str_replace("`", "", $filter);
					$filter = trim($filter);
					if($filter){
						$sql .= "or LOWER(`".db_escape($filter)."`) like '%".db_escape($search)."%'";
					}
				}
				$sql .= ")";
			}
		}
		if($sortby){
			$sql .= " order by `".db_escape($sortby)."` ".$sort." limit $start, $limit";
		}
		else{
			$sql .= " order by `name` asc limit $start, $limit" ;
		}
		

		$export_sql = md5($sql);
		$_SESSION['export_sqls'][$export_sql] = $sql;
		$q = $this->db->query($sql);
		$records = $q->result_array();
				
		$sql = "select count(id) as `cnt`  from `".$table."` where `deleted`<>1 ";
		if($search != ''){
			if(is_array($filters)){
				$sql .= "and (0 ";
				foreach($filters as $filter){
					$filter = str_replace("`", "", $filter);
					$filter = trim($filter);
					if($filter){
						$sql .= "or LOWER(`".db_escape($filter)."`) like '%".db_escape($search)."%'";
					}
				}
				$sql .= ")";
			}
		}
		$q = $this->db->query($sql);
		$cnt = $q->result_array();
		$pages = ceil($cnt[0]['cnt']/$limit);
		
		$data = array();
		$data['records'] = $records;		
		$data['export_sql'] = $export_sql;
		$data['pages'] = $pages;
		$data['start'] = $start;
		$data['sort'] = $sort;
		$data['sortby'] = $sortby;
		$data['limit'] = $limit;
		$data['search'] = $searchx;
		$data['filters'] = $filters;
		$data['cnt'] = $cnt[0]['cnt'];
		$data['controller'] = $controller;
		$data['content'] = $this->load->view($controller.'/main', $data, true);
		$this->load->view('admin_layout/main', $data);		
	}	
	function ajax_edit(){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		$controller = $this->controller;
		$error = false;		
		
		/*start validation*/
		if ($_POST['name'] == ''){
			$error = "Please input Group Name";
		}
		else if ($_POST['exactscorepoints'] == ''){
			$error = "Please input Exact Score Points";
		}
		else if ($_POST['winnerpoints'] == ''){
			$error = "Please input Winner Points";
		}

		/*end validation*/
		
		if(!$error){
			if($_FILES){
				pre($_FILES);
				$filepaths = array();
				//make the directory
				$abspath = dirname(__FILE__)."/../../user_uploads/".$controller;
				@mkdir(dirname(__FILE__)."/../../user_uploads/".$controller, 0777);
				$_files = $_FILES;
				if(is_array($_files)){
					foreach($_files as $key=>$value){
						$filepaths[$key] = upload_file($value, $abspath, $newfilename="");
					}
				}
			}
			// check if there are other lands that are connected to the same land detail
			$id = $_POST['id'];			
			$sql = " update `".$table."` set ";
			
			/*start fields*/
			$sql .= "`name` = '".db_escape($_POST['name'])."'";
			$sql .= ", `description` = '".db_escape($_POST['description'])."'";
			$sql .= ", `elimination` = '".db_escape($_POST['elimination'])."'";
			$sql .= ", `winnerpoints` = '".db_escape($_POST['winnerpoints'])."'";
			$sql .= ", `exactscorepoints` = '".db_escape($_POST['exactscorepoints'])."'";

			//for files
			if(is_array($filepaths)){
				foreach($filepaths as $key=>$value){
					$key = str_replace("`", "", $key);
					$key = trim($key);
					$filepath = $value;
					if($filepath){
						$sql .= " , `".db_escape($key)."` = '".db_escape($filepath)."'";
					}
				}
			}
			/*end fields*/
			
			$sql .= " where `id` = '$id' limit 1";	
			$this->db->query($sql);										
			?>
			<script>
			parent.swal({
				title: "Success!",   
				text: "Record was successfully updated",   
				timer: 2000,
				type: "success",
				showConfirmButton: true 
			});
			setTimeout(function(){parent.location="<?php echo site_url($controller); ?>"}, 2000);
			</script>
			<?php
			exit();
		}
		?>
		<script>
		parent.notify("top", "center", "fa fa-comments", "<?php echo htmlentitiesX($error); ?>", "", "danger");
		</script>
		<?php
	}	
	function ajax_add(){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		$controller = $this->controller;
		$error = false;		
				
		/*start validation*/
		if ($_POST['name'] == ''){
			$error = "Please input Group Name";
		}
		else if ($_POST['exactscorepoints'] == ''){
			$error = "Please input Exact Score Points";
		}
		else if ($_POST['winnerpoints'] == ''){
			$error = "Please input Winner Points";
		}

		/*end validation*/
		
		if(!$error){								
			$sql = "insert into `".$table."` set ";
			
			/*start fields*/
			$sql .= "`name` = '".db_escape($_POST['name'])."'";
			$sql .= ", `description` = '".db_escape($_POST['description'])."'";
			$sql .= ", `elimination` = '".db_escape($_POST['elimination'])."'";
			$sql .= ", `winnerpoints` = '".db_escape($_POST['winnerpoints'])."'";
			$sql .= ", `exactscorepoints` = '".db_escape($_POST['exactscorepoints'])."'";

			//for files
			if($_FILES){
				pre($_FILES);
				$filepaths = array();
				//make the directory
				$abspath = dirname(__FILE__)."/../../user_uploads/".$controller;
				@mkdir(dirname(__FILE__)."/../../user_uploads/".$controller, 0777);
				$_files = $_FILES;
				if(is_array($_files)){
					foreach($_files as $key=>$value){
						$filepaths[$key] = upload_file($value, $abspath, $newfilename="");
					}
				}
			}
			if(is_array($filepaths)){
				foreach($filepaths as $key=>$value){
					$key = str_replace("`", "", $key);
					$key = trim($key);
					$filepath = $value;
					if($filepath){
						$sql .= " , `".db_escape($key)."` = '".db_escape($filepath)."'";
					}
				}
			}
			/*end fields*/

			$this->db->query($sql);										
			?>
			<script>
			parent.swal({
				title: "Success!",   
				text: "Record was added",   
				timer: 2000,
				type: "success",
				showConfirmButton: true 
			});
			setTimeout(function(){parent.location="<?php echo site_url($controller); ?>"}, 2000);
			</script>
			<?php
			exit();
		}
		?>
		<script>
		parent.notify("top", "center", "fa fa-comments", "<?php echo htmlentitiesX($error); ?>", "", "danger");
		</script>
		<?php
	}
	
	public function edit($id){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		$controller = $this->controller;
		if(!trim($id)){
			redirect(site_url($controller));
		}
		$sql = "select * from `".$table."` where `id` = '".db_escape($id)."' limit 1";
		$q = $this->db->query($sql);
		$record = $q->result_array();
		$record = $record[0];
		if(!trim($record['id'])){
			redirect(site_url($controller));
		}
		$data['record'] = $record;
		$data['controller'] = $controller;
		$data['content'] = $this->load->view($controller.'/add', $data, true);		
		$this->load->view('admin_layout/main', $data);;
	}
		
	public function add(){	
		$this->user_validation->validate($this->router->class, $this->router->method);
		$controller = $this->controller;
		$data['controller'] = $controller;
		$data['content'] = $this->load->view($controller.'/add', $data, true);
		$this->load->view('admin_layout/main', $data);
	}
	public function ajax_delete($id=""){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		if(!$id){
			$id = $_POST['id'];
		}
		$sql = "select * from `".$table."` where `id` = '".db_escape($id)."' limit 1";
		$q = $this->db->query($sql);
		$record = $q->result_array();
		$record = $record[0];
		
		$id = db_escape($id);
		$sql = "update `".$table."` set `deleted`=1 where id = '".$id."' limit 1";
		$q = $this->db->query($sql);		
		exit();
	}
}
?>