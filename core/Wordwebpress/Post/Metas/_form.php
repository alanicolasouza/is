<?php
global $post;

$dados =  get_post_meta($post->ID, WORDWEBPRESS_APP_NAME . '_metas_' . $this->name);
$dados = unserialize( base64_decode( $dados[0] ) );

// Use for stylesheet
echo '<div class="w2p-metas">';

// Use nonce for verification
echo '<input type="hidden" name="custom-post" id="custom-post" value="'.md5($this->name).'" />';

foreach ( $this->_itens as $item )
{
	$value = '';
	if( !empty( $dados[ $item['name'] ] ) )
	{
		$value = $dados[ $item['name'] ];
	}elseif ( !empty( $item['defaultValue'] ) ) {
		$value = $item['defaultValue'];
	}
?>
	<p>
		<label for="<?php echo $item['name']?>"><?php echo $item['label'] ?></label><br />
		<?php 
			if ( $item['type'] == 'radio' )
			{
		?>
			<input id="<?php echo $item['name']?>" name="<?php echo $item['name']?>" type="hidden" value="<?php echo $value ?>" /><div class="buttomRadio" name="<?php echo $item['name']?>"></div>
		<?php 
			}elseif ( $item['type'] == 'text' ){
		?>
			<input class="" id="<?php echo $item['name']?>" name="<?php echo $item['name']?>" type="text" value="<?php echo $value ?>" />
		<?php 
			}elseif ( $item['type'] == 'textarea' ){
		?>
			<textarea name="<?php echo $item['name']?>" id="<?php echo $item['name']?>"><?php echo $value ?></textarea>
		    
		 <?php    }elseif ( $item['type'] == 'editor' ){ ?>
		 
			<div class="customEditor"><textarea name="<?php echo $item['name']?>" id="<?php echo $item['name']?>"><?php echo $value ?></textarea></div>
			<script type="text/javascript">/* <![CDATA[ */
		        jQuery(function($)
		        {
		            var i=1;
		            $('.customEditor textarea').each(function(e)
		            {
		                var id = $(this).attr('id');
		 
		                if (!id)
		                {
		                    id = 'customEditor-' + i++;
		                    $(this).attr('id',id);
		                }
		 
		                tinyMCE.execCommand('mceAddControl', false, id);
		                 
		            });
		        });
		    /* ]]> */</script>
		<?php 
			} elseif ( $item['type'] == 'image' ){
		?>
			<input type="text" name="<?php echo $item['name']?>" id="<?php echo $item['name']?>" value="<?php echo $value ?>" />
			&nbsp;&nbsp;&nbsp;
			<input type="button" class="button upload-img-w2p" name="<?php echo $post->ID ?>" id="<?php echo md5($item['name']) ?>" refid="<?php echo $item['name']?>" value="<?php echo __('Browser image')?>" />
		<?php 
			} elseif( $item['type'] == 'select' ) {

		?>
			<select id="<?php echo $item['name']?>" name="<?php echo $item['name']?>">
			
			<?php				
				foreach ($item['params'] as $_value => $option) {
					
					if( $value == $_value )
					{
			?>
					<option value="<?php echo $_value ?>" selected="selected"><?php echo $option ?></option>
					
				<?php } else { ?>
                  
                  	<option value="<?php echo $_value ?>" ><?php echo $option ?></option>
            
            <?php
					 } 
				} ?>
            
            </select>
		<?php
			}
		?>
	</p>
<?php
}

// Close for used stylesheet
echo '</div>';

?>