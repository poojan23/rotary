<?php

class ModelClubAddData extends PT_Model {


     public function addMember($data)
    {

        $date = $this->db->escape((string)$data['year']).'-'. $this->db->escape((string)$data['month']);
       
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "member SET  club_id = '" . $this->db->escape((string)$data['club_id']) . "', date = '".$date. "',induction = '" . $this->db->escape((string)$data['member_induct']) . "',unlist = '" . $this->db->escape((string)$data['member_unlist']) . "',net = '" . $this->db->escape((string)$data['net_growth']) . "',points = '" . $this->db->escape((string)$data['point_accumulate']) . "', date_added = NOW()");
       
        return $query;
    }


     public function addTrf($data)
    {

        $date = $this->db->escape((string)$data['year']).'-'. $this->db->escape((string)$data['month']);
       
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "trf SET  club_id = '" . $this->db->escape((string)$data['club_id']) . "', date = '".$date. "',amount_inr = '" . $this->db->escape((string)$data['amount_inr']) . "',exchange_rate = '" . $this->db->escape((string)$data['exchange_rate']) . "',	amount_usd = '" . $this->db->escape((string)$data['amount_usd']) . "',points = '" . $this->db->escape((string)$data['points']) . "', date_added = NOW()");

        return $query;
    }


     public function addProject($data)
    {

        $date = $this->db->escape((string)$data['year']).'-'. $this->db->escape((string)$data['month']);
       
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "projects SET club_id = '" . $this->db->escape((string)$data['club_id']) . "', date = '".$date. "',title = '" . $this->db->escape((string)$data['title']) . "',description = '" . $this->db->escape((string)$data['description']) . "',	amount = '" . $this->db->escape((string)$data['amount']) .  "',	no_of_beneficiary = '" . $this->db->escape((string)$data['no_of_beneficiary']) . "',points = '" . $this->db->escape((string)$data['points']) . "', date_added = NOW()");
        
        $project_id = $this->db->lastInsertId();
        $i=1;
        
        foreach ($this->request->post['image'] as $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "project_image SET project_id = '" . (int)$project_id . "', sort_order = '" . (int)$i++ . "', image = '" . $this->db->escape((string)$value) ."'");
        }

        foreach ($this->request->post['category'] as $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "project_to_category SET project_id = '" . (int)$project_id . "', category_id = '" . $this->db->escape((string)$value['category_id']) ."'");
        }


        $this->cache->delete('projects');

     return $project_id;
    }
     public function getMemberById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "' AND review='1'");

        return $query->rows;
    }
     public function getMember($member_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE member_id = '" . (int)$member_id . "' AND review='1'");

        return $query->row;
    }
     public function getTotalMemberById($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT SUM(net) as total FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "' AND review='1'");

        return $query->row['total'];
    }

     public function getMemberPoints($club_id)
    {
        $query = $this->db->query("SELECT sum(points) as total FROM " . DB_PREFIX . "member WHERE club_id = '" . (int)$club_id . "' AND review='1'");

        return $query->row['total'];
    }
     public function getTrfPoints($club_id)
    {
        $query = $this->db->query("SELECT sum(points) as total FROM " . DB_PREFIX . "trf WHERE club_id = '" . (int)$club_id . "' AND review='1'");

        return $query->row['total'];
    }

     public function getProjectPoints($club_id)
    {
        $query = $this->db->query("SELECT sum(points) as total FROM " . DB_PREFIX . "projects WHERE club_id = '" . (int)$club_id . "' AND review='1'");

        return $query->row['total'];
    }

    public function getExchangeRate()
    {
        $query = $this->db->query("SELECT rate FROM " . DB_PREFIX . "exchange_rate");

        return $query->row['rate'];
    }

}
