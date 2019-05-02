<?php
namespace GlobalsProjects\CustomEmailSender\Library;


class UserUtility
{

    private $model;

    /**
     * UserUtility constructor.
     * @param Model|mixed $userClass
     */
    public function __construct($userClass)
    {
        $this->model = new $userClass;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllUsers()
    {
        $userCollection = collect([]);

        $this->model->each(function($user) use ($userCollection) {
            $user->{'$isDisabled'} = false;
            $userCollection->push($user);
        });

        return $userCollection;
    }

}