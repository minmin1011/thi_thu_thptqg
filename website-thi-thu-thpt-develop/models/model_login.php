<?php



require_once('config/database.php');

class Model_Login extends Database
{
    public function get_username($username)
    {
        $sql = "SELECT DISTINCT username, name FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT DISTINCT username, name FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT DISTINCT username, name FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_password($username)
    {
        $sql = "SELECT DISTINCT permission,password FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT DISTINCT permission,password FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT DISTINCT permission,password FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function reset_password($username)
    {
        $sql = "SELECT DISTINCT name,email,password,permission FROM students WHERE username = '$username' OR email = '$username'
        UNION
        SELECT DISTINCT name,email,password,permission FROM teachers WHERE username = '$username' OR email = '$username'
        UNION
        SELECT DISTINCT name,email,password,permission FROM admins WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        $get = $this->load_row();
        if ($get) {
            $password = rand(10000000, 99999999);
            $get->password = $password;
            if ($get->permission == 1) {
                $get->permission = 'admins';
            }
            if ($get->permission == 2) {
                $get->permission = 'teachers';
            }
            if ($get->permission == 3) {
                $get->permission = 'students';
            }
            return $get;
        } else {
            return false;
        }
    }
    /**
     * Cập nhật mật khẩu
     * CreatedBy: PQ Huy (10.10.2021)
     */
    public function update_new_password($password, $permission, $username)
    {
        $sql = "UPDATE $permission SET password = '$password' WHERE username = '$username' OR email = '$username'";
        $this->set_query($sql);
        $this->load_row();
    }
    /**
     * Hàm xử lý đăng ký
     *      
     */
    public function save_register($result)
    {
        // mã hóa md5 password
        $sql = "INSERT INTO students (username, email, password, name, permission, class_id, last_login, gender_id, avatar, birthday, doing_exam, starting_time, time_remaining)".
        "VALUES ('".$result['username']."', '".$result['username']."', '".md5($result["password"])."', '".$result['fullname']."', '3', '1', '".date('Y-m-d H:i:s')."', '2', 'avatar-default.jpg', '".date('Y-m-d')."', NULL, '".date('Y-m-d H:i:s')."', NULL);";
        $this->set_query($sql);
        $this->load_row();
    }
}
