<?php

class ModelCatalogInformationGroup extends PT_Model
{
    public function addInformationGroup($data)
    {
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "information_group SET  group_name = '" . $this->db->escape((string)$data['group_name']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        return $query;
    }

    public function editInformationGroup($information_group_id, $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "information_group SET group_name = '" . $this->db->escape((string)$data['group_name']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW() WHERE information_group_id = '" . (int)$information_group_id . "'");
    }

    public function deleteInformationGroup($information_group_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_group WHERE information_group_id = '" . (int)$information_group_id . "'");

        $this->cache->delete('information_group');
    }

    public function getInformationGroup($information_group_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_group WHERE information_group_id = '" . (int)$information_group_id . "'");

        return $query->row;
    }
    public function getInformationGroups()
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_group");

        return $query->rows;
    }

    public function getInformationGroupDescriptions($information_group_id)
    {
        $information_group_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_group_description WHERE information_group_id = '" . (int)$information_group_id . "'");

        foreach ($query->rows as $result) {
            $information_group_description_data[$result['language_id']] = array(
                'title'     => $result['title'],
                'title_footer'      => $result['title_footer'],
                'description'       => $result['description'],
                'meta_title'        => $result['meta_title'],
                'meta_description'  => $result['meta_description'],
                'meta_keyword'      => $result['meta_keyword']
            );
        }

        return $information_group_description_data;
    }

    public function getInformationGroupSeoUrls($information_group_id)
    {
        $information_group_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'information_group_id=" . (int)$information_group_id . "'");

        foreach ($query->rows as $result) {
            $information_group_seo_url_data[$result['language_id']] = $result['keyword'];
        }

        return $information_group_seo_url_data;
    }

    public function getTotalInformationGroups()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_group");

        return $query->row['total'];
    }
}
