create table User(user_id int auto_increment,first_name varchar(100) ,last_name varchar(100),
email varchar(100) unique,password varchar(100),birth_date date,user_state bool,primary key(user_id));

create table Environment(environment_id int auto_increment, user_id int,environment_name varchar(100),
environment_description varchar(200),environment_state bool,environment_creation_date datetime,
environment_picture blob,last_accessed_environment int,
primary key(environment_id), foreign key(user_id) references User(user_id));

create table Compartment(compartment_id int auto_increment,environment_id int,user_id int,
compartment_name varchar(100) ,compartment_description varchar(200),compartment_state bool,
compartment_picture blob,compartment_creation_date datetime,primary key(compartment_id),
foreign key(environment_id) references Environment(environment_id), foreign key(user_id) 
references User(user_id));

create table Apointment(apointment_id int auto_increment,compartment_id int,user_id int,
apointment_name varchar(100),apointment_type varchar(100),apointment_description varchar(200),
apointment_creation_date date,apointment_picture blob,apointment_state bool,primary
key(apointment_id),foreign key(compartment_id) references Compartment(compartment_id),
foreign key(user_id) references User(user_id));

