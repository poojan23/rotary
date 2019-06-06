<?php

class ModelClubProject extends PT_Model {

    public function getCategories()
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category WHERE status = '1' ORDER BY sort_order ASC");

        return $query->rows;
    }

     public function addProject($data)
    {
        
        // print_r($data); exit;

        $date = $this->db->escape((string)$data['year']).'-'. $this->db->escape((string)$data['month']);
       
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "projects SET club_id = '" . $this->db->escape((string)$data['club_id']) . "', date = '".$date. "',title = '" . $this->db->escape((string)$data['title']) . "',description = '" . $this->db->escape((string)$data['description']) . "',	amount = '" . $this->db->escape((string)$data['amount']) .  "',	no_of_beneficiary = '" . $this->db->escape((string)$data['no_of_beneficiary']) . "',points = '" . $this->db->escape((string)$data['points']) . "', date_added = NOW()");
        
        $project_id = $this->db->lastInsertId();

        

        // if (isset($data['image'])) {
        //     $this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape((string)$data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
        // }

        foreach ($this->request->post['category'] as $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "project_to_category SET project_id = '" . (int)$project_id . "', category_id = '" . $this->db->escape((string)$value['category_id']) ."'");
        }
        $this->cache->delete('projects');

        return $project_id;
        //return $query;
    }

    // public function editClub($club_id, $data)
    // {
    //     $this->db->query("UPDATE " . DB_PREFIX . "club SET  date = '" . $this->db->escape((string)$data['date']) . "',club_name = '" . $this->db->escape((string)$data['name']) . "',president = '" . $this->db->escape((string)$data['president']) . "',district_secretary = '" . $this->db->escape((string)$data['secretary']) . "',assistant_governor = '" . $this->db->escape((string)$data['governor']) . "',mobile = '" . $this->db->escape((string)$data['mobile']) . "',email = '" . $this->db->escape((string)$data['email']) . "',website = '" . $this->db->escape((string)$data['website']) . "',status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW() WHERE club_id = '" . (int)$club_id . "'");

    //     if (isset($data['image'])) {
    //         $this->db->query("UPDATE " . DB_PREFIX . "club SET image = '" . $this->db->escape((string)$data['image']) . "' WHERE club_id = '" . (int)$club_id . "'");
    //     }
    // }

    // public function deleteClub($club_id)
    // {
    //     $this->db->query("DELETE FROM " . DB_PREFIX . "club WHERE club_id = '" . (int)$club_id . "'");

    //     $this->cache->delete('club');
    // }

    // public function getMember($member_id)
    // {
    //     $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE member_id = '" . (int)$member_id . "'");

    //     return $query->row;
    // }
     public function getProjectById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "projects WHERE club_id = '" . (int)$club_id . "' AND status='1'");

        return $query->rows;
    }
    //  public function getTotalProjectById($club_id)
    // {
    //     $query = $this->db->query("SELECT DISTINCT SUM(amount_usd) as totaltrf FROM " . DB_PREFIX . "trf WHERE club_id = '" . (int)$club_id . "'");

    //     return $query->row;
    // }
    // public function getMembers()
    // {
    //     $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "club WHERE status = '1'");

    //     return $query->rows;
    // }

}
