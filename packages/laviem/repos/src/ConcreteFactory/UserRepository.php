<?php

namespace LaviemRepos\ConcreteFactory;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LaviemRepos\AbstractFactory\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    function __construct()
    {

    }

    function getUsers()
    {
        return User::all();
    }

    function getUser($idUser)
    {
        return User::find($idUser);
    }

    function getUsersPagination()
    {
        return User::orderBy('updated_at', 'desc')->cursorPaginate(config('pagination.num_users'));
    }

    public function store($data)
    {
        try {

            DB::beginTransaction();

            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->password);
            $user->save();

            $profile = new Profile();
            $profile->description = $data->description;
            $user->profile()->save($profile);

            DB::commit();

            return $user->id;

        } catch (\Exception $e) {

            \Log::debug('rollback delete user');

            DB::rollBack();
        }

        return 0;
    }

    public function update($data, $idUser)
    {
        try {

            DB::beginTransaction();

            $user = User::find($idUser);
            $user->name = $data->name;
            $user->email = $data->email;
            $user->save();

            $user->profile->description = $data->description;
            $user->profile->save();

            DB::commit();

        } catch (\Exception $e) {

            \Log::debug('rollback delete user');

            DB::rollBack();
        }
    }

    public function delete($idUser)
    {
        try {

            DB::beginTransaction();

            $user = User::find($idUser);

            $user->categories()->delete();

            foreach ($user->bookmarks as $bookmark)
            {
                if ($bookmark->details !== null)
                {
                    $bookmark->details->delete();
                }
            }
            $user->bookmarks()->delete();
            if ($user->profile !== null) $user->profile->delete();
            $user->delete();

            DB::commit();

        } catch (\Exception $e) {

            \Log::debug('rollback delete user');

            DB::rollBack();
        }
    }
}
