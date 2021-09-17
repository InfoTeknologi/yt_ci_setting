Keamanana XSS_HELPER============================================================================= -->

	function sec_xss($x){
	    echo htmlentities($x, ENT_QUOTES, 'UTF-8');
	}

<!-- Keamanana XSS_HELPER============================================================================= -->

<!-- MATAUANG_HELPER============================================================================= -->
if (!function_exists('rupiah')) {

		function rupiah($angka){
			$hasil_rupiah = "Rp. ".number_format($angka,0,",",".");
			return $hasil_rupiah;
		}
	}
<!-- MATAUANG_HELPER============================================================================= -->

<!-- VALIDASI DATA SAMA_HELPER===================================================================== -->
function in_check($table, $dataArray)
{
	$ci = &get_instance();
	$data = $ci->db->get_where($table, $dataArray)->num_rows();
	if ($data > 0) {
		return 0;
	} else {
		return 1;
	}
}
<!-- VALIDASI DATA SAMA_HELPER===================================================================== -->

<!-- TERBILANG_HELPER===================================================================== -->
if (!function_exists('terbilang')) {

		function penyebut($nilai) {
			$nilai = abs($nilai);
			$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
			$temp = "";
			if ($nilai < 12) {
				$temp = " ". $huruf[$nilai];
			} else if ($nilai <20) {
				$temp = penyebut($nilai - 10). " Belas";
			} else if ($nilai < 100) {
				$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
			} else if ($nilai < 200) {
				$temp = " Seratus" . penyebut($nilai - 100);
			} else if ($nilai < 1000) {
				$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
			} else if ($nilai < 2000) {
				$temp = " Seribu" . penyebut($nilai - 1000);
			} else if ($nilai < 1000000) {
				$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
			} else if ($nilai < 1000000000) {
				$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
			} else if ($nilai < 1000000000000) {
				$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
			} else if ($nilai < 1000000000000000) {
				$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
			}     
			return $temp;
		}
	 
		function terbilang($nilai) {
			if($nilai<0) {
				$hasil = "minus ". trim(penyebut($nilai));
			} else {
				$hasil = trim(penyebut($nilai));
			}     		
			return $hasil;
		}
	}
<!-- TERBILANG_HELPER===================================================================== -->


<!-- BASE_URL CONFIG.PHP===================================================================== -->
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://" . $_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
<!-- BASE_URL CONFIG.PHP===================================================================== -->

<!-- .htaccess===================================================================== -->
<IfModule authz_core_module>
RewriteEngine On
RewriteCond %{REQUEST_URI} ^system.*
RewriteCond $1 !^(index\.php|images|js|uploads|css|robots\.txt)
RewriteRule ^(.*)$ /index.php/$1 [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L] 

<Files ~ ".(xml|css|jpe?g|png|gif|js)$">
    #order allow,deny
    #deny from all
</Files>

<files .htaccess="">
	order allow,deny
	deny from all
</files>

<Files ~ "^.*\.([Hh][Tt][Aa])">
    order allow,deny
    deny from all
    satisfy all
</Files>

#directory browsing
Options All -Indexes
</IfModule>
<!-- .htaccess=====================================================================