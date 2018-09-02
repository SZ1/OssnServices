# OssnServices
A basic API for your OSSN website, which allows you to integrate OSSN into your applications. This is a initial version and will be improved in the future.  This component is introduced in OSSN v5.0 and requires minimum OSSN v5.0

* You can get Users basic details like 
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
    
Below is the sample response from the API

```json
{
    "merchant": "Ossn Development",
    "url": "https:\/\/development.opensource-socialnetwork.org\/",
    "time_token": 1535399772,
    "payload": false,
    "code": "100",
    "message": "Request successfully executed",
    "payload": {
        "first_name": "System",
        "last_name": "Administrator",
        "email": "someuser@localhost.com",
        "birthdate": "20\/02\/2000",
        "gender": "male"
    }
}
```
### User Friends

    CURL https://www.mywebsite.com/api/v1.0/user_friends?api_key_token=<my_api_key_token>&guid=<user_guid>

### User Authentication

    CURL https://www.mywebsite.com/api/v1.0/user_authenticate?api_key_token=<my_api_key_token>&username=<user_username>&password=<user_password_in_plaintext>
    
### API CODES

Code   | Description
------------ | -------------
100 | The requested method successfully responded to the request.
101 | Invalid API method.
102 | The requested method didn't returned any response.
103 | The requested user is invalid.
104 | The requested user is not validated.
105 | Unable to login. The supplied password is incorrect or system have returned the error.

If you have questions please post it to our community website https://www.opensource-socialnetwork.org/community
