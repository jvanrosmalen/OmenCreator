<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
			return view('/user/errorDeleteOwnAdmin',["user"=>$user]);
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
	
	public function showProfile(){
		$user = Auth::user();
		$rights = ["Speler"];
		
		if($user->is_story_telling){
			$rights[] = "Spelleiding";	
		}
		if($user->is_admin){
			$rights[] = "Administrator";	
		}
		if($user->is_system_rep){
			$rights[] = "Systeemverantwoordelijke";	
		}
		
		return view('/user/myProfile', ['user' => $user,
						'rights_string' => join(', ', $rights)]);
	}
	
	public function changeUserName(){
		$user = Auth::user();
		$password = $_POST['user_name_password'];
		$new_name = $_POST['user_name'];
		
		if(Hash::check($password, $user->password)){
			// Password is correct
			
			// Check if this is a valid name
			if(strlen($new_name) >= 4 && preg_match("/^(?=.*[a-z])^(.*?[A-Z]){2,}.*$/", $new_name) == 1){
				// And it is a valid name. (Min 4 long and at least 2 capitals.)
				$user->name = $new_name;
				$user->save();
					
				$url = route('profile_change_successful');
				header("Location:".$url);
				die();
			}else{
				// invalid name
				$url = route('profile_name_change_error');
				header("Location:".$url);
				die();
			}
			
		} else {
			$url = route('password_error');
			header("Location:".$url);
			die();
		}
	}
	
	public function changeUserEmail(){
		$user = Auth::user();
		$password = $_POST['user_email_password'];
		$new_email = $_POST['user_email'];
	
		if(Hash::check($password, $user->password)){
			// Password is correct
			
			// Check if valid email
			if(preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $new_email) == 1){
				$user->email = $new_email;
				$user->save();
					
				$url = route('profile_change_successful');
				header("Location:".$url);
				die();
			}else{
				// invalid email
				$url = route('profile_email_change_error');
				header("Location:".$url);
				die();				
			}
		} else {
			$url = route('password_error');
			header("Location:".$url);
			die();
		}
	}
	
	public function changeUserPassword(){
		$user = Auth::user();
		$password = $_POST['user_password'];
		$new_password = $_POST['user_new_password'];
		$new_password2 = $_POST['user_new_password2'];
		
		if(Hash::check($password, $user->password)){
			// Password is correct
			if(strlen($new_password) >=6){
				// first password is ok.
				if(strcmp($new_password, $new_password2) === 0){
					// both new passwords are equal. Store new password.
					$user->password = Hash::make($new_password);
					$user->save();

					$url = route('profile_change_successful');
					header("Location:".$url);
					die();
				}else{
					$url = route('new_passwords_not_equal_error');
					header("Location:".$url);
					die();
				}
			}else{
				$url = route('new_password_error');
				header("Location:".$url);
				die();
			}
		} else {
			$url = route('password_error');
			header("Location:".$url);
			die();
		}
	}
}
