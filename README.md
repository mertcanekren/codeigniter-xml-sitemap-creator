codeigniter-xml-sitemap-creator
===============================
Example
`
$this->load->library('My_xml_sitemap');

$static_pages = array(
  'index',
  'about',
  'contact'
);
`
// generate sitemap file static.xml 
$this->my_xml_sitemap->writesitemap('sitemaps',$static_pages,'1.0','weekly','static');
`
// generate sitemap index file sitemaps_index.xml 
// Sitemap index file - http://support.google.com/webmasters/bin/answer.py?hl=tr&answer=71453`
$this->my_xml_sitemap->generate_sitemap_index('sitemaps');
