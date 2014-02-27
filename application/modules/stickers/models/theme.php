<?php
class Theme extends ORM {

    var $table = 'themes';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>