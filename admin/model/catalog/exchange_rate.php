<?php

class ModelCatalogExchangeRate extends PT_Model
{
    public function addExchangeRate($data)
    {
        $query = $this->db->query("INSERT INTO " . DB_PREFIX . "exchange_rate SET  content = '" . $this->db->escape((string)$data['content']) . "', value = '" . $this->db->escape((string)$data['value']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        return $query;
    }

    public function editExchangeRate($exchange_rate_id, $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "exchange_rate SET  rate = '" . $this->db->escape((string)$data['rate']) . "', date_modified = NOW() WHERE exchange_rate_id = '" . (int)$exchange_rate_id . "'");
    }

    public function deleteExchangeRate($exchange_rate_id)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "exchange_rate WHERE exchange_rate_id = '" . (int)$exchange_rate_id . "'");

        $this->cache->delete('exchange_rate');
    }

    public function getExchangeRate($exchange_rate_id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "exchange_rate WHERE exchange_rate_id = '" . (int)$exchange_rate_id . "'");

        return $query->row;
    }
    public function getExchangeRates()
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "exchange_rate");

        return $query->rows;
    }
}
