<?php
$pass_hash = password_hash("password123", CRYPT_BLOWFISH);
echo $pass_hash;
