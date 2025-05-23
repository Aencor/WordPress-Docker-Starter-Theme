<?php
/**
 * Block Name: Hero
 * Slug: hero
 * Description: Display Hero Section.
 * Keywords: Hero
 * Align: full
 */

  $block_name = 'hero-block';
  $blockID = $block_name . '-' . $block['id'];
  if (!empty(get_field('block_id'))) {
    $blockID = get_field('block_id');
  }
  $className   = array( $block_name );
  $editBG = get_field('edit_background_options');
  $editPadding = get_field('edit_padding_options');
  if($editBG){
    $bgColor = get_field('background_color');
    array_push($className, $bgColor);
  }

  if($editPadding){
    $topP = get_field('padding_top');
    $bottomP = get_field('padding_bottom');
    array_push($className, 'pt-' . $topP);
    array_push($className, 'pb-' . $bottomP);
  }
?>
 
 <section 
  id="<?= $blockID; ?>" 
  data-block="name-block" 
  class="<?php echo implode( ' ', $className ); ?>"
>
  
 </section>