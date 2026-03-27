<?php

class StaffModel {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAllStaff() {
        $stmt = $this->db->prepare("
            SELECT s.StaffID, s.Name,
                   COUNT(DISTINCT m.ModuleID) AS ModuleCount
            FROM Staff s
            LEFT JOIN Modules m ON m.ModuleLeaderID = s.StaffID
            GROUP BY s.StaffID
            ORDER BY s.Name
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStaffById($id) {
        $stmt = $this->db->prepare("
            SELECT StaffID, Name FROM Staff WHERE StaffID = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getModulesByStaff($staffId) {
        $stmt = $this->db->prepare("
            SELECT m.ModuleName, m.Description,
                   GROUP_CONCAT(DISTINCT p.ProgrammeName ORDER BY p.ProgrammeName SEPARATOR ', ') AS Programmes
            FROM Modules m
            LEFT JOIN ProgrammeModules pm ON m.ModuleID = pm.ModuleID
            LEFT JOIN Programmes p ON pm.ProgrammeID = p.ProgrammeID
            WHERE m.ModuleLeaderID = ?
            GROUP BY m.ModuleID
            ORDER BY m.ModuleName
        ");
        $stmt->execute([$staffId]);
        return $stmt->fetchAll();
    }
}