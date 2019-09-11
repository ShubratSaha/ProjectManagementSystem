# ProjectManagementSystem
This project was designed to develop REST APIs using PHP which serve as a backend for a front end for handling projects of an organization. The project is then deployed in the Amazon EC2 instance.

# Steps to execute the project:
1. Install Postman from https://www.getpostman.com/downloads/.
2. Signin to AWS Management Console.
3. Create an Amazon Linux 2018 EC2 instance. Enable the ports for HTTP and HTTPS protocol. Install httpd24, php70, mysql56-server and php70-mysqlnd.
4. Install phpMyAdmin inside the /var/www/html.
5. Move this project to /var/www/html using FileZilla or WinSCP.
6. Create a database 'project_mgmt_system'. Import the SQL File using phpMyAdmin.
7. Change the UserName and Password as per your MySQL in the Database.php file inside config folder.
8. Use the IP Address of the EC2 instance to open the phpMyAdmin and make API requests using Postman application.
