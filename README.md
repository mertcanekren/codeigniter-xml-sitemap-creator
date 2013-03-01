codeigniter-xml-sitemap-creator
===============================
Example

Generate sitemap file static.xml

```php
$this->load->library('My_xml_sitemap');
$static_pages = array(
  'index',
  'about',
  'contact'
)
$this->my_xml_sitemap->writesitemap('sitemaps',$static_pages,'1.0','weekly','static');
```

Generate sitemap index file sitemaps_index.xml 

Sitemap index file - http://support.google.com/webmasters/bin/answer.py?hl=en&answer=71453

```php
$this->my_xml_sitemap->generate_sitemap_index('sitemaps');
```
