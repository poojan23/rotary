<?php

class ModelCatalogClub extends PT_Model
{
    public function addClub($data)
    {
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "club SET  date = '" . $this->db->escape((string)$data['date']) . "',club_name = '" . $this->db->escape((string)$data['name']) . "',president = '" . $this->db->escape((string)$data['president']) . "',mobile = '" . $this->db->escape((string)$data['mobile']) . "',email = '" . $this->db->escape((string)$data['email']) . "', password = '" . $this->db->escape(password_hash(html_entity_decode($data['password'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT)) . "',website = '" . $this->db->escape((string)$data['website']) . "',image = '" . $this->db->escape((string)$data['image']) . "',ip = ':81',status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        return $query;
    }

    public function editClub($club_id, $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "club SET  date = '" . $this->db->escape((string)$data['date']) . "',club_name = '" . $this->db->escape((string)$data['name']) . "',president = '" . $this->db->escape((string)$data['president']) . "',mobile = '" . $this->db->escape((string)$data['mobile']) . "',email = '" . $this->db->escape((string)$data['email']) . "',website = '" . $this->db->escape((string)$data['website']) . "',status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW() WHERE club_id = '" . (int)$club_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "club SET image = '" . $this->db->escape((string)$data['image']) . "' WHERE club_id = '" . (int)$club_id . "'");
        }
    }

    public function deleteClub($club_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "club WHERE club_id = '" . (int)$club_id . "'");

        $this->cache->delete('club');
    }

    public function getClub($club_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "club WHERE club_id = '" . (int)$club_id . "'");

        return $query->row;
    }
    public function getClubs()
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "club WHERE status = '1'");

        return $query->rows;
    }

//    public function getServices($data = array())
//    {
//        if ($data) {
//            $sql = "SELECT *, (SELECT igd.name FROM " . DB_PREFIX . "club_group_description igd WHERE igd.club_group_id = i.club_group_id AND igd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS club_group FROM " . DB_PREFIX . "club i LEFT JOIN " . DB_PREFIX . "club_description id ON (i.club_id = id.club_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";
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
//            $club_data = $this->cache->get('club.' . (int)$this->config->get('config_language_id'));
//
//            if (!$club_data) {
//                $query = $this->db->query("SELECT *, (SELECT igd.title FROM " . DB_PREFIX . "club_group_description igd WHERE igd.club_group_id = i.club_group_id AND igd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS club_group FROM " . DB_PREFIX . "club i LEFT JOIN " . DB_PREFIX . "club_description id ON (i.club_id = id.club_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");
//
//                $club_data = $query->rows;
//
//                $this->cache->set('club.' . (int)$this->config->get('config_language_id'), $club_data);
//            }
//
//            return $club_data;
//        }
//    }

    public function getClubDescriptions($club_id)
    {
        $club_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "club_description WHERE club_id = '" . (int)$club_id . "'");

        foreach ($query->rows as $result) {
            $club_description_data[$result['language_id']] = array(
                'title'             => $result['title'],
                'description'       => $result['description'],
                'meta_title'        => $result['meta_title'],
                'meta_description'  => $result['meta_description'],
                'meta_keyword'      => $result['meta_keyword']
            );
        }

        return $club_description_data;
    }

    public function getClubSeoUrls($club_id)
    {
        $club_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'club_id=" . (int)$club_id . "'");

        foreach ($query->rows as $result) {
            $club_seo_url_data[$result['language_id']] = $result['keyword'];
        }

        return $club_seo_url_data;
    }

    public function getTotalClubs()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "club");

        return $query->row['total'];
    }
}
