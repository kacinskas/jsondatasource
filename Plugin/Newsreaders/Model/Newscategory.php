<?php

class Newscategory extends NewsreadersAppModel {

    var $useTable = 'newscategory';
    var $name = 'Newscategory';
    var $primaryKey = '_id';
    var $useDbConfig = 'json';
//    var $order = array("Newscategory.name" => "asc");
    var $order = 'name asc';

}
