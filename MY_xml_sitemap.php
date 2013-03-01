<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter My_xml_sitemap Class
 *
 * Xml sitemap ve sitemap index oluşturucu.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Mertcan Ekren
 * @license		http://en.wikipedia.org/wiki/MIT_License
 */
 Class My_xml_sitemap {

	function __construct(){ 
        $this->CI =& get_instance();
		$this->CI->load->helper('file');
		$this->CI->load->helper('directory');
		$this->xml_header = '<?xml version="1.0" encoding="UTF-8"?>
		<!-- create-date="' . date('d.m.y H:i') . '" -->
        <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$this->xml_footer = '</urlset>';
		$this->xml_sitemap_index_header ='	<?xml version="1.0" encoding="UTF-8"?>
     <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	 	$this->xml_sitemap_index_footer ='</sitemapindex>';		
	}

	/*  
	 *  Site haritalarının dosyalarında site haritalarının indexlerini oluşturur.
	 *
	 *  @param string $directory	Site haritası index dosyasının bulunacağı dizin.
	 */
	function generate_sitemap_index($directory){
		$index = array();
		$index[] = $this->xml_sitemap_index_header;
 		$sitemaps = directory_map('./'.$directory.'/');		
		foreach($sitemaps as $sitemap){
			if(strstr($sitemap,".gz")){
				$index[] = "
				<sitemap>
					<loc>".base_url()."/".$directory"/".$sitemap."</loc>
				</sitemap>";
			}
		}
		$index[] = $this->xml_sitemap_index_footer;
		$indexfile = "";
		foreach($index as $indexline){
			$indexfile.=$indexline;
		}
		if(write_file('./'.$directory.'/sitemaps_index.xml', $indexfile, 'w+')){     		
     		return true;
		}else{
     		return false;
		}
	}
	
	/*	
	 *  Gönderilen sitemap değerlerine göre sitemap dosyası oluşturur.
	 *
	 *  @param string $directory	Site haritalarının bulunacağı dizin.
	 *  @param array $links			Site haritası oluşturulacak linkler.
	 *  @param string $priority		Priority değeri. http://www.sitemaps.org/protocol.html
	 *  @param string $changefreq	Changefreq değeri. http://www.sitemaps.org/protocol.html
	 *  @param string $filename		Oluşturulacak site haritası dosyasının adı.
	 */
	function writesitemap($directory,$links=array(),$priority,$changefreq,$filename){
		$items = array();
		$items[] = $this->xml_header;
		foreach($links as $link){
			$items[] = "
			<url>
				<loc>".base_url().$link."/#!</loc>
				<changefreq>".$changefreq."</changefreq>
				<priority>".$priority."</priority>
			</url>";
		}
		$items[] = $this->xml_footer;
		$data="";
		foreach($items as $item){
			$data.=$item;
		}
		if(write_file('./'.$directory.'/'.$filename.'.xml', $data, 'w+')){
			if(write_file('./'.$directory.'/'.$filename.'.xml.gz', gzencode($data, 9), 'w+')){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }

 }