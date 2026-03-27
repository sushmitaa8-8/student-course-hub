<?php

class StaffController extends Controller {

    public function index() {

        require_once __DIR__ . '/../models/StaffModel.php';
        $model = new StaffModel();

        $staff = $model->getAllStaff();

        $this->view('staff/index', [
            'staff' => $staff
        ]);
    }

    public function show() {

        require_once __DIR__ . '/../models/StaffModel.php';
        $model = new StaffModel();

        $id      = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $member  = $model->getStaffById($id);
        $modules = $model->getModulesByStaff($id);

        $this->view('staff/show', [
            'member'  => $member,
            'modules' => $modules
        ]);
    }
}