ALTER TABLE user ADD UNIQUE (email);
ALTER TABLE user ALTER user_state SET DEFAULT true;
ALTER TABLE apointment ALTER apointment_state SET DEFAULT true;
ALTER TABLE environment ALTER environment_state SET DEFAULT true;
ALTER TABLE compartment ALTER compartment_state SET DEFAULT true;

ALTER TABLE apointment
ADD environment_id int;

ALTER TABLE apointment
ADD FOREIGN KEY (environment_id) REFERENCES environment(environment_id);
