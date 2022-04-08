<?php


namespace App\Repositories;

use App\Student;

class UserRepository
{
    public function checkEmailIsPresentOrNotRepo($inputData)
    {
        if(isset($inputData['email']))
        {
            $user=Student::where('email',$inputData['email'])->first();
            if($user)
            {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function checkMobileNosPresentOrNotRepo($inputData)
    {
        if(isset($inputData['mobile']))
        {
            $user=Student::where('mobile',$inputData['mobile'])->first();
            if($user)
            {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}
