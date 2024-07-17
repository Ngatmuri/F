
<?php
date_default_timezone_set('Asia/Jakarta');

$url = 'https://m.facebook.com/story.php?story_fbid=pfbid0ZvwuqLDayJC9GHS22ME6bugPaXYLF8D9EWBXiJtfFYoqWtPFhUXLc8hT5K3MB5BZl&id=100023707813487&refid=8&_ft_=qid.-6065724583237763388%3Amf_story_key.2780089216474489414%3Atop_level_post_id.1218856095581306%3Acontent_owner_id_new.100023707813487%3Asrc.22%3Aphoto_id.1218856062247976%3Astory_location.5%3Astory_attachment_style.photo%3Aview_time.1656562554%3Afilter.h_nor%3Aweight.413.89868164062%3Asty.247%3Amf_objid.1218856095581306%3Aent_attachement_type.MediaAttachment%3Aviewstate_id.2780089216474489414%3Apos.5%3Aactrs.100023707813487%3Aftmd_400706.111111l&__tn__=%2AW-R';
include 'atur.php';
$useragent = 'curl/7.73.0';
$header = array(
	'Host: m.facebook.com',
	'User-Agent: '.$useragent,
	'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
	'Accept-Language: en-US,en;q=0.5',
	'DNT: 1',
	'Connection: keep-alive',
	'Cookie: '.$cookie,
	'Upgrade-Insecure-Requests: 1',
	'Sec-Fetch-Dest: document',
	'Sec-Fetch-Mode: navigate',
	'Sec-Fetch-Site: cross-site',
	'TE: trailers'
);

$get = curl($url, $header, 0, $useragent, $cookie)[1];

$fb_dtsg = preg_match_all('/name="fb_dtsg" value="(.*?)"/', $get, $fb_dtsg) ? $fb_dtsg[1][0] : null;
$myfile = fopen("dtsg.txt", "w") or die("Unable to open file!");
$txt = "".print_r($fb_dtsg,1)."";
fwrite($myfile, $txt);
fclose($myfile);
print '<pre>'.print_r($fb_dtsg,1).'</pre>'; flush(); die();






function curl($url, $header = null, $postfields = null, $useragent = null, $cookie = null, $proxy = null) {
    $c = curl_init();
    if($proxy) curl_setopt($c, CURLOPT_PROXY, $proxy);
    curl_setopt($c, CURLOPT_URL, $url); 
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    if($header) curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    if($postfields) curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($c, CURLOPT_HEADER, 1);
    if($cookie) curl_setopt($c, CURLOPT_COOKIE, $cookie);
    if($useragent) curl_setopt($c, CURLOPT_USERAGENT, $useragent);
    $response = curl_exec($c);
    $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    $body = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    curl_close($c);
    return array($header, $body);
}
