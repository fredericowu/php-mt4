<?php

foreach (  openssl_get_cipher_methods() as $k ) {
  echo "$k\n";
}


?>
