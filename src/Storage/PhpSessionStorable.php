<?php

namespace MikeMcLin\Acl\Storage;

class PhpSessionStorable
{
    /**
     * Retrieve data array from storage.
     *
     * Returns `null` if data doesn't exist.
     *
     * @return array|null
     */
    public function fetch()
    {
        return (isset($_SESSION['mikemclin.acl']) && !empty($_SESSION['mikemclin.acl']))
            ? $_SESSION['mikemclin.acl']
            : null;
    }

    /**
     * Persist data array to storage.
     *
     * @param array $dataArray
     */
    public function persist($dataArray)
    {
        $_SESSION['mikemclin.acl'] = $dataArray;
    }
}
