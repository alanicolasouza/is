<?php
/*
Plugin Name: WP Simple Pagseguro Shopping cart
Version: v1.0
Author: Elcio Ferreira - Melhora-lo: Alan Nicolas Souza
*/
session_start();


function ps_shopping_cart_show($content)
{
	if (strpos($content, "<!--show-wp-shopping-cart-->") !== FALSE)
    {
    	if (ps_cart_not_empty())
    	{
        	$content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        	$matchingText = '<!--show-wp-shopping-cart-->';
        	$replacementText = ps_print_wp_shopping_cart();
        	$content = str_replace($matchingText, $replacementText, $content);
    	}
    }
    return $content;
}

if ( $_POST['addcart'] )
{
    $count = 1;
    $products = $_SESSION['pssimpleCart'];

    
    if ( is_array($products) )
    {
        foreach ($products as $key => $item)
        {
            if ($item['name'] == $_POST['product'])
            {
                $count += $item['quantity'];
                $item['quantity'] = $item['quantity'] + $_POST['addcart'];
                unset($products[$key]);
                array_push($products, $item);
            }
        }
    }
    else
    {
        $products = array();
    }

    if ($count == 1)
    {
        if (!empty($_POST[$_POST['product']]))
            $price = $_POST[$_POST['product']];
        else
            $price = $_POST['price'];

        $product = array(
        			'name' => stripslashes($_POST['product']), 
        			'price' => $price, 
        			'quantity' => $_POST['addcart'], 
        			'cartLink' => $_POST['cartLink'], 
        			'item_number' => $_POST['item_number'], 
        			'id' => $_POST['id'],
        			'weight' => $_POST['weight']
        		);
        
        array_push($products, $product);
    }

    sort($products);
    $_SESSION['pssimpleCart'] = $products;    
    
    exit();
    
} else if ($_POST['cquantity']) {
	
    $products = $_SESSION['pssimpleCart'];
    foreach ($products as $key => $item)
    {
        if (($item['name'] == $_POST['product']) && $_POST['quantity'])
        {
            $item['quantity'] = $_POST['quantity'];
            unset($products[$key]);
            array_push($products, $item);
        }
        else if (($item['name'] == $_POST['product']) && !$_POST['quantity'])
            unset($products[$key]);
    }
    sort($products);
    $_SESSION['pssimpleCart'] = $products;
}
else if ($_POST['delcart'])
{
    $products = $_SESSION['pssimpleCart'];
    foreach ($products as $key => $item)
    {
        if ($item['name'] == $_POST['product'])
            unset($products[$key]);
    }
    $_SESSION['pssimpleCart'] = $products;
}

/**
 * Cria Resumo do Carrinho com Total de Itens e Valor
 * @version 1.0
 *  
 * @return Object $resume
 * @author Alan Nicolas Souza - interative.cc
 */
function ps_wp_cart_button()
{

	$resume['total'] = '0';
	$resume['items'] = '0';
	
	if( !empty( $_SESSION['pssimpleCart'] ) ){ 
		
		foreach ($_SESSION['pssimpleCart'] as $item)
		{			
			$resume['total']  += str_replace(',', '.', $item['price']) * $item['quantity'];
	
			$resume['items'] +=  $item['quantity'];
		}
	}
	
	$resume['total']  =	money( $resume['total'] );
		
	return (object) $resume;
}


/**
 * Imprime o carrinho com detalhes e form para submissão para o Pague Seguro
 *
 * @author Infelizmente um FDP que nao sabe comentar e escrever código
 * @version 1.0
 *  
 * @return Object $resume
 */

