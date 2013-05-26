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

    public function get_last_articles($_page)
    {
        return $this->db->select('A.*, A.titre_'.config_item('lng').' AS titre, A.contenu_'.config_item('lng').' AS contenu, C.nom_'.config_item('lng').' AS nom_categorie')
                ->from($this->table.' A')
                ->join($this->tableCategorie.' C', 'A.categorie_id = C.id', 'LEFT')
                ->limit(config_item('nb_results_news_list'), ($_page - 1) * config_item('nb_results_news_list'))->order_by('A.id', 'desc')->get()->result();
    }

    public function get_article($_id)
    {
        return $this->db->select('A.*, A.titre_'.config_item('lng').' AS titre, A.contenu_'.config_item('lng').' AS contenu, C.nom_'.config_item('lng').' AS nom_categorie')
                        ->join($this->tableCategorie.' C', 'A.categorie_id = C.id', 'LEFT')
                        ->get_where($this->table.' A', array('A.id' => $_id))->row();
    }

    public function get_count_articles()
    {
        return $this->db->count_all_results($this->table);
    }

}