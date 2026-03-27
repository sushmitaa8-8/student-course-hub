<?php

class Controller {

    // Load a view file and pass data to it
    protected function view($viewPath, $data = []) {

        // Turn the data array into individual variables
        extract($data);

        $file = __DIR__ . '/../app/views/' . $viewPath . '.php';

        if (!file_exists($file)) {
            die("View not found: " . $viewPath);
        }

        require $file;
    }

    // Send the user to a different page
    protected function redirect($url) {
        header('Location: /student-course-hub' . $url);
        exit;
    }
}