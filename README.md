# PHP ACL

---

## About

PHP ACL _(Access Control List)_ is a service that allows you to protect/enable functionality based on the current user's assigned role(s), and those role(s) permissions (abilities).  So, if the current user has a "moderator" role, and a moderator can "ban_users", then the current user can "ban_users".

---

## Documentation

### `MikeMcLin\Acl|Acl` methods

#### `resume()`

Restore data from storage.

###### Returns

**boolean** - true if web storage existed, false if it didn't

#### `attachRole(role)`

Attach a role to the current user. A user can have multiple roles.

###### Parameters

| Param | Type | Example | Details |
| ----- | ---- | ------- | ------- |
| `role` | string | `"admin"` | The role label |

#### `detachRole(role)`

Remove a role from the current user

###### Parameters

| Param | Type | Example | Details |
| ----- | ---- | ------- | ------- |
| `role` | string | `"admin"` | The role label |

#### `flushRoles()`

Remove all roles from current user

#### `hasRole(role)`

Check if the current user has role attached

###### Returns

**boolean**

#### `setAbilities(abilities)`

Set the abilities object (overwriting previous abilities).

###### Parameters

| Param | Type | Details |
| ----- | ---- | ------- |
| `abilities` | object | Each property on the abilities object should be a role. Each role should have a value of an array. The array should contain a list of all of the role's abilities. |

###### Example

```js
var abilities = (object)[
  guest: ['login'],
  user: ['logout', 'view_content'],
  admin: ['logout', 'view_content', 'manage_content']
]
setAbilities(abilities);
```

#### `addAbility(role, ability)`

Add an ability to a role

###### Parameters

| Param | Type | Example | Details |
| ----- | ---- | ------- | ------- |
| `role` | string | `"admin"` | The role label |
| `ability` | string | `"create_users"` | The ability/permission label |

#### `can(ability)`

Does current user have permission to do the given ability?

###### Returns

**boolean**

###### Example

```php
// Setup some abilities
$acl->addAbility('moderator', 'ban_users');
$acl->addAbility('admin', 'create_users');

// Add moderator role to the current user
$acl->attachRole('moderator');

// Check if the current user has these permissions
$acl->can('ban_users'); // returns true
$acl->can('create_users'); // returns false
```

---

## License

The MIT License

Angular ACL
Copyright (c) 2015 Mike McLin

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
