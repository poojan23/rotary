<?php

class ModelCatalogGovernorApprove extends PT_Model
{
     public function getMemberById($club_id)
    {
//         echo "SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "'";exit;
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "'");

        return $query->rows;
    }
     public function getProjectById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "projects WHERE club_id = '" . (int)$club_id . "' AND status='1'");

        return $query->rows;
    }
}