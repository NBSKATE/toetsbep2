<?php

/**
 * Dit is de model voor de controller Countries
 */

class Les
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    // public function getLessen()
    // {
    //     $this->db->query("SELECT Mankement.Datum
    //                             ,Mankement.Id as LEID
    //                             ,Auto.Id
    //                             ,Mankement.Mankement as LENA
    //                             ,Instructeur1.Naam as INNA
    //                       FROM Mankement
    //                       INNER JOIN Auto
    //                       ON Auto.Id = Mankement.AutoId
    //                       INNER JOIN Instructeur1
    //                       ON Instructeur1.Id = Auto.InstructeurId
    //                       WHERE Mankement.InstructeurId = :Id");
    //     $this->db->bind(':Id', 2, PDO::PARAM_INT);
    //     return $this->db->resultSet();
    // }

    public function getLessen()
    {
        $this->db->query("SELECT Mankement.Datum
                                ,Mankement.Id as LEID
                                ,Auto.Id
                                ,Mankement.Mankement as LENA
                                ,Instructeur1.Naam as INNA
                          FROM Instructeur1
                          INNER JOIN Auto
                          ON Auto.InstructeurId = Instructeur1.Id
                          INNER JOIN Mankement
                          ON Auto.Id = Mankement.AutoId
                          WHERE Instructeur1.Id = :Id");
        $this->db->bind(':Id', 2, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getTopics($lessonId)
    {
        // Maak je query
        $sql = "SELECT Les.DatumTijd
                      ,Les.Id
                      ,Onderwerp.Onderwerp
                FROM Onderwerp
                INNER JOIN Les
                ON Les.Id = Onderwerp.LesId
                WHERE LesId= :lessonId";

        // Prepareer je query
        $this->db->query($sql);
        $this->db->bind(':lessonId', $lessonId, PDO::PARAM_INT);

        // Haal je resultaat op en return deze.
        return $this->db->resultSet();
    }

    public function addTopic($post)
    {
        $sql = "INSERT INTO Onderwerp (LesId
                                      ,Onderwerp)
                VALUES                (:LesId,
                                       :topic);";

        $this->db->query($sql);

        $this->db->bind(':lesId', $post['id'], PDO::PARAM_INT);
        $this->db->bind(':topic', $post['topic'], PDO::PARAM_INT);

        return $this->db->execute();
    }
}
