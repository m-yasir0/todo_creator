<?php
$hash= password_hash("12345", PASSWORD_DEFAULT);
echo $hash;
?>
</br>
<?php
if(password_verify("1245", $hash)){
    echo 'true';
}else{
    echo 'false';
}
?>