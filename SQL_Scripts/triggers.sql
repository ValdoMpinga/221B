
DELIMITER $$

CREATE TRIGGER insertMainEnvironment
    AFTER INSERT
    ON user FOR EACH ROW
BEGIN
  INSERT INTO `221b_test`.`environment` (`user_id`,`environment_name`,`environment_description`,
`environment_state`,`environment_creation_date`,
`environment_picture`,`last_accessed_environment`)
VALUES
(NEW.user_id,'Casa','A minha casa!',1,sysdate(),null,null);

END$$    

DELIMITER ;
select * from compartment where  user_id= (select user_id from user where email='valdomm@ipvc.pt') and
 environment_id=(select environment_id from environment where environment_name='Casa' and user_id=
 (select user_id from user where email='valdomm@ipvc.pt')) ;
delete from user where user_id =16;


