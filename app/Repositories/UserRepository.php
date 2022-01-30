<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\SickInfo;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\Interfaces\UserInterface;

class UserRepository extends BaseRepository implements UserInterface {
    
    // App\Models\User::class 
    protected $model = User::class;

    /**
     * update password 
     * 
     * @param array $validated 
     * @return void 
     */
    private function updatePassword(mixed &$validateData) 
    {
        if (isset($validateData['password'])) 
        {
            $validateData['password'] = Hash::make($validateData['password']);
        }
    }

    
    /**
     * Update role for user
     * 
     * @param array $validated
     * @return void 
     */
    private function updateRole(mixed &$validated) 
    {   
        if (isset($validated['role'])) {
            if ($role = Role::where('name', $validated['role'])->first()) {

                $validated["role_id"] = $role->id;
            }    
        }
    }

    /**
     * Create Or Update info for user-sick  
     * 
     * @param array $validated
     * @param \App\Models\User $user
     * @return void
     */
    private function updateOrCreateSickInfo($validated, $user)
    {   
        if ($user->hasRoles(['sick'])){   
            if ($user->sickInfo){
                $user->sickInfo->fill($validated)->save();
            } else {

                $user->sickInfo()->create($validated);
            }
        }

        $user->refresh();
    }

    /**
     * Filter users by name and rolename  
     * 
     * @param string $name 
     * @param string $rolename 
     * @return Illuminate\Database\Eloquent\Model
     */
    function filter($name, $rolename)
    {
        $users = $this->filterLike("name", $name);
        if ($rolename) {
            $users->whereHas('role', function($query) use($rolename) {
                return $query->where("name", $rolename);
            });
        }
        return $users;
    }

    /**
     * update user profile 
     * 
     * @param array $validatedData
     * @param int $id 
     * @return App\Models\User::class 
     */
    function update($validatedData, $id)
    {
        
        $this->updatePassword($validatedData);
        $this->uploadFile($validatedData, "avatar");
        $this->updateRole($validatedData);
        $user = parent::update($validatedData, $id);
        $this->updateOrCreateSickInfo($validatedData, $user);
        return $user;
    }

    /**
     * create new user 
     * 
     * @param array $validatedData
     * @return App\Models\User::class 
     */
    function create($validatedData)
    {
        
        $this->updatePassword($validatedData);
        $this->updateRole($validatedData);
        $user = parent::create($validatedData);
        $this->updateOrCreateSickInfo($validatedData, $user);
        return $user;
    }
}