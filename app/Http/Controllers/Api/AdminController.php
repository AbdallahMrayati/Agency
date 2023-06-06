<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::all();

        return $this->sendResponse(UserResource::collection($Users), 'Admin retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "admin";

        $selectedPermission = $request->permissions;

        $blogsPermissions = ['blogAdd', 'blogEdit', 'blogShow', 'blogsView', 'blogDelete'];
        $portfoliosPermissions = ['portfolioAdd', 'portfolioEdit', 'portfolioShow', 'portfoliosView', 'portfolioDelete'];
        $requestsPermissions = ['requestShow', 'requestsView'];
        $pricesPermissions = ['pricingAdd', 'pricingEdit', 'pricingShow', 'pricingsView', 'pricingDelete'];
        $tagsPermissions = ['tagAdd', 'tagEdit', 'tagShow', 'tagsView', 'tagDelete'];
        if ($selectedPermission == "blog") {
            foreach ($blogsPermissions as $permission) {
                $user->givePermissionTo($permission);
            }
            $user->permissions = json_encode($blogsPermissions);
        }
        if ($selectedPermission == "pricing") {
            foreach ($pricesPermissions as $permission) {
                $user->givePermissionTo($permission);
            }
            $user->permissions = json_encode($pricesPermissions);
        }
        if ($selectedPermission == "portfolio") {
            foreach ($portfoliosPermissions as $permission) {
                $user->givePermissionTo($permission);
            }
            $user->permissions = json_encode($portfoliosPermissions);
        }
        if ($selectedPermission == "requests") {
            foreach ($requestsPermissions as $permission) {
                $user->givePermissionTo($permission);
            }
            $user->permissions = json_encode($requestsPermissions);
        }
        if ($selectedPermission == "tags") {
            foreach ($tagsPermissions as $permission) {
                $user->givePermissionTo($permission);
            }
            $user->permissions = json_encode($tagsPermissions);
        }


        $user->save();
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success["permissions"] = $user->permissions;


        return $this->sendResponse($success, 'Admin register successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Users = User::find($id);

        if (is_null($Users)) {
            return $this->sendError('Admin not found.');
        }

        return $this->sendResponse(new UserResource($Users), 'Admin retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();

        return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(["Not found"]);
        }
        $user->delete();
        return $this->sendResponse([], 'Admin deleted successfully.');
    }
}
