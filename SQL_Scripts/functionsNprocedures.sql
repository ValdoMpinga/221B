-- ================================ APP FUNCTIONS =============================================================

drop function if exists createEnvironment;

DELIMITER $$

CREATE function createEnvironment
(_user_id int,_environment_name varchar(100),_environment_description varchar(200),
  _environment_state tinyint,_environment_creation_date datetime)returns varchar(50)
BEGIN

	declare fetchedName varchar(100);
    
    select environment_name into fetchedName from environment where environment_name=_environment_name
    and user_id=_user_id;
  	 

	if fetchedName is null then
		insert into environment (user_id,environment_name,
         environment_description,environment_state,environment_creation_date) values(_user_id,_environment_name,
         _environment_description,_environment_state,_environment_creation_date);
         return 'Ambiente cirado com sucesso!';
 	else
		return  'Este ambiente ja existe';
	end if;
END $$

DELIMITER ;

-- ****************************************************************************************************************

drop procedure if exists deleteEnvironment;
drop procedure deleteEnvironment;


DELIMITER $$

CREATE procedure deleteEnvironment
(_environment_id int)
BEGIN

	update environment set environment_state=false where environment_id = _environment_id;
	update compartment set compartment_state=false where environment_id = _environment_id;
	update  apointment set apointment_state=false where  environment_id = _environment_id;
    
END $$

DELIMITER ;
call deleteEnvironment(1);

select *from environment;
select *from compartment;
select *from apointment;

-- ****************************************************************************************************************



-- ****************************************************************************************************************
drop function if exists createCompartment;

DELIMITER $$

CREATE function createCompartment
(_environment_id int,_user_id int,_compartment_name varchar(100) ,_compartment_description varchar(200),
_compartment_state bool,compartment_creation_date datetime)returns varchar(50)
BEGIN

	declare fetchedEnvironmentName varchar(100);
	declare fetchedCompartmentName varchar(100);
    
    select compartment_name into fetchedCompartmentName from compartment where compartment_name=_compartment_name
    and user_id=_user_id and environment_id=_environment_id;
	
    select environment_name into fetchedEnvironmentName from environment where
    environment_id= _environment_id and user_id=_user_id ;

	if fetchedCompartmentName is null then
		set fetchedCompartmentName='initialized';
	end if;
         
	if  fetchedCompartmentName != fetchedEnvironmentName and fetchedCompartmentName='initialized' then
		insert into compartment (environment_id ,user_id ,compartment_name,compartment_description,
		compartment_state,compartment_creation_date) values
        (_environment_id ,_user_id ,_compartment_name,_compartment_description,
		_compartment_state,compartment_creation_date);
         return 'Compartimento criado com sucesso!';
	else
		return  'Os compartimnentos devem ser inexistentes e de nome diferente dos seus ambientes';
	end if;
END $$

DELIMITER ;

drop function if exists createCompartment;

-- ****************************************************************************************************************

drop procedure if exists deleteCompartment;

DELIMITER $$

CREATE procedure deleteCompartment
(_compartment_id int)
BEGIN
	update compartment set compartment_state=false where compartment_id = _compartment_id;
	update  apointment set apointment_state=false where  compartment_id = _compartment_id;
    
END $$

DELIMITER ;





-- ****************************************************************************************************************

drop function if exists createApointment;

DELIMITER $$

CREATE function createApointment
(_compartment_id int, _user_id int,_apointment_name varchar(100),
_apointment_type varchar(100),_apointment_description varchar(200),_apointment_creation_date datetime)returns varchar(50)
BEGIN

	declare fetchedCompartmentName varchar(100);
	declare fetchedApointmentName varchar(100);

    select compartment_name into fetchedCompartmentName from compartment where compartment_id=_compartment_id
    and user_id=_user_id;
	
    select apointment_name into fetchedApointmentName from apointment where
    compartment_id= _compartment_id and user_id=_user_id;

	if fetchedApointmentName is null then
		set fetchedApointmentName='initialized';
	end if;
         
	if  fetchedApointmentName != fetchedCompartmentName and fetchedApointmentName='initialized' then
		insert into apointment (compartment_id,user_id,apointment_name,apointment_type,
        apointment_description,apointment_creation_date) values
        (_compartment_id,_user_id,_apointment_name,_apointment_type,
        _apointment_description,_apointment_creation_date);
         return 'Apontamento criado com sucesso!';
	else
		return  'Os Apontamentos devem ser inexistentes e de nome diferente dos seus ambientes';
	end if;
END $$

DELIMITER ;

-- ======================================== USER FUNCTIONS AND PROCEDURES ==============================================================

drop procedure if exists registerUser;

DELIMITER $$
CREATE procedure registerUser(_first_name varchar(100) ,_last_name varchar(100),
_email varchar(100) ,_password varchar(100),_birth_date date)
BEGIN
    insert into user (first_name,last_name,email,password,birth_date) values
    (_first_name,_last_name,_email,_password,_birth_date);
END $$

DELIMITER ;


-- ****************************************************************************************************************

drop function if exists getUserPassword;

DELIMITER $$

CREATE function getUserPassword
(_email varchar(100))returns varchar(100)
BEGIN
	declare returnEmail varchar(100);

	set returnEmail:= (select password from user where email=_email);
    
     return returnEmail;
END $$

DELIMITER ;

select  getUserPassword('crazydiamond');

-- ****************************************************************************************************************


drop function if exists delete;

DELIMITER $$

CREATE function getUserPassword
(_email varchar(100))returns varchar(100)
BEGIN
	declare returnEmail varchar(100);

	set returnEmail:= (select password from user where email=_email);
    
     return returnEmail;
END $$

DELIMITER ;

select  getUserPassword('crazydiamond');
select * from user;

ALTER TABLE apointment
ADD FOREIGN KEY (environment_id) REFERENCES environment(environment_id);



