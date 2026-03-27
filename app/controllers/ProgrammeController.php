<?php

class ProgrammeController extends Controller {

    public function index() {

      require_once __DIR__ . '/../models/ProgrammeModel.php';
      $model = new ProgrammeModel();

      // Get search and filter values from the URL
      $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
      $level   = isset($_GET['level'])   ? trim($_GET['level'])   : '';

      $programmes = $model->getAllProgrammes($keyword, $level);

      $this->view('programmes/index', [
          'programmes' => $programmes,
          'keyword'    => $keyword,
          'level'      => $level
      ]);
    }

    public function show() {

        // Get the programme ID from the URL
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Load the model
        require_once __DIR__ . '/../models/ProgrammeModel.php';
        $model = new ProgrammeModel();

        // Get the programme details
        $programme = $model->getProgrammeById($id);

        // Get the modules for this programme
        $allModules = $model->getModulesByProgramme($id);

        // Group modules by year
        $modulesByYear = [];
        foreach ($allModules as $module) {
            $year = $module['Year'];
            $modulesByYear[$year][] = $module;
        }

        // Send data to the view
        $this->view('programmes/show', [
            'programme'    => $programme,
            'modulesByYear' => $modulesByYear
        ]);
    }
}
