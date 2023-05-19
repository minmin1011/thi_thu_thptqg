<?php


require_once('models/model_student.php');
require_once 'views/view_student.php';

class Controller_Student
{
	public $info =  array();

	 
	public function __construct()
	{
		$user_info = $this->profiles();
		$this->info['ID'] = $user_info->ID;
		$this->update_last_login($this->info['ID']);
		$this->info['username'] = $user_info->username;
		$this->info['name'] = $user_info->name;
		$this->info['avatar'] = $user_info->avatar;
		$this->info['class_id'] = $user_info->class_id;
		$this->info['grade_id'] = $user_info->grade_id;
		$this->info['doing_exam'] = $user_info->doing_exam;
		$this->info['time_remaining'] = $user_info->time_remaining;
	}

	 
	public function profiles()
	{
		$model = new Model_Student();
		return $model->get_profiles($_SESSION['username']);
	}

	 
	public function get_question($ID)
	{
		$model = new Model_Student();
		return $model->get_question($ID);
	}

	 
	public function get_doing_exam()
	{
		return $this->info['doing_exam'];
	}

	 
	public function update_last_login()
	{
		$model = new Model_Student();
		$model->update_last_login($this->info['ID']);
	}

	 
	public function update_doing_exam($exam, $time)
	{
		$model = new Model_Student();
		$model->update_doing_exam($exam, $time, $this->info['ID']);
	}

	 
	public function update_answer()
	{
		$model = new Model_Student();
		$question_id = $_POST['id'];
		$answer = 'answer_' . $_POST['answer'];
		$student_answer = $model->get_student_quest_of_testcode($this->info['ID'], $this->info['doing_exam'], $question_id)->$answer;
		$model->update_answer($this->info['ID'], $this->info['doing_exam'], $question_id, $student_answer);
		$time = $_POST['min'] . ':' . $_POST['sec'];
		$model->update_timing($this->info['ID'], $time);
	}

	 
	public function update_timing()
	{
		$model = new Model_Student();
		$time = $_POST['min'] . ':' . $_POST['sec'];
		$model->update_timing($this->info['ID'], $time);
	}

	 
	public function reset_doing_exam()
	{
		$model = new Model_Student();
		$model->reset_doing_exam($this->info['ID']);
	}

	 
	public function get_profiles()
	{
		$model = new Model_Student();
		echo json_encode($model->get_profiles($this->info['username']));
	}

	 
	public function get_notifications()
	{
		$model = new Model_Student();
		echo json_encode($model->get_notifications($this->info['class_id']));
	}

	 
	public function get_chats()
	{
		$model = new Model_Student();
		echo json_encode($model->get_chats($this->info['class_id']));
	}

	 
	public function get_chat_all()
	{
		$model = new Model_Student();
		echo json_encode($model->get_chat_all($this->info['class_id']));
	}

	 
	public function valid_email_on_profiles()
	{
		$result = array();
		$model = new Model_Student();
		$new_email = isset($_POST['new_email']) ? htmlspecialchars($_POST['new_email']) : '';
		$curren_email = isset($_POST['curren_email']) ? htmlspecialchars($_POST['curren_email']) : '';
		if (empty($new_email)) {
			$result['status'] = 0;
		} else {
			if ($model->valid_email_on_profiles($curren_email, $new_email)) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}

	 
	public function update_avatar($avatar, $username)
	{
		$model = new Model_Student();
		return $model->update_avatar($avatar, $username);
	}

	 
	public function submit_update_avatar()
	{
		if (isset($_FILES['file'])) {
			$duoi = explode('.', $_FILES['file']['name']);
			$duoi = $duoi[(count($duoi) - 1)];
			if ($duoi === 'jpg' || $duoi === 'png') {
				if (move_uploaded_file($_FILES['file']['tmp_name'], 'res/img/avatar/' . $this->info['username'] . '_' . $_FILES['file']['name'])) {
					$avatar = $this->info['username'] . '_' . $_FILES['file']['name'];
					$update = $this->update_avatar($avatar, $this->info['username']);
				}
			}
		}
	}

	/**
	 * Hàm submit xác nhận vào thi
	 *    
	 */
	public function approval_start_test()
	{
		$result = array();
		$model = new Model_Student();
		$test_code = isset($_POST['test_code']) ? $_POST['test_code'] : '493205';
		$list_quest = $model->get_quest_of_test($test_code);
		foreach ($list_quest as $quest) {
			$array = array();
			$array[0] = $quest->answer_a;
			$array[1] = $quest->answer_b;
			$array[2] = $quest->answer_c;
			$array[3] = $quest->answer_d;
			shuffle($array);
			$ID = rand(1, time()) + rand(100000, 999999);
			$time = $model->get_test($test_code)->time_to_do . ':00';
			$model->add_student_quest($this->info['ID'], $ID, $test_code, $quest->question_id, $array[0], $array[1], $array[2], $array[3]);
			$model->update_doing_exam($test_code, $time, $this->info['ID']);
		}
		$result['status_value'] = "Đang chuyển trang! Chúc bạn hoàn thành tốt bài thi!";
		$result['status'] = 1;
		echo json_encode($result);
	}

	/**
	 * Hàm gửi tin nhắn trò chuyện
	 *    
	 */
	public function send_chat()
	{
		$result = array();
		$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';
		if (empty($content)) {
			$result['status_value'] = "Nội dung trống";
			$result['status'] = 0;
		} else {
			$model = new Model_Student();
			$model->chat($this->info['username'], $this->info['name'], $this->info['class_id'], $content);
			$result['status_value'] = "Thành công";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}

	/**
	 * Hàm cập nhật thông tin profile
	 *    
	 */
	public function update_profiles($username, $name, $email, $password, $gender, $birthday)
	{
		$model = new Model_Student();
		return $model->update_profiles($username, $name, $email, $password, $gender, $birthday);
	}

	 
	public function submit_update_profiles()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name) || empty($gender) || empty($birthday) || empty($password) || empty($email)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$update = $this->update_profiles($username, $name, $email, $password, $gender, $birthday);
			if (!$update) {
				$result['status_value'] = "Tài khoản không tồn tại!";
				$result['status'] = 0;
			} else {
				$result = json_decode(json_encode($this->profiles($username)), true);
				$result['status_value'] = "Sửa thành công!";
				$result['status'] = 1;
			}
		}
		echo json_encode($result);
	}

	/**
	 * Hàm xác nhận nộp bài thi
	 *    
	 */
	public function accept_test()
	{
		try {
			// lấy kết quả thi của hs
			$model = new Model_Student();
			$test = $model->get_result_quest($this->info['doing_exam'], $this->info['ID']);
			// lấy ra test code và user để xóa cái cũ đi nếu có
			$test_code = $test[0]->test_code;
			$studentID = $test[0]->student_id;
			$model->del_old_score($test_code, $studentID);
			// tiến hành tính điểm và lưu kết quả
			$total_questions = $test[0]->total_questions;
			$correct = 0;
			$c = 10 / $total_questions;
			foreach ($test as $t) {
				if (trim($t->student_answer) == trim($t->correct_answer))
					$correct++;
			}
			$score = $correct * $c;
			$score_detail = $correct . '/' . $total_questions;
			$model->insert_score($this->info['ID'], $test_code, $score, $score_detail);
			$model->reset_doing_exam($this->info['ID']);
			header("Location: index.php?action=show_result&test_code=" . $test_code);
		} catch (Exception $e) {
			echo 'Exception: ',  $e->getMessage(), "\n";
		}
	}

	/**
	 * Hàm logout
	 *    
	 */
	public function logout()
	{
		$result = array();
		$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : true;
		if ($confirm) {
			$result['status_value'] = "Đăng xuất thành công!";
			$result['status'] = 1;
			session_destroy();
		}
		echo json_encode($result);
	}

	/**
	 * Hàm hiển thị trang dashboard
	 *    
	 */
	public function show_dashboard()
	{
		$view = new View_Student();
		if ($this->info['doing_exam'] == '') {
			$view->show_head_left($this->info);
			$model = new Model_Student();
			$scores = $model->get_scores($this->info['ID']);
			$tests = $model->get_list_tests();
			$view->show_dashboard($tests, $scores);
			$view->show_foot();
		} else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'], $this->info['ID']);
			$time_string[] = explode(":", $this->info['time_remaining']);
			$min = $time_string[0][0];
			$sec = $time_string[0][1];
			$view->show_exam($test, $min, $sec);
		}
	}

	 
	public function show_chat()
	{
		$view = new View_Student();
		if ($this->info['doing_exam'] == '') {
			$view->show_head_left($this->info);
			$view->show_chat();
			$view->show_foot();
		} else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'], $this->info['ID']);
			$time_string[] = explode(":", $this->info['time_remaining']);
			$min = $time_string[0][0];
			$sec = $time_string[0][1];
			$view->show_exam($test, $min, $sec);
		}
	}

	 
	public function show_all_chat()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_all_chat();
		$view->show_foot();
	}

	 
	public function show_notifications()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_notifications();
		$view->show_foot();
	}

	
	public function student_detail()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->student_detail($this->info);
		$view->show_foot();
	}

	 
	public function show_result()
	{
		$view = new View_Student();
		if ($this->info['doing_exam'] == '') {
			$model = new Model_Student();
			$test_code = htmlspecialchars($_GET['test_code']);
			$score = $model->get_score($this->info['ID'], $test_code);
			$test_status = $model->get_test($test_code)->status_id;
			if ($test_status != 5)
				$result = null;
			else
				$result = $model->get_result_quest($test_code, $this->info['ID']);
			if ($score) {
				$view->show_head_left($this->info);
				$view->show_result($test_code, $score, $result);
				$view->show_foot();
			} else {
				$this->show_404();
			}
		} else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'], $this->info['ID']);
			$time_string[] = explode(":", $this->info['time_remaining']);
			$min = $time_string[0][0];
			$sec = $time_string[0][1];
			$view->show_exam($test, $min, $sec);
		}
	}


	public function show_about()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_about();
		$view->show_foot();
	}

	public function show_profiles()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_profiles($this->profiles());
		$view->show_foot();
	}

	
	public function show_404()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_404();
		$view->show_foot();
	}
}
