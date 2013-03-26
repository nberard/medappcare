<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        echo 'aaaa';
//        $this->load->helper('assets');
		$this->load->view('welcome_message');
	}

    public function importAndroid()
    {
        $clientToken = '121bc1910a119f65f19910356ca8faaaf9bb9dd3';
        $params = array(
            'd=month',
            'c=12',
            'num=5',
            't=popular',
            'app_info=extended',
            'client_token='.$clientToken,
        );
        $url = 'http://dev.appaware.com/1/app/top.json?'.implode('&', $params);
        $returnDecoded = json_decode(file_get_contents($url), true);
        echo 'call <br/><h2>'.$url."</h2><br/>";
        echo 'nb results : '.count($returnDecoded['results'])."<br/><br/>";
        foreach ($returnDecoded['results'] as $entry)
        {
            var_dump($entry);
            echo $entry['name'].'['.$entry['package_name']."]<br/>";
            $url = 'http://dev.appaware.com/1/app/show.json?p='.$entry['package_name'].'&client_token='.$clientToken;
            $details = json_decode(file_get_contents($url), true);
            var_dump($details);
        }
    }

    public function importApple()
    {
        $url = 'https://itunes.apple.com/fr/rss/newapplications/limit=10/genre=6020/json';
        $returnDecoded = json_decode(file_get_contents($url), true);
//        var_dump($returnDecoded);
        foreach ($returnDecoded['feed']['entry'] as $entry)
        {
            var_dump($entry);
        }
    }

    function langTest()
    {
        // load language file
        $this->lang->load('about');


        $this->load->view('about');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */