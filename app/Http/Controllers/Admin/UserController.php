<?php


    /**
     * PHP Version 7.2.19 or newer
     * Functions for dashboard
     * 
     * @category    File
     * @package     User
     * @author     Nkuke Henry
     * @copyright   henricsanyu@gmail.com
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Auth;
    
    use App\Models\User;
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;
    use App\Mail\WelcomeNewUserMail;

    

    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    User
     *  @author     Henry nkuke
     *  @copyright  Tipostar
     */

    class UserController extends Controller
    {
       
        /**
         * index
         *
         * @return all users registerd on the site
         */
        public function index()
        {
            $Users = User::all();

            // Append the status and the roles of the users to the collection result
            $Users->map(function ($User) {

                $User['status'] =  $User->is_active?'Active':'InActive'; 
                $User['country'] = 'Uganda';
                

                $roles = Role::all();
                $userRoles = '';
                foreach ($roles as $role) 
                {
                    if ($User->hasRole($role->name))
                    {
                        $userRoles .= $role->name.' ';
                    }   
                }

                $User['userRoles'] = $userRoles;

                return $User;
            });

            // Return the result to jquery datatables
            if(request()->ajax())
            {
                return datatables()->of($Users)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $editurl = route('admin.editUser', ['user_id'=> $row->id]);
                            $btn = '<a href="'.$editurl.'"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Edit" 
                                    class="edit btn btn-primary btn-sm btn-flat editUser">
                                    Edit</a>';

                            $btn .= '<a href="javascript:void(0)" 
                                    data-toggle="tooltip"  data-id="'.$row->id.'" 
                                    data-original-title="Delete" 
                                    class="btn btn-danger btn-sm btn-flat deleteUser">
                                    Delete</a>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('admin.users.index');
        }

       
        /**
         * create
         *
         * @param  mixed $request
         *
         * @return user creation form
         */
        public function create(Request $request)
        {
            return view ('admin.users.create');
        }

       
        /**
         * edit
         *
         * @param  mixed $user_id
         * @param  mixed $request
         *
         * @return user edit form 
         */
        public function edit($user_id='', Request $request)
        {
            $user = User::findOrFail($user_id);
            return view('admin.users.edit', compact('user'));
        }

        
        /**
         * saveUser
         * 
         * Function to handle the creation of a new user and update an existing user
         * 
         * @param  mixed $request
         *
         * @return void
         */
        public function saveUser(Request $request)
        {
            $user_id = $request->input('user_id');

            // validation rules
            if ($user_id)
            {
                $validation_rules = [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                ];
            }
            else 
            {
                $validation_rules = [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                ];
            }

            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) 
            {                
                return $this->return_output('error', 'error', $validator, 'back', '422');
            }

            if($user_id)
            {
                $user = User::find($user_id);

                $success_message = 'User updated successfully';
            }
            else
            {
                $user = new User();
            
                // generate random password
                $length = 8;
                $keyspace = '23456789abcdefghjkmnpqrstuvWxyzABCDEFGHJKLMNPQRSTUVWXYZ';
                $password = '';
                $max = mb_strlen($keyspace, '8bit') - 1;

                for ($i=0; $i<$length; $i++)
                {
                    $password .= $keyspace[random_int(0, $max)];
                }

                $user->password = bcrypt($password);

                $success_message = 'User added successfully';
            }
              
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email'); 
            $user->is_active = $request->input('is_active');
            $user->save();

            if(!$user_id)
            {
                $user->attachRole(Role::where('name', 'administrator')->first());

                // Data to email new user
                $new_user = [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'password' => $password,
                    'email' => $user->email,
                    'subject' => 'New account creation'
                ];

                //event(new NewUserRegisteredEvent($newUserMailedData));
                Mail::send(new WelcomeNewUserMail($new_user));

            }

            return $this->return_output('flash', 'success', $success_message, 'admin/users', '200');
        }


        public function delete(Request $request)
        {
            if(!empty($request->user_id))
            {
                $id =  $request->user_id;
                $user = Auth::user();
                if($user->id == $id)
                {
                    return response()->json(['error'=>'User not deleted']);
                }
                else 
                {
                    User::find($id)->delete();
                    return response()->json(['error'=>'User deleted']);
                }
            }
            else
            {
                return response()->json(['error'=>'User not deleted']);
            }
        }


        public function initialUser(){

            $user = new User();
            $user_id = null;

            $request = (Object) [
                "first_name"=>"Henry",
                "last_name"=>"Nkuke",
                "email"=>"henricsanyu@gmail.com"
            ];
            
            // generate random password
            $length = 8;
            $keyspace = '23456789abcdefghjkmnpqrstuvWxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $password = 'admin123';
            $max = mb_strlen($keyspace, '8bit') - 1;

            // for ($i=0; $i<$length; $i++)
            // {
            //     $password .= $keyspace[random_int(0, $max)];
            // }

            $user->password = bcrypt($password);
              
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email; 
            $user->is_active = 1;
            $user->save();

            if(!$user_id)
                $user->attachRole(Role::where('name', 'administrator')->first());
            
        }


    }
