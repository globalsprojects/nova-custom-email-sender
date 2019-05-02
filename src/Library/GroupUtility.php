<?php
namespace GlobalsProjects\CustomEmailSender\Library;

use GlobalsProjects\CustomEmailSender\Library\UserUtility;


class GroupUtility
{

    private $model;

    /**
     * GroupUtility constructor.
     * @param Model|mixed $userClass
     */
    public function __construct($userClass)
    {
        $this->model = new $userClass;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllGroups()
    {
        $relationFunction = config('novaemailsender.group_model.relationship_name') ?: config('novaemailsender.group_model.foreign_key') ;
        $groupCollection = collect([]);

        $this->model->each(function ($group) use ($relationFunction, $groupCollection) {
            $users = collect($group->$relationFunction()->filter()->values()->all());
            $relatedUsers = collect([]);

            if (config('novaemailsender.group_model.relationship_name')) {
                $users->each(function($user) use ($relatedUsers) {
                    $recipientClassName = config('novaemailsender.model.class');
                    $recipientClass = new $recipientClassName;
                    $relatedUser = $recipientClass->where('id', $user[config('novaemailsender.group_model.foreign_key')])->first();
                    $relatedUsers->push($relatedUser);
                });

                $users = $relatedUsers;
            }

            if ($users) {
                $object = new \stdClass();
                $object->name = $group->name;
                $object->users = $users;

                $groupCollection->push($object);
            }
        });

        return $groupCollection;
    }

}