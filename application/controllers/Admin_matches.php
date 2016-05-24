<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin_matches extends CI_Controller {
	var $table;
	var $controller;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "matches";
		$this->controller = "Admin_matches";
	}
	public function index(){
		$this->user_validation->validate($this->router->class, $this->router->method);
		$table = $this->table;
		$controller = $this->controller;
		$data = array();
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
		$data['sortby'] = $sortby;
		if($sortby=="category"){
			$sortby = "groups`.`name";
		}
		if($sortby){
			$sql = "select 
			`".$table."`.`id`,
			`".$table."`.`team1`,
			`".$table."`.`team2`,
			`".$table."`.`team1score`,
			`".$table."`.`team2score`,
			`".$table."`.`winner`,
			`".$table."`.`bettingclosed`,
			`".$table."`.`datetime`,
			`groups`.`name` as `category`,
			`groups`.`id` as `group_id`
			from `".$table."` left join `groups` on (`".$table."`.`category` = `groups`.`id` and `groups`.`deleted`<>1) where `".$table."`.`deleted`<>1 order by `".db_escape($sortby)."` ".$sort." limit $start, $limit";
		}
		else{
			$sql = "select 
			`".$table."`.`id`,
			`".$table."`.`team1`,
			`".$table."`.`team2`,
			`".$table."`.`team1score`,
			`".$table."`.`team2score`,
			`".$table."`.`winner`,
			`".$table."`.`bettingclosed`,
			`".$table."`.`datetime`,
			`groups`.`name` as `category`,
			`groups`.`id` as `group_id`
			from `".$table."` left join `groups` on (`".$table."`.`category` = `groups`.`id` and `groups`.`deleted`<>1) where `".$table."`.`deleted`<>1 order by `datetime` asc limit $start, $limit";
		}
		$export_sql = md5($sql);
		$_SESSION['export_sqls'][$export_sql] = $sql;
		$q = $this->db->query($sql);
		$records = $q->result_array();		
		
		$sql = "select count(`id`) as `cnt` from `".$table."` where `deleted`<>1" ;
		$q = $this->db->query($sql);
		$cnt = $q->result_array();
		$pages = ceil($cnt[0]['cnt']/$limit);

		$data['records'] = $records;
		$data['export_sql'] = $export_sql;
		$data['pages'] = $pages;
		$data['start'] = $start;
		$data['sort'] = $sort;
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
		$data = array();
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
		$data['sortby'] = $sortby;
		$search = strtolower(trim($_GET['search']));
		$searchx = trim($_GET['search']);
		
		$sql = "select 
		`".$table."`.`id`,
		`".$table."`.`team1`,
		`".$table."`.`team2`,
		`".$table."`.`team1score`,
		`".$table."`.`team2score`,
		`".$table."`.`winner`,
		`".$table."`.`bettingclosed`,
		`".$table."`.`datetime`,
		`groups`.`name` as `category`,
		`groups`.`id` as `group_id`
		from `".$table."` left join `groups` on (`".$table."`.`category` = `groups`.`id` and `groups`.`deleted`<>1)  where `".$table."`.`deleted`<>1 ";
		if($search != ''){
			if(is_array($filters)){
				$sql .= "and (0 ";
				foreach($filters as $filter){
					if($filter=="team1"){
						$sql .= "or (`".$table."`.`team1` in (select `id` from `teams` where `deleted`<>1 and lower(`name`) like '%".db_escape($search)."%'))";
					}
					else if($filter=="team2"){
						$sql .= "or (`".$table."`.`team2` in (select `id` from `teams` where `deleted`<>1 and lower(`name`) like '%".db_escape($search)."%'))";
					}
					else if($filter=="category"){
						$sql .= "or (`".$table."`.`category` in (select `id` from `groups` where `deleted`<>1 and lower(`name`) like '%".db_escape($search)."%'))";
					}
					else{
						$filter = str_replace("`", "", $filter);
						$filter = trim($filter);
						if($filter){
							$sql .= "or LOWER(`".db_escape($filter)."`) like '%".db_escape($search)."%'";
						}
					}
				}
				$sql .= ")";
			}
		}
		if($sortby=="category"){
			$sortby = "groups`.`name";	
		}
		else{
			$sortby = db_escape($sortby);
		}
		if($sortby){
			$sql .= " order by `".$sortby."` ".$sort." limit $start, $limit";
		}
		else{
			$sql .= " order by `datetime` asc limit $start, $limit" ;
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
		
		
		$data['records'] = $records;		
		$data['export_sql'] = $export_sql;
		$data['pages'] = $pages;
		$data['start'] = $start;
		$data['sort'] = $sort;
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
		if ($_POST['team1'] == ''){
			$error = "Please input Team 1";
		}
		 else if ($_POST['team2'] == ''){
			$error = "Please input Team 2";
		}
		 else if ($_POST['datetime'] == ''){
			$error = "Please input Date & Time";
		}
		 else if ($_POST['category'] == ''){
			$error = "Please input Group Category";
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
			$sql .= "`team1` = '".db_escape($_POST['team1'])."'";
			$sql .= " ,`team2` = '".db_escape($_POST['team2'])."'";
			$sql .= " ,`bettingclosed` = '".db_escape($_POST['bettingclosed'])."'";
			if(trim($_POST['team1score'])!=""){
				$sql .= " ,`team1score` = '".db_escape($_POST['team1score'])."'";
			}
			else{
				$sql .= " ,`team1score` = NULL ";
			}
			if(trim($_POST['team2score'])!=""){
				$sql .= " ,`team2score` = '".db_escape($_POST['team2score'])."'";
			}
			else{
				$sql .= " ,`team2score` = NULL ";
			}
			if(trim($_POST['winner'])!=""){
				$sql .= " ,`winner` = '".db_escape($_POST['winner'])."'";
			}
			else{
				$sql .= " ,`winner` = NULL ";
			}
			$sql .= " ,`datetime` = '".db_escape(date("Y-m-d H:i:s", strtotime($_POST['datetime'])))."'";
			$sql .= " ,`category` = '".db_escape($_POST['category'])."'";

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
		if ($_POST['team1'] == ''){
			$error = "Please input Team 1";
		}
		 else if ($_POST['team2'] == ''){
			$error = "Please input Team 2";
		}
		 else if ($_POST['datetime'] == ''){
			$error = "Please input Date & Time";
		}
		 else if ($_POST['category'] == ''){
			$error = "Please input Group Category";
		}

		/*end validation*/
		
		if(!$error){								
			$sql = "insert into `".$table."` set ";
			
			/*start fields*/
			$sql .= "`team1` = '".db_escape($_POST['team1'])."'";
			$sql .= " ,`team2` = '".db_escape($_POST['team2'])."'";
			$sql .= " ,`bettingclosed` = '".db_escape($_POST['bettingclosed'])."'";
			if(trim($_POST['team1score'])!=""){
				$sql .= " ,`team1score` = '".db_escape($_POST['team1score'])."'";
			}
			else{
				$sql .= " ,`team1score` = NULL ";
			}
			if(trim($_POST['team2score'])!=""){
				$sql .= " ,`team2score` = '".db_escape($_POST['team2score'])."'";
			}
			else{
				$sql .= " ,`team2score` = NULL ";
			}
			if(trim($_POST['winner'])!=""){
				$sql .= " ,`winner` = '".db_escape($_POST['winner'])."'";
			}
			else{
				$sql .= " ,`winner` = NULL ";
			}
			$sql .= " ,`datetime` = '".db_escape(date("Y-m-d H:i:s", strtotime($_POST['datetime'])))."'";
			$sql .= " ,`category` = '".db_escape($_POST['category'])."'";

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