<?php

class ModelClubDashboard extends PT_Model {

    public function getTotalTrf($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT SUM(amount_usd) as total FROM " . DB_PREFIX . "trf WHERE club_id = '" . (int)$club_id . "'");

        return $query->row['total'];
    }

    public function getTotalProject($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT COUNT(title) as total FROM " . DB_PREFIX . "projects WHERE club_id = '" . (int)$club_id . "'");

        return $query->row['total'];
    }

    public function getTotalMember($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT SUM(net) as total FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "'");

        return $query->row['total'];
    }

    public function getTotalClub($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT COUNT(club_id) as total FROM " . DB_PREFIX . "club WHERE parent_id = '" . (int)$club_id . "'");

        return $query->row['total'];
    }

    public function getMemberTable($club_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "'  ORDER BY date_added DESC LIMIT 5");

        return $query->rows;
    }
    public function getProjectTable($club_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "projects WHERE club_id = '" . (int)$club_id . "'  ORDER BY date_added DESC LIMIT 5");

        return $query->rows;
    }
    public function getTrfTable($club_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "trf WHERE club_id = '" . (int)$club_id . "'  ORDER BY date_added DESC LIMIT 5");

        return $query->rows;
    }
    //  public function getTotalTrf($club_id)
    // {
       
    //     $query = $this->db->query("INSERT INTO " . DB_PREFIX . "trf SET  club_id = '" . $this->db->escape((string)$data['club_id']) . "', date = '".$date. "',induction = '" . $this->db->escape((string)$data['member_induct']) . "',unlist = '" . $this->db->escape((string)$data['member_unlist']) . "',net = '" . $this->db->escape((string)$data['net_growth']) . "',points = '" . $this->db->escape((string)$data['point_accumulate']) . "', date_added = NOW()");

    //     return $query;
    // }

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
     public function getMemberById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "'");

        return $query->rows;
    }
     public function getMember($member_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE member_id = '" . (int)$member_id . "'");

        return $query->row;
    }
     public function getTotalMemberById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT SUM(net) as totalmembers FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "'");

        return $query->row;
    }
    // public function getMembers()
    // {
    //     $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "club WHERE status = '1'");

    //     return $query->rows;
    // }

}
