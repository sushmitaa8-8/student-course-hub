<?php

class ModuleModel {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Get all modules with their leader name
    public function getAllModules() {
        $stmt = $this->db->prepare("
            SELECT m.ModuleID, m.ModuleName, m.Description,
                  s.Name AS LeaderName,
                  COUNT(DISTINCT pm.ProgrammeID) AS ProgrammeCount
            FROM Modules m
            JOIN Staff s ON m.ModuleLeaderID = s.StaffID
            LEFT JOIN ProgrammeModules pm ON m.ModuleID = pm.ModuleID
            GROUP BY m.ModuleID
            ORDER BY m.ModuleName
        ");
        $stmt->execute();
        $modules = $stmt->fetchAll();

        // For each module get the list of programmes it belongs to
        foreach ($modules as &$module) {
            $stmt2 = $this->db->prepare("
                SELECT p.ProgrammeID, p.ProgrammeName
                FROM ProgrammeModules pm
                JOIN Programmes p ON pm.ProgrammeID = p.ProgrammeID
                WHERE pm.ModuleID = ?
            ");
            $stmt2->execute([$module['ModuleID']]);
            $module['ProgrammeNames'] = $stmt2->fetchAll();
        }

        return $modules;
    }
}
