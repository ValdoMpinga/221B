select environment_name from environment where user_id=(select user_id from user where email='james@gmail.com');

select compartment_name,compartment_description,compartment_state from compartment where user_id=(select user_id 
from user where email='james@gmail.com');

select apointment_name,apointment_description,apointment_creation_date from apointment where user_id=(select user_id 
from user where email='james@gmail.com');

select *from user;
SELECT 
    *
FROM
    environment;

select environment_name from environment where user_id=1;

select *from environment;
select *from compartment;
select *from apointment;

