<?php

/**
 * View Teacher
 * Author: Phạm Quang Huy (Harry Pham)
 * Mail: pqhuy2@software.misa.com.vn
 **/

class View_Teacher
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/teacher/head_left.php';
    }
    public function show_dashboard()
    {
        include 'res/templates/teacher/dashboard.html';
    }
    public function show_class_detail()
    {
        include 'res/templates/teacher/class_detail.html';
    }
    public function show_notifications()
    {
        include 'res/templates/teacher/notifications.html';
    }

    public function show_list_test($tests)
    {
        include 'res/templates/teacher/list_test.php';
    }
    public function show_test_score($scores)
    {
        include 'res/templates/teacher/test_score.php';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/about.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/foot.php';
    }
    public function show_students_panel()
    {
        include 'res/templates/teacher/students_panel.html';
    }
    public function show_profiles($profile)
    {
        include 'res/templates/shared/profiles.php';
    }
    public function show_404()
    {
        include 'res/templates/shared/404.html';
    }
    // add view
    public function show_admins_panel()
    {
        include 'res/templates/teacher/admins_panel.html';
    }
    public function show_teachers_panel()
    {
        include 'res/templates/teacher/teachers_panel.html';
    }
    public function show_classes_panel()
    {
        include 'res/templates/teacher/classes_panel.html';
    }
    public function show_questions_panel()
    {
        include 'res/templates/teacher/questions_panel.html';
    }
    public function show_add_question()
    {
        include 'res/templates/teacher/add_question.html';
    }
    public function show_edit_question($question, $grades, $subjects)
    {
        include 'res/templates/teacher/edit_question.php';
    }
    public function show_subjects_panel()
    {
        include 'res/templates/teacher/subjects_panel.html';
    }
    public function show_tests_panel()
    {
        include 'res/templates/teacher/tests_panel.html';
    }
    public function show_tests_detail($questions)
    {
        include 'res/templates/teacher/tests_detail.php';
    }
    public function show_notifications_panel()
    {
        include 'res/templates/teacher/notifications_panel.html';
    }
}
