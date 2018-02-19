<?php

include_once 'connect.php';
//include 'db_recs.php';
include 'handig.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function insert_record($table, $p_key, $p_record) {
    global $db;

    $onzin = 0;
    $p_record->id = NULL;
    $sql = 'INSERT INTO ' . $table . ' (';

    foreach ($p_record as $k => $v) {
        $v != NULL ? $sql .= $k . " , " : "";
    }
    $sql = substr($sql, 0, strlen($sql) - 2) . ") VALUES ( ";
    foreach ($p_record as $k => $v) {
        $v != NULL ? $sql .= ":" . $k . " , " : "";
    }
    $sql = substr($sql, 0, strlen($sql) - 2) . ")";
//    echo $sql. brk();
    $stmt = $db->prepare($sql);
    foreach ($p_record as $k => $v) {
        $v != NULL ? $stmt->bindParam(":" . "$k", $p_record->$k) : $onzin += 1;
    }

    $stmt->execute();
    $r_record = get_record($table, 0, $p_key, $p_record->$p_key, 2, $p_record);
//    print_r($r_record);
    return $r_record->id;
}


function update_record($table, $p_record) {
    global $db;
    $sql = "update $table set ";
    foreach ($p_record as $k => $v) {
        if ($k != 'id') {
            $sql .= $k . " = :" . $k . ", ";
        }
    }
    $sql = substr($sql, 0, strlen($sql) - 2);
    $sql .= " WHERE id = :id;";
    $stmt = $db->prepare($sql);
    foreach ($p_record as $k => $v) {
        $stmt->bindParam(":" . "$k", $p_record->$k);
    }
    try {
        $ret = $stmt->execute();
    } catch (Exception $ex) {
        alert("Fout " . $ret . " ex " . $ex->getMessage());
        return 0;
    }
    return 1;
}


function get_record($table, $p_id, $p_key, $p_value, $next, $p_record) {
    global $db;

    $r_record = $p_record;
    $value_up = strtoupper($p_value); //."% limit 1";
    //   $p_id != 0 ? $sql_end = " id = :id" : $sql_end = " $p_key  like \"".$value_up."%\" limit 1";
    switch ($next) {
        case -1:
            $p_id != 0 ? $sql_end = " id < :id order by id desc" : $sql_end = " STRCMP($p_key, :$p_key)<0 ORDER BY $p_key DESC limit 1";
            break;
        case 0:
            $value_up .= '%';
            $p_id != 0 ? $sql_end = " id = :id" : $sql_end = " $p_key  like :$p_key limit 1";

            break;
        case 1:

            $p_id != 0 ? $sql_end = " id > :id order by id " : $sql_end = " STRCMP($p_key, :$p_key)=1 ORDER BY $p_key limit 1";

            break;
        case 2:
            $value_up=$p_value;
            $p_id != 0 ? $sql_end = " id = :id" : $sql_end = " $p_key  like :$p_key limit 1";

            break;

        default: alert("$next is geen geldige waarde voor next");
            break;
    }


    $sql = 'Select * from ' . $table . ' where ' . $sql_end;
//echo $sql. brk();
    $stmt = $db->prepare($sql);
    $p_id != 0 ? $stmt->bindParam(':id', $p_id) : $stmt->bindParam(":$p_key", $value_up, PDO::PARAM_STR);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
        foreach ($r_record as $k => $v) {
            $r_record->$k = $row->$k;
        }
    }
    return $r_record;
}


