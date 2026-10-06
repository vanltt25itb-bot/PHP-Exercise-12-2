<?php
// Start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 365;    // 1 year in seconds
session_set_cookie_params($lifetime, '/');
session_start();

// Create a task list array if needed
if (empty($_SESSION['task_list'])) {
    $_SESSION['task_list'] = array();
}

$task_list = $_SESSION['task_list'];

$errors = array();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}

switch($action) {
    case 'add':
        $new_task = $_POST['newtask'];
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            $task_list[] = $new_task;
        }
        break;

    case 'delete':
        $task_index = $_POST['taskid'];
        unset($task_list[$task_index]);
        $task_list = array_values($task_list);
        break;
}

$_SESSION['task_list'] = $task_list;

include('task_list.php');
?>