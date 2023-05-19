<?php

/**
 * View Admin
 * Author: Phạm Quang Huy (Harry Pham)
 * Mail: pqhuy2@software.misa.com.vn
 **/

class View_Teacher01
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/teacher01/head_left.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/foot.php';
    }
    public function show_teacher01s_panel()
    {
        include 'res/templates/teacher01/admins_panel.html';
    }
    public function show_dashboard($dashboard)
    {
        include 'res/templates/teacher01/dashboard.php';
    }
    public function show_teachers_panel()
    {
        include 'res/templates/teacher01/teachers_panel.html';
    }
    public function show_classes_panel()
    {
        include 'res/templates/teacher01/classes_panel.html';
    }
    public function show_students_panel()
    {
        include 'res/templates/teacher01/students_panel.html';
    }
    public function show_questions_panel()
    {
        include 'res/templates/teacher01/questions_panel.html';
    }
    public function show_add_question()
    {
        include 'res/templates/teacher01/add_question.html';
    }
    public function show_edit_question($question, $grades, $subjects)
    {
        include 'res/templates/teacher01/edit_question.php';
    }
    public function show_subjects_panel()
    {
        include 'res/templates/teacher01/subjects_panel.html';
    }
    public function show_tests_panel()
    {
        include 'res/templates/teacher01/tests_panel.html';
    }
    public function show_tests_detail($questions)
    {
        include 'res/templates/teacher01/tests_detail.php';
    }
    public function show_test_score($scores)
    {
        include 'res/templates/teacher01/test_score.php';
    }
    public function show_notifications_panel()
    {
        include 'res/templates/teacher01/notifications_panel.html';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/about.php';
    }
    public function show_profiles($profile)
    {
        include 'res/templates/shared/profiles.php';
    }
    public function show_404()
    {
        include 'res/templates/shared/404.html';
    }
}
