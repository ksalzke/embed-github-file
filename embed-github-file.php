<?php
/**
 * Plugin Name: Embed GitHub File
 * Plugin URI: https://kaitlinsalzke.com
 * Description: Use a shortcude to display the content of a GitHub file in a page or post.
 * Version: 1.0
 * Text Domain: embed-github-file
 * Author: Kaitlin Salzke
 * Author URI: https://kaitlinsalzke.com
*/

function git_embed_shortcode($atts) {
    $response = wp_remote_get('https://api.github.com/repos/' . $atts['file']);
    $body = wp_remote_retrieve_body($response);
    $decoded = json_decode($body);
    $content = $decoded->content; 
    $base64decode = base64_decode($content);
    $addLineBreaks = str_replace(array("\n","\r"), "<br />", $base64decode);
    return '<pre class="wp-block-code"><code>' . $addLineBreaks . '</code></pre>';
};

add_shortcode('githubfile', 'git_embed_shortcode');

?>