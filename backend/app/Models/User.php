<?php
namespace App;
namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'imagefootage_users';
    protected $guard = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    public function account(){
        return $this->hasOne(Account::class,'id', 'account_manager_id');
    }

    public function country(){
        return $this->hasOne(Country::class,'id', 'country');
    }

    public function city(){
        return $this->hasOne(City::class,'id', 'city');
    }
    public function state(){
        return $this->hasOne(State::class,'id', 'state');
    }
    public function cart(){
        return $this->hasMany(Usercart::class,'cart_added_by', 'id');
    }
    public function plans(){
        return $this->hasMany(UserPackage::class,'user_id', 'id');
    }



    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function save_user($data){
        try{
               $save_data = new User();
               $save_data->first_name = $data->first_name;
               $save_data->last_name = $data->last_name;
               $save_data->title = $data->title;
               $save_data->user_name = $data->user_name;
               $save_data->contact_owner = $data->contact_owner;
               $save_data->account_manager_id = $data->account_manager_id;

               $save_data->email = $data->email;
               $save_data->phone = $data->phone;
               $save_data->mobile = $data->mobile;
               $save_data->extension = $data->extension;
               $save_data->address = $data->bill_address;
               $save_data->city = $data->bill_city;
               $save_data->state = $data->bill_state;
               $save_data->country = $data->bill_country;
               $save_data->postal_code = $data->bill_postal;
               $save_data->password =Hash::make('123456');
               $save_data->type = $data->type;
               $save_data->notes = $data->notes;
               $save_data->description = $data->description;
               $save_data->save();
          }catch (Exception $e) {
           report($e);
           return false;
         }
         return true;
       }

       public function getUserData($id=NULL){
        if($id==''){
        return User::with('account')->get()->toArray();
        }else{
         return User::with('account')->where('id','=',$id)->first()->toArray();
        }
    }

    public function getPurchaseOrders($id=NULL){
        if($id==''){
        return User::with('account')->paginate(100);  
        }else{
         return User::with('account')->where('id','=',$id)->first()->toArray();
        }
    }

    public function update_user($data,$id){
        try{
               $save_data =  User::find($id);
               $save_data->id = $id;
               $save_data->first_name = $data->first_name;
               $save_data->last_name = $data->last_name;
               $save_data->title = $data->title;
               $save_data->user_name = $data->user_name;
               $save_data->contact_owner = $data->contact_owner;
               $save_data->account_manager_id = $data->account_manager_id;

               $save_data->email = $data->email;
               $save_data->phone = $data->phone;
               $save_data->mobile = $data->mobile;
               $save_data->extension = $data->extension;
               $save_data->address = $data->bill_address;
               $save_data->city = $data->bill_city;
               $save_data->state = $data->bill_state;
               $save_data->country = $data->bill_country;
               $save_data->postal_code = $data->bill_postal;
               $save_data->password =Hash::make('123456');
               $save_data->type = $data->type;
               $save_data->notes = $data->notes;
               $save_data->description = $data->description;
               $save_data->save();
          }catch (Exception $e) {
           report($e);
           return false;
         }
         return true;
       }

    //change status of accounts
    public function change_status($flag,$id){
        try{
          $user = User::find($id);
          $user->id = $id;
          $user->status = $flag;
          $user->save();
          }catch (Exception $e) {
          report($e);
          return false;
        }
        return true;
      }

    //   public function getAccountDataForShow($id){
    //     if($id>0){
    //     $data  = DB::table('imagefootage_users')
    //              ->select('imagefootage_users.*,states.state,countries.name as countryName,states.name as stateName,industry_types.name as industryName,currency_convertes.name as curruncyName')
    //              ->join('countries','countries.id','=','imagefootage_accounts.bill_country')
    //              ->join('states','states.id','=','imagefootage_accounts.bill_state')
    //              ->join('cities','cities.id','=','imagefootage_accounts.bill_city')
    //              ->join('industry_types','industry_types.id','=','imagefootage_accounts.industry_type_id')
    //              ->join('currency_convertes','currency_convertes.id','=','imagefootage_accounts.curruncy_id')
    //             ->where('id','=',$id)->get()->toArray();
    //         return $data ;
    //     }else{
    //       return [];
    //     }

    //   }

   // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }
}