function ps_print_wp_shopping_cart()
{
	// Se carinho está vazio mostra mensagem.
	if (!ps_cart_not_empty())
		return '<h2 class="empty_cart">Seu carrinho está vazio!</h2>';

    $email = get_bloginfo('admin_email');

    $defaultEmail = get_option('cart_pagseguro_email');
    $pagseguro_symbol = 'R$';

    if (!empty($defaultEmail))
        $email = $defaultEmail;

    $decimal = '.';
	$urls = '';

	$title = get_option('wp_cart_title');
	if (empty($title)) $title = 'Suas compras';

    $output .= '<div class="shopping_cart">';

	$output .= '<table style="width: 100%;">';

    $count = 1;
    $total_items = 0;
    $total = 0;
    $form = '';
    if ($_SESSION['pssimpleCart'] && is_array($_SESSION['pssimpleCart']))
    {
        $output .= '
        <tr>
            <th><h2 class="h-main-small">Produto</h2></th>
            <th style="border-right: 1px solid #CCCCCC;"><h2 class="h-main-small">&nbsp</h2></th>
            <th style="border-right: 1px solid #CCCCCC;"><h2 class="h-main-small">Qtd.</h2></th>
            <th><h2 class="h-main-small">Valor</h2></th>
        </tr>';

	    foreach ($_SESSION['pssimpleCart'] as $item)
	    {
	        $total += $item['price'] * $item['quantity'];
	
	        $total_items +=  $item['quantity'];
	    }

	    foreach ($_SESSION['pssimpleCart'] as $item)
	    {    	
	        $output .= "
	        <tr>
	            <td class='padding10' style='overflow: hidden; border-bottom: 1px solid #CCCCCC;'>
	               ".  get_image( $item['id'], array( 180, 180 ) ) ."
	            </td>
	            <td class='padding10' style='overflow: hidden; border-right: 1px solid #CCCCCC;  border-bottom: 1px solid #CCCCCC;'>
	                <a href='".$item['cartLink']."'>".$item['name']."</a>
	            </td>
	            <td class='padding10' style='text-align: center; border-right: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>
	                <form method=\"post\"  action=\"\" name='pcquantity' style='display: inline'>
	                    <input type='hidden' name='product' value='".$item['name']."' />
	                    <input type='hidden' name='cquantity' value='1' />
	                    <input type='number' name='quantity' value='".$item['quantity']."' size='1' onchange='document.pcquantity.submit();' onkeypress='document.getElementById(\"pinfo\").style.display = \"\";' />
	                </form>
	                <form method=\"post\"  action=\"\">
	                    <input type='hidden' name='product' value='".$item['name']."' />
	                    <input type='hidden' name='delcart' value='1' />
	                    <input type='image' src='http://livrariaplenitude.com.br/wp-content/plugins/wordpress-pagseguro-shopping-cartzip/images/remove-button.png' value='x' title='Remover' />
	                </form>
	            </td>
	
	            <td class='padding10' style='text-align: center;  border-bottom: 1px solid #CCCCCC;'>".ps_print_payment_currency(($item['price'] * $item['quantity']), $pagseguro_symbol, $decimal)."</td>
	
	            
	        </tr>
	
	        ";
	
	        $form .= "
	            <input type=\"hidden\" name=\"item_descr_$count\" value=\"".$item['name']."\" />
	            <input type=\"hidden\" name=\"item_valor_$count\" value='".str_replace('.','',$item['price'])."' />
	            <input type=\"hidden\" name=\"item_quant_$count\" value=\"".$item['quantity']."\" />
	            <input type='hidden' name='item_id_$count' value='".$count."' />
	        ";
	        $form .= "<input type=\"hidden\" name=\"item_frete_$count\" value=\"0\" />";
	        $count++;
	    }
    }

       	$count--;

       	if ($count)
       	{
       		$output .= '<tr><td></td><td></td><td></td></tr>';
       		$output .= "
       		<tr>
                <td class='txt-blue h-main-small padding10' colspan='3' style=' font-weight: bold; text-indent: 10px; font-size: 16px!important; border-bottom: none !important'>Total: </td>
                <td class='txt-blue padding10' style=' text-align: center'>".ps_print_payment_currency(($total), $pagseguro_symbol, $decimal)."</td>
            </tr>
       		<tr>
                <td style=' position: relative;' colspan='4'>";


              	$output .= "<form action=\"https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx\" method=\"post\">$form";
    			if ($count)
            		$output .= '<input type="submit" name="submit" value="Concluir Compra" class="btn button btn-submit" />';

    			$output .= $urls.'
			    <input type="hidden" name="email_cobranca" value="'.$email.'" />
                  <input type="hidden" name="tipo" value="CP">
                  <input type="hidden" name="moeda" value="BRL">
			    </form>';
       	}
       	$output .= "

       	</td></tr>
    	</table></div>
    	";

    return $output;
}

