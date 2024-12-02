<?php

class TypeConge
{
    private $db;

    public function __construct()
    {
        $this->db = Connexion::getConnexion();
    }

    public function Insertion($typeConge, $description)
    {
        $sql = "INSERT INTO type_conge (Type_Conge, Description) VALUES (?, ?)";
        $req = $this->db->prepare($sql);
        $req->execute([$typeConge, $description]);
    }

    public function Modification($id, $typeConge, $description)
    {
        $sql = "UPDATE type_conge SET Type_Conge = :typeConge, Description = :description WHERE ID_Type = :id";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':typeConge', $typeConge, PDO::PARAM_STR);
        $req->bindParam(':description', $description, PDO::PARAM_STR);
        $req->execute();
    }

    public function Afficher()
    {
        $sql = "SELECT * FROM type_conge";
        $req = $this->db->query($sql);
        return $req;
    }

    public function del($id)
    {
        $sql = "DELETE FROM type_conge WHERE ID_Type = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
    }
}