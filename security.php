<?php

define ('HMAC_SHA256', 'sha256');
define ('SECRET_KEY', 'da70cce2bafd469f936705f1ab90c17ac0baa646d7824df58a2bcf935ca0d9110e81a34159be49d2985b57c93accbf09fd29002455214ee89edac9158adabe3e6b5e395e94ad41f2a28bdbe32a7ccc4bac6e6dcdfb2a4631ab26b9b5c6fb027f8cff083c61cb44b0b4ab626e555321f8ab4e64a750ed44a29533b89b8dba9512');

function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
