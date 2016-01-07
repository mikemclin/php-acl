<?php

namespace MikeMcLin\Acl;

use MikeMcLin\Acl\Storage\ForgetStorable;
use MikeMcLin\Acl\Storage\StorableContract;

class Acl implements AclContract, StorableContract
{
    use ForgetStorable;

    protected $roles = [];
    protected $abilities = [];

    /**
     * Restore data from web storage.
     *
     * Returns true if web storage exists and false if it doesn't.
     *
     * @return bool
     */
    public function resume()
    {
        $dataArray = $this->fetch();
        if (!is_array($dataArray)) {
            return false;
        }
        $this->roles = $dataArray['roles'];
        $this->abilities = $dataArray['abilities'];
        return true;
    }

    /**
     * Attach a role to the current user
     *
     * @param $role
     */
    public function attachRole($role)
    {
        $this->roles[] = $role;
    }

    /**
     * Detach a role to the current user
     *
     * @param $role
     */
    public function detachRole($role)
    {
        $this->roles = array_diff($this->roles, [$role]);
    }

    /**
     * Remove all roles from current user
     */
    public function flushRoles()
    {
        $this->roles = [];
    }

    /**
     * Check if the current user has role attached
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return in_array($role, $this->roles);
    }

    /**
     * Get the abilities object
     *
     * @return array
     */
    public function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * Set the abilities array (overwriting previous abilities)
     *
     * Each property on the abilities object should be a role.
     * Each role should have a value of an array. The array should contain
     * a list of all of the roles abilities.
     *
     * Example:
     *
     *    [
     *        guest => ['login'],
     *        user  => ['logout', 'view_content'],
     *        admin => ['logout', 'view_content', 'manage_users']
     *    ]
     *
     * @param array $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = (array)$abilities;
    }

    /**
     * Add an ability to a role
     *
     * @param $role
     * @param $ability
     */
    public function addAbility($role, $ability)
    {
        if (!isset($this->abilities[$role])) {
            $this->abilities[$role] = [];
        }
        $this->abilities[$role][] = $ability;
    }

    /**
     * Does current user have permission to do something?
     *
     * @param $ability
     *
     * @return bool
     */
    public function can($ability)
    {
        foreach ($this->roles as $role) {
            if (
                is_array($this->abilities[$role]) &&
                in_array($ability, $this->abilities[$role])
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Persist data to storage
     */
    protected function save()
    {
        $this->persist([
            'roles'     => $this->roles,
            'abilities' => $this->abilities,
        ]);
    }
}
