<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function index(){
		if($_SESSION['user']){
			$data['content'] = $this->load->view("admin/welcome", $data, true);		
			$this->load->view('admin_layout/main', $data);
		}
		else{
			$this->load->view('admin_layout/main');
		}
	}
	public function createcms(){
		$this->user_validation->validate($this->router->class, $this->router->method);
		if(isset($_GET['clear'])){
			unset($_SESSION['createcmsfields']);
			unset($_SESSION['createcmstable']);
			redirect(site_url("admin/createcms"));
			exit();
		}
		if($_POST){
			if(isset($_GET['fetchtable'])){
				$error = "";
				$tablename = trim($_POST['tablename']);
				if(!$tablename){
					$error = "Invalid table name";
				}
				if(!$error){
					$sql = "show table status like  '".db_escape($tablename)."'";
					$q = $this->db->query($sql);
					$r = $q->result_array();
					if(!$r[0]){
						$error = "Table `".$_POST['tablename']."` doesn't exists";
					}
				}
				if(!$error){
					$sql = "show columns from  `".db_escape($tablename)."`";
					$q = $this->db->query($sql);
					$r = $q->result_array();
					$_SESSION['createcmsfields'] = $r;
					$_SESSION['createcmstable'] = $tablename;
					?>
					<script>
					parent.location=parent.location;
					</script>
					<?php
					exit();
				}
				?>
				<script>
				parent.notify("top", "center", "fa fa-comments", "<?php echo $error; ?>", "", "danger");
				</script>
				<?php
				exit();
			}

			$table = trim($_POST['table']);
			$controller = trim($_POST['controller']);
			$fields_name = $_POST['fields_name'];
			$fields_label = $_POST['fields_label'];
			$fields_main = $_POST['fields_main'];
			$fields_type = $_POST['fields_type'];
			$fields_edit = $_POST['fields_edit'];
			$fields_required = $_POST['fields_required'];
			$fields_search = $_POST['fields_search'];
			if(file_exists(dirname(__FILE__)."/".$controller.".php")){
				redirect(site_url("admin/createcms/?error=Invalid Controller Name"), 'refresh');
				exit();
			}
			
			//CREATE CONTROLLER FILE
			$controller_contents = file_get_contents(dirname(__FILE__)."/admin/controller.txt");
			$controller_contents = str_replace("[[table]]", $table, $controller_contents);
			$controller_contents = str_replace("[[controller]]", $controller, $controller_contents);
			//validation
			$validation_template = file_get_contents(dirname(__FILE__)."/admin/controller_validation.txt");
			$validation_file_template = file_get_contents(dirname(__FILE__)."/admin/controller_validation_file.txt");
			$validation = "";
			$fieldsstr = "";
			$t = count($fields_name);
			$start = 0;
			for($i=0; $i<$t; $i++){
				if(trim($fields_name[$i])){
					if(trim($fields_required[$i])){
						if($validation==""){
							if($fields_type[$i]=="file"||$fields_type[$i]=="image"){
								$str = str_replace("[[field]]", $fields_name[$i], $validation_file_template);
								$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
								//$validation = $str;
							}
							else{
								$str = str_replace("[[field]]", $fields_name[$i], $validation_template);
								$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
								$validation = $str;
							}
						}
						else{
							if($fields_type[$i]=="file"||$fields_type[$i]=="image"){
								$str = str_replace("[[field]]", $fields_name[$i], $validation_file_template);
								$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
								//$validation .= $str;
							}
							else{
								$str = str_replace("[[field]]", $fields_name[$i], $validation_template);
								$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
								$validation .= " else ".$str;
							}
						}
					}
					if(trim($fields_edit[$i])){
						if(
							$fields_type[$i]=="text"
							||$fields_type[$i]=="textarea"
							||$fields_type[$i]=="wysywyg"
							||$fields_type[$i]=="time"
						){
							if($start==0){ $start=1; $fieldsstr .= "\$sql .= \""; } else{ $fieldsstr .= "\$sql .= \" ,"; }
							$fieldsstr .= "`".$fields_name[$i]."` = '\".db_escape(\$_POST['".$fields_name[$i]."']).\"'\";\n";
						}
						else if($fields_type[$i]=="date"){
							if($start==0){ $start=1; $fieldsstr .= "\$sql .= \""; } else{ $fieldsstr .= "\$sql .= \" ,"; }
							$fieldsstr .= "`".$fields_name[$i]."` = '\".db_escape(date(\"Y-m-d 00:00:00\", strtotime(\$_POST['".$fields_name[$i]."'].\" 00:00:00\"))).\"'\";\n";
						}
						else if($fields_type[$i]=="datetime"){
							if($start==0){ $start=1; $fieldsstr .= "\$sql .= \""; } else{ $fieldsstr .= "\$sql .= \" ,"; }
							$fieldsstr .= "`".$fields_name[$i]."` = '\".db_escape(date(\"Y-m-d H:i:s\", strtotime(\$_POST['".$fields_name[$i]."']))).\"'\";\n";
						}
					}
				}
			}
			$controller_contents = str_replace("[[validation]]", $validation, $controller_contents);
			$controller_contents = str_replace("[[fieldsstr]]", $fieldsstr, $controller_contents);
			file_put_contents(dirname(__FILE__)."/".$controller.".php", $controller_contents);
			
			//CREATE VIEW FILES
			if(is_dir(dirname(__FILE__)."/../views/".$controller)){
				redirect(site_url("admin/createcms/?error=Views Folder Already Exists"), 'refresh');
				exit();
			}
			$views_dir = dirname(__FILE__)."/../views/".$controller;
			@mkdir($views_dir, 0777);
			$main_contents = file_get_contents(dirname(__FILE__)."/admin/main.txt");
			$add_contents = file_get_contents(dirname(__FILE__)."/admin/add.txt");
			$forms = "";
			$filters1_template = file_get_contents(dirname(__FILE__)."/admin/filters1.txt");
			$filters2_template = file_get_contents(dirname(__FILE__)."/admin/filters2.txt");
			$main_content_template = file_get_contents(dirname(__FILE__)."/admin/main_content.txt");
			$main_header_template = file_get_contents(dirname(__FILE__)."/admin/main_header.txt");
			$filters1 = "";
			$filters2 = "";
			$main_content = "";
			$main_header = "";
			for($i=0; $i<$t; $i++){
				if(trim($fields_name[$i])){
					if(trim($fields_search[$i])){
						$str = str_replace("[[field]]", $fields_name[$i], $filters1_template);
						$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
						$filters1 .= $str;
						$str = str_replace("[[field]]", $fields_name[$i], $filters2_template);
						$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
						$filters2 .= $str;
					}
					if(trim($fields_main[$i])){
						$str = str_replace("[[field]]", $fields_name[$i], $main_content_template);
						$main_content .= $str;
						$str = str_replace("[[field]]", $fields_name[$i], $main_header_template);
						$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
						$main_header .= $str;
					}
					if(trim($fields_edit[$i])){
						$add_template = file_get_contents(dirname(__FILE__)."/admin/add_".$fields_type[$i].".txt");
						$str = str_replace("[[field]]", $fields_name[$i], $add_template);
						$str = str_replace("[[field_label]]", addslashes($fields_label[$i]), $str);
						if($fields_required[$i]){
							$str = str_replace("[[required]]", "* ", $str);
						}
						else{
							$str = str_replace("[[required]]", "", $str);
						}
						$forms .= $str;
					}
				}
			}
			$add_contents = str_replace("[[forms]]", $forms, $add_contents);
			file_put_contents($views_dir."/add.php", $add_contents);
			$main_contents = str_replace("[[controller]]", $controller, $main_contents);
			$main_contents = str_replace("[[main_content]]", $main_content, $main_contents);
			$main_contents = str_replace("[[main_header]]", $main_header, $main_contents);
			$main_contents = str_replace("[[filters1]]", $filters1, $main_contents);
			$main_contents = str_replace("[[filters2]]", $filters2, $main_contents);
			file_put_contents($views_dir."/main.php", $main_contents);
			redirect(site_url("admin/createcms/?clear"), 'refresh');
			exit();
		}
		$data['createcms'] = 1;
		$data['content'] = $this->load->view("admin/createcms", $data, true);		
		$this->load->view('admin_layout/main', $data);
	}
	public function logout(){
		unset($_SESSION['user']);
		redirect(site_url("admin"), 'refresh');
	}
	public function login(){
		$sql = "select * from `users` where `email`= '".db_escape($_POST['login_email'])."' and `password`= '".md5($_POST['password'])."' and `deleted`<>1";
		$q = $this->db->query($sql);
		$r = $q->result_array();	
		if($r[0]){
			unset($_SESSION['user']);
			$_SESSION['user'] = $r[0];
			
			//get user groups
			$user_user_groups = array();
			$sql = "select * from `user_user_groups` where `user_email` = '".db_escape($r[0]['email'])."' and `deleted`<>1";
			$q = $this->db->query($sql);
			$uusergroups = $q->result_array();
			foreach($uusergroups as $value){
				$user_user_groups[] = $value['user_group'];
			}
			$_SESSION['user']['user_groups'] = $user_user_groups;
			redirect(site_url("admin"), 'refresh');
		}
		else{
			redirect(site_url("admin/?error=Invalid Login&login_email=".$_POST['login_email']), 'refresh');
		}
	}
	function editprofile(){
		if($_SESSION['user']){
			if($_POST['id']==$_SESSION['user']['id']){
				$error = "";
				$sql = "update `users` set 
				`name` = '".db_escape($_POST['name'])."'
				";
				if($_POST['password']&&$_POST['password']==$_POST['confirmpassword']){
					$sql .= " ,`password` = '".md5($_POST['password'])."'
					";
				}
				else if($_POST['password']&&$_POST['password']!=$_POST['confirmpassword']){
					$error = "New Password is not the same as the Confirm Password";
				}
				$sql .= "where `id`='".db_escape($_POST['id'])."' and `deleted`<>1";
				if(!$error){
					$this->db->query($sql);
					$sql = "select * from `users` where `id`='".db_escape($_POST['id'])."' and `deleted`<>1";
					$r = $this->db->query($sql)->result_array();
					$_SESSION['user'] = $r[0];
					//get user groups
					$user_user_groups = array();
					$sql = "select * from `user_user_groups` where `user_email` = '".db_escape($r[0]['email'])."' and `deleted`<>1";
					$q = $this->db->query($sql);
					$uusergroups = $q->result_array();
					foreach($uusergroups as $value){
						$user_user_groups[] = $value['user_group'];
					}
					$_SESSION['user']['user_groups'] = $user_user_groups;
					
					?>
					<script>
					parent.swal({
						title: "Success!",   
						text: "Profile was updated",   
						timer: 2000,
						type: "success",
						showConfirmButton: true 
					});
					</script>
					<?php
				}
				else{
					?>
					<script>
					parent.notify("top", "center", "fa fa-comments", "<?php echo htmlentitiesX($error); ?>", "", "danger");
					</script>
					<?php
				}
				exit();
				//redirect(site_url("admin/editprofile"), 'refresh');
			}
			$data['content'] = $this->load->view("admin/editprofile", $data, true);		
			$this->load->view('admin_layout/main', $data);
		}
		else{
			$this->load->view('admin_layout/main');
		}
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */