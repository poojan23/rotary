<?php

class ModelCatalogGovernorApprove extends PT_Model
{
     public function getMemberById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "' AND review='0'");

        return $query->rows;
    }
     public function getProjectById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "projects WHERE club_id = '" . (int)$club_id . "' AND status='1'");

        return $query->rows;
    }
}