function ps_print_wp_cart_button($content)
{
        $addcart = get_option('addToCartButtonName');
        if (!$addcart || ($addcart == '') )
            $addcart = 'Adicionar ao Carrinho';

        $pattern = '#\[wp_cart:.+:price:#';
        preg_match_all ($pattern, $content, $matches);

        foreach ($matches[0] as $match)
        {
            $pattern = '[wp_cart:';
            $m = str_replace ($pattern, '', $match);
            $pattern = ':price:';
            $m = str_replace ($pattern, '', $m);

            $pieces = explode('|',$m);

            if (sizeof($pieces) == 1)
            {
                $replacement = '<object><form method="post"  action=""  style="display:inline">
                <input type="submit" value="'.$addcart.'" />
                <input type="hidden" name="product" value="'.$pieces['0'].
                '" /><input type="hidden" name="price" value="';

                $content = str_replace ($match, $replacement, $content);
            }
        }

        $forms = str_replace(':item_num:',
        '" /><input type="hidden" name="shipping" value="',
        $content);

        $forms = str_replace(':end]',
        '" /><input type="hidden" name="addcart" value="1" /><input type="hidden" name="cartLink" value="'.ps_cart_current_page_url().'" />
        </form></object>',
        $forms);

    if (empty($forms))
        $forms = $content;

    return $forms;
}

function ps_cart_not_empty()
{
        $count = 0;
        if (isset($_SESSION['pssimpleCart']) && is_array($_SESSION['pssimpleCart']))
        {
            foreach ($_SESSION['pssimpleCart'] as $item)
                $count++;
            return $count;
        }
        else
            return 0;
}

function ps_print_payment_currency($price, $symbol, $decimal)
{
    return $symbol.number_format($price, 2, $decimal, ',');
}

function ps_cart_current_page_url() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function ps_show_ps_wp_cart_options_page () {

	$wp_simple_pagseguro_shopping_cart_version = 1.2;

    $defaultEmail = get_option('cart_pagseguro_email');
    if (empty($defaultEmail)) $defaultEmail = get_bloginfo('admin_email');

    $addcart = get_option('addToCartButtonName');
    if (empty($addcart)) $addcart = 'Adicionar ao Carrinho';

	$title = get_option('wp_cart_title');
	if (empty($title)) $title = 'Suas compras';

	?>
 	<h2>Opções do Carrinho Simples Pagseguro v <?php echo $wp_simple_pagseguro_shopping_cart_version; ?></h2>

 	<p>Para informações e atualizações, por favor, visite::<br />
    <a href="http://visie.com.br/pagseguro/">http://visie.com.br/pagseguro/</a></p>

     <fieldset class="options">
    <legend>Como usar:</legend>

    <p>1. Para adicionar um botão 'Adicionar ao Carrinho' simplesmente insira o texto <strong>[wp_cart:NOME-DO-PRODUTO:price:VALOR-DO-PRODUTO:end]</strong> ao artigo ou página, próximo ao produto. Substitua NOME-DO-PRODUTO e VALOR-DO-PRODUTO pelo nome e valor reais, assim: [wp_cart:Enxugador de gelo:price:129.50:end].</p>
	<p>2. Para adicionar o carrinho de compras a um artigo ou página de checkout ou à sidebar simplesmente adicione o texto <strong>&lt;!--show-wp-shopping-cart--&gt;</strong> a um post, página ou sidebar. O carrinho só será visível quando o comprador adicionar pelo menos um produto. 
    </fieldset>

 	<?php

    echo '
 <form method="post" action="options.php">';
 wp_nonce_field('update-options');
 echo '
<table class="form-table">
<tr valign="top">
<th scope="row">E-mail de cobrança Pagseguro</th>
<td><input type="text" name="cart_pagseguro_email" value="'.$defaultEmail.'" /></td>
</tr>
<tr valign="top">
<th scope="row">Título do carrinho de compras</th>
<td><input type="text" name="wp_cart_title" value="'.$title.'"  /></td>
</tr>

<tr valign="top">
<th scope="row">Texto do botão de adicionar ao carrinho</th>
<td><input type="text" name="addToCartButtonName" value="'.$addcart.'" /></td>
</tr>

</table>

<p class="submit">
<input type="submit" name="Submit" value="Salvar Opções &raquo;" />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="cart_payment_currency,cart_currency_symbol,cart_pagseguro_email,addToCartButtonName,wp_cart_title" />
</p>

 </form>
 ';
}

