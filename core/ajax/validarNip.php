<?php

$nip = sha1(trim($_POST['nip']));

$res = array(
   'msg' => 'NIP INCORRECTO',
   'error' => true
);

if ($nip === '1fb458cbc12eed14502240d0404c942d1281b42e') {
   $res = array(
   'msg' => 'NIP CORRECTO',
   'error' => false
   );
}

header('Content-type:aplication/json');
echo json_encode($res);

?>