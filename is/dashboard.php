<?php
/**
 * Customização Dashboard
 *
 *
 * @package		is
 * @author		Alan Nicolas Souza - alan@interative.cc
 * @since		Version 1.0
 */

// Facebook
function facebookis_dashboard_widget() {
	echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Finterativestudio&amp;width=400&amp;height=558&amp;show_faces=true&amp;colorscheme=light&amp;stream=true&amp;border_color&amp;header=false&amp;appId=394776670589458" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:558px;" allowTransparency="true"></iframe>';
}

function facebookis_add_dashboard_widget() {
	wp_add_dashboard_widget( 'facebookis-custom-widget', 'Curta nossa página no Facebook', 'facebookis_dashboard_widget' );
}

add_action( 'wp_dashboard_setup', 'facebookis_add_dashboard_widget' );

// Bem Vindo
function bemvindo_dashboard_widget() {
	
	echo '<p><a href="">Acessar Webmail</a></p>';
	
	if( isset( $is['mensalidade'] ) && $is['mensalidade'] = true ) { echo '<p><a href="http://interative.cc/boletos/'.date( 'm' ).'_'.WORDWEBPRESS_APP_NAME.'">Download da Mensalidade ( boleto )</a></p>'; }
}

function bemvindo_add_dashboard_widget() {
	wp_add_dashboard_widget( 'bemvindo-custom-widget', 'Bem Vindo ao Painel Administrativo da ' . WORDWEBPRESS_APP_NAME, 'bemvindo_dashboard_widget' );
}

add_action( 'wp_dashboard_setup', 'bemvindo_add_dashboard_widget' );


// Suporte
function suporte_dashboard_widget() {
	echo '<p> O suporte é prestado por telefone ( 51 3463.3505), email ( <a href="mailto:suporte@interative.cc">suporte@interative.cc</a> ) ou chat ( skype ) das 10:00 às 17hs de segunda à sexta. </p><p> Solicitamos que só entre em contato após tentar tirar as dúvidas pelos manual e tutoriais <a href="'.get_bloginfo( 'url' ).'/wp-admin/themes.php?page=user_guide">neste link</a>. </p>';
}

function suporte_add_dashboard_widget() {
	wp_add_dashboard_widget( 'suporte-custom-widget', 'Suporte', 'suporte_dashboard_widget' );
}

add_action( 'wp_dashboard_setup', 'suporte_add_dashboard_widget' );

// Adiciona Assinatura no Footer
function wpmidia_change_footer_admin () {
	echo 'Orgulhosamente Desenvolvido com Wordpress pela <strong><a href="http://interative.cc">Agência Digital Interative Studio</a></strong>';
}

add_filter('admin_footer_text', 'wpmidia_change_footer_admin');

// Remove Widgets Dashboard
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

// Remover Aviso de Atualização
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
//

// Remove o Opções de Tela
function remove_screen_options(){ return false; }
// add_filter('screen_options_show_screen', 'remove_screen_options');