function ps_wp_cart_options()
{
     echo '<div class="wrap"><h2>Opções do Carrinho Pagseguro</h2>';
     ps_show_ps_wp_cart_options_page();
     echo '</div>';
}

// Display The Options Page
function ps_wp_cart_options_page () 
{
     add_options_page('Carrinho Pagseguro', 'Carrinho Pagseguro', 'manage_options', __FILE__, 'ps_wp_cart_options');  
}

function show_wp_pagseguro_shopping_cart_widget()
{
    echo ps_print_wp_shopping_cart();
}

function wp_pagseguro_shopping_cart_widget_control()
{
    ?>
    <p>
    <? _e("Configure as opções do plugin no menu de opções."); ?>
    </p>
    <?php
}

function widget_wp_pagseguro_shopping_cart_init()
{
    $widget_options = array('classname' => 'widget_wp_pagseguro_shopping_cart', 'description' => __( "Mostra o carrinho de compras Pagseguro.") );
    wp_register_sidebar_widget('wp_pagseguro_shopping_cart_widgets', __('Carrinho Pagseguro'), 'show_wp_pagseguro_shopping_cart_widget', $widget_options);
    wp_register_widget_control('wp_pagseguro_shopping_cart_widgets', __('Carrinho Pagseguro'), 'wp_pagseguro_shopping_cart_widget_control' );
}

// Insert the options page to the admin menu
add_action('admin_menu','ps_wp_cart_options_page');

add_action('init', 'widget_wp_pagseguro_shopping_cart_init');

add_filter('the_content', 'ps_print_wp_cart_button');

add_filter('the_content', 'ps_shopping_cart_show');

/**
 * Trata a valor de float para Real 0,00
 *
 * @version 1.0
 *
 * @author: Alan Nicolas Souza
 *
 * @param Float $preco_format
 *  
 * @return String
 */
function money( $preco_format )
{
	return 'R$ ' . number_format($preco_format, 2, ',', '.');
}

/**
 * Trata a imagem retornando-a redimencionada e recortada
 *
 * $size = width, height
 *
 * $crop =
 *
 * c : position in the center (this is the default)
 * t : align top
 * tr : align top right
 * tl : align top left
 * b : align bottom
 * br : align bottom right
 * bl : align bottom left
 * l : align left
 * r : align right
 *
 * @author: Alan Nicolas Souza
 *
 * @version 1.0
 *
 * @param Integer $id
 * @param Array  $size
 * @param String  $crop
 *  
 * @return Object
 */
function get_image( $id, $size = array(), $crop = 't' )
{
	$src = wp_get_attachment_url( get_post_thumbnail_id( $id) );
	return  '<img src="'. get_bloginfo('template_directory') .'/is/images/resize.php?src='.$src.'&w='.$size[0].'&h='.$size[1].'&q=75&a='.$crop.'" />';
}