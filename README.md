# php-local
This a learning repository for me to learn the syntax, features and do's and dont's of PHP.

You have to specify the following env variables:

- PHP_LOCAL_DB_HOST
- PHP_LOCAL_DB_USER
- PHP_LOCAL_DB_PASSWORD
- PHP_LOCAL_DB_NAME

The schema is not auto created yet. This app will need the following table:

| |	Name        |	Type         | Collation	        | Attributes | Null |	Default           |	Comments | Extra             |
|-|-------------|--------------|--------------------|------------|------|-------------------|----------|-------------------|
|1|	id          |	int(11)      |         	          |            | No   | None              |		       | AUTO_INCREMENT    |
|2|	title       |	varchar(255) | utf8mb4_general_ci |            | No	  | None              |		       |                   |
|3|	body        |	text         | utf8mb4_general_ci |            | No		|	                  |          |                   |
|4|	create_date | timestamp		 | 	                  |            | No   | CURRENT_TIMESTAMP	|	         | DEFAULT_GENERATED |

## My disclaimer
Be warned this is only a learning project. All code residing in this project and or repo is my attempt to learn 
how to build websites with OOP and PHP and database persistence.  
So it is possible that some code maybe not best practice or standard. 

