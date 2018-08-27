# OssnServices
A basic API for your OSSN website, allow you to integrate OSSN into your application. This is a initial version and will be improved in future.  This component is introduced in OSSN v5.0 and requires minimum OSSN v5.0

* You can get User basic details like 
   - First Name
   - Last Name
   - Email
   - Gender
   - Birthdate
 * Get user friends
 * User Authentication (by username and password)
    - Username can be email
 
## Basic Usage

### User Details

    CURL https://www.mywebsite.com/api/v1.0/user_details?api_key_token=<my_api_key_token>&guid=<user_guid>

### User Friends

    CURL https://www.mywebsite.com/api/v1.0/user_friends?api_key_token=<my_api_key_token>&guid=<user_guid>

### User Authentication

    CURL https://www.mywebsite.com/api/v1.0/user_authenticate?api_key_token=<my_api_key_token>&username=<user_username>&password=<user_password_in_plaintext>
