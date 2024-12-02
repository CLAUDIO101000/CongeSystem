<?php

class Personnel
{
    private $nom;
    private $prenom;
    private $dnais;
    private $demb;
    private $adr;
    private $email;
    private $contact;
    private $solde;
    private $db;

    public function __construct()
    {
        $this->db = Connexion::getConnexion();
    }

    public function Insertion($nom, $prenom, $dnais, $demb, $adr, $email, $contact, $direction, $fonction)
    {
        $sql = "INSERT INTO `personnel`(`Nom`, `Prenom`, `Date_de_naissance`, `Date_d_embauche`, `Adresse`, `Contact`, `E_Mail`, `ID_Direction`, `ID_Fonction`) VALUES (?,?,?,?,?,?,?,?,?)";
        $req = $this->db->prepare($sql);
        $res = $req->execute([$nom, $prenom, $dnais, $demb, $adr, $contact, $email, $direction, $fonction]);
    }

    public function Modification($id, $nom, $prenom, $dnais, $demb, $adr, $email, $contact, $direction, $fonction)
    {
        $sql = "UPDATE personnel 
        SET Nom = :nom, 
            Prenom = :prenom, 
            Date_de_naissance = :dnais, 
            Date_d_embauche = :demb, 
            Adresse = :adr,  
            E_Mail = :email,
            Contact = :cont,
            ID_Direction = :direction, 
            ID_Fonction = :fonction 
        WHERE ID_Personnel = :id";

        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':dnais', $dnais);
        $req->bindParam(':demb', $demb);
        $req->bindParam(':adr', $adr);
        $req->bindParam(':cont', $contact);
        $req->bindParam(':email', $email);
        $req->bindParam(':direction', $direction);
        $req->bindParam(':fonction', $fonction);

        if (!$req->execute()) {
            error_log("Erreur lors de la modification du personnel : " . implode(", ", $req->errorInfo()));
            return false;
        }

        return true;
    }

    public function Afficher()
    {
        $sql = "SELECT * FROM `personnel_view`";
        $req = $this->db->query($sql);
        return $req;
    }

    public function AfficherM($id)
    {
        $sql = "SELECT * FROM `personnel` WHERE ID_Personnel = $id";
        $req = $this->db->query($sql);
        return $req;
    }

    public function del($id)
    {
        $sql = "DELETE FROM `personnel` WHERE `ID_Personnel` = $id";
        $req = $this->db->query($sql);
    }
}
