<?php

namespace MikeMcLin\Acl\Storage;

interface StorableContract
{
    /**
     * Retrieve data array from storage.
     *
     * Returns `null` if data doesn't exist.
     *
     * @return array|null
     */
    public function fetch();

    /**
     * Persist data array to storage.
     *
     * @param array $dataArray
     */
    public function persist($dataArray);
}
