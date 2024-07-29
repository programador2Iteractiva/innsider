<?php
/**
 * The template for displaying category pages.
 *
 * @package connexo_in
 */

get_header();

$category = get_queried_object();
$current_category = get_query_var('cat');
?>


<?php get_footer(); ?>