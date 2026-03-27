<?php

class ProgrammeModel {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Get all published programmes
   public function getAllProgrammes($keyword = '', $level = '') {

    $sql = "
        SELECT p.ProgrammeID, p.ProgrammeName, p.Description,
               l.LevelName
        FROM Programmes p
        JOIN Levels l ON p.LevelID = l.LevelID
        WHERE p.IsPublished = 1
    ";

    $params = [];

    // Add keyword filter if provided
    if ($keyword != '') {
        $sql .= " AND p.ProgrammeName LIKE ?";
        $params[] = '%' . $keyword . '%';
    }

    // Add level filter if provided
    if ($level != '' && $level != 'All Levels') {
        $sql .= " AND l.LevelName = ?";
        $params[] = $level;
    }

    $sql .= " ORDER BY l.LevelName, p.ProgrammeName";

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

    // Get one programme by ID
    public function getProgrammeById($id) {
        $stmt = $this->db->prepare("
            SELECT p.ProgrammeID, p.ProgrammeName, p.Description,
                   l.LevelName, s.Name AS LeaderName
            FROM Programmes p
            JOIN Levels l ON p.LevelID = l.LevelID
            JOIN Staff s ON p.ProgrammeLeaderID = s.StaffID
            WHERE p.ProgrammeID = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Get all modules for a programme grouped by year
    public function getModulesByProgramme($programmeId) {
        $stmt = $this->db->prepare("
            SELECT m.ModuleName, m.Description,
                   s.Name AS LeaderName, pm.Year
            FROM ProgrammeModules pm
            JOIN Modules m ON pm.ModuleID = m.ModuleID
            JOIN Staff s ON m.ModuleLeaderID = s.StaffID
            WHERE pm.ProgrammeID = ?
            ORDER BY pm.Year
        ");
        $stmt->execute([$programmeId]);
        return $stmt->fetchAll();
    }
}
