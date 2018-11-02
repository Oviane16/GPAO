<?php

class connection_base
{

    public function __construct()
    {
    $this->connection = pg_conne("host=localhost dbname=postgres user=postgres password=admin");
    //$this->connection = pg_connect("host=localhost dbname=postgres user=postgres password=postgres");
    }
    public function getResult($query)
    {
      return pg_query($query);
    }
}
http://www.codingcage.com/2014/12/simple-php-crud-operations-with-mysql.html
