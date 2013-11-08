<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Membres_model extends CI_Model {

    protected $table = 'membre';
    protected $table_categories = 'membre_categorie';
    protected $table_plateformes = 'membre_plateforme';

    private $interets = array();
    private $plateformes = array();

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_membres($_condition)
    {
        return $this->db->get_where($this->table, $_condition)->row();
    }

    public function update_password($_membre_email, $_new_password)
    {
//        log_message('debug', "update_password($_membre_email, $_new_password)");
        $this->db->update($this->table, array('mot_de_passe' => $_new_password), array('email' => $_membre_email));
        return $this->db->affected_rows();
    }

    public function update_membre($_membre_id, $_params, $_list, $_pro)
    {
//        log_message('debug', "update_membre($_membre_id,  =".var_export($_params, true)."=".var_export($_list, true)."");
        if(empty($_params['mot_de_passe']))
        {
            unset($_params['mot_de_passe']);
        }
        $updates = $this->_clean_parameters($_params, $_list, false);
        $this->db->update($this->table, $updates, array('id' => $_membre_id));
        $this->db->delete($this->table_categories, array('membre_id' => $_membre_id));
        $this->_insert_membre_interets($_membre_id);
        if(!$_pro)
        {
            $this->db->delete($this->table_plateformes, array('membre_id' => $_membre_id));
            $this->_insert_membre_plateformes($_membre_id);
        }
        return true;
    }

    protected function _clean_parameters($_params, $_list, $_create)
    {
        $_updates = array();
        foreach($_params as $key => $value)
        {
            if(in_array($key, $_list))
            {
                if($key == 'mot_de_passe')
                {
                    $value = get_crypt_password($value);
                }
                else if($key == 'date_naissance')
                {
                    $this->load->helper('date');
                    $value = date_to_date_mysql($value);
                }
                if($_create)
                {
                    $this->db->set($key,  $value);
                }
                else
                {
                    $_updates[$key] = $value;
                }
            }
            else if(is_array($value))
            {
                if($key == 'interets')
                {
                    $this->interets = $value;
                }
                else if($key == 'plateformes')
                {
                    $this->plateformes = $value;
                }
            }
        }
        return $_updates;
    }

    private function _insert_membre_plateformes($_membre_id)
    {
        if(!empty($this->plateformes))
        {
            foreach($this->plateformes as $plateforme)
            {
                $this->db->insert($this->table_plateformes, array('membre_id' => $_membre_id, 'plateforme_id' => $plateforme));
            }
        }
    }

    private function _insert_membre_interets($_membre_id)
    {
        if(!empty($this->interets))
        {
            foreach($this->interets as $interet)
            {
                $this->db->insert($this->table_categories, array('membre_id' => $_membre_id, 'categorie_id' => $interet));
            }
        }
    }

    public function insert_membres($_params, $_list, $_pro)
    {
//        log_message('debug', "insert_membres=".var_export($_params, true)."=".var_export($_list, true)."");

        $this->_clean_parameters($_params, $_list, true);

        $this->db->set('est_pro', $_pro ? 2 : 0);
        $this->db->set('date_creation', 'NOW()', false);
        $this->db->insert($this->table);
        $membre_id = $this->db->insert_id();
//        log_message('debug', "membre_id=".var_export($membre_id, true)."");
        if($membre_id)
        {
            $this->_insert_membre_plateformes($membre_id);
            $this->_insert_membre_interets($membre_id);
            return $membre_id;
        }
        else
        {
            return false;
        }
    }

    public function get_categories_id_membre($_membre_id)
    {
        $res =  $this->db->get_where($this->table_categories, array('membre_id' => $_membre_id))->result();
        if(!empty($res))
        {
            $categories_ids = array();
            foreach ($res as $row)
            {
                $categories_ids[] = $row->categorie_id;
            }
            return $categories_ids;
        }
        else
        {
            return array();
        }
    }

    public function get_plateformes_id_membre($_membre_id)
    {
        $res = $this->db->get_where($this->table_plateformes, array('membre_id' => $_membre_id))->result();
        if(!empty($res))
        {
            $plateformes_ids = array();
            foreach ($res as $row)
            {
                $plateformes_ids[] = $row->plateforme_id;
            }
            return $plateformes_ids;
        }
        else
        {
            return array();
        }
    }

    public function get_membres_attente()
    {
        $res = $this->db->select('id, email')->get_where($this->table, array('est_pro' => 2), 10)->result();
        return $res ? $res : array();
    }
}