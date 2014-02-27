<?php
class Sticker extends ORM {

    var $table = 'stickers';

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>