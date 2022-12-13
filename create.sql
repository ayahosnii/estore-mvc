CREATE DATABASE estore CHARACTER SET utf8 COLLATE utf8_general_ci;
use estore;

CREATE TABLE app_users (
                           UserId INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                           Username VARCHAR(12) NOT NULL ,
                           Password CHAR(60) NOT NULL ,
                           Email VARCHAR(40) NOT NULL ,
                           PhoneNumber VARCHAR(15),
                           SubscriptionDate DATE NOT NULL ,
                           LastLogin DATETIME NOT NULL ,
                           Privilege TINYINT NOT NULL
);

ALTER TABLE app_users MODIFY Username VARCHAR(12) NOT NULL UNIQUE ;
ALTER TABLE app_users MODIFY Email VARCHAR(40) NOT NULL UNIQUE ;

DESCRIBE app_users;

CREATE TABLE app_users_profiles (
                                    UserId INT UNSIGNED NOT NULL ,
                                    FirstName VARCHAR(10) NOT NULL ,
                                    LastName VARCHAR(10) NOT NULL ,
                                    Address VARCHAR(50),
                                    DOB DATE,
                                    Image VARCHAR(30),
                                    FOREIGN KEY (UserId) REFERENCES app_users (UserId)
);

DESCRIBE app_users_profiles;

CREATE TABLE app_users_groups (
                                  GroupId TINYINT(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                  GroupName VARCHAR(20) NOT NULL
);

ALTER TABLE app_users CHANGE Privilege GroupId TINYINT(1) NOT NULL ;

DESCRIBE app_users_groups;

CREATE TABLE app_users_groups_privileges (
                                             PrivilegeId TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                             GroupId TINYINT(1) UNSIGNED NOT NULL ,
                                             Privilege VARCHAR(30) NOT NULL
);

ALTER TABLE app_users_groups_privileges MODIFY GroupId TINYINT(1) NOT NULL;
ALTER TABLE app_users_groups_privileges ADD FOREIGN KEY(GroupId) REFERENCES app_users_groups(GroupId);
ALTER TABLE app_users ADD FOREIGN KEY(GroupId) REFERENCES app_users_groups(GroupId);
DESCRIBE app_users_profiles;
ALTER TABLE app_users_profiles ADD FOREIGN KEY(UserId) REFERENCES app_users(UserId);
SHOW TABLES;
DESCRIBE app_users_groups;
#ALTER TABLE app_users_groups MODIFY GroupId DROP ;
SHOW CREATE TABLE app_users;
SHOW CREATE TABLE app_users_groups_privileges;
ALTER TABLE app_users DROP FOREIGN KEY app_users_ibfk_1;
ALTER TABLE app_users_groups_privileges DROP FOREIGN KEY app_users_groups_privileges_ibfk_1;
ALTER TABLE app_users_groups DROP GroupId;
DESCRIBE app_users_groups;
ALTER TABLE app_users_groups ADD GroupId tinyint(1) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST ;
DESCRIBE app_users_groups;
ALTER TABLE app_users MODIFY GroupId TINYINT(1) UNSIGNED NOT NULL ;
ALTER TABLE app_users_groups_privileges MODIFY GroupId TINYINT(1) UNSIGNED NOT NULL ;
SHOW CREATE TABLE app_users_groups_privileges;
ALTER TABLE app_users_groups_privileges DROP KEY GroupId;
RENAME TABLE app_users_groups_privileges TO app_users_privileges;
alter table app_users_privileges drop GroupId;
create table app_users_groups_privileges(
                                            id tinyint(3) unsigned not null primary key auto_increment,
                                            GroupId tinyint(1) unsigned not null ,
                                            PrivilegeId tinyint(3) unsigned not null ,
                                            foreign key (GroupId) references  app_users_groups(GroupId) ,
                                            foreign key (PrivilegeId) references  app_users_privileges(PrivilegeId)
);

show create table app_users_profiles;
describe app_users;

alter table app_users_profiles drop foreign key app_users_profiles_ibfk_2;
alter table app_users drop key GroupId;
alter table app_users ADD FOREIGN KEY (GroupId) REFERENCES app_users_groups (GroupId);