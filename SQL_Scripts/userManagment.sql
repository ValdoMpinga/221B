CREATE USER '221B_DB2'@'localhost' IDENTIFIED BY 'sherlockAwesomeHolmes';
DROP USER '221B_DB'@'localhost';

repair table 221b_test.user use_frm;

-- https://linuxhint.com/create-new-user-mysql/

GRANT SELECT ON 221b_test.* TO '221B_DB'@'localhost';
revoke SELECT ON 221b_test.* from '221B_DB'@'localhost';

grant execute on function createEnvironment TO '221B_DB'@'localhost';
grant execute on function createCompartment TO '221B_DB'@'localhost';
grant execute on function createApointment TO '221B_DB'@'localhost';
grant execute on procedure registerUser TO '221B_DB'@'localhost';
grant execute on function  getUserPassword TO '221B_DB'@'localhost';

