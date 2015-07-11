<?php

namespace MikeMcLin\Acl\Storage;

trait ForgetStorable
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
        return null;
    }

    /**
     * Persist data array to storage.
     *
     * @param array $dataArray
     */
    public function persist($dataArray)
    {
        // Be forgetful, persist nothing
    }
}
