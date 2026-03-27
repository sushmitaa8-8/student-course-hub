<?php

class InterestModel {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Get all programmes for the dropdown
    public function getAllProgrammes() {
        $stmt = $this->db->prepare("
            SELECT ProgrammeID, ProgrammeName
            FROM Programmes
            ORDER BY ProgrammeName
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Save a student's interest
    public function registerInterest($programmeId, $name, $email) {
        $stmt = $this->db->prepare("
            INSERT INTO InterestedStudents (ProgrammeID, StudentName, Email)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$programmeId, $name, $email]);
    }

    // Remove a student's interest
    public function withdrawInterest($email, $programmeId) {
        $stmt = $this->db->prepare("
            DELETE FROM InterestedStudents
            WHERE Email = ? AND ProgrammeID = ?
        ");
        $stmt->execute([$email, $programmeId]);
        return $stmt->rowCount();
    }

    public function alreadyRegistered($email, $programmeId) {
      $stmt = $this->db->prepare("
          SELECT COUNT(*) FROM InterestedStudents
          WHERE Email = ? AND ProgrammeID = ?
      ");
      $stmt->execute([$email, $programmeId]);
      return $stmt->fetchColumn() > 0;
    }
}