<?php
$o = $_GET['o'];
if ($o === "a" || $o === "A"){
    $v = [
        ['code' => '111', 'curso' => 'AF11'],
        ['code' => '112', 'curso' => 'AF12'],
        ['code' => '121', 'curso' => 'AF21'],
		['code' => '122', 'curso' => 'AF22'],
		['code' => '131', 'curso' => 'AF31'],
		['code' => '132', 'curso' => 'AF32']
    ];
}
elseif ($o === "d" || $o === "D"){
    $v = [
        ['code' => '211', 'curso' => 'DS11'],
        ['code' => '212', 'curso' => 'DS12'],
        ['code' => '221', 'curso' => 'DS21'],
		['code' => '222', 'curso' => 'DS22'],
		['code' => '231', 'curso' => 'DS31'],
		['code' => '232', 'curso' => 'DS32']
    ];
}
elseif ($o === "i" || $o === "I"){
    $v = [
        ['code' => '311', 'curso' => 'ITI11'],
        ['code' => '312', 'curso' => 'ITI12'],
        ['code' => '321', 'curso' => 'ITI21'],
		['code' => '322', 'curso' => 'ITI22'],
		['code' => '331', 'curso' => 'ITI31'],
		['code' => '332', 'curso' => 'ITI32']
    ];
}
else{
    $v = [
        ['code' => 'e', 'curso' => 'ERROR: NO ENCONTRADO'],
    ];
}
header('Content-Type: application/json');
echo json_encode($v);