<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Articles_model extends CI_Model {

    protected $table = 'article';
    protected $tableCategorie = 'article_categorie';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_last_articles($_limit)
    {
        return $this->db->select('A.*, A.titre_'.config_item('lng').' AS titre, A.contenu_'.config_item('lng').' AS contenu, C.nom_'.config_item('lng').' AS nom_categorie')
                ->from($this->table.' A')
                ->join($this->tableCategorie.' C', 'A.categorie_id = C.id')
                ->limit($_limit)->order_by('A.id', 'desc')->get()->result();
    }

}