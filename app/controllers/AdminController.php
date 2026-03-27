<?php

class AdminController extends Controller {

    // Check if admin is logged in
    private function checkLogin() {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirect('/?page=login');
        }
    }

    public function index() {

        $this->checkLogin();

        require_once __DIR__ . '/../models/AdminModel.php';
        $model = new AdminModel();

        $data = [
            'totalProgrammes'  => $model->countProgrammes(),
            'totalModules'     => $model->countModules(),
            'totalInterested'  => $model->countInterestedStudents(),
            'mailingList'      => $model->getMailingList(),
            'programmes'       => $model->getAllProgrammes(),
            'staff'            => $model->getAllStaff(),
            'levels'           => $model->getAllLevels(),
            'modules'          => $model->getAllModules(),
            'message'          => ''
        ];

        $this->view('admin/dashboard', $data);
    }

    public function handlePost() {

      $this->checkLogin();

      require_once __DIR__ . '/../models/AdminModel.php';
      $model = new AdminModel();

      $action = $_POST['action'] ?? '';

      if ($action == 'add') {

        $name        = trim($_POST['programme_name'] ?? '');
        $levelId     = (int)($_POST['programme_level'] ?? 0);
        $leaderId    = (int)($_POST['programme_leader'] ?? 0);
        $description = trim($_POST['programme_description'] ?? '');

        if ($name != '' && $levelId != 0 && $leaderId != 0) {
            $model->addProgramme($name, $levelId, $leaderId, $description);
        }

      } else if ($action == 'delete') {

        $id = (int)($_POST['programme_id'] ?? 0);
        if ($id != 0) {
          $model->deleteProgramme($id);
        }

      } else if ($action == 'publish') {

        $id            = (int)($_POST['programme_id']   ?? 0);
        $currentStatus = (int)($_POST['current_status'] ?? 1);

        if ($id != 0) {
          $model->togglePublish($id, $currentStatus);
        }

      } else if ($action == 'update') {

        $id          = (int)($_POST['programme_id']          ?? 0);
        $name        = trim($_POST['programme_name']         ?? '');
        $levelId     = (int)($_POST['programme_level']       ?? 0);
        $leaderId    = (int)($_POST['programme_leader']      ?? 0);
        $description = trim($_POST['programme_description']  ?? '');

        if ($id != 0 && $name != '') {
          $model->updateProgramme($id, $name, $levelId, $leaderId, $description);
        }

      } else if ($action == 'add_module') {

        $name        = trim($_POST['module_name']        ?? '');
        $leaderId    = (int)($_POST['module_leader']     ?? 0);
        $description = trim($_POST['module_description'] ?? '');

        if ($name != '' && $leaderId != 0) {
          $model->addModule($name, $leaderId, $description);
        }

      } else if ($action == 'remove_interest') {

        $id = (int)($_POST['interest_id'] ?? 0);
        if ($id != 0) {
        $model->removeInterest($id);
        }
      } else if ($action == 'reassign_leader') {

        $moduleId = (int)($_POST['module_id'] ?? 0);
        $staffId  = (int)($_POST['staff_id']  ?? 0);

        if ($moduleId != 0 && $staffId != 0) {
            $model->reassignModuleLeader($moduleId, $staffId);
        }
      } else if ($action == 'delete_module') {

      $id = (int)($_POST['delete_module_id'] ?? 0);
      if ($id != 0) {
          $model->deleteModule($id);
        }
      }
      $this->redirect('/?page=admin');
    }

    public function exportCsv() {

        $this->checkLogin();

        require_once __DIR__ . '/../models/AdminModel.php';
        $model = new AdminModel();

        $mailingList = $model->getMailingList();

        // Tell the browser to download a CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="mailing-list.csv"');

        $output = fopen('php://output', 'w');

        // Write the header row
        fputcsv($output, ['Name', 'Email', 'Programme', 'Registered At']);

        // Write each student row
        foreach ($mailingList as $row) {
            fputcsv($output, [
                $row['StudentName'],
                $row['Email'],
                $row['ProgrammeName'],
                $row['RegisteredAt']
            ]);
        }

        fclose($output);
        exit;
    }
}