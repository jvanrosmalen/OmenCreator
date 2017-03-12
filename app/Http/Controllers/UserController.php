<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
	public function showAll(){
		$users = User::where('is_accepted', true)->orderBy('name', 'desc')->get();
		$requests = User::where('is_accepted', false)->orderBy('name', 'desc')->get();
		
		return view('/user/showAllUsers',["users"=>$users,"requests" => $requests]);
	}
	
	public function submitUser($id){
		$user_is_admin = isset($_POST['isAdmin']);
		$user = User::find($id);
		
		if(Auth::user()->id == $id && !$user_is_admin){
			return view('/user/errorRemoveOwnAdmin',["user"=>$user]);
		}else{
			$user->is_story_telling = isset($_POST['isStoryTelling']);
			$user->is_admin = $user_is_admin;
			$user->is_system_rep = isset($_POST['isSystemRep']);
			
			if(!$user->is_accepted){
				$user->is_accepted = true;
				$user->save();
				return view('/user/submitUser',["user"=>$user]);
			}else{
				$user->save();
				return view('/user/updateUser',["user"=>$user]);
			}
		}
	}
	
	public function showDeleteUser($id){
		$user = User::find($id);
	
		if(Auth::user()->id == $id){
			return view('/user/errorDeleteOwnAdminUser',["user"=>$user]);
		}else{
			return view('/user/showDeleteUser',["user"=>$user]);
		}
	}
	
	public function deleteUser($id){
		$user = User::find($id);
		
		if(Auth::user()->id != $id && Auth::user()->is_admin){
			$user->delete();
		}
		
		return redirect()->route('showall_user');
	}
}
