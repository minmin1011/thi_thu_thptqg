<?php



require_once('config/database.php');

class Model_Admin extends Database
{
    public function get_admin_info($username)
    {
        $sql = "
        SELECT DISTINCT admin_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail,genders.gender_id FROM admins
        INNER JOIN permissions ON admins.permission = permissions.permission
        INNER JOIN genders ON admins.gender_id = genders.gender_id
        WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_teacher_info($username)
    {
        $sql = "
        SELECT DISTINCT teacher_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission = permissions.permission
        INNER JOIN genders ON teachers.gender_id = genders.gender_id WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_student_info($username)
    {
        $sql = "
        SELECT DISTINCT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id WHERE username = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_class_info($class_name)
    {
        $sql = "
        SELECT DISTINCT class_id,class_name,name as teacher_name, detail as grade_detail FROM classes
        INNER JOIN grades ON classes.grade_id = grades.grade_id
        INNER JOIN teachers ON classes.teacher_id = teachers.teacher_id
        WHERE class_name = '$class_name'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_list_admins()
    {
        $sql = "SELECT DISTINCT admin_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM admins
        INNER JOIN permissions ON admins.permission = permissions.permission
        INNER JOIN genders ON admins.gender_id = genders.gender_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_grades()
    {
        $sql = "SELECT DISTINCT * FROM grades";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_subjects()
    {
        $sql = "SELECT DISTINCT * FROM subjects";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function update_last_login($admin_id)
    {
        $sql = "UPDATE admins set last_login=NOW() where admin_id='$admin_id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function valid_username_or_email($data)
    {
        $sql = "SELECT DISTINCT name FROM students WHERE username = '$data' OR email = '$data'
        UNION
        SELECT DISTINCT name FROM teachers WHERE username = '$data' OR email = '$data'
        UNION
        SELECT DISTINCT name FROM admins WHERE username = '$data' OR email = '$data'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }
    public function valid_class_name($class_name)
    {
        $sql = "SELECT DISTINCT class_id FROM classes WHERE class_name = '$class_name'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }
    public function valid_email_on_profiles($curren_email, $new_email)
    {
        $sql = "SELECT DISTINCT name FROM students WHERE email = '$new_email' AND email NOT IN ('$curren_email')
        UNION SELECT DISTINCT name FROM admins WHERE email = '$new_email' AND email NOT IN ('$curren_email')
        UNION SELECT DISTINCT name FROM teachers WHERE email = '$new_email' AND email NOT IN ('$curren_email')";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }
    public function edit_admin($admin_id, $password, $name, $gender_id, $birthday)
    {
        $sql = "SELECT DISTINCT username FROM admins WHERE admin_id = '$admin_id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE admins set password='$password', name ='$name', gender_id ='$gender_id', birthday ='$birthday' where admin_id='$admin_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }
    public function del_admin($admin_id)
    {
        $sql = "DELETE FROM admins where admin_id='$admin_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT DISTINCT username FROM admins WHERE admin_id = '$admin_id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }
    public function add_admin($name, $username, $password, $email, $birthday, $gender)
    {
        $sql = "SELECT DISTINCT admin_id FROM admins WHERE username = '$username' OR email = '$email'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `admins` AUTO_INCREMENT=1";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "INSERT INTO admins (name, username, password, email, birthday, gender_id) VALUES ('$name', '$username', '$password', '$email', '$birthday', '$gender')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }
    public function get_list_teachers()
    {
        $sql = "SELECT DISTINCT teacher_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission = permissions.permission
        INNER JOIN genders ON teachers.gender_id = genders.gender_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function edit_teacher($teacher_id, $password, $name, $gender_id, $birthday)
    {
        $sql = "SELECT DISTINCT username FROM teachers WHERE teacher_id = '$teacher_id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE teachers set password='$password', name ='$name', gender_id ='$gender_id', birthday ='$birthday' where teacher_id='$teacher_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }
    public function del_teacher($teacher_id)
    {
        $sql = "DELETE FROM teacher_notifications where teacher_id='$teacher_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM teachers where teacher_id='$teacher_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT DISTINCT username FROM teachers WHERE teacher_id = '$teacher_id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }
    public function add_teacher($name, $username, $password, $email, $birthday, $gender)
    {
        $sql = "SELECT DISTINCT teacher_id FROM teachers WHERE username = '$username' or email = '$email'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `teachers` AUTO_INCREMENT=1";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "INSERT INTO teachers (username,password,name,email,birthday,gender_id) VALUES ('$username','$password','$name','$email','$birthday','$gender')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }
    public function get_list_students()
    {
        $sql = "
        SELECT DISTINCT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function edit_student($student_id, $birthday, $password, $name, $class_id, $gender)
    {
        $sql = "UPDATE students set birthday='$birthday', password='$password', name ='$name', class_id ='$class_id', gender_id = '$gender' where student_id='$student_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "UPDATE scores set class_id ='$class_id' where student_id='$student_id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function del_student($student_id)
    {
        $sql = "DELETE FROM scores where student_id='$student_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM students where student_id='$student_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT DISTINCT username FROM students WHERE student_id = '$student_id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }
    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender)
    {
        $sql = "SELECT DISTINCT student_id FROM students WHERE username = '$username' OR email = '$email";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `students` AUTO_INCREMENT=1";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "INSERT INTO students (username,password,name,class_id,email,birthday,gender_id) VALUES ('$username','$password','$name','$class_id','$email','$birthday','$gender')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }
    public function get_list_classes()
    {
        $sql = "
        SELECT DISTINCT class_id,class_name,name as teacher_name, detail as grade_detail FROM classes
        INNER JOIN grades ON classes.grade_id = grades.grade_id
        INNER JOIN teachers ON classes.teacher_id = teachers.teacher_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_units($grade_id, $subject_id)
    {
        $sql = "SELECT DISTINCT unit, COUNT(unit) as total FROM questions WHERE subject_id = $subject_id and grade_id = $grade_id GROUP BY unit";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_levels_of_unit($grade_id, $subject_id, $unit)
    {
        $sql = "SELECT DISTINCT level_detail,questions.level_id, COUNT(questions.level_id) as total FROM questions
        INNER JOIN levels ON levels.level_id = questions.level_id
        WHERE subject_id = $subject_id and grade_id = $grade_id and unit = $unit GROUP BY questions.level_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function list_quest_of_unit($grade_id, $subject_id, $unit, $level_id, $limit)
    {
        $sql = "SELECT DISTINCT * FROM `questions` WHERE `grade_id` = $grade_id and `subject_id` = $subject_id and `unit` = $unit and `level_id` = $level_id ORDER BY RAND() LIMIT $limit";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function edit_class($class_id, $grade_id, $class_name, $teacher_id)
    {
        $sql = "UPDATE classes set grade_id='$grade_id', class_name='$class_name', teacher_id ='$teacher_id'  where class_id ='$class_id'";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function toggle_test_status($test_code, $status_id)
    {
        $sql = "UPDATE tests set status_id='$status_id' where test_code ='$test_code'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function del_class($class_id)
    {
        $sql = "DELETE FROM chats where class_id='$class_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM student_notifications where class_id='$class_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "DELETE FROM classes where class_id='$class_id'";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "SELECT DISTINCT class_name FROM classes WHERE class_id = '$class_id'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        return true;
    }
    public function add_class($grade_id, $class_name, $teacher_id)
    {
        $sql = "SELECT DISTINCT class_id FROM classes WHERE class_name = '$class_name'";
        $this->set_query($sql);
        if ($this->load_row() != '') {
            return false;
        }
        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `classes` AUTO_INCREMENT=1";
        $this->set_query($sql);
        $this->execute_return_status();
        $sql = "INSERT INTO classes (grade_id,class_name,teacher_id) VALUES ('$grade_id','$class_name','$teacher_id')";
        $this->set_query($sql);
        return $this->execute_return_status();
        // return true;
    }
    public function add_quest_to_test($test_code, $question_id)
    {
        $sql = "INSERT INTO quest_of_test (test_code,question_id) VALUES ('$test_code','$question_id')";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function get_list_questions()
    {
        $sql = "
        SELECT DISTINCT questions.question_id,questions.question_content,questions.unit,grades.detail as grade_detail, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer,subjects.subject_detail,levels.level_detail FROM `questions`
        INNER JOIN grades ON grades.grade_id = questions.grade_id
        INNER JOIN levels ON levels.level_id = questions.level_id
        INNER JOIN subjects ON subjects.subject_id = questions.subject_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_tests()
    {
        $sql = "
        SELECT DISTINCT tests.test_code,tests.test_name,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail,statuses.status_id,statuses.detail as status FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        INNER JOIN statuses ON statuses.status_id = tests.status_id";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_question($question_id)
    {
        $sql = "
        SELECT * FROM `questions` WHERE question_id = $question_id";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_list_statuses()
    {
        $sql = "
        SELECT DISTINCT * FROM `statuses`";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function edit_question($question_id, $subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $level_id)
    {
        $sql = "UPDATE questions set question_content='$question_content', grade_id='$grade_id', unit ='$unit',answer_a ='$answer_a',answer_b ='$answer_b',answer_c ='$answer_c',answer_d ='$answer_d',correct_answer ='$correct_answer',subject_id='$subject_id',level_id='$level_id' where question_id = '$question_id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function del_question($question_id)
    {
        $sql = "DELETE FROM questions where question_id='$question_id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function add_question($subject_id, $question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer, $level_id, $sent_by)
    {
        $sql = "INSERT INTO questions (subject_id,grade_id,unit,question_content,answer_a,answer_b,answer_c,answer_d,correct_answer,level_id,sent_by,status_id) VALUES ($subject_id,$grade_id,$unit,'$question_detail','$answer_a','$answer_b','$answer_c','$answer_d','$correct_answer','$level_id','$sent_by',4)";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function add_test($test_code, $test_name, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note)
    {
        $sql = "INSERT INTO tests (test_code,test_name,password,grade_id,subject_id,total_questions,time_to_do,note,status_id) VALUES ($test_code,'$test_name', '$password', $grade_id, $subject_id, $total_questions, $time_to_do, '$note', 2)";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function insert_notification($notification_id, $username, $name, $notification_title, $notification_content)
    {
        $sql = "INSERT INTO notifications (notification_id,username,name,notification_title,notification_content,time_sent) VALUES ($notification_id,'$username','$name','$notification_title','$notification_content',NOW())";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function notify_teacher($ID, $teacher_id)
    {
        $sql = "INSERT INTO teacher_notifications (notification_id,teacher_id) VALUES ('$ID','$teacher_id')";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function notify_class($ID, $class_id)
    {
        $sql = "INSERT INTO student_notifications (notification_id,class_id) VALUES ('$ID','$class_id')";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function get_teacher_notifications()
    {
        $sql = "
        SELECT DISTINCT notifications.notification_id, notifications.notification_title, notifications.notification_content, notifications.username,notifications.name,teachers.name as receive_name,teachers.username as receive_username,notifications.time_sent FROM teacher_notifications
        INNER JOIN notifications ON notifications.notification_id = teacher_notifications.notification_id
        INNER JOIN teachers ON teachers.teacher_id = teacher_notifications.teacher_id
        ORDER BY `ID` DESC";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_student_notifications()
    {
        $sql = "
        SELECT DISTINCT notifications.notification_id, notifications.notification_title, notifications.notification_content, notifications.username,notifications.name,classes.class_name,notifications.time_sent FROM student_notifications
        INNER JOIN notifications ON notifications.notification_id = student_notifications.notification_id
        INNER JOIN classes ON classes.class_id = student_notifications.class_id
        ORDER BY `ID` DESC";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_test_score($test_code)
    {
        $sql = "SELECT DISTINCT * FROM `scores` INNER JOIN students ON scores.student_id = students.student_id
        INNER JOIN classes ON students.class_id = classes.class_id
        WHERE test_code = '$test_code'";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql = "UPDATE admins set email='$email',password='$password', name ='$name', gender_id ='$gender', birthday ='$birthday' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
        return true;
    }
    public function update_avatar($avatar, $username)
    {
        $sql = "UPDATE admins set avatar='$avatar' where username='$username'";
        $this->set_query($sql);
        $this->execute_return_status();
    }
    public function get_total_student()
    {
        $sql = "SELECT DISTINCT COUNT(student_id) as total FROM students";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_admin()
    {
        $sql = "SELECT DISTINCT  COUNT(admin_id) as total FROM admins";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_teacher()
    {
        $sql = "SELECT DISTINCT  COUNT(teacher_id) as total FROM teachers";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_class()
    {
        $sql = "SELECT DISTINCT COUNT(class_id) as total FROM classes";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_subject()
    {
        $sql = "SELECT DISTINCT COUNT(subject_id) as total FROM subjects";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_question()
    {
        $sql = "SELECT DISTINCT COUNT(question_id) as total FROM questions";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_grade()
    {
        $sql = "SELECT DISTINCT COUNT(grade_id) as total FROM grades";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_test()
    {
        $sql = "SELECT DISTINCT COUNT(test_code) as total FROM tests";
        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function edit_subject($subject_id, $subject_detail)
    {
        $sql = "SELECT DISTINCT subject_detail FROM subjects WHERE subject_id = '$subject_id'";
        $this->set_query($sql);
        if ($this->load_row() == '') {
            return false;
        }
        $sql = "UPDATE subjects set subject_detail='$subject_detail' where subject_id='$subject_id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function del_subject($subject_id)
    {
        $sql = "DELETE FROM subjects where subject_id='$subject_id'";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function add_subject($subject_detail)
    {
        $sql = "INSERT INTO subjects (subject_detail) VALUES ('$subject_detail')";
        $this->set_query($sql);
        return $this->execute_return_status();
    }
    public function get_quest_of_test($test_code)
    {
        $sql = "SELECT DISTINCT * FROM `quest_of_test`
        INNER JOIN questions ON quest_of_test.question_id = questions.question_id
        WHERE test_code = $test_code";
        $this->set_query($sql);
        return $this->load_rows();
    }
}
