<?php

class InterestController extends Controller {

    public function showForm() {

        require_once __DIR__ . '/../models/InterestModel.php';
        $model = new InterestModel();

        $programmes = $model->getAllProgrammes();

        // Pre-select a programme if ID is passed in the URL
        $selectedId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $this->view('interest/form', [
            'programmes' => $programmes,
            'selectedId' => $selectedId,
            'message'    => ''
        ]);
    }

    public function submit() {

      require_once __DIR__ . '/../models/InterestModel.php';
      $model = new InterestModel();

      $programmes = $model->getAllProgrammes();
      $message    = '';

      $name        = trim($_POST['student_name'] ?? '');
      $email       = trim($_POST['email'] ?? '');
      $programmeId = (int)($_POST['programme'] ?? 0);

      if ($name == '' || $email == '' || $programmeId == 0) {
          $message = 'Please fill in all fields.';

      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $message = 'Please enter a valid email address.';

      } else if ($model->alreadyRegistered($email, $programmeId)) {
          $message = 'You have already registered interest in this programme.';

      } else {
          $model->registerInterest($programmeId, $name, $email);
          $message = 'Thank you! Your interest has been registered.';
      }

      $this->view('interest/form', [
          'programmes' => $programmes,
          'selectedId' => $programmeId,
          'message'    => $message
      ]);
    }

    public function showWithdraw() {

        require_once __DIR__ . '/../models/InterestModel.php';
        $model = new InterestModel();

        $programmes = $model->getAllProgrammes();

        $this->view('interest/withdraw', [
            'programmes' => $programmes,
            'message'    => ''
        ]);
    }

    public function withdraw() {

        require_once __DIR__ . '/../models/InterestModel.php';
        $model = new InterestModel();

        $programmes = $model->getAllProgrammes();
        $message    = '';

        $email       = trim($_POST['withdraw_email'] ?? '');
        $programmeId = (int)($_POST['withdraw_programme'] ?? 0);

        if ($email == '' || $programmeId == 0) {
            $message = 'Please fill in all fields.';

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Please enter a valid email address.';

        } else {
            $rows = $model->withdrawInterest($email, $programmeId);

            if ($rows > 0) {
                $message = 'Your interest has been withdrawn successfully.';
            } else {
                $message = 'No registration found for that email and programme.';
            }
        }

        $this->view('interest/withdraw', [
            'programmes' => $programmes,
            'message'    => $message
        ]);
    }
}