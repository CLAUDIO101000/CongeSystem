<?php

class Direction
{
    private $db;

    public function __construct()
    {
        $this->db = Connexion::getConnexion();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function Insertion($dir)
    {
        try {
            $sql = "INSERT INTO direction (Direction) VALUES (?)";
            $req = $this->db->prepare($sql);
            $req->execute([$dir]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function Modification($id, $dir)
    {
        try {
            $sql = "UPDATE direction SET Direction = :direction WHERE ID_Direction = :id";
            $req = $this->db->prepare($sql);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->bindParam(':direction', $dir, PDO::PARAM_STR);
            $req->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function Afficher()
    {
        try {
            $sql = "SELECT * FROM direction";
            $req = $this->db->query($sql);
            return $req;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function del($id)
    {
        try {
            $sql = "DELETE FROM direction WHERE ID_Direction = ?";
            $req = $this->db->prepare($sql);
            $req->execute([$id]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
