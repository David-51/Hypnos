-- Test file
DELIMITER ;
-- Delete and create an empty BDD
SOURCE db.sql;

-- create "establishment" datas
SOURCE demo/establishments.sql;

-- create "suites" datas
SOURCE demo/suites.sql;

-- create "pictures" datas
SOURCE demo/pictures.sql;

-- create "users" datas
SOURCE demo/users.sql;

-- create "administrators" datas
SOURCE demo/administrators.sql;

-- create "managers" datas
SOURCE demo/managers.sql;

-- create "messages" datas
SOURCE demo/messages.sql;

-- create "bookings" datas
SOURCE demo/bookings.sql;
