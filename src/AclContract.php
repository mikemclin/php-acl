<?php

namespace MikeMcLin\Acl;

interface AclContract
{
    /**
     * Restore data from web storage.
     *
     * Returns true if web storage exists and false if it doesn't.
     *
     * @return bool
     */
    public function resume();

    /**
     * Attach a role to the current user
     *
     * @param $role
     */
    public function attachRole($role);

    /**
     * Detach a role to the current user
     *
     * @param $role
     */
    public function detachRole($role);

    /**
     * Remove all roles from current user
     */
    public function flushRoles();

    /**
     * Check if the current user has role attached
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role);

    /**
     * Set the abilities object (overwriting previous abilities)
     *
     * Each property on the abilities object should be a role.
     * Each role should have a value of an array. The array should contain
     * a list of all of the roles abilities.
     *
     * Example:
     *
     *    (object) [
     *        guest => ['login'],
     *        user  => ['logout', 'view_content'],
     *        admin => ['logout', 'view_content', 'manage_users']
     *    ]
     *
     * @param $abilities
     */
    public function setAbilities($abilities);

    /**
     * Get the abilities object
     *
     * @return object
     */
    public function getAbilities();

    /**
     * Add an ability to a role
     *
     * @param $role
     * @param $ability
     */
    public function addAbility($role, $ability);

    /**
     * Does current user have permission to do something?
     *
     * @param $ability
     *
     * @return bool
     */
    public function can($ability);
}
