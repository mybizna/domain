<?php

/** @var \Modules\Base\Classes\Fetch\Rights $this */

$this->add_right("domain", "domain", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("domain", "domain", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("domain", "domain", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("domain", "domain", "staff", view:true, add:true, edit:true);
$this->add_right("domain", "domain", "registered", view:true, add:true);
$this->add_right("domain", "domain", "guest", view:true, );
