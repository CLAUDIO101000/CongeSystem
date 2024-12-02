<?php
class Conge
{
    private $db;

    public function __construct()
    {
        $this->db = Connexion::getConnexion();
    }

    public function Insertion($personnelId, $dateDebut, $dateFin, $idType)
    {
        $jours = $this->calculerJoursConge($dateDebut, $dateFin);
        // var_dump($jours);

        if ($jours > 0) {
            if ($this->verifierSoldeConge($personnelId, $jours)) {
                $sql = "INSERT INTO conge (Date_de_debut, Date_de_fin, Nombre_conge, ID_Type, ID_Personnel)
                VALUES (?, ?, ?, ?, ?)";
                $req = $this->db->prepare($sql);
                $req->execute([$dateDebut, $dateFin, $jours, $idType, $personnelId]);

                $this->mettreAJourSoldeConge($personnelId, $jours);
                // var_dump('Solde suffisant');
                return true;
            } else {
                // var_dump('Solde insuffisant');
                return false;
            }
        }

        return false;
    }

    private function verifierSoldeConge($personnelId, $jours)
    {
        $sql = "SELECT Solde_Conge FROM personnel WHERE ID_Personnel = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$personnelId]);
        $data = $req->fetch(PDO::FETCH_ASSOC);
    
        // var_dump($data['Solde_Conge']);
        // var_dump($jours);
        
        return $data['Solde_Conge'] >= $jours;
    }    
    
    private function mettreAJourSoldeConge($personnelId, $jours)
    {
        $sql = "UPDATE personnel SET Solde_Conge = Solde_Conge - ? WHERE ID_Personnel = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$jours, $personnelId]);
    }

    public function Afficher()
    {
        $sql = "SELECT c.ID_conge, 
                   p.Nom, 
                   p.Prenom, 
                   c.Date_de_debut, 
                   c.Date_de_fin, 
                   c.Nombre_conge, 
                   tc.Type_Conge
            FROM conge c
            JOIN personnel p ON c.ID_Personnel = p.ID_Personnel
            JOIN type_conge tc ON c.ID_Type = tc.ID_Type";
        $req = $this->db->query($sql);
        return $req;
    }

    private function calculerJoursConge($dateDebut, $dateFin)
    {
        $dateDebut = new DateTime($dateDebut);
        $dateFin = new DateTime($dateFin);
        $jours = 0;
    
        for ($date = clone $dateDebut; $date <= $dateFin; $date->modify('+1 day')) {
            $annee = $date->format('Y');
            $joursFeries = $this->getJoursFeries($annee);
            $jourSemaine = $date->format('N');
            
            if ($jourSemaine < 6 && !in_array($date->format('Y-m-d'), $joursFeries)) {
                $jours++;
            }            
        }
    
        // var_dump($jours);
        return $jours;
    }    

    private function getJoursFeries($annee)
    {
        $joursFeries = [
            $annee . '-01-01', // Jour de l'An
            $this->getLundiDePaques($annee), // Lundi de Pâques
            $annee . '-05-01', // Fête du Travail
            $annee . '-05-08', // Victoire 1945
            $this->getAscension($annee), // Ascension
            $this->getLundiDePentecote($annee), // Lundi de Pentecôte
            $annee . '-07-14', // Fête Nationale
            $annee . '-08-15', // Assomption
            $annee . '-11-01', // Toussaint
            $annee . '-11-11', // Armistice 1918
            $annee . '-12-25', // Noël
        ];
        
        // var_dump($joursFeries);
        return $joursFeries;
    }    

    // Calcul de la date du Lundi de Pâques
    private function getLundiDePaques($annee)
    {
        $datePaques = new DateTime("@" . easter_date($annee));
        $datePaques->modify('+1 day'); // Lundi de Pâques, le jour après Pâques
        return $datePaques->format('Y-m-d');
    }

    // Calcul de la date de l'Ascension (40 jours après Pâques)
    private function getAscension($annee)
    {
        $datePaques = new DateTime("@" . easter_date($annee));
        $datePaques->modify('+39 days'); // 40 jours après Pâques
        return $datePaques->format('Y-m-d');
    }

    // Calcul de la date du Lundi de Pentecôte (50 jours après Pâques)
    private function getLundiDePentecote($annee)
    {
        $datePaques = new DateTime("@" . easter_date($annee));
        $datePaques->modify('+50 days'); // 50 jours après Pâques
        return $datePaques->format('Y-m-d');
    }

    public function RechercherParDates($dateDebut, $dateFin)
    {
        $sql = "SELECT c.ID_conge, 
                       p.Nom, 
                       p.Prenom, 
                       c.Date_de_debut, 
                       c.Date_de_fin, 
                       c.Nombre_conge, 
                       tc.Type_Conge
                FROM conge c
                JOIN personnel p ON c.ID_Personnel = p.ID_Personnel
                JOIN type_conge tc ON c.ID_Type = tc.ID_Type
                WHERE c.Date_de_debut >= ? AND c.Date_de_fin <= ?";
        $req = $this->db->prepare($sql);
        $req->execute([$dateDebut, $dateFin]);
        return $req;
    }
}
