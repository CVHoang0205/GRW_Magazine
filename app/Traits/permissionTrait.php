<?php

namespace App\Traits;

trait permissionTrait{
    public function hasPermission(){

        //for faculty
        if(!isset(auth()->user()->role->permission['name']['faculty']['can-add']) && \Route::is('facultys.create')){
            return abort(401);
        }

        if(!isset(auth()->user()->role->permission['name']['faculty']['can-view']) && \Route::is('facultys.index')){
            return abort(401);
        }

        //for user
        if(!isset(auth()->user()->role->permission['name']['user']['can-add']) && \Route::is('users.create')){
            return abort(401);
        }

        if(!isset(auth()->user()->role->permission['name']['user']['can-add']) && \Route::is('users.index')){
            return abort(401);
        }

        //for role
        if(!isset(auth()->user()->role->permission['name']['role']['can-add']) && \Route::is('roles.create')){
            return abort(401);
        }

        if(!isset(auth()->user()->role->permission['name']['role']['can-view']) && \Route::is('roles.index')){
            return abort(401);
        }

        //for permission
        if(!isset(auth()->user()->role->permission['name']['permission']['can-add']) && \Route::is('permissions.create')){
            return abort(401);
        }

        if(!isset(auth()->user()->role->permission['name']['permission']['can-add']) && \Route::is('permissions.index')){
            return abort(401);
        }

        //for event
        if(!isset(auth()->user()->role->permission['name']['event']['can-add']) && \Route::is('events.create')){
            return abort(401);
        }

        if(!isset(auth()->user()->role->permission['name']['event']['can-view']) && \Route::is('events.index')){
            return abort(401);
        }

        //for contributions
        if(!isset(auth()->user()->role->permission['name']['contribution']['can-add']) && \Route::is('contributions.create')){
            return abort(401);
        }

        if(!isset(auth()->user()->role->permission['name']['contribution']['can-view']) && \Route::is('contributions.index')){
            return abort(401);
        }
    }
}