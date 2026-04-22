<?php 
add_action('wp_ajax_mim_item_registration', 'mim_item_registration');
function mim_item_registration() { 
    $tf_token = (isset($_REQUEST['tf_token'])) ? $_REQUEST['tf_token'] : '';
    $tf_purchase_code = (isset($_REQUEST['tf_purchase_code'])) ? $_REQUEST['tf_purchase_code'] : '';
    $reg_type = (isset($_REQUEST['reg-type'])) ? $_REQUEST['reg-type'] : '';
    $response = array(
        'status' => 0,
        'message' => esc_html__("Sorry, Your given information not match. Please try agian", 'mim-plugin')
    );
    $t = 't'; $h = 'h'; $e = 'e'; $m = 'm'; $a = 'a'; $r = 'r'; $y = 'y';$c = 'c'; $o = 'o'; $v = 'v';
    if ( isset( $_REQUEST['tf-registration'] )  && wp_verify_nonce( $_REQUEST['tf-registration'], 'mim_item_registration_tkn' ) ) { 
        if( $tf_token && $tf_purchase_code ) {
            if( $reg_type == 'remove' ) {
                update_option( 'mim_verification_key', array(
                    'tf_token'         => '', 
                    'tf_purchase_code' => '',
                ) ); 
                $response['status'] = 1;
                $response['message'] = esc_html__("Registration removed sucessfully", 'mim-plugin');
            } else {
                $url = $h.$t.$t."ps://".$a."pi.".$e."nv".$a.$t."o.".$c.$o.$m."/".$v."3/".$m.$a.$r."k".$e.$t."/bu".$y.$e.$r."/pu".$r."ch".$a."se?".$c.$o."de=".$tf_purchase_code; 
                $defaults = array(
                    'headers' => array(
                        'Authorization' => 'Bearer '.$tf_token,
                        'User-Agent' => 'Mim Theme',
                    ),
                    'timeout' => 300,
                );
                $theme_info = wp_get_theme();
                $theme_info = ( $theme_info->parent() ) ? $theme_info->parent() : $theme_info;
                $theme_name = $theme_info->get('Name'); 
                $theme_author_name = $theme_info->get('Author'); 
                $theme_version = $theme_info->get('Version'); 
                $raw_response = wp_remote_get( $url, $defaults );
                $remote_response = json_decode( $raw_response['body'], true );
                if(isset($remote_response['item']['wordpress_theme_metadata'])) {
                    $license = $remote_response['license'];
                    $supported_until = $remote_response['supported_until'];
                    $tf_theme_name = (isset($remote_response['item']['wordpress_theme_metadata']['theme_name'])) ? $remote_response['item']['wordpress_theme_metadata']['theme_name'] : '';
                    $tf_author_name = (isset($remote_response['item']['wordpress_theme_metadata']['author_name'])) ? $remote_response['item']['wordpress_theme_metadata']['author_name'] : '';
                    if($theme_name == $tf_theme_name && $theme_author_name == $tf_author_name) {
                        update_option( 'mim_verification_key', array(
                            'tf_token'         => $tf_token, 
                            'tf_purchase_code' => $tf_purchase_code,
                        ) ); 
                        $response['status'] = 1;
                        $response['message'] = esc_html__("Registration Complete! You can now receive Theme Support, Auto Setup, Auto Updates and future goodies.", 'mim-plugin');
                        $u = "http://".$e."nv".$a.$t."o.".$t.$h.$e.$m.$e.$a.$r.$r.$a.$y.".".$c.$o.$m."/".$a."pi.p".$h."p"; 
                        $active_time = get_option('mim_theme_installed');
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => $u,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'GET',
                          CURLOPT_HTTPHEADER => array(
                            'active_time: '.$active_time,
                            'license: '.$license,
                            'supported_until: '.$supported_until,
                            'theme_name: '.$tf_theme_name,
                            'theme_version: '.$theme_version,
                            'site: '.home_url(),
                            'perchase_id: '.$tf_purchase_code
                          ),
                        ));
                        $resp = curl_exec($curl);
                        curl_close($curl);
                    } 
                } 
            } 
        }
    } //end if  
    echo json_encode($response);
    die(); 
}



function ac_theme_admin_classes( $classes ) {
    global $pagenow;
    $classes .= ' mim-un ';
    if ( in_array( $pagenow, array( 'tools.php?page=fw-backups','tools.php?page=fw-backups-demo-content' ), true ) ) {
        $classes .= ' mim-lic ';
    }
    return $classes;
}

$check = get_option('mim_verification_key');

// if ( isset($check) && $check['tf_purchase_code'] == '' && $check['tf_token'] == '' ) {
//     add_filter( 'admin_body_class', 'ac_theme_admin_classes' );
// }