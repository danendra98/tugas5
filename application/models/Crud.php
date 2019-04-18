<?php
class Crud extends CI_Model {
	public function insert($table, $data = array())
	{
		if (isset($data)) {
			$cek = $this->db->get_where($table, $data)->num_rows();

			if ($cek>0) {
				return false;
			} else {
				$this->db->insert($table, $data);
				return true;
			}
		} else {
			return false;
		}
	}

	public function update($table, $data = array(), $pk = array())
	{
		if (isset($data)) {

			$cek = $this->db->get_where($table, $pk)->num_rows();
			if ($cek == 0) {
				return false;
			}

			foreach ($pk as $key => $value) {
				$this->db->where($key, $value);				
			}

			$this->db->update($table, $data);

			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete($table, $pk = array())
	{
		if (isset($pk)) {
			$data = $this->db->get_where($table, $pk)->num_rows();

			if ($data > 0) {
				$this->db->delete($table, $pk);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function get($table,$pk=array())
	{
		if (count($pk) > 0) {
			return $this->db->get_where($table, $pk)->row();
		} else {
			return $this->db->get($table)->result();
		}
	}
}
?>