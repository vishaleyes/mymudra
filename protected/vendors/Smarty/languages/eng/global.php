<?php
$messages=array();

/*Registration user*/
$messages['_REQ_NAME_'] = "Name is mandatory.";
$messages['_REQ_EMAIL_ID_'] = "Email is mandatory.";
$messages['_VALID_EMAIL_'] = "Please enter valid email.";
$messages['_REQ_MOBILE_NUMBER_'] = "Mobile number is mandatory.";
$messages['_REQ_EMPLOYMENT_TYPE_'] = "Employment type is mandatory.";
$messages['_REQ_ANNUAL_INCOME'] = "Annual Income is mandatory.";
$messages['_REQ_PASSWORD_'] = "Password is mandatory.";
$messages['_REQ_ADDRESS_'] = "Address is required.";
$messages['_REQ_CITY_'] = "City is required.";
$messages['_REQ_STATE_'] = "State is required.";
$messages['_REQ_PINCODE_'] = "Pincode is required.";

/*login user*/
$messages['_REQ_EMAIL_'] = "Email is mandatory.";
$messages['_REQ_PASSWORD_'] = "Password is mandatory.";
$messages['_REQ_DEVICE_TOKEN_'] = "'device_token' parameter is mandatory.";
$messages['_REQ_ENDPOINT_'] = "Push notification token not found.";

$messages['_MOBILE_NUMBER_ALREADY_EXIST_'] = "Mobile number already registered please try with other number.";
$messages['_EMAIL_ALREADY_REGISTER_'] = "Email address already registered please try with other email Id.";

$messages['_SUCCESS_'] = "Success";
$messages['_DATA_NOT_FOUND_'] = "Data not found.";
$messages['_GETTING_ERROR_REGISTRATION_'] = "Getting issue while doing user registration.";
$messages['_PERMISSION_DENIED_'] = "Permission Denied.";

$messages['_ACCOUNT_NOT_VERIFIED_'] = "Account is not verified.";
$messages['_ACCOUNT_DEACTIVATE_'] = "Account is deactivate.";
$messages['_INVALID_PASSWORD_'] = "Please enter valid password.";
$messages['_INVALID_USERNAME_'] = 'Please enter email or mobile number to login';
$messages['_INVALID_SESSION_'] = 'Invalid Session';

$messages['_MAIL_SEND_FAIL_'] = "Getting issue while sending email.";
$messages['_USER_NOT_EXIST_'] = "User details not exist.";

$messages['_REQ_LOAN_AMOUNT_'] = "Loan Amount is mandatory.";
$messages['_REQ_INV_AMOUNT_'] = "Investment Amount is mandatory.";
$messages['_REQ_PROPERTY_TYPE_ID_'] = "property type id parameter is mandatory.";
$messages['_REQ_SIZE_'] = "property size is mandatory.";
$messages['_REQ_SIZE_TYPE_'] = "property size type is mandatory.";
$messages['_REQ_PROPERTY_TYPE_'] = "property type is mandatory.";
$messages['_REQ_LOAN_TYPE_ID_'] = "loan type id parameter is mandatory.";
$messages['_REQ_INV_TYPE_ID_'] = "Investment type id parameter is mandatory.";
$messages['_REQ_PROPERTY_AMOUNT_'] = "Property amount is mandatory.";
$messages['_MAIL_SEND_SUCCESS_'] = "Email sent successfully.";
$messages['_REQ_EMAIL_OR_MOBILE_'] = "Please enter email or mobile number to login.";
$messages['_REQ_ANNUAL_INCOME_'] = "annual income is required";


$messages['_BANK_LOAN_USER_SUCCESS_'] = "Bank loan details added successfully";
$messages['_INV_LOAN_DETAILS_SUCCESS_'] = "Investment advisory details added successfully";
$messages['_REAL_ESTATE_DETAILS_SUCCESS_'] = "Real estate details added successfully";
$messages['_REQ_MIN_LENGTH_'] = "Password must be 7 digits long or more than 7 digits";

/*$messages['_REQ_MAXLENGTH_'] = "Password must be 7 digits or less";*/


return $messages;

?>	
