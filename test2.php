



<?php
function has_ssl( $domain ) {
    $ssl_check = @fsockopen( 'ssl://' . $domain, 443, $errno, $errstr, 30 );
    $res = !! $ssl_check;
    if ( $ssl_check ) { fclose( $ssl_check ); }
    return $res;
}

// Test it:
print_r( has_ssl('github.com') );
?>