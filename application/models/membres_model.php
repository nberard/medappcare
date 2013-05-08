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

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_membres($_condition)
    {
        $membre = $this->db->select('*')->from($this->table)->where($_condition)->get()->result();
        return !empty($membre) ? $membre[0] : false;
    }

    public function insert_membres($_params, $_list)
    {
        log_message('debug', "insert_membres=".var_export($_params, true)."=".var_export($_list, true)."");
        $plateformes = $interets = array();
        foreach($_params as $key => $value)
        {
            if(in_array($key, $_list))
            {
                if($key == 'mot_de_passe')
                {
                    $value = get_crypt_password($value);
                }
                $this->db->set($key,  $value);
            }
            else if(is_array($value))
            {
                if($key == 'interets')
                {
                    $interets = $value;
                }
                else if($key == 'plateformes')
                {
                    $plateformes = $value;
                }
            }
        }
        $this->db->set('est_pro', 0); //will be set if rpps number ok or e-mail validation ok
        $this->db->insert($this->table);
        $membre_id = $this->db->insert_id();
        log_message('debug', "membre_id=".var_export($membre_id, true)."");
        if($membre_id)
        {
            if(!empty($plateformes))
            {
                foreach($plateformes as $plateforme)
                {
                    $this->db->insert($this->table_plateformes, array('membre_id' => $membre_id, 'plateforme_id' => $plateforme));
                }
            }
            if(!empty($interets))
            {
                foreach($interets as $interet)
                {
                    $this->db->insert($this->table_categories, array('membre_id' => $membre_id, 'categorie_id' => $interet));
                }
            }
            return $membre_id;
        }
        else
        {
            return false;
        }
    }
}