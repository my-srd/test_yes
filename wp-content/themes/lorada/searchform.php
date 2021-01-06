<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="searchform-wrap">
        <label class="screen-reader-text" for="s"><?php echo esc_html__( 'Search for', 'lorada' ); ?>:</label>
        <input type="text" value="" name="s" id="s" placeholder="<?php echo esc_html__( 'Search...', 'lorada' ); ?>">
        <button type="submit" id="searchsubmit"><i class="lorada lorada-magnifier"></i></button>
    </div>
</form>