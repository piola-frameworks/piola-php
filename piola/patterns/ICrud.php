<?php

namespace piola\patterns
{
    interface ICrud
    {
        public function index(); // select
        public function create(); // insert
        public function read($id); // select one
        public function update($id); // update
        public function delete($id); // delete
    }
}

?>