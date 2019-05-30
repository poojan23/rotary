<?php

class ModelCatalogCenter extends PT_Model
{
    public function addCenter($data)
    {
//        echo "INSERT INTO " . DB_PREFIX . "rotary_center SET  club_id = '" . ((int)$data['club_id']) . "', address = '" . $this->db->escape((string)$data['address']) . "', contact_person = '" . $this->db->escape((string)$data['person']) . "',mobile = '" . $this->db->escape((string)$data['mobile']) . "',email = '" . $this->db->escape((string)$data['email']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()";exit;
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "rotary_center SET   club_id = '" . ((int)$data['club_id']) . "', address = '" . $this->db->escape((string)$data['address']) . "', contact_person = '" . $this->db->escape((string)$data['person']) . "',mobile = '" . $this->db->escape((string)$data['mobile']) . "',email = '" . $this->db->escape((string)$data['email']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        return $query;
    }

    public function editCenter($center_id, $data)
    {
    
        $this->db->query("UPDATE " . DB_PREFIX . "rotary_center SET club_id = '" . ((int)$data['club_id']) . "', address = '" . $this->db->escape((string)$data['address']) . "', contact_person = '" . $this->db->escape((string)$data['person']) . "',mobile = '" . $this->db->escape((string)$data['mobile']) . "',email = '" . $this->db->escape((string)$data['email']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW() WHERE center_id = '" . (int)$center_id . "'");
    }

    public function deleteCenter($center_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "rotary_center WHERE center_id = '" . (int)$center_id . "'");

        $this->cache->delete('center');
    }

    public function getCenter($center_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "rotary_center WHERE center_id = '" . (int)$center_id . "'");

        return $query->row;
    }
    public function getCenters()
    {
//        echo "SELECT  c.*,cl.club_name FROM " . DB_PREFIX . "rotary_center c LEFT JOIN " . DB_PREFIX . "club cl ON c.club_id = cl.club_id WHERE c.status = '1'";exit;
        $query = $this->db->query("SELECT  c.*,cl.club_name FROM " . DB_PREFIX . "rotary_center c LEFT JOIN " . DB_PREFIX . "club cl ON c.club_id = cl.club_id WHERE c.status = '1'");

        return $query->rows;
    }

//    public function getServices($data = array())
//    {
//        if ($data) {
//            $sql = "SELECT *, (SELECT igd.name FROM " . DB_PREFIX . "center_group_description igd WHERE igd.center_group_id = i.center_group_id AND igd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS center_group FROM " . DB_PREFIX . "center i LEFT JOIN " . DB_PREFIX . "center_description id ON (i.center_id = id.center_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";
//
//            $sort_data = array(
//                'id.title',
//                'i.sort_order'
//            );
//
//            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
//                $sql .= " ORDER BY " . $data['sort'];
//            } else {
//                $sql .= " ORDER BY id.title";
//            }
//
//            if (isset($data['order']) && ($data['order'] == 'DESC')) {
//                $sql .= " DESC";
//            } else {
//                $sql .= " ASC";
//            }
//
//            if (isset($data['start']) || isset($data['limit'])) {
//                if ($data['start'] < 0) {
//                    $data['start'] = 0;
//                }
//
//                if ($data['limit'] < 1) {
//                    $data['limit'] = 20;
//                }
//
//                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
//            }
//
//            $query = $this->db->query($sql);
//
//            return $query->rows;
//        } else {
//            $center_data = $this->cache->get('center.' . (int)$this->config->get('config_language_id'));
//
//            if (!$center_data) {
//                $query = $this->db->query("SELECT *, (SELECT igd.title FROM " . DB_PREFIX . "center_group_description igd WHERE igd.center_group_id = i.center_group_id AND igd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS center_group FROM " . DB_PREFIX . "center i LEFT JOIN " . DB_PREFIX . "center_description id ON (i.center_id = id.center_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");
//
//                $center_data = $query->rows;
//
//                $this->cache->set('center.' . (int)$this->config->get('config_language_id'), $center_data);
//            }
//
//            return $center_data;
//        }
//    }

    public function getCenterDescriptions($center_id)
    {
        $center_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "center_description WHERE center_id = '" . (int)$center_id . "'");

        foreach ($query->rows as $result) {
            $center_description_data[$result['language_id']] = array(
                'title'             => $result['title'],
                'description'       => $result['description'],
                'meta_title'        => $result['meta_title'],
                'meta_description'  => $result['meta_description'],
                'meta_keyword'      => $result['meta_keyword']
            );
        }

        return $center_description_data;
    }

    public function getCenterSeoUrls($center_id)
    {
        $center_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'center_id=" . (int)$center_id . "'");

        foreach ($query->rows as $result) {
            $center_seo_url_data[$result['language_id']] = $result['keyword'];
        }

        return $center_seo_url_data;
    }

    public function getTotalCenters()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "center");

        return $query->row['total'];
    }
}
