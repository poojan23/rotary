<?php

class ModelCatalogCitation extends PT_Model
{
    public function addCitation($data)
    {
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "citation SET  content = '" . $this->db->escape((string)$data['content']) . "', value = '" . $this->db->escape((string)$data['value']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        return $query;
    }

    public function editCitation($citation_id, $data)
    {
    
        $this->db->query("UPDATE " . DB_PREFIX . "citation SET  content = '" . $this->db->escape((string)$data['content']) . "', value = '" . $this->db->escape((string)$data['value']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW()WHERE citation_id = '" . (int)$citation_id . "'");
    }

    public function deleteCitation($citation_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "citation WHERE citation_id = '" . (int)$citation_id . "'");

        $this->cache->delete('citation');
    }

    public function getCitation($citation_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "citation WHERE citation_id = '" . (int)$citation_id . "'");

        return $query->row;
    }
    public function getCitations()
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "citation WHERE status = '1'");

        return $query->rows;
    }

//    public function getServices($data = array())
//    {
//        if ($data) {
//            $sql = "SELECT *, (SELECT igd.name FROM " . DB_PREFIX . "citation_group_description igd WHERE igd.citation_group_id = i.citation_group_id AND igd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS citation_group FROM " . DB_PREFIX . "citation i LEFT JOIN " . DB_PREFIX . "citation_description id ON (i.citation_id = id.citation_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";
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
//            $citation_data = $this->cache->get('citation.' . (int)$this->config->get('config_language_id'));
//
//            if (!$citation_data) {
//                $query = $this->db->query("SELECT *, (SELECT igd.title FROM " . DB_PREFIX . "citation_group_description igd WHERE igd.citation_group_id = i.citation_group_id AND igd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS citation_group FROM " . DB_PREFIX . "citation i LEFT JOIN " . DB_PREFIX . "citation_description id ON (i.citation_id = id.citation_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");
//
//                $citation_data = $query->rows;
//
//                $this->cache->set('citation.' . (int)$this->config->get('config_language_id'), $citation_data);
//            }
//
//            return $citation_data;
//        }
//    }

    public function getCitationDescriptions($citation_id)
    {
        $citation_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "citation_description WHERE citation_id = '" . (int)$citation_id . "'");

        foreach ($query->rows as $result) {
            $citation_description_data[$result['language_id']] = array(
                'title'             => $result['title'],
                'description'       => $result['description'],
                'meta_title'        => $result['meta_title'],
                'meta_description'  => $result['meta_description'],
                'meta_keyword'      => $result['meta_keyword']
            );
        }

        return $citation_description_data;
    }

    public function getCitationSeoUrls($citation_id)
    {
        $citation_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'citation_id=" . (int)$citation_id . "'");

        foreach ($query->rows as $result) {
            $citation_seo_url_data[$result['language_id']] = $result['keyword'];
        }

        return $citation_seo_url_data;
    }

    public function getTotalCitations()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "citation");

        return $query->row['total'];
    }
}
