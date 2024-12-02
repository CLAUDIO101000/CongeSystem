<?php

class Fonction
{
    private $db;

    public function __construct()
    {
        $this->db = Connexion::getConnexion();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function Insertion($func)
    {
        $sql = "INSERT INTO fonction (Fonction) VALUES (?)";
        $req = $this->db->prepare($sql);
        $req->execute([$func]);
    }

    public function Modification($id, $func)
    {
        $sql = "UPDATE fonction SET Fonction = :fonction WHERE ID_Fonction = :id";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':fonction', $func, PDO::PARAM_STR);
        $req->execute();
    }

    public function Afficher()
    {
        $sql = "SELECT * FROM fonction";
        $req = $this->db->query($sql);
        return $req;
    }

    public function del($id)
    {
        $sql = "DELETE FROM fonction WHERE ID_Fonction = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
    }
}
