<?php


include 'db_act.php';

//alternatief datatype databasetabel persoon
class C_persoon {

    public $id = NULL;
    public $naam = NULL;
    public $email_up = NULL;
    public $email = NULL;
    public $ww = NULL;
    public $postcode = NULL;
    public $huisnummer = NULL;
    public $telefoon = NULL;
    public $rechten = NULL;
    public $trust = NULL;

//    function __construct($p_id, $p_naam){
//        
//    }

    function insert_persoon($email_up, $ww) {
    global $db, $Y_persoon;
    $p_persoon = $Y_persoon;
    $p_persoon["email_up"] = strtoupper($email_up);
    $p_persoon["email"] = $email_up;
    $p_persoon["ww"] = encrypt_A1($email_up, $ww);
    return insert_persoon_all($p_persoon);
}

function update_persoon($p_persoon) {
    $p_persoon["email_up"] = strtoupper($p_persoon["email"]);
    $ret = update_record("persoon", $p_persoon);
    if ($ret == 0)
        alert("fout : $ret");
}

function get_persoon($p_id, $p_email, $p_persoon) {

//    $p_persoon = new C_persoon();
    return get_record("persoon", $p_id, "email_up", $p_email, 2, $p_persoon);
}

function edit_field_persoon($key) {
    return !($key == 'id' || $key == 'ww' || $key == 'trust' ||$key=='rechten'|| (strpos($key, 'mail') != 0));
}

    
}

class C_drank{
    public $id=NULL; 
    public $naam_up=NULL; 
    public $naam=NULL; 
    public $barcode=NULL;
    public $inkoop=NULL; 
    public $verkoop=NULL; 
    public $inhoudcc=NULL; 
    public $btw=NULL; 
    public $alcoholperc;

function get_drank($p_id, $p_naam, $next) {
    global $Y_drank;

    $p_drank = $Y_drank;
    return get_record("drank", $p_id, "naam_up", $p_naam, $next, $p_drank);
}

function update_drank($p_drank) {
    $p_drank['naam_up'] = strtoupper($p_drank['naam']);
    update_record("drank", $p_drank);

    function insert_drank($drank) {
    $drank['naam_up'] = strtoupper($drank['naam']);
    return insert_record('drank', 'naam', $drank);
}

function edit_field_drank($key) {
    return !($key == 'id' || $key == 'naam_up' );
}
}

}
class C_tel {
    private static $keylen=11;

    public $id=NULL;
    public $pers_id=NULL; 
    public $Item=NULL; 
    public $Item_up=NULL; 
    public $teller=NULL; 
    public $maxteller=NULL; 
    public $nu=NULL; 
    public $deadline=NULL; 
    public $omschrijving=NULL; 
    public $optellen=NULL;
//
//    function __construct($p_id, $pers_id, $p_Item){
//      get_teller($p_id, $pers_id, $p_Item, 0, $this); 
//}
function get_key($pers_id, $Item){
return str_pad($pers_id, 11, '0', STR_PAD_LEFT).strtoupper($Item);
    
}


    function update_teller($p_teller) {
    $p_teller["Item_up"] = 
    $ret = update_record("teller", $p_teller);
    if ($ret == 0)
        alert("fout : $ret");
}

function get_teller($p_id, $pers_id, $p_Item, $next, $p_teller) {
//    $p_naam='';    
    $p_id != NULL ? $p_naam=''
                : $p_naam=$p_teller->get_key($pers_id, $p_Item);
    return get_record("todo", $p_id, "Item_up", $p_naam, $next, $p_teller);
}

function insert_teller($tel) {
    $tel->Item_up=$tel->get_key($tel->pers_id, $tel->Item);
        return insert_record('todo', 'Item_up', $tel);
}

function edit_field_teller($key) {
    return !($key == 'id' || $key == 'Item_up' );
}
}


