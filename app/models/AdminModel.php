<?php

class AdminModel {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function countProgrammes() {
        return $this->db->query("SELECT COUNT(*) FROM Programmes")->fetchColumn();
    }

    public function countModules() {
        return $this->db->query("SELECT COUNT(*) FROM Modules")->fetchColumn();
    }

    public function countInterestedStudents() {
        return $this->db->query("SELECT COUNT(*) FROM InterestedStudents")->fetchColumn();
    }

    public function getMailingList() {
      $stmt = $this->db->prepare("
          SELECT i.InterestID, i.StudentName, i.Email,
                p.ProgrammeName, i.RegisteredAt
          FROM InterestedStudents i
          JOIN Programmes p ON i.ProgrammeID = p.ProgrammeID
          ORDER BY i.RegisteredAt DESC
      ");
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public function getAllProgrammes() {
        $stmt = $this->db->prepare("
          SELECT p.ProgrammeID, p.ProgrammeName, l.LevelName, p.IsPublished
          FROM Programmes p
          JOIN Levels l ON p.LevelID = l.LevelID
          ORDER BY p.ProgrammeName
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addProgramme($name, $levelId, $leaderId, $description) {
        $stmt = $this->db->prepare("
            INSERT INTO Programmes (ProgrammeName, LevelID, ProgrammeLeaderID, Description)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$name, $levelId, $leaderId, $description]);
    }

    public function deleteProgramme($id) {
        $stmt = $this->db->prepare("DELETE FROM Programmes WHERE ProgrammeID = ?");
        $stmt->execute([$id]);
    }

    public function getAllStaff() {
        $stmt = $this->db->prepare("SELECT StaffID, Name FROM Staff ORDER BY Name");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addStaff($name) {
        $stmt = $this->db->prepare("
        INSERT INTO Staff (Name) VALUES (?)
        ");
        $stmt->execute([$name]);
    }

    public function getAllLevels() {
        $stmt = $this->db->prepare("SELECT LevelID, LevelName FROM Levels");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function togglePublish($id, $currentStatus) {
      $newStatus = $currentStatus == 1 ? 0 : 1;
      $stmt = $this->db->prepare("
          UPDATE Programmes SET IsPublished = ? WHERE ProgrammeID = ?
      ");
      $stmt->execute([$newStatus, $id]);
    }

    public function getProgrammeById($id) {
    $stmt = $this->db->prepare("
        SELECT ProgrammeID, ProgrammeName, LevelID,
               ProgrammeLeaderID, Description
        FROM Programmes
        WHERE ProgrammeID = ?
      ");
      $stmt->execute([$id]);
      return $stmt->fetch();
    }

    public function updateProgramme($id, $name, $levelId, $leaderId, $description) {
        $stmt = $this->db->prepare("
            UPDATE Programmes
            SET ProgrammeName = ?, LevelID = ?,
                ProgrammeLeaderID = ?, Description = ?
            WHERE ProgrammeID = ?
        ");
        $stmt->execute([$name, $levelId, $leaderId, $description, $id]);
    }

    public function addModule($name, $leaderId, $description) {
    $stmt = $this->db->prepare("
        INSERT INTO Modules (ModuleName, ModuleLeaderID, Description)
        VALUES (?, ?, ?)
      ");
      $stmt->execute([$name, $leaderId, $description]);
    }

    public function removeInterest($interestId) {
        $stmt = $this->db->prepare("
            DELETE FROM InterestedStudents WHERE InterestID = ?
        ");
        $stmt->execute([$interestId]);
    }

    public function reassignModuleLeader($moduleId, $staffId) {
      $stmt = $this->db->prepare("
          UPDATE Modules SET ModuleLeaderID = ? WHERE ModuleID = ?
      ");
      $stmt->execute([$staffId, $moduleId]);
    }

    public function getAllModules() {
        $stmt = $this->db->prepare("
            SELECT ModuleID, ModuleName FROM Modules ORDER BY ModuleName
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

   public function deleteModule($id) {
      // First remove all programme-module links for this module
      $stmt = $this->db->prepare("
          DELETE FROM ProgrammeModules WHERE ModuleID = ?
      ");
      $stmt->execute([$id]);

      // Then delete the module itself
      $stmt = $this->db->prepare("
          DELETE FROM Modules WHERE ModuleID = ?
      ");
      $stmt->execute([$id]);
    }
}