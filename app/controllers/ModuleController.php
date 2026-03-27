<?php

class ModuleController extends Controller {

    public function index() {

        // Load the model
        require_once __DIR__ . '/../models/ModuleModel.php';
        $model = new ModuleModel();

        // Get all modules from the database
        $modules = $model->getAllModules();

        // Send data to the view
        $this->view('modules/index', [
            'modules' => $modules
        ]);
    }
}