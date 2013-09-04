<?php 
global $w2p_theme_admin;
?>
<div class="w2p-admin">
<div id="container">
	<div class="menu">
		<ul>
		<?php 
			$admin = Wordwebpress::getInstance()->admin();
			foreach ( $admin->getAllModules() as $module )
			{
				$module instanceof Wordwebpress_Admin_Module;
		?>
			<li class="button" alt="<?php echo md5($module->getName())?>"><?php echo $module->getName() ;?></li>
		<?php 
			}
		?>
		</ul>
	</div><!-- Final .menu -->
	
	<div class="content">
		
		<?php 
			$key = 0;
			$admin = Wordwebpress::getInstance()->admin();
			foreach ( $admin->getAllModules() as $module )
			{
				$module instanceof Wordwebpress_Admin_Module;
		?>
		<div class="form" id="<?php echo md5($module->getName())?>" style="<?php echo ( $key == 0 ? 'display: block' : '' )?>;">
			<form action="" >
				<div class="gravar"><button class="button" type="button">gravar dados</button></div>
				<input type="hidden" name="w2p_theme_gravar" value="<?php echo md5($module->getName())?>" />
				<?php 
					foreach ( $module->getItens() as $item )
					{
						$item instanceof Wordwebpress_Admin_Module_Item;
				?>
					<p>
						<label><?php echo $item->getLabel() ?></label>
						<?php 
							if ( $item->getType() == 'radio' )
							{
						?>
							<input id="<?php echo $item->getName()?>" name="<?php echo $item->getName()?>" type="hidden" value="<?php echo Wordwebpress::getInstance()->configuration()->get_cfn_value( $item->getName() ) ?>" /><div class="buttomRadio" name="<?php echo $item->getName()?>"></div>
						<?php 
							}elseif ( $item->getType() == 'text' ){
						?>
							<input class="" id="<?php echo $item->getName()?>" name="<?php echo $item->getName()?>" type="text" value="<?php echo Wordwebpress::getInstance()->configuration()->get_cfn_value( $item->getName() ) ?>" />
						<?php 
							}elseif ( $item->getType() == 'textarea' ){
						?>
							<textarea name="<?php echo $item->getName()?>" id="<?php echo $item->getName()?>"><?php echo Wordwebpress::getInstance()->configuration()->get_cfn_value( $item->getName() ) ?></textarea>
						<?php 
							}elseif ( $item->getType() == 'image' ){
						?>
							<p><input type="text" name="<?php echo $item->getName()?>" id="<?php echo $item->getName()?>" value="<?php echo Wordwebpress::getInstance()->configuration()->get_cfn_value( $item->getName() ) ?>" size="30" style="width:50%" />
							&nbsp;&nbsp;&nbsp;
							<input type="button" class="button upload-img-w2p" name="<?php echo md5($item->getName()) ?>" id="<?php echo md5($item->getName()) ?>" refid="<?php echo $item->getName()?>" value="<?php echo __('Browser image')?>" /></p>
						<?php 
							}
						?>
					</p>						
					<hr />
				<?php 
				
					}
				?>
				<div class="gravar"><button class="button" type="button">gravar dados</button></div>
			</form>
		</div>
		<?php 
			$key++;
			}
		?>
		
		<div class="form" id="my_menu">
			<form>
				<div class="gravar"><button class="button" type="button">gravar dados</button></div>
				<input type="hidden" name="lelo_theme_gravar" value="menu" />
				<h4>Menu</h4>
				<p><label for="menu_a_empresa">Link da página A Empresa:</label><input class="" id="menu_a_empresa" name="menu_a_empresa" type="text" value="<?=$LeloTheme['menu_a_empresa']?>" /></p>
				<p><label for="menu_parceiros">Link da página de parceiros:</label><input class="" id="menu_parceiros" name="menu_parceiros" type="text" value="<?=$LeloTheme['menu_parceiros']?>" /></p>
				<p><label for="menu_contato">Link da página de Contato:</label><input class="" id="menu_contato" name="menu_contato" type="text" value="<?=$LeloTheme['menu_contato']?>" /></p>
				<hr />
				<div class="gravar"><button class="button" type="button">gravar dados</button></div>
			</form>
		</div>
		
		<div class="form" id="redes-sociais">
			<form>
				<div class="gravar"><button class="button" type="button">gravar dados</button></div>
				<input type="hidden" name="lelo_theme_gravar" value="redes-sociais" />
				<h4>Configurações das Redes Sociais</h4>
				<p><label for="twitter_username">Username do twitter:</label><input class="" id="twitter_username" name="twitter_username" type="text" value="<?=$LeloTheme['twitter_username']?>" /></p>
				<p><label for="flickr">Username do Flickr:</label><input class="" id="flickr" name="flickr" type="text" value="<?=$LeloTheme['flickr']?>" /></p>
				<p><label for="facebook">Link para a página do Facebook:</label><input class="" id="facebook" name="facebook" type="text" value="<?=$LeloTheme['facebook']?>" /></p>
				<p><label for="youtube">Link para o canal do Youtube:</label><input class="" id="youtube" name="youtube" type="text" value="<?=$LeloTheme['youtube']?>" /></p>
				<hr />
				<div class="gravar"><button class="button" type="button">gravar dados</button></div>
			</form>
		</div>
		
	</div><!-- Final .content -->
	
	<div class="clear"></div><!-- Final .clear -->
</div><!-- Final #container -->
</div><!-- Final .w2p-admin -->