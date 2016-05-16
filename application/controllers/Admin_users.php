<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin_users extends CI_Controller {
	var $table;
	var $controller;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "users";
		$this->controller = "Admin_users";
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
			$sql = "select * from `".$table."` where `deleted`<>1 order by id desc limit $start, $limit";
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
			$sql .= " order by id desc limit $start, $limit" ;
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
			$error = "Please input Name";
		}

		/*end validation*/
		
		if(!$error){
			if($_FILES){
				pre($_FILES);
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
			if(trim($_POST['password'])){
				$sql .= " ,`password` = '".db_escape(md5($_POST['password']))."'";
			}
			$sql .= " ,`dateadded` = '".db_escape(date("Y-m-d H:i:s", strtotime($_POST['dateadded'])))."'";

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
			
			//user groups
			$sql = "select * from `users` where `id`='".db_escape($id)."' and `deleted`<>1";
			$r = $this->db->query($sql)->result_array();
			$email = $r[0]['email'];
			$sql = "update `user_user_groups` set `deleted`=1 where `user_email`='".db_escape($email)."'";
			$this->db->query($sql);
			if($_POST['user_groups']){
				$user_groups = $_POST['user_groups'];
				$t = count($user_groups);
				if($email){
					for($i=0; $i<$t; $i++){
						$sql = "insert into `user_user_groups` set `user_group`='".db_escape($user_groups[$i])."', `user_email`='".db_escape($email)."'";
						$this->db->query($sql);
					}
				}
			}
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
		if ($_POST['email'] == ''){
			$error = "Please input Login Name";
		}
		else if ($_POST['name'] == ''){
			$error = "Please input Name";
		}
		else if ($_POST['password'] == ''){
			$error = "Please input Password";
		}

		/*end validation*/
		
		if(!$error){								
			$sql = "insert into `".$table."` set ";
			
			/*start fields*/
			$sql .= "`name` = '".db_escape($_POST['name'])."'";
			$sql .= " ,`email` = '".db_escape($_POST['email'])."'";
			if(trim($_POST['password'])){
				$sql .= " ,`password` = '".db_escape(md5($_POST['password']))."'";
			}
			$sql .= " ,`dateadded` = NOW()";

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
			$this->db->query($sql);
			
			//user groups
			$sql = "select * from `users` where `email`='".db_escape($_POST['email'])."' and `deleted`<>1";
			$r = $this->db->query($sql)->result_array();
			if($_POST['user_groups']){
				$email = $r[0]['email'];
				$user_groups = $_POST['user_groups'];
				$t = count($user_groups);
				if($email){
					$sql = "update `user_user_groups` set `deleted`=1 where `user_email`='".db_escape($email)."'";
					$this->db->query($sql);
					for($i=0; $i<$t; $i++){
						$sql = "insert into `user_user_groups` set `user_group`='".db_escape($user_groups[$i])."', `user_email`='".db_escape($email)."'";
						$this->db->query($sql);
					}
				}
			}
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
		$sql = "select * from `user_user_groups` where `user_email`='".db_escape($record['email'])."' and `deleted`<>1";
		$r = $this->db->query($sql)->result_array();
		$t = count($r);
		$user_groups = array();
		for($i=0; $i<$t; $i++){
			$user_groups[] = $r[$i]['user_group'];
		}
		$record['user_groups'] = $user_groups;
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
		
		$sql = "update `user_user_groups` set `deleted`=1 where `user_email`='".db_escape($record['email'])."'";
		$this->db->query($sql);
		
		if($record['email']!="admin"){
			$id = db_escape($id);
			$sql = "update `".$table."` set `deleted`=1 where id = '".$id."' limit 1";
			$q = $this->db->query($sql);	
		}		
		exit();
	}
}
?